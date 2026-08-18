<?php
    session_start();
    include 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoveAniGuessr — Personnages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/loveanime.css">
    <link rel="stylesheet" href="/aniguessr/aniguessr.css">
</head>
<body>

    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
    </header>

    <div id="gameScreen" class="game-screen">
        <div class="game-interface">
            <h1 class="game-main-title"><i class="fa-solid fa-user"></i> GUESS THE CHARACTER</h1>
            <div class="round-info">
                <span class="round-title">Round <span id="roundNumber">1</span></span>
            </div>

            <div id="characterInterface">
                <div id="summaryPoints" class="score-value" style="display:none; margin: 1rem auto;">0 pts</div>
                <div class="characters-grid" id="charactersGrid"></div>
                <button id="guessCharacterBtn" class="guess-btn" onclick="submitCharacterGuess()">VALIDER</button>
                <button onclick="goToMenu()" id="menuBtn" class="menu-btn" style="display:none">← Revenir au menu</button>
            </div>
        </div>
    </div>

    <!-- FINAL SCORE -->
    <div id="finalScoreScreen" class="final-score-screen" style="display:none;">
        <div class="final-score-container">
            <h1 class="game-main-title"><i class="fa-solid fa-user"></i> GUESS THE CHARACTER</h1>
            <h1 class="final-score-title">Score Final</h1>
            <div class="total-score-card">
                <div class="total-score-value" id="finalTotalScore">0</div>
            </div>
            <div class="rounds-summary" id="roundsSummaryList"></div>
            <button onclick="goToMenu()" class="menu-btn">← Revenir au menu</button>
        </div>
    </div>

    <script>
        let characterDatabase = <?php echo json_encode($characters); ?>;

        let gameState = {
            currentRound: 1,
            currentCharacters: [],
            answered: false,
            scores: { character: parseInt(localStorage.getItem('characterScore') || '0') },
            mode: 'character',
            roundResults: []
        };

        const pathParts = window.location.pathname.split('/').filter(Boolean);
        gameState.maxRounds = parseInt(pathParts[pathParts.length - 1]) || 3;

        const POINTS = { characterCorrect: 2000, animeCorrect: 500 };

        function startNewRound() {
            gameState.answered = false;
            document.getElementById('roundNumber').textContent = gameState.currentRound;
            const guess = document.getElementById('guessCharacterBtn');
            guess.textContent = 'VALIDER';
            guess.onclick = submitCharacterGuess;
            initProgressBar("gameScreen");
            startCharacterRound();
        }

        function startCharacterRound() {
            document.getElementById('summaryPoints').style.display = 'none';
            const MAX_COOLDOWN = 10;
            let recentCharacters = JSON.parse(localStorage.getItem('recentCharacters') || '[]');

            function getRandomCharacters() {
                const available = characterDatabase.filter(c =>
                    !recentCharacters.some(r => r.name === c.name && r.anime === c.anime)
                );
                const pool = available.length >= 4 ? available : characterDatabase;
                const shuffled = [...pool].sort(() => Math.random() - 0.5);
                const chosen = shuffled.slice(0, 4);
                chosen.forEach(c => recentCharacters.push({ name: c.name, anime: c.anime }));
                if (recentCharacters.length > MAX_COOLDOWN) recentCharacters = recentCharacters.slice(-MAX_COOLDOWN);
                localStorage.setItem('recentCharacters', JSON.stringify(recentCharacters));
                return chosen;
            }

            gameState.currentCharacters = getRandomCharacters();
            displayCharacters();
        }

        function displayCharacters() {
            const grid = document.getElementById('charactersGrid');
            grid.innerHTML = '';
            gameState.currentCharacters.forEach((character, index) => {
                const card = document.createElement('div');
                card.className = 'character-card';
                card.dataset.index = index;
                card.innerHTML = `
                    <img src="/aniguessr/${generateAnonymousImageUrl(character.id)}" alt="Personnage" class="character-image">
                    <div class="character-info">
                        <div class="character-input-container">
                            <input type="text" class="character-name-input" placeholder="Nom du personnage" data-type="name" data-index="${index}">
                            <div class="character-autocomplete-dropdown" id="charDropdown${index}"></div>
                        </div>
                        <span id="errorCharacter${index}" style="color:#ff6b7a; font-size:12px; display:none;">Sélectinonner un personnage suggéré</span>
                        <div class="anime-input-container">
                            <input type="text" class="anime-name-input" placeholder="Titre de l'animé" data-type="anime" data-index="${index}">
                            <div class="anime-autocomplete-dropdown" id="animeDropdown${index}"></div>
                        </div>
                        <span id="errorAnime${index}" style="color:#ff6b7a; font-size:12px; display:none;">Sélectionner un animé suggéré</span>
                        <div class="character-name-display"><span></span><div class="result-icon" id="nameIcon${index}"></div></div>
                        <div class="anime-name-display"><span></span><div class="result-icon" id="animeIcon${index}"></div></div>
                    </div>
                `;
                grid.appendChild(card);
            });

            document.querySelectorAll('.character-name-input').forEach(setupCharacterAutocomplete);
            document.querySelectorAll('.anime-name-input').forEach(setupAnimeAutocomplete);
        }

        function generateAnonymousImageUrl(id) {
            return `character-image.php?id=${encodeURIComponent(id)}&t=${Date.now()}`;
        }

        function setupCharacterAutocomplete(input) {
    const index = input.dataset.index;
    const dropdown = document.getElementById(`charDropdown${index}`);
    const allNames = [...new Set(characterDatabase.map(c => c.name))];
    let state = { index: -1 };

    input.addEventListener('input', function() {
        state.index = -1;
        const q = this.value.trim().toLowerCase();
        if (!q) { dropdown.style.display = 'none'; return; }
        const normalize = s => s.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        const filtered = allNames.filter(n => normalize(n).includes(normalize(q)))
            .sort((a, b) => normalize(a).startsWith(normalize(q)) ? -1 : normalize(b).startsWith(normalize(q)) ? 1 : a.localeCompare(b));
        if (!filtered.length) { dropdown.style.display = 'none'; return; }
        
        dropdown.innerHTML = filtered.map(n => `<div class="character-autocomplete-item">${n}</div>`).join('');
        dropdown.querySelectorAll('.character-autocomplete-item').forEach(item => {
            item.addEventListener('click', () => { 
                input.value = item.textContent; 
                dropdown.style.display = 'none'; 
                state.index = -1; // Synchronisation de l'état ici
            });
        });
        dropdown.style.display = 'block';
    });

    input.addEventListener('keydown', e => handleDropdownKey(e, input, dropdown, state, submitCharacterGuess));
    input.addEventListener('blur', () => setTimeout(() => { dropdown.style.display = 'none'; state.index = -1; }, 150));
}

function setupAnimeAutocomplete(input) {
    const index = input.dataset.index;
    const dropdown = document.getElementById(`animeDropdown${index}`);
    const allNames = [...new Set(characterDatabase.map(c => c.anime))];
    let state = { index: -1 };

    input.addEventListener('input', function() {
        state.index = -1;
        const q = this.value.trim().toLowerCase();
        if (!q) { dropdown.style.display = 'none'; return; }
        
        // Ajout de la normalisation pour une recherche plus souple sur les animés (ex: gérant les accents)
        const normalize = s => s.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        const filtered = allNames.filter(n => normalize(n).includes(normalize(q)))
            .sort((a, b) => normalize(a).startsWith(normalize(q)) ? -1 : normalize(b).startsWith(normalize(q)) ? 1 : a.localeCompare(b));
        if (!filtered.length) { dropdown.style.display = 'none'; return; }
        
        dropdown.innerHTML = filtered.map(n => `<div class="anime-autocomplete-item">${n}</div>`).join('');
        dropdown.querySelectorAll('.anime-autocomplete-item').forEach(item => {
            item.addEventListener('click', () => { 
                input.value = item.textContent; 
                dropdown.style.display = 'none'; 
                state.index = -1; // Synchronisation de l'état ici
            });
        });
        dropdown.style.display = 'block';
    });

    input.addEventListener('keydown', e => handleDropdownKey(e, input, dropdown, state, submitCharacterGuess));
    input.addEventListener('blur', () => setTimeout(() => { dropdown.style.display = 'none'; state.index = -1; }, 150));
}

function handleDropdownKey(e, input, dropdown, stateObj, fallback) {
    // Ciblage explicite de tes deux classes de suggestions
    const items = dropdown.querySelectorAll('.character-autocomplete-item, .anime-autocomplete-item');
    if (!items.length) return;

    const updateSelection = (elements) => {
        elements.forEach((item, i) => {
            item.classList.toggle('selected', i === stateObj.index);
        });
    };

    switch (e.key) {
        case 'ArrowDown':
            e.preventDefault();
            stateObj.index++;
            if (stateObj.index >= items.length) stateObj.index = items.length - 1;
            updateSelection(items);
            break;
            
        case 'ArrowUp':
            e.preventDefault();
            stateObj.index--;
            if (stateObj.index < 0) stateObj.index = -1;
            updateSelection(items);
            break;
            
        case 'Enter':
            e.preventDefault();
            // Sécurité : on vérifie que l'index est valide ET que l'élément existe
            if (stateObj.index >= 0 && items[stateObj.index]) {
                input.value = items[stateObj.index].textContent;
                dropdown.style.display = 'none';
                stateObj.index = -1;
            } else {
                dropdown.style.display = 'none'; // Ferme le menu par sécurité
                fallback(); // Valide le bloc (submitCharacterGuess)
            }
            break;
            
        case 'Escape':
            dropdown.style.display = 'none';
            stateObj.index = -1;
            break;
    }
}

        function submitCharacterGuess() {
            if (gameState.answered) return;

            document.querySelectorAll('[id^="errorCharacter"], [id^="errorAnime"]').forEach(e => e.style.display = 'none');

            const allCharacterNames = [...new Set(characterDatabase.map(c => c.name))];
            const allAnimeNames = [...new Set(characterDatabase.map(c => c.anime))];
            let allValid = true;

            document.querySelectorAll('.character-card').forEach((card, index) => {
                const nameVal = card.querySelector('.character-name-input').value.trim();
                const animeVal = card.querySelector('.anime-name-input').value.trim();
                if (nameVal && !allCharacterNames.some(n => n.toLowerCase() === nameVal.toLowerCase())) {
                    document.getElementById(`errorCharacter${index}`).style.display = 'block';
                    allValid = false;
                }
                if (animeVal && !allAnimeNames.some(n => n.toLowerCase() === animeVal.toLowerCase())) {
                    document.getElementById(`errorAnime${index}`).style.display = 'block';
                    allValid = false;
                }
            });

            if (!allValid) return;
            gameState.answered = true;

            const summaryPoints = document.getElementById('summaryPoints');
            summaryPoints.style.display = 'inline-block';
            document.getElementById('menuBtn').style.display = 'block';

            let totalPoints = 0;
            const correctCharacters = [], correctAnimes = [];

            document.querySelectorAll('.character-card').forEach((card, index) => {
                const character = gameState.currentCharacters[index];
                const nameInput = card.querySelector('.character-name-input');
                const animeInput = card.querySelector('.anime-name-input');
                const nameDisplay = card.querySelector('.character-name-display');
                const animeDisplay = card.querySelector('.anime-name-display');

                nameInput.style.display = 'none';
                animeInput.style.display = 'none';
                nameDisplay.style.display = 'block';
                animeDisplay.style.display = 'block';
                nameDisplay.querySelector('span').textContent = character.name;
                animeDisplay.querySelector('span').textContent = character.anime;

                const nameCorrect = nameInput.value.trim().toLowerCase() === character.name.toLowerCase();
                const allAnimesForChar = characterDatabase.filter(c => c.name.toLowerCase() === character.name.toLowerCase()).map(c => c.anime.toLowerCase());
                const animeCorrect = allAnimesForChar.includes(animeInput.value.trim().toLowerCase());

                correctCharacters.push(nameCorrect);
                correctAnimes.push(animeCorrect);

                const nameIcon = document.getElementById(`nameIcon${index}`);
                const animeIcon = document.getElementById(`animeIcon${index}`);

                nameIcon.textContent = nameCorrect ? '✓' : '✗';
                nameIcon.className = `result-icon ${nameCorrect ? 'correct' : 'incorrect'}`;
                if (nameCorrect) totalPoints += 2000;

                animeIcon.textContent = animeCorrect ? '✓' : '✗';
                animeIcon.className = `result-icon ${animeCorrect ? 'correct' : 'incorrect'}`;
                if (animeCorrect) totalPoints += 500;
                if (animeCorrect) animeDisplay.querySelector('span').textContent = animeInput.value;

                card.classList.add(nameCorrect && animeCorrect ? 'correct' : (nameCorrect || animeCorrect ? 'partial' : 'incorrect'));
                if (!nameCorrect || !animeCorrect) {
                    card.classList.add('shake');
                    setTimeout(() => card.classList.remove('shake'), 650);
                } else {
                    card.id = `characterCard${index}`;
                    launchConfettiOnElement(card.id);
                }
            });

            summaryPoints.textContent = totalPoints + ' pts';
            gameState.scores.character += totalPoints;
            localStorage.setItem('characterScore', gameState.scores.character);

            const allOk = correctCharacters.every(v => v) && correctAnimes.every(v => v);
            const someOk = correctCharacters.some(v => v) || correctAnimes.some(v => v);
            const status = allOk ? 'correct' : someOk ? 'partial' : 'incorrect';

            gameState.roundResults.push({
                round: gameState.currentRound,
                characters: [...gameState.currentCharacters],
                correctCharacters, correctAnimes, status,
                points: totalPoints, mode: 'character'
            });

            updateProgressBar();

            const guess = document.getElementById('guessCharacterBtn');
            guess.disabled = true;
            setTimeout(() => {
                if (gameState.currentRound >= gameState.maxRounds) {
                    guess.textContent = 'SCORE FINAL →';
                    guess.onclick = showFinalScore;
                } else {
                    guess.textContent = 'PROCHAIN ROUND →';
                    guess.onclick = () => { gameState.currentRound++; gameState.answered = false; startNewRound(); };
                }
                guess.disabled = false;
            }, 500);

            initProgressBar("summaryScreen");
        }

        function showFinalScore() {
            const finalScreen = document.getElementById('finalScoreScreen');
            const gameScreen = document.getElementById('gameScreen');
            finalScreen.style.display = window.innerWidth <= 768 ? 'block' : 'flex';
            gameScreen.style.display = 'none';

            const totalScore = gameState.roundResults.reduce((s, r) => s + r.points, 0);
            document.getElementById('finalTotalScore').textContent = totalScore + ' pts';

            const roundsList = document.getElementById('roundsSummaryList');
            roundsList.innerHTML = '';

            gameState.roundResults.forEach((result, roundIndex) => {
                const div = document.createElement('div');
                div.className = 'round-item';

                const header = document.createElement('div');
                header.className = 'round-header';
                header.innerHTML = `<div class="round-title">Round ${roundIndex + 1}</div><div class="score-value">${result.points} pts</div>`;

                const grid = document.createElement('div');
                grid.className = 'character-grid';

                result.characters.forEach((character, ci) => {
                    const item = document.createElement('div');
                    item.className = 'character-item';
                    item.innerHTML = `
                        <img src="/aniguessr/${generateAnonymousImageUrl(character.id)}" alt="${character.name}">
                        <div class="character-name ${result.correctCharacters[ci] ? 'correct' : 'incorrect'}">${character.name}</div>
                        <div class="character-anime ${result.correctAnimes[ci] ? 'correct' : 'incorrect'}">${character.anime}</div>
                    `;
                    grid.appendChild(item);
                });

                div.appendChild(header);
                div.appendChild(grid);
                roundsList.appendChild(div);
            });

            initProgressBar("finalScoreScreen");
        }

        function goToMenu() { window.location.href = "/aniguessr"; }

        document.addEventListener('DOMContentLoaded', () => startNewRound());
    </script>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>