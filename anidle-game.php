<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoveAniGuessr - Anidle Mode</title>
    <link rel="stylesheet" href="/aniguessr/aniguessr.css">
</head>
<body>
    <div class="header">
        <div class="logo"><a href="/aniguessr">LoveAniGuessr</a></div>
    </div>
    <div id="modalReglages" class="modal-reglages">
        <div id="settings" class="round-selector">
        <label for="roundCount">Nombre de tentatives</label>
            <div class="number-input" style="margin:1em">
                <button type="button" onclick="stepDown('maxGuesses')">-</button>
                <input type="number" id="maxGuesses" min="1" max="20" value="10">
                <button type="button" onclick="stepUp('maxGuesses')">+</button>
            </div>
            <button id="startGameBtn" class="next-round-btn" style="margin:0" value="0">Lancer le jeu</button>
        </div>
    </div>
    
    <div id="gameScreen" class="game-screen">
        <div class="game-interface" id="gameInterface">
            <h1 class="game-main-title">ANIDLE</h1>
            <div class="round-info">
                <span class="round-title">Round <span id="roundNumber"></span></span>
            </div>

            <span class="guesses">Nombre de tentatives restantes : <span id="guessNumber"></span></span>

            <div id="anidleInterface">
                <div class="anidle-grid" id="anidleGrid">
                    <!-- Les lignes de tentatives seront ajoutées ici -->
                </div>
                
                <div class="answer-section">
                    <div class="answer-input-container">
                        <input type="text" id="answerInput" class="answer-input" placeholder="Type your answer here" autocomplete="off">
                        <div id="autocompleteDropdown" class="autocomplete-dropdown"></div>
                    </div>
                    <span id="error">Sélectionner une réponse suggérée</span>
                    <button id="guessBtn" class="guess-btn" onclick="submitGuess()">GUESS</button>
                </div>
                
                <div class="anidle-legend">
                    <div class="legend-item">
                        <div class="legend-color correct"></div>
                        <span>Correct</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color incorrect"></div>
                        <span>Incorrect</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="roundSummary" class="round-summary" style="display:none">
        <div class="round-header">
            <h1 class="game-main-title">ANIDLE</h1>
            <h1 class="round-title">Round <span id="summaryRoundNumber"></span></h1>
        </div>
        
        <div class="result-container">
            <div>
                <img id="summaryPoster" src="" alt="Anime poster" class="anime-poster">
                <a href="#" class="mal-link" id="malLink">
                    LoveAnime ↗
                </a>
            </div>
            
            <div class="result-info">
                <h2 id="summaryTitle" class="anime-title">Anime Title</h2>
                <div class="annee-container">
                    <span id="annee">Année</span>
                </div>
                <div class="score-section">
                    <div id="summaryPoints" class="score-value">0 pts</div>
                </div>
                
                <button id="nextRoundBtn" class="next-round-btn">
                    PROCHAIN ROUND → 
                </button>
            </div>
        </div>
        <div id="summaryTable"></div>
        <button onclick="goToMenu()" class="menu-btn" type="button">Back to Menu</button>
    </div>

    <div id="finalScoreScreen" class="final-score-screen" style="display:none;">
        <div class="final-score-container">
            <h1 class="game-main-title">ANIDLE</h1>
            <h1 class="final-score-title">Final Score</h1>
            
            <div class="total-score-card">
                <div class="total-score-value" id="finalTotalScore">0 pts</div>
            </div>
            
            <div class="rounds-summary" id="roundsSummaryList">
                <!-- Les rounds seront ajoutés dynamiquement ici -->
            </div>
            <button onclick="goToMenu()" class="menu-btn" type="button">Back to Menu</button>
        </div>
    </div>

    <script>
        // Récupération des données depuis config.php
        let animeDatabase = <?php echo json_encode($animes); ?>;
        const fullAnimeDatabase = [...animeDatabase];
        
        let MAX_GUESSES;
        let INITIAL_POINTS;
        let PENALTY_PER_WRONG_GUESS;

        document.getElementById('startGameBtn').addEventListener('click', () => {
            document.getElementById('modalReglages').style.display = 'none';
            const inputVal = parseInt(document.getElementById('maxGuesses').value);
            if (!isNaN(inputVal) && inputVal > 0) {
                MAX_GUESSES = inputVal;
                INITIAL_POINTS = MAX_GUESSES * 1000; // Score de départ
                PENALTY_PER_WRONG_GUESS = MAX_GUESSES * 100;
            }
            startNewRound();
        });

        
        let gameState = {
            currentRound: 1,
            maxRounds: 20,
            currentAnime: null,
            guesses: [],
            answered: false,
            scores: {
                screenshot: parseInt(localStorage.getItem('screenshotScore') || '0'),
                character: parseInt(localStorage.getItem('characterScore') || '0'),
                opening: parseInt(localStorage.getItem('openingScore') || '0'),
                anidle: parseInt(localStorage.getItem('anidleScore') || '0')
            },
            mode: 'anidle',
            roundResults: []
        };

        // Récupère le nombre de rounds depuis l'URL
        const pathParts = window.location.pathname.split('/').filter(Boolean);

        // Récupérer le dernier segment comme rounds
        const rounds = pathParts[pathParts.length - 1];
        gameState.maxRounds = rounds ? parseInt(rounds) : 3;

        // Initialisation du jeu
        function startNewRound() {
            gameState.answered = false;
            gameState.guesses = [];
            document.getElementById('roundNumber').textContent = gameState.currentRound;
            document.getElementById("guessNumber").textContent = MAX_GUESSES - gameState.guesses.length;

            animeDatabase = [...fullAnimeDatabase];
            
            const MAX_COOLDOWN = 10;
            let recentAnimes = JSON.parse(localStorage.getItem('recentAnidleAnimes') || '[]');

            function getRandomAnime() {
                const availableAnimes = animeDatabase.filter(a => !recentAnimes.includes(a.name));
                let chosenAnime;
                if (availableAnimes.length > 0) {
                    chosenAnime = availableAnimes[Math.floor(Math.random() * availableAnimes.length)];
                } else {
                    chosenAnime = animeDatabase[Math.floor(Math.random() * animeDatabase.length)];
                }
                recentAnimes.push(chosenAnime.name);
                if (recentAnimes.length > MAX_COOLDOWN) recentAnimes.shift();
                localStorage.setItem('recentAnidleAnimes', JSON.stringify(recentAnimes));
                return chosenAnime;
            }

            gameState.currentAnime = getRandomAnime();
            document.getElementById('answerInput').value = '';
            initializeGrid();
            setupAutocomplete();
            initProgressBar("gameScreen");
        }

        function initializeGrid() {
            const grid = document.getElementById("anidleGrid");
            grid.innerHTML = `
                <table id="guessTable" class="guess-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Genres</th>
                            <th>Themes</th>
                            <th>Episodes</th>
                            <th>Studio</th>
                        </tr>
                    </thead>
                    <tbody id="guessTableBody"></tbody>
                </table>
            `;
        }

        function compareAnimes(guess, target) {
            const result = {};
            
            // Titre
            result.title = guess.name === target.name ? 'correct' : 'incorrect';
            
            // Année
            if (guess.annee === target.annee) {
                result.year = 'correct';
            } else if (parseInt(guess.annee) < parseInt(target.annee)) {
                result.year = 'after'; // année devinée après
            } else {
                result.year = 'before'; // année devinée avant
            }

            // Studio
            const guessStudio = guess.studio ? guess.studio.split(', ').map(g => g.trim()) : [];
            const targetStudio = target.studio ? target.studio.split(', ').map(g => g.trim()) : [];
            const studioMatch = guessStudio.some(g => targetStudio.includes(g));
            result.studio = guessStudio.join(', ') === targetStudio.join(', ') ? 'correct' : 
                            studioMatch ? 'partial' : 'incorrect';
            
            // Genres (comparaison partielle)
            const guessGenres = guess.genres ? guess.genres.split(' - ').map(g => g.trim()) : [];
            const targetGenres = target.genres ? target.genres.split(' - ').map(g => g.trim()) : [];
            const genreMatch = guessGenres.some(g => targetGenres.includes(g));
            result.genres = guessGenres.join(' - ') === targetGenres.join(' - ') ? 'correct' : 
                            genreMatch ? 'partial' : 'incorrect';
            
            // Thèmes (comparaison partielle)
            const guessThemes = guess.themes ? guess.themes.split(' - ').map(t => t.trim()) : [];
            const targetThemes = target.themes ? target.themes.split(' - ').map(t => t.trim()) : [];
            const themeMatch = guessThemes.some(t => targetThemes.includes(t));
            result.themes = guessThemes.join(' - ') === targetThemes.join(' - ') ? 'correct' : 
                           themeMatch ? 'partial' : 'incorrect';
            
            if (guess.episodes === target.episodes) {
                result.episodes = 'correct';
            } else if (parseInt(guess.episodes) < parseInt(target.episodes)) {
                result.episodes = 'after';
            } else {
                result.episodes = 'before';
            }
            
            return result;
        }

        function updateGrid(showSolution = false) {
            const tableBody = document.getElementById('guessTableBody');
            tableBody.innerHTML = ''; // On réinitialise le tableau

            gameState.guesses.forEach((guess) => {
                const comparison = compareAnimes(guess.anime, gameState.currentAnime);
                const guessGenres = guess.anime.genres ? guess.anime.genres.split(' - ').map(g => g.trim()) : [];
                const targetGenres = gameState.currentAnime.genres ? gameState.currentAnime.genres.split(' - ').map(g => g.trim()) : [];
                const guessThemes = guess.anime.themes ? guess.anime.themes.split(' - ').map(t => t.trim()) : [];
                const targetThemes = gameState.currentAnime.themes ? gameState.currentAnime.themes.split(' - ').map(t => t.trim()) : [];
                const guessStudio = guess.anime.studio ? guess.anime.studio.split(', ').map(g => g.trim()) : [];
                const targetStudio = gameState.currentAnime.studio ? gameState.currentAnime.studio.split(', ').map(g => g.trim()) : [];

                const row = document.createElement('tr');

                row.innerHTML = `
                    <td class="grid-anime-name ${getCellClass(comparison.title)}">${guess.anime.name}</td>
                    <td class="${getCellClass(comparison.year)}">${guess.anime.annee}</td>
                    <td class="genresThemes">${formatItemsWithColors(guessGenres, targetGenres)}</td>
                    <td class="genresThemes">${formatItemsWithColors(guessThemes, targetThemes)}</td>
                    <td class="${getCellClass(comparison.episodes)}">${guess.anime.episodes}</td>
                    <td>${formatItemsWithColors(guessStudio, targetStudio)}</td>
                `;

                tableBody.appendChild(row);
            });

            if (showSolution) {
                const row = document.createElement('tr');
                const comparison = compareAnimes(gameState.currentAnime, gameState.currentAnime);
                const guessGenres = gameState.currentAnime.genres ? gameState.currentAnime.genres.split(' - ').map(g => g.trim()) : [];
                const targetGenres = gameState.currentAnime.genres ? gameState.currentAnime.genres.split(' - ').map(g => g.trim()) : [];
                const guessThemes = gameState.currentAnime.themes ? gameState.currentAnime.themes.split(' - ').map(t => t.trim()) : [];
                const targetThemes = gameState.currentAnime.themes ? gameState.currentAnime.themes.split(' - ').map(t => t.trim()) : [];
                const guessStudio = gameState.currentAnime.studio ? gameState.currentAnime.studio.split(', ').map(g => g.trim()) : [];
                const targetStudio = gameState.currentAnime.studio ? gameState.currentAnime.studio.split(', ').map(g => g.trim()) : [];

                row.innerHTML = `
                    <td class="grid-anime-name cell-correct">${gameState.currentAnime.name}</td>
                    <td class="cell-correct">${gameState.currentAnime.annee}</td>
                    <td>${formatItemsWithColors(guessGenres, targetGenres)}</td>
                    <td>${formatItemsWithColors(guessThemes, targetThemes)}</td>
                    <td class="cell-correct">${gameState.currentAnime.episodes}</td>
                    <td>${formatItemsWithColors(guessStudio, targetStudio)}</td>
                `;

                tableBody.appendChild(row);
            }
        }


        function getCellClass(value) {
            if (value === "correct") return "cell-correct";
            if (value === "partial") return "cell-partial";
            if (value === "after") return "cell-after";   // flèche haut
            if (value === "before") return "cell-before"; // flèche bas
            return "cell-wrong";
        }


        function calculatePoints() {
            const wrongGuesses = gameState.guesses.length - 1; // On ne pénalise pas la bonne réponse
            const points = Math.max(INITIAL_POINTS - (wrongGuesses * PENALTY_PER_WRONG_GUESS), 0);
            return points;
        }


        function submitGuess() {
            const userAnswer = document.getElementById('answerInput').value.trim();
            if (!userAnswer || gameState.answered) return;

            const guessedAnime = animeDatabase.find(anime => 
                anime.name.toLowerCase() === userAnswer.toLowerCase()
            );
            
            const error = document.getElementById('error');

            if (!guessedAnime) {
                // Si l'utilisateur n'a pas sélectionné une suggestion, on montre l'erreur (pas de shake)
                error.style.display = "block";
                return;
            }

            error.style.display = "none";
            gameState.guesses.push({ anime: guessedAnime, guess: userAnswer });
            document.getElementById("guessNumber").textContent = MAX_GUESSES - gameState.guesses.length;
            updateGrid();

            const isCorrect = userAnswer.toLowerCase() === gameState.currentAnime.name.toLowerCase();
            
            let status;
            if (isCorrect) {
                // succès : confettis + score
                gameState.answered = true;
                let points = calculatePoints();
                gameState.scores.anidle += points;
                localStorage.setItem('anidleScore', gameState.scores.anidle);
                status = "correct";
                showResult(true, points, status);
            } else if (gameState.guesses.length >= MAX_GUESSES) {
                // plus de tentatives, fin de round -> montrer solution
                gameState.answered = true;
                status = "incorrect"
                updateGrid(true);
                showResult(false, 0, status);
            } else {
                // mauvaise tentative mais encore des essais : on retire l'anime deviné de la base et on shake le container
                document.getElementById('answerInput').value = '';
                animeDatabase = animeDatabase.filter(a => a.name.toLowerCase() !== guessedAnime.name.toLowerCase());
                triggerShake();
            }
        }

        function showResult(isCorrect, points, status) {
            const grid = document.getElementById("anidleGrid");
            const summary = document.getElementById('roundSummary');
            const gameScreen = document.getElementById('gameScreen');
            const summaryTable = document.getElementById('summaryTable');
            summary.style.display = 'flex';
            gameScreen.style.display = 'none';
            summaryTable.innerHTML = grid.outerHTML

            document.getElementById('summaryRoundNumber').textContent = gameState.currentRound;
            document.getElementById('summaryPoster').src = gameState.currentAnime.poster;
            document.getElementById('summaryTitle').textContent = gameState.currentAnime.name;
            document.getElementById('annee').textContent = gameState.currentAnime.annee;
            
            const malLink = document.getElementById('malLink');
            malLink.href = `https://loveanime.rf.gd/anime/${gameState.currentAnime.id}`;

            document.getElementById('summaryPoints').textContent = points + ' pts';

            scrollToAndAnimate('roundSummary', isCorrect);

            const nextBtn = document.getElementById('nextRoundBtn');

            if (!gameState.roundResults) {
                gameState.roundResults = [];
            }
            gameState.roundResults.push({
                round: gameState.currentRound,
                anime: gameState.currentAnime,
                guesses: [...gameState.guesses],
                points: points,
                isCorrect: isCorrect,
                status: status,
                mode: 'anidle'
            });

            updateProgressBar();

            if (gameState.currentRound >= gameState.maxRounds) {
                nextBtn.textContent = 'SCORE FINAL →';
                nextBtn.onclick = () => {
                    summary.style.display = 'none';
                    showFinalScore();
                };
            } else {
                nextBtn.textContent = 'PROCHAIN ROUND →';
                nextBtn.onclick = () => {
                    summary.style.display = 'none';
                    gameScreen.style.display = 'block';
                    nextRound();
                };
            }
            initProgressBar("summaryScreen")
        }

        function nextRound() {
            if (gameState.currentRound >= gameState.maxRounds) {
                showFinalScore();
                return;
            }
            gameState.currentRound++;
            startNewRound();
        }

        function showFinalScore() {
            const finalScreen = document.getElementById('finalScoreScreen');
            finalScreen.style.display = 'flex';
            
            const totalScore = gameState.scores.anidle;
            document.getElementById('finalTotalScore').textContent = totalScore + ' pts';
            
            const roundsList = document.getElementById('roundsSummaryList');
            roundsList.innerHTML = '';
            
            gameState.roundResults.forEach((result, index) => {
                const roundDiv = document.createElement('div');
                roundDiv.className = 'round-item';
                
                roundDiv.innerHTML = `
                    <div class="round-header">
                        <div class="round-title">Round ${result.round}</div>
                        <div class="round-score-section">
                            <div class="score-value">${result.points} pts</div>
                        </div>
                    </div>
                    <div class="round-container">
                        <div>
                            <img src="${result.anime.poster}" alt="${result.anime.name}" class="round-poster">
                            <a href="https://loveanime.rf.gd/anime/${result.anime.id}" class="mal-link">LoveAnime ↗</a>
                        </div>
                        <div class="round-info">
                            <div class="round-anime-title">
                                <h1>${result.anime.name}</h1>
                            </div>
                            <div class="annee-container">
                                <span>${result.anime.annee}</span>
                            </div>
                        </div>
                    </div>
                `;
                roundsList.appendChild(roundDiv);
            });

            initProgressBar("finalScoreScreen");
        }

        function goToMenu() {
            window.location.href = "/aniguessr";
        }

        function formatItemsWithColors(items, targetItems) {
            return items.map(item => {
                if (targetItems.includes(item)) {
                    if (items.join(' - ') === targetItems.join(' - ')) {
                        return `<span class="cell-correct">${item}</span>`;
                    }
                    return `<span class="cell-correct">${item}</span>`;
                } else {
                    return `<span class="cell-wrong">${item}</span>`;
                }

                if (targetItems.includes(item)) {
                    if (items.join(', ') === targetItems.join(', ')) {
                        return `<span class="cell-correct">${item}</span>`;
                    }
                    return `<span class="cell-correct">${item}</span>`;
                } else {
                    return `<span class="cell-wrong">${item}</span>`;
                }
            }).join('<br>');
        }

        function stepUp(id) {
            const input = document.getElementById(id);
            if (+input.value < +input.max) input.stepUp();
        }

        function stepDown(id) {
            const input = document.getElementById(id);
            if (+input.value > +input.min) input.stepDown();
        }

        // Exemple : récupération de la valeur pour Anidle
        function getMaxGuesses() {
            return parseInt(document.getElementById('maxGuesses').value);
        }

        /* ---------- Shake helper ---------- */
        function triggerShake() {
            const container = document.getElementById('gameInterface');
            if (!container) return;
            container.classList.remove('shake'); // reset si déjà présent
            // force reflow pour relancer l'animation
            void container.offsetWidth;
            container.classList.add('shake');
            // la classe sera retirée après la fin de l'animation via timeout
            setTimeout(() => container.classList.remove('shake'), 650);
        }


    </script>
</body>
</html>
