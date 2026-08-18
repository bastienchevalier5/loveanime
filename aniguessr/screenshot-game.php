<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoveAniGuessr — Screenshot Mode</title>
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
            <h1 class="game-main-title"><i class="fa-solid fa-image"></i> GUESS THE ANIME</h1>
            <div class="round-info">
                <span class="round-title">Round <span id="roundNumber">1</span></span>
            </div>

            <div id="screenshotInterface">
                <div class="image-container">
                    <img id="gameImage" class="game-image" alt="Anime screenshot">
                </div>

                <div class="clues-container">
                    <button class="clue-btn used" id="originalBtn" onclick="gameState.currentImageIndex=0; updateGameImage();">
                        <span class="clue-icon">🔓</span>
                        <span>SCREENSHOT ORIGINAL</span>
                    </button>
                    <button class="clue-btn locked" id="firstClueBtn" onclick="useClue('first'); gameState.currentImageIndex=1; updateGameImage();">
                        <span class="clue-icon">🔒</span>
                        <span>PREMIER INDICE</span>
                    </button>
                    <button class="clue-btn locked" id="secondClueBtn" onclick="useClue('second'); gameState.currentImageIndex=2; updateGameImage();">
                        <span class="clue-icon">🔒</span>
                        <span>SECOND INDICE</span>
                    </button>
                    <button class="clue-btn locked" id="titleClueBtn" onclick="useClue('title')">
                        <span class="clue-icon">🔒</span>
                        <span>INDICE DU TITRE</span>
                    </button>
                </div>

                <div class="answer-section">
                    <div class="answer-input-container">
                        <input type="text" id="answerInput" class="answer-input" placeholder="Tape ta réponse ici" autocomplete="off">
                        <div id="autocompleteDropdown" class="autocomplete-dropdown"></div>
                    </div>
                    <span id="error">Sélectionne une réponse suggérée</span>
                    <button id="guessBtn" class="guess-btn" onclick="submitGuess()">VALIDER</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ROUND SUMMARY -->
    <div id="roundSummary" class="round-summary" style="display:none;">
    <div class="round-interface-container">
        
        <div class="result-card-row">
            <span class="round-badge-left">Round <span id="summaryRoundNumber">1</span></span>
            
            <div class="result-main-content">
                <div class="poster-wrapper">
                    <img id="summaryPoster" src="" alt="Affiche anime" class="anime-poster">
                    <a href="#" class="mal-link" id="malLink">LoveAnime <i class="fa-solid fa-arrow-up-right-from-square small-icon"></i></a>
                </div>
                
                <div class="anime-details-middle">
                    <div class="title-inline-group">
                        <h2 id="summaryTitle" class="anime-title">Titre de l'animé</h2>
                        <span id="annee" class="annee-badge">2025</span>
                    </div>
                    
                    <div class="screenshots-section" id="screenshotsSection">
                        <div id="summaryScreenshots" class="screenshots-grid"></div>
                    </div>
                </div>
            </div>

            <div class="score-badge-right" id="summaryPoints">0 pts</div>
        </div>

        <div class="summary-actions">
            <button id="nextRoundBtn" class="next-round-btn">PROCHAIN ROUND →</button>
            <button onclick="goToMenu()" class="menu-btn">← Revenir au menu</button>
        </div>
    </div>
</div>

    <!-- FINAL SCORE -->
    <div id="finalScoreScreen" class="final-score-screen" style="display:none;">
        <div class="final-score-container">
            <h1 class="game-main-title"><i class="fa-solid fa-image"></i> GUESS THE ANIME</h1>
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
        const POINTS = { noClue: 10000, oneClue: 7500, twoClues: 5000, threeClues: 2500 };

        let gameState = {
            currentRound: 1,
            maxRounds: 3,
            currentAnime: null,
            cluesUsed: [],
            answered: false,
            currentImageIndex: 0,
            scores: { screenshot: parseInt(localStorage.getItem('screenshotScore') || '0') },
            mode: 'screenshot',
            roundResults: []
        };

        const pathParts = window.location.pathname.split('/').filter(Boolean);
        const rounds = pathParts[pathParts.length - 1];
        gameState.maxRounds = rounds ? parseInt(rounds) : 3;

        function startNewRound() {
            gameState.answered = false;
            document.getElementById('roundNumber').textContent = gameState.currentRound;
            const MAX_COOLDOWN = 10;
            let recentAnimes = JSON.parse(localStorage.getItem('recentAnimes') || '[]');

            function getRandomAnime() {
                const available = animeDatabase.filter(a => !recentAnimes.includes(a.name));
                const chosen = available.length > 0
                    ? available[Math.floor(Math.random() * available.length)]
                    : animeDatabase[Math.floor(Math.random() * animeDatabase.length)];
                recentAnimes.push(chosen.name);
                if (recentAnimes.length > MAX_COOLDOWN) recentAnimes.shift();
                localStorage.setItem('recentAnimes', JSON.stringify(recentAnimes));
                return chosen;
            }

            gameState.currentAnime = getRandomAnime();
            gameState.cluesUsed = [];
            gameState.currentAnime.images = [
                gameState.currentAnime.image,
                gameState.currentAnime.image2,
                gameState.currentAnime.image3
            ];
            gameState.currentImageIndex = 0;
            updateGameImage();
            document.getElementById('answerInput').value = '';
            resetClueButtons();
            setupAutocomplete();
            initProgressBar("gameScreen");
        }

        function updateGameImage() {
            const img = document.getElementById('gameImage');
            img.src = '/aniguessr/' + gameState.currentAnime.images[gameState.currentImageIndex];
            img.style.opacity = '0.4';
            setTimeout(() => { img.style.opacity = '1'; }, 200);
        }

        function resetClueButtons() {
            ['firstClueBtn', 'secondClueBtn', 'titleClueBtn'].forEach(btnId => {
                const btn = document.getElementById(btnId);
                btn.classList.remove('used');
                btn.classList.add('locked');
                btn.innerHTML = `<span class="clue-icon">🔒</span><span>${getOriginalClueText(btnId)}</span>`;
                btn.disabled = (btnId === 'secondClueBtn' || btnId === 'titleClueBtn');
            });
            document.getElementById('originalBtn').classList.add('used');
            document.getElementById('originalBtn').classList.remove('locked');
        }

        function getOriginalClueText(btnId) {
            return { firstClueBtn: 'PREMIER INDICE', secondClueBtn: 'SECOND INDICE', titleClueBtn: 'INDICE DU TITRE' }[btnId] || '';
        }

        function useClue(clueType) {
            if (gameState.answered) return;
            if ((clueType === 'second' || clueType === 'title') && !gameState.cluesUsed.includes('first')) return;
            if (gameState.cluesUsed.includes(clueType)) return;

            gameState.cluesUsed.push(clueType);
            const btn = document.getElementById(clueType + 'ClueBtn');
            btn.classList.add('used');
            btn.classList.remove('locked');

            if (clueType === 'first') {
                document.getElementById('secondClueBtn').disabled = false;
                btn.innerHTML = '<span class="clue-icon">🔓</span><span>PREMIER INDICE DÉBLOQUÉ</span>';
            } else if (clueType === 'second') {
                document.getElementById('titleClueBtn').disabled = false;
                btn.innerHTML = '<span class="clue-icon">🔓</span><span>SECOND INDICE DÉBLOQUÉ</span>';
            } else if (clueType === 'title') {
                const hint = gameState.currentAnime.name[0] + ' _'.repeat(Math.max(0, gameState.currentAnime.name.length - 1));
                btn.innerHTML = `<span class="clue-icon">🔓</span><span>TITRE : ${hint}</span>`;
            }
        }

        function calculatePoints() {
            const c = gameState.cluesUsed.length;
            return c === 0 ? POINTS.noClue : c === 1 ? POINTS.oneClue : c === 2 ? POINTS.twoClues : POINTS.threeClues;
        }

        function submitGuess() {
            const userAnswer = document.getElementById('answerInput').value.trim();
            if (userAnswer) {
                const valid = animeDatabase.some(a => a.name.toLowerCase() === userAnswer.toLowerCase());
                if (!valid) { document.getElementById('error').style.display = 'block'; return; }
            }
            gameState.answered = true;
            const isCorrect = userAnswer.toLowerCase() === gameState.currentAnime.name.toLowerCase();
            let points = 0;
            if (isCorrect) {
                points = calculatePoints();
                gameState.scores.screenshot += points;
                localStorage.setItem('screenshotScore', gameState.scores.screenshot);
            }
            showResult(isCorrect, points, isCorrect ? 'correct' : 'incorrect');
        }

        function showResult(isCorrect, points, status) {
    document.getElementById('roundSummary').style.display = 'flex';
    document.getElementById('gameScreen').style.display = 'none';

    let resultContainer = document.querySelector('#roundSummary .result-container') || 
                          document.querySelector('#roundSummary .result-card-row') ||
                          document.querySelector('#roundSummary .round-item');
    
    if (!resultContainer) {
        resultContainer = document.getElementById('roundSummary').children[1];
    }

    // On applique la classe round-item pour calquer le rendu final au pixel près
    resultContainer.className = "round-item"; 
    resultContainer.innerHTML = `
        <span class="round-badge-left">ROUND ${gameState.currentRound}</span>
        
        <div class="result-main-content">
            <div class="poster-wrapper">
                <img src="${gameState.currentAnime.poster}" alt="${gameState.currentAnime.name}" class="anime-poster">
                <a href="https://loveanime.rf.gd/anime/${gameState.currentAnime.id}" class="mal-link">LoveAnime <i class="fa-solid fa-arrow-up-right-from-square small-icon"></i></a>
            </div>
            
            <div class="anime-details-middle">
                <div class="title-inline-group">
                    <h2 class="anime-title">${gameState.currentAnime.name}</h2>
                    <span class="annee-badge">${gameState.currentAnime.annee}</span>
                </div>
                
                <div class="screenshots-grid" id="summaryScreenshots">
                    </div>
            </div>
        </div>

        <div class="score-badge-right">${points} pts</div>
    `;

    // Injection des images
    const screenshotsDiv = document.getElementById('summaryScreenshots');
    screenshotsDiv.innerHTML = '';
    [gameState.currentAnime.image, gameState.currentAnime.image2, gameState.currentAnime.image3].forEach(src => {
        const img = document.createElement('img');
        img.src = '/aniguessr/' + src;
        img.className = 'screenshot-thumb';
        screenshotsDiv.appendChild(img);
    });

    scrollToAndAnimate('roundSummary', isCorrect);

    gameState.roundResults.push({ round: gameState.currentRound, anime: gameState.currentAnime, points, isCorrect, status, mode: 'screenshot' });
    updateProgressBar();

    const nextBtn = document.getElementById('nextRoundBtn');
    if (gameState.currentRound >= gameState.maxRounds) {
        nextBtn.textContent = 'SCORE FINAL →';
        nextBtn.onclick = () => { document.getElementById('roundSummary').style.display = 'none'; showFinalScore(); };
    } else {
        nextBtn.textContent = 'PROCHAIN ROUND →';
        nextBtn.onclick = () => {
            document.getElementById('roundSummary').style.display = 'none';
            document.getElementById('gameScreen').style.display = 'block';
            gameState.currentRound++;
            startNewRound();
        };
    }
    initProgressBar("summaryScreen");
}

        function showFinalScore() {
    document.getElementById('finalScoreScreen').style.display = 'flex';
    document.getElementById('finalTotalScore').textContent = gameState.scores.screenshot + ' pts';

    const roundsList = document.getElementById('roundsSummaryList');
    roundsList.innerHTML = '';
    
    gameState.roundResults.forEach(result => {
        const div = document.createElement('div');
        div.className = 'round-item';
        div.innerHTML = `
            <span class="round-badge-left">Round ${result.round}</span>
            
            <div class="result-main-content">
                <div class="poster-wrapper">
                    <img src="${result.anime.poster}" alt="${result.anime.name}" class="anime-poster">
                    <a href="https://loveanime.rf.gd/anime/${result.anime.id}" class="mal-link">LoveAnime <i class="fa-solid fa-arrow-up-right-from-square small-icon"></i></a>
                </div>
                
                <div class="anime-details-middle">
                    <div class="title-inline-group">
                        <h2 class="anime-title">${result.anime.name}</h2>
                        <span class="annee-badge">${result.anime.annee}</span>
                    </div>
                    
                    <div class="screenshots-section">
                        <div class="screenshots-grid">
                            <img src="/aniguessr/${result.anime.image}"  alt="" class="screenshot-thumb">
                            <img src="/aniguessr/${result.anime.image2}" alt="" class="screenshot-thumb">
                            <img src="/aniguessr/${result.anime.image3}" alt="" class="screenshot-thumb">
                        </div>
                    </div>
                </div>
            </div>

            <div class="score-badge-right">${result.points} pts</div>
        `;
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