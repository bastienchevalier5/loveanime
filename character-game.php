<?php
    session_start();
    include 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoveAniGuessr - Character Mode</title>
    <link rel="stylesheet" href="/aniguessr/aniguessr.css">
</head>
<body>
    <div class="header">
        <div class="logo"><a href="/aniguessr">LoveAniGuessr</a></div>
    </div>
    <div id="gameScreen" class="game-screen">
        <div class="game-interface">
            <h1 class="game-main-title">GUESS THE CHARACTER</h1>
            <div class="round-info">
                <span class="round-title">Round <span id="roundNumber">1</span></span>
            </div>

            <div id="characterInterface">
                <div id="summaryPoints" class="score-value">0 pts</div>
                <div class="characters-grid" id="charactersGrid">
                    <!-- Les personnages seront chargés ici -->
                </div>
                <button id="guessCharacterBtn" class="guess-btn" onclick="submitCharacterGuess()">GUESS</button>
                <button onclick="goToMenu()" id="menuBtn" class="menu-btn" type="button" style="display:none">Back to Menu</button>
            </div>
        </div>
    </div>

    <div id="finalScoreScreen" class="final-score-screen" style="display:none;">
        <div class="final-score-container">
            <h1 class="game-main-title">GUESS THE CHARACTER</h1>
            <h1 class="final-score-title">Final Score</h1>

            <div class="total-score-card">
                <div class="total-score-value" id="finalTotalScore">0</div>
            </div>

            <div class="rounds-summary" id="roundsSummaryList">
                <!-- Les rounds seront ajoutés dynamiquement ici -->
            </div>

            <button onclick="goToMenu()" class="menu-btn">Back to Menu</button>
        </div>
    </div>


    <script>
        // Récupération des données depuis menu.php
        let characterDatabase = <?php echo json_encode($characters); ?>;

        let gameState = {
            currentRound: 1,
            currentAnime: null,
            currentCharacters: [],
            correctCharacters: [],
            correctAnimes: [],
            cluesUsed: [],
            roundResults: [],
            answered: false,
            scores: {
                screenshot: parseInt(localStorage.getItem('screenshotScore') || '0'),
                character: parseInt(localStorage.getItem('characterScore') || '0'),
                opening: parseInt(localStorage.getItem('openingScore') || '0')
            },
            mode: 'character',
            charactersAnswered: 0,
        };

        // Récupère le nombre de rounds depuis l'URL
        const pathParts = window.location.pathname.split('/').filter(Boolean);

        // Récupérer le dernier segment comme rounds
        const rounds = pathParts[pathParts.length - 1];
        gameState.maxRounds = rounds ? parseInt(rounds) : 3;

        const POINTS = {
            characterCorrect: 2000, // 5000 / 4 personnages
            characterIncorrect: 0,
            animeCorrect: 500,
            animeIncorrect: 0
        };

        function startNewRound() {
            const guess = document.getElementById("guessCharacterBtn");

            gameState.answered = false;

            document.getElementById('roundNumber').textContent = gameState.currentRound;

            // Réinitialise le bouton "GUESS"
            guess.textContent = "GUESS";
            guess.onclick = submitCharacterGuess;

            initProgressBar("gameScreen");
            startCharacterRound();
        }


        function startCharacterRound() {
            document.getElementById('summaryPoints').style.display = 'none';
            const MAX_COOLDOWN = 10;
            let recentCharacters = JSON.parse(localStorage.getItem('recentCharacters') || '[]');

            function getRandomCharacters() {
                // Filtre les personnages qui ne sont pas dans la liste des récents
                const availableCharacters = characterDatabase.filter(char => 
                    !recentCharacters.some(recentChar => 
                        recentChar.name === char.name && recentChar.anime === char.anime
                    )
                );

                let chosenCharacters;
                
                if (availableCharacters.length >= 4) {
                    // Sélectionne 4 personnages aléatoires parmi les disponibles
                    const shuffled = availableCharacters.sort(() => Math.random() - 0.5);
                    chosenCharacters = shuffled.slice(0, 4);
                } else {
                    // Si pas assez de personnages disponibles, prend tout ce qui est disponible
                    // et complète avec des personnages aléatoires
                    const shuffled = [...characterDatabase].sort(() => Math.random() - 0.5);
                    chosenCharacters = shuffled.slice(0, 4);
                }

                // Ajoute les personnages choisis à la liste des récents
                chosenCharacters.forEach(char => {
                    recentCharacters.push({name: char.name, anime: char.anime});
                });

                // Maintient la taille de la liste des récents
                if (recentCharacters.length > MAX_COOLDOWN) {
                    recentCharacters = recentCharacters.slice(-MAX_COOLDOWN);
                }

                localStorage.setItem('recentCharacters', JSON.stringify(recentCharacters));
                return chosenCharacters;
            }

            gameState.currentCharacters = getRandomCharacters();
            gameState.correctCharacters = [...gameState.currentCharacters];
            displayCharacters();
        }

        function displayCharacters() {
            const grid = document.getElementById('charactersGrid');
            grid.innerHTML = '';
            gameState.currentCharacters.forEach((character, index) => {
                const card = document.createElement('div');
                card.className = 'character-card';
                card.dataset.index = index;

                const anonymousImageUrl = generateAnonymousImageUrl(character.id);

                card.innerHTML = `
                    <img src="/aniguessr/${anonymousImageUrl}" alt="Character" class="character-image">
                    <div class="character-info">
                        <div class="character-input-container">
                            <input type="text" class="character-name-input" placeholder="Nom du personnage" data-type="name" data-index="${index}">
                            <div class="character-autocomplete-dropdown" id="charDropdown${index}"></div>
                        </div>
                        <span id="errorCharacter${index}" style="color: red; font-size: 12px; display: none;">Please select a suggested character</span>
                        
                        <div class="anime-input-container">
                            <input type="text" class="anime-name-input" placeholder="Titre de l'animé" data-type="anime" data-index="${index}">
                            <div class="anime-autocomplete-dropdown" id="animeDropdown${index}"></div>
                        </div>
                        <span id="errorAnime${index}" style="color: red; font-size: 12px; display: none;">Please select a suggested anime</span>

                        <div class="character-name-display">
                            <span></span>
                            <div class="result-icon" id="nameIcon${index}"></div>
                        </div>
                        <div class="anime-name-display">
                            <span></span>
                            <div class="result-icon" id="animeIcon${index}"></div>
                        </div>
                    </div>
                `;

                grid.appendChild(card);
            });

            document.querySelectorAll('.character-name-input').forEach(input => {
                setupCharacterAutocomplete(input);
            });

            document.querySelectorAll('.anime-name-input').forEach(input => {
                setupAnimeAutocomplete(input);
            });
        }

        function generateAnonymousImageUrl(imageId) {
            const timestamp = Date.now();
            return `character-image.php?id=${encodeURIComponent(imageId)}&t=${timestamp}`;
        }



        function setupCharacterAutocomplete(input) {
            const index = input.dataset.index;
            const dropdown = document.getElementById(`charDropdown${index}`);
            const allCharacterNames = [...new Set(characterDatabase.map(char => char.name))];
            let selectedIndex = -1;

            input.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                
                // Reset du style du champ
                this.style.borderColor = '#555';
                this.style.backgroundColor = '#333';
                
                if (query.length === 0) {
                    dropdown.style.display = 'none';
                    selectedIndex = -1;
                    return;
                }

                function normalizeString(str) {
                    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                }

                const filtered = allCharacterNames
                    .filter(name => normalizeString(name).includes(normalizeString(query)))
                    .sort((a, b) => {
                        const aStarts = normalizeString(a).startsWith(normalizeString(query));
                        const bStarts = normalizeString(b).startsWith(normalizeString(query));
                        if (aStarts && !bStarts) return -1;
                        if (!aStarts && bStarts) return 1;
                        return a.localeCompare(b);
                    })
                    .slice(0);

                if (filtered.length === 0) {
                    dropdown.style.display = 'none';
                    selectedIndex = -1;
                    return;
                }

                dropdown.innerHTML = '';
                filtered.forEach((name, idx) => {
                    const item = document.createElement('div');
                    item.className = 'character-autocomplete-item';
                    item.textContent = name;
                    item.addEventListener('click', () => {
                        input.value = name;
                        dropdown.style.display = 'none';
                        selectedIndex = -1;
                    });
                    dropdown.appendChild(item);
                });

                dropdown.style.display = 'block';
            });

            input.addEventListener('keydown', function(e) {
                const items = dropdown.querySelectorAll('.character-autocomplete-item');
                if (items.length === 0) return;

                switch (e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        selectedIndex++;
                        if (selectedIndex >= items.length) selectedIndex = items.length - 1;
                        updateSelection(items);
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        selectedIndex--;
                        if (selectedIndex < 0) selectedIndex = -1;
                        updateSelection(items);
                        break;
                    case 'Enter':
                        e.preventDefault();
                        if (selectedIndex >= 0) {
                            input.value = items[selectedIndex].textContent;
                            dropdown.style.display = 'none';
                            selectedIndex = -1;
                        } else {
                            submitCharacterGuess();
                        }
                        break;
                    case 'Escape':
                        dropdown.style.display = 'none';
                        selectedIndex = -1;
                        break;
                }
            });

            input.addEventListener('blur', function() {
                setTimeout(() => {
                    dropdown.style.display = 'none';
                    selectedIndex = -1;
                }, 150);
            });

            function updateSelection(items) {
                items.forEach((item, i) => {
                    item.classList.toggle('selected', i === selectedIndex);
                });
            }
        }


        function setupAnimeAutocomplete(input) {
            const index = input.dataset.index;
            const dropdown = document.getElementById(`animeDropdown${index}`);
            const allAnimeNames = [...new Set(characterDatabase.map(char => char.anime))];
            let selectedIndex = -1;

            input.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                
                // Reset du style du champ
                this.style.borderColor = '#555';
                this.style.backgroundColor = '#333';
                
                if (query.length === 0) {
                    dropdown.style.display = 'none';
                    selectedIndex = -1;
                    return;
                }

                const filtered = allAnimeNames
                    .filter(name => name.toLowerCase().includes(query))
                    .sort((a, b) => {
                        const aStarts = a.toLowerCase().startsWith(query);
                        const bStarts = b.toLowerCase().startsWith(query);
                        if (aStarts && !bStarts) return -1;
                        if (!aStarts && bStarts) return 1;
                        return a.localeCompare(b);
                    })
                    .slice(0);

                if (filtered.length === 0) {
                    dropdown.style.display = 'none';
                    selectedIndex = -1;
                    return;
                }

                dropdown.innerHTML = '';
                filtered.forEach((name, idx) => {
                    const item = document.createElement('div');
                    item.className = 'anime-autocomplete-item';
                    item.textContent = name;
                    item.addEventListener('click', () => {
                        input.value = name;
                        dropdown.style.display = 'none';
                        selectedIndex = -1;
                    });
                    dropdown.appendChild(item);
                });

                dropdown.style.display = 'block';
            });

            input.addEventListener('keydown', function(e) {
                const items = dropdown.querySelectorAll('.anime-autocomplete-item');
                if (items.length === 0) return;

                switch (e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        selectedIndex++;
                        if (selectedIndex >= items.length) selectedIndex = items.length - 1;
                        updateSelection(items);
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        selectedIndex--;
                        if (selectedIndex < 0) selectedIndex = -1;
                        updateSelection(items);
                        break;
                    case 'Enter':
                        e.preventDefault();
                        if (selectedIndex >= 0) {
                            input.value = items[selectedIndex].textContent;
                            dropdown.style.display = 'none';
                            selectedIndex = -1;
                        } else {
                            submitCharacterGuess();
                        }
                        break;
                    case 'Escape':
                        dropdown.style.display = 'none';
                        selectedIndex = -1;
                        break;
                }
            });

            input.addEventListener('blur', function() {
                setTimeout(() => {
                    dropdown.style.display = 'none';
                    selectedIndex = -1;
                }, 150);
            });

            function updateSelection(items) {
                items.forEach((item, i) => {
                    item.classList.toggle('selected', i === selectedIndex);
                });
            }
        }


        function submitCharacterGuess() {
            if (gameState.answered) return;

            // Masquer les messages d'erreur
            document.querySelectorAll('[id^="errorCharacter"], [id^="errorAnime"]').forEach(error => {
                error.style.display = 'none';
            });

            const summaryPoints = document.getElementById('summaryPoints');
            summaryPoints.style.display = 'inline-block';

            document.getElementById('menuBtn').style.display = 'block';

            let allValid = true;
            const allCharacterNames = [...new Set(characterDatabase.map(char => char.name))];
            const allAnimeNames = [...new Set(characterDatabase.map(char => char.anime))];

            // Vérification des inputs
            document.querySelectorAll('.character-card').forEach((card, index) => {
                const nameInput = card.querySelector('.character-name-input');
                const animeInput = card.querySelector('.anime-name-input');
                const errorCharacter = document.getElementById(`errorCharacter${index}`);
                const errorAnime = document.getElementById(`errorAnime${index}`);

                const nameValue = nameInput.value.trim();
                const animeValue = animeInput.value.trim();

                // Si le joueur a saisi un nom qui n'est pas dans la liste → erreur
                if (nameValue && !allCharacterNames.some(name => name.toLowerCase() === nameValue.toLowerCase())) {
                    errorCharacter.style.display = 'block';
                    allValid = false;
                }

                // Idem pour l’anime
                if (animeValue && !allAnimeNames.some(name => name.toLowerCase() === animeValue.toLowerCase())) {
                    errorAnime.style.display = 'block';
                    allValid = false;
                }
            });

            if (!allValid) return; // Stop si erreurs

            gameState.answered = true;
            let totalPoints = 0;
            const guess = document.getElementById('guessCharacterBtn');

            const correctCharacters = [];
            const correctAnimes = [];

            document.querySelectorAll('.character-card').forEach((card, index) => {
                const character = gameState.currentCharacters[index];
                const nameInput = card.querySelector('.character-name-input');
                const animeInput = card.querySelector('.anime-name-input');
                const nameDisplay = card.querySelector('.character-name-display');
                const animeDisplay = card.querySelector('.anime-name-display');
                const nameIcon = document.getElementById(`nameIcon${index}`);
                const animeIcon = document.getElementById(`animeIcon${index}`);
                card.id = `characterCard${index}`;

                // On cache les champs et on montre les résultats
                nameInput.style.display = 'none';
                animeInput.style.display = 'none';
                nameDisplay.style.display = 'block';
                animeDisplay.style.display = 'block';
                nameDisplay.querySelector("span").textContent = character.name;
                animeDisplay.querySelector("span").textContent = character.anime;


                // Vérifie si le nom est correct
                const nameCorrect = nameInput.value.trim().toLowerCase() === character.name.toLowerCase();

                // Vérifie si l’anime est correct
                const allAnimesForCharacter = characterDatabase
                    .filter(c => c.name.toLowerCase() === character.name.toLowerCase())
                    .map(c => c.anime.toLowerCase());

                const animeCorrect = allAnimesForCharacter.includes(animeInput.value.trim().toLowerCase());

                // On stocke séparément les résultats
                correctCharacters.push(nameCorrect);
                correctAnimes.push(animeCorrect);

                // Points pour le nom
                if (nameCorrect) {
                    nameIcon.textContent = '✓';
                    nameIcon.className = 'result-icon correct';
                    totalPoints += 2000;
                } else {
                    nameIcon.textContent = '✗';
                    nameIcon.className = 'result-icon incorrect';
                }

                // Points pour l’anime
                if (animeCorrect) {
                    animeIcon.textContent = '✓';
                    animeIcon.className = 'result-icon correct';
                    totalPoints += 500;
                    animeDisplay.querySelector('span').textContent = animeInput.value;
                } else {
                    animeIcon.textContent = '✗';
                    animeIcon.className = 'result-icon incorrect';
                }

                // Mise en couleur de la carte
                if (nameCorrect && animeCorrect) {
                    card.classList.add('correct');
                    launchConfettiOnElement(card.id);
                } else if (nameCorrect || animeCorrect) {
                    card.classList.add('partial');
                    card.classList.add('shake');
                    setTimeout(() => card.classList.remove('shake'), 650);
                } else {
                    card.classList.add('incorrect');
                    card.classList.add('shake');
                    setTimeout(() => card.classList.remove('shake'), 650);
                }
            });

            // Affiche le score du round
            summaryPoints.textContent = totalPoints + ' pts';

            // Met à jour le score global
            gameState.scores.character += totalPoints;
            localStorage.setItem('characterScore', gameState.scores.character);

            const allCharactersCorrect = correctCharacters.every(val => val === true);
            const allAnimesCorrect = correctAnimes.every(val => val === true);

            let status;
            if (allCharactersCorrect && allAnimesCorrect) {
                status = "correct";   // tout bon
            } else if (correctCharacters.some(v => v) || correctAnimes.some(v => v)) {
                status = "partial";   // au moins un bon
            } else {
                status = "incorrect"; // tout faux
            }



            // Sauvegarde du round
            gameState.roundResults.push({
                round: gameState.currentRound,
                characters: [...gameState.currentCharacters],
                correctCharacters: correctCharacters,
                correctAnimes: correctAnimes,
                status: status,
                points: totalPoints,
                mode: 'character'
            });

            updateProgressBar();

            // Bouton pour round suivant ou score final
            guess.disabled = true;
            setTimeout(() => {
                if (gameState.currentRound >= gameState.maxRounds) {
                    guess.textContent = 'SCORE FINAL →';
                    guess.onclick = showFinalScore;
                } else {
                    guess.textContent = 'PROCHAIN ROUND →';
                    guess.onclick = nextRound;
                }
                guess.disabled = false;
            }, 500);

            initProgressBar("summaryScreen");
        }





        function nextRound() {
            if (gameState.currentRound >= gameState.maxRounds) {
                showFinalScore();
                return;
            }

            gameState.currentRound++;
            gameState.answered = false; // Réinitialise l'état "answered"
            startNewRound();
        }


        function showFinalScore() {
            const finalScreen = document.getElementById('finalScoreScreen');
            const gameScreen = document.getElementById('gameScreen');
            if (window.innerWidth <= 768) { 
                // On considère <= 768px comme mobile
                finalScreen.style.display = 'block';
            } else {
                finalScreen.style.display = 'flex';
            }

            gameScreen.style.display = 'none';


            // Calcule le score total
            const totalScore = gameState.roundResults.reduce((sum, result) => sum + result.points, 0);
            document.getElementById('finalTotalScore').textContent = totalScore + ' pts';

            // Affiche les rounds
            const roundsList = document.getElementById('roundsSummaryList');
            roundsList.innerHTML = '';

            gameState.roundResults.forEach((result, roundIndex) => {
                const roundDiv = document.createElement('div');
                roundDiv.className = 'round-item';

                // Header du round
                const roundHeader = document.createElement('div');
                roundHeader.className = 'round-header';
                roundHeader.innerHTML = `
                    <div class="round-title">Round ${roundIndex + 1}</div>
                    <div class="round-score-section">
                        <div class="score-value">${result.points} pts</div>
                    </div>
                `;

                // Grille des personnages
                const characterGrid = document.createElement('div');
                characterGrid.className = 'character-grid';

                result.characters.forEach((character, charIndex) => {
                    const characterItem = document.createElement('div');
                    characterItem.className = 'character-item';

                    // Détermine si la réponse est correcte
                    const isCorrectCharacter = result.correctCharacters[charIndex];
                    const correctClassCharacter = isCorrectCharacter ? 'correct' : 'incorrect';
                    const anonymousImageUrl = generateAnonymousImageUrl(character.id);
                    const isCorrectAnime= result.correctAnimes[charIndex];
                    const correctClassAnime = isCorrectAnime? 'correct' : 'incorrect';

                    characterItem.innerHTML = `
                        <img src="/aniguessr/${anonymousImageUrl}" alt="${character.name}">
                        <div class="character-name ${correctClassCharacter}">
                            ${character.name}
                        </div>
                        <div class="character-anime ${correctClassAnime}">
                            ${character.anime}
                        </div>
                    `;
                    characterGrid.appendChild(characterItem);
                });

                roundDiv.appendChild(roundHeader);
                roundDiv.appendChild(characterGrid);
                roundsList.appendChild(roundDiv);
            });
            initProgressBar("finalScoreScreen");
        }

    function goToMenu() {
        window.location.href = "/aniguessr";
    }


        // Démarrage du jeu
        document.addEventListener('DOMContentLoaded', function() {
            startNewRound();
        });
    </script>
</body>
</html>
