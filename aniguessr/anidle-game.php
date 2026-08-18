<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoveAniGuessr — Anidle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/loveanime.css">
    <link rel="stylesheet" href="/aniguessr/aniguessr.css">
</head>
<body>

    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
    </header>

    <!-- MODAL RÉGLAGES -->
    <div id="modalReglages" class="modal-reglages">
        <div id="settings">
            <i class="fa-solid fa-sliders" style="font-size:2rem; color:var(--blue-lt); margin-bottom:.5rem;"></i>
            <h2 style="font-size:1.3rem; font-weight:800; margin:0;">Anidle</h2>
            <p style="font-size:.9rem; color:rgba(255,255,255,.6); margin:0;">Devine l'animé via ses caractéristiques</p>
            <label for="maxGuesses">Nombre de tentatives</label>
            <div class="number-input">
                <button type="button" onclick="stepDown('maxGuesses')">-</button>
                <input type="number" id="maxGuesses" min="1" max="20" value="10">
                <button type="button" onclick="stepUp('maxGuesses')">+</button>
            </div>
            <button id="startGameBtn" class="next-round-btn" style="margin-top:.5rem;">Lancer le jeu</button>
        </div>
    </div>

    <div id="gameScreen" class="game-screen">
        <div class="game-interface" id="gameInterface">
            <h1 class="game-main-title"><i class="fa-solid fa-magnifying-glass"></i> ANIDLE</h1>
            <div class="round-info">
                <span class="round-title">Round <span id="roundNumber"></span></span>
            </div>
            <span class="guesses">Tentatives restantes : <strong><span id="guessNumber"></span></strong></span>

            <div id="anidleInterface">
                <div class="anidle-grid" id="anidleGrid"></div>

                <div class="answer-section">
                    <div class="answer-input-container">
                        <input type="text" id="answerInput" class="answer-input" placeholder="Tape ta réponse ici" autocomplete="off">
                        <div id="autocompleteDropdown" class="autocomplete-dropdown"></div>
                    </div>
                    <span id="error">Sélectionne une réponse suggérée</span>
                    <button id="guessBtn" class="guess-btn" onclick="submitGuess()">VALIDER</button>
                </div>

                <div class="anidle-legend">
                    <div class="legend-item"><div class="legend-color correct"></div><span>Correct</span></div>
                    <div class="legend-item"><div class="legend-color incorrect"></div><span>Incorrect</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ROUND SUMMARY -->
    <div id="roundSummary" class="round-summary" style="display:none;">
        <div class="round-header">
            <h1 class="game-main-title"><i class="fa-solid fa-magnifying-glass"></i> ANIDLE</h1>
            <span class="round-title">Round <span id="summaryRoundNumber"></span></span>
        </div>
        <div class="result-container">
            <div>
                <img id="summaryPoster" src="" alt="Affiche" class="anime-poster">
                <a href="#" class="mal-link" id="malLink"><i class="fa-solid fa-arrow-up-right-from-square"></i> LoveAnime</a>
            </div>
            <div class="result-info">
                <h2 id="summaryTitle" class="anime-title">Titre</h2>
                <div class="annee-container"><span id="annee">Année</span></div>
                <div class="score-section"><div id="summaryPoints" class="score-value">0 pts</div></div>
                <button id="nextRoundBtn" class="next-round-btn">PROCHAIN ROUND →</button>
            </div>
        </div>
        <div id="summaryTable"></div>
        <button onclick="goToMenu()" class="menu-btn">← Revenir au menu</button>
    </div>

    <!-- FINAL SCORE -->
    <div id="finalScoreScreen" class="final-score-screen" style="display:none;">
        <div class="final-score-container">
            <h1 class="game-main-title"><i class="fa-solid fa-magnifying-glass"></i> ANIDLE</h1>
            <h1 class="final-score-title">Score Final</h1>
            <div class="total-score-card">
                <div class="total-score-value" id="finalTotalScore">0 pts</div>
            </div>
            <div class="rounds-summary" id="roundsSummaryList"></div>
            <button onclick="goToMenu()" class="menu-btn">← Revenir au menu</button>
        </div>
    </div>

    <script>
        let animeDatabase = <?php echo json_encode($animes); ?>;
        const fullAnimeDatabase = [...animeDatabase];

        let MAX_GUESSES, INITIAL_POINTS, PENALTY_PER_WRONG_GUESS;

        document.getElementById('startGameBtn').addEventListener('click', () => {
            document.getElementById('modalReglages').style.display = 'none';
            const val = parseInt(document.getElementById('maxGuesses').value);
            if (!isNaN(val) && val > 0) {
                MAX_GUESSES = val;
                INITIAL_POINTS = MAX_GUESSES * 1000;
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
            scores: { anidle: parseInt(localStorage.getItem('anidleScore') || '0') },
            mode: 'anidle',
            roundResults: []
        };

        const pathParts = window.location.pathname.split('/').filter(Boolean);
        gameState.maxRounds = parseInt(pathParts[pathParts.length - 1]) || 3;

        function startNewRound() {
            gameState.answered = false;
            gameState.guesses = [];
            document.getElementById('roundNumber').textContent = gameState.currentRound;
            document.getElementById('guessNumber').textContent = MAX_GUESSES;
            animeDatabase = [...fullAnimeDatabase];

            const MAX_COOLDOWN = 10;
            let recentAnimes = JSON.parse(localStorage.getItem('recentAnidleAnimes') || '[]');
            const available = animeDatabase.filter(a => !recentAnimes.includes(a.name));
            const chosen = available.length > 0
                ? available[Math.floor(Math.random() * available.length)]
                : animeDatabase[Math.floor(Math.random() * animeDatabase.length)];
            recentAnimes.push(chosen.name);
            if (recentAnimes.length > MAX_COOLDOWN) recentAnimes.shift();
            localStorage.setItem('recentAnidleAnimes', JSON.stringify(recentAnimes));

            gameState.currentAnime = chosen;
            document.getElementById('answerInput').value = '';
            initializeGrid();
            setupAutocomplete();
            initProgressBar("gameScreen");
        }

        function initializeGrid() {
            document.getElementById('anidleGrid').innerHTML = `
                <table id="guessTable" class="guess-table">
                    <thead>
                        <tr>
                            <th>Titre</th><th>Année</th><th>Genres</th><th>Thèmes</th><th>Épisodes</th><th>Studio</th>
                        </tr>
                    </thead>
                    <tbody id="guessTableBody"></tbody>
                </table>
            `;
        }

        function compareAnimes(guess, target) {
            const split = (str, sep) => str ? str.split(sep).map(s => s.trim()) : [];
            const guessGenres  = split(guess.genres, ' - ');
            const targetGenres = split(target.genres, ' - ');
            const guessThemes  = split(guess.themes, ' - ');
            const targetThemes = split(target.themes, ' - ');
            const guessStudio  = split(guess.studio, ', ');
            const targetStudio = split(target.studio, ', ');

            return {
                title:    guess.name === target.name ? 'correct' : 'incorrect',
                year:     guess.annee === target.annee ? 'correct' : parseInt(guess.annee) < parseInt(target.annee) ? 'after' : 'before',
                episodes: guess.episodes === target.episodes ? 'correct' : parseInt(guess.episodes) < parseInt(target.episodes) ? 'after' : 'before',
                genres:   guessGenres.join(' - ') === targetGenres.join(' - ') ? 'correct' : guessGenres.some(g => targetGenres.includes(g)) ? 'partial' : 'incorrect',
                themes:   guessThemes.join(' - ') === targetThemes.join(' - ') ? 'correct' : guessThemes.some(t => targetThemes.includes(t)) ? 'partial' : 'incorrect',
                studio:   guessStudio.join(', ') === targetStudio.join(', ') ? 'correct' : guessStudio.some(s => targetStudio.includes(s)) ? 'partial' : 'incorrect'
            };
        }

        function getCellClass(v) {
            return v === 'correct' ? 'cell-correct' : v === 'partial' ? 'cell-partial' : v === 'after' ? 'cell-after' : v === 'before' ? 'cell-before' : 'cell-wrong';
        }

        function formatItemsWithColors(items, targetItems) {
            return items.map(item =>
                `<span class="${targetItems.includes(item) ? 'cell-correct' : 'cell-wrong'}">${item}</span>`
            ).join('<br>');
        }

        function split(str, sep) { return str ? str.split(sep).map(s => s.trim()) : []; }

        function updateGrid(showSolution = false) {
            const tbody = document.getElementById('guessTableBody');
            tbody.innerHTML = '';
            gameState.guesses.forEach(({ anime: g }) => {
                const cmp = compareAnimes(g, gameState.currentAnime);
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="grid-anime-name ${getCellClass(cmp.title)}">${g.name}</td>
                    <td class="${getCellClass(cmp.year)}">${g.annee}</td>
                    <td class="genresThemes">${formatItemsWithColors(split(g.genres, ' - '), split(gameState.currentAnime.genres, ' - '))}</td>
                    <td class="genresThemes">${formatItemsWithColors(split(g.themes, ' - '), split(gameState.currentAnime.themes, ' - '))}</td>
                    <td class="${getCellClass(cmp.episodes)}">${g.episodes}</td>
                    <td>${formatItemsWithColors(split(g.studio, ', '), split(gameState.currentAnime.studio, ', '))}</td>
                `;
                tbody.appendChild(row);
            });

            if (showSolution) {
                const ca = gameState.currentAnime;
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="grid-anime-name cell-correct">${ca.name}</td>
                    <td class="cell-correct">${ca.annee}</td>
                    <td>${formatItemsWithColors(split(ca.genres, ' - '), split(ca.genres, ' - '))}</td>
                    <td>${formatItemsWithColors(split(ca.themes, ' - '), split(ca.themes, ' - '))}</td>
                    <td class="cell-correct">${ca.episodes}</td>
                    <td>${formatItemsWithColors(split(ca.studio, ', '), split(ca.studio, ', '))}</td>
                `;
                tbody.appendChild(row);
            }
        }

        function calculatePoints() {
            const wrong = gameState.guesses.length - 1;
            return Math.max(INITIAL_POINTS - wrong * PENALTY_PER_WRONG_GUESS, 0);
        }

        function submitGuess() {
            const userAnswer = document.getElementById('answerInput').value.trim();
            if (!userAnswer || gameState.answered) return;

            const guessedAnime = animeDatabase.find(a => a.name.toLowerCase() === userAnswer.toLowerCase());
            if (!guessedAnime) { document.getElementById('error').style.display = 'block'; return; }
            document.getElementById('error').style.display = 'none';

            gameState.guesses.push({ anime: guessedAnime, guess: userAnswer });
            document.getElementById('guessNumber').textContent = MAX_GUESSES - gameState.guesses.length;
            updateGrid();

            const isCorrect = userAnswer.toLowerCase() === gameState.currentAnime.name.toLowerCase();
            if (isCorrect) {
                gameState.answered = true;
                const points = calculatePoints();
                gameState.scores.anidle += points;
                localStorage.setItem('anidleScore', gameState.scores.anidle);
                showResult(true, points, 'correct');
            } else if (gameState.guesses.length >= MAX_GUESSES) {
                gameState.answered = true;
                updateGrid(true);
                showResult(false, 0, 'incorrect');
            } else {
                document.getElementById('answerInput').value = '';
                animeDatabase = animeDatabase.filter(a => a.name.toLowerCase() !== guessedAnime.name.toLowerCase());
                triggerShake();
            }
        }

        function showResult(isCorrect, points, status) {
            const grid = document.getElementById('anidleGrid');
            const summary = document.getElementById('roundSummary');
            const gameScreen = document.getElementById('gameScreen');
            summary.style.display = 'flex';
            gameScreen.style.display = 'none';
            document.getElementById('summaryTable').innerHTML = grid.outerHTML;

            document.getElementById('summaryRoundNumber').textContent = gameState.currentRound;
            document.getElementById('summaryPoster').src = gameState.currentAnime.poster;
            document.getElementById('summaryTitle').textContent = gameState.currentAnime.name;
            document.getElementById('annee').textContent = gameState.currentAnime.annee;
            document.getElementById('malLink').href = `https://loveanime.rf.gd/anime/${gameState.currentAnime.id}`;
            document.getElementById('summaryPoints').textContent = points + ' pts';

            scrollToAndAnimate('roundSummary', isCorrect);
            gameState.roundResults.push({ round: gameState.currentRound, anime: gameState.currentAnime, guesses: [...gameState.guesses], points, isCorrect, status, mode: 'anidle' });
            updateProgressBar();

            const nextBtn = document.getElementById('nextRoundBtn');
            if (gameState.currentRound >= gameState.maxRounds) {
                nextBtn.textContent = 'SCORE FINAL →';
                nextBtn.onclick = () => { summary.style.display = 'none'; showFinalScore(); };
            } else {
                nextBtn.textContent = 'PROCHAIN ROUND →';
                nextBtn.onclick = () => { summary.style.display = 'none'; gameScreen.style.display = 'block'; gameState.currentRound++; startNewRound(); };
            }
            initProgressBar("summaryScreen");
        }

        function showFinalScore() {
            const finalScreen = document.getElementById('finalScoreScreen');
            finalScreen.style.display = window.innerWidth <= 768 ? 'block' : 'flex';
            document.getElementById('finalTotalScore').textContent = gameState.scores.anidle + ' pts';

            const roundsList = document.getElementById('roundsSummaryList');
            roundsList.innerHTML = '';
            gameState.roundResults.forEach(result => {
                const div = document.createElement('div');
                div.className = 'round-item';
                div.innerHTML = `
                    <div class="round-header">
                        <div class="round-title">Round ${result.round}</div>
                        <div class="score-value">${result.points} pts</div>
                    </div>
                    <div class="round-container">
                        <div>
                            <img src="${result.anime.poster}" alt="${result.anime.name}" class="round-poster">
                            <a href="https://loveanime.rf.gd/anime/${result.anime.id}" class="mal-link">LoveAnime ↗</a>
                        </div>
                        <div class="round-info">
                            <div class="round-anime-title"><h1>${result.anime.name}</h1></div>
                            <div class="annee-container"><span>${result.anime.annee}</span></div>
                        </div>
                    </div>
                `;
                roundsList.appendChild(div);
            });
            initProgressBar("finalScoreScreen");
        }

        function goToMenu() { window.location.href = "/aniguessr"; }

        function stepUp(id)   { const i = document.getElementById(id); if (+i.value < +i.max) i.stepUp(); }
        function stepDown(id) { const i = document.getElementById(id); if (+i.value > +i.min) i.stepDown(); }

        function triggerShake() {
            const c = document.getElementById('gameInterface');
            if (!c) return;
            c.classList.remove('shake');
            void c.offsetWidth;
            c.classList.add('shake');
            setTimeout(() => c.classList.remove('shake'), 650);
        }
    </script>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>