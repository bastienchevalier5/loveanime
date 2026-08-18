<?php
    require_once 'config.php';

    // S'assurer qu'une session existe (si config.php ne le fait pas déjà)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoveAniGuessr — Devine l'animé !</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/loveanime.css">
    <link rel="stylesheet" href="aniguessr.css">
</head>
<body>

    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
    </header>

    <!-- HERO -->
    <section class="ag-hero">
        <div class="ag-hero-content">
            <div class="ag-eyebrow"><i class="fa-solid fa-gamepad"></i> Mini-jeux anime</div>
            <h1>Love<span>Ani</span>Guessr</h1>
            <p>Teste tes connaissances avec nos 4 modes de jeu : screenshots, personnages, openings et indices.</p>

            <div class="ag-round-selector">
                <label for="roundCount"><i class="fa-solid fa-repeat"></i> Nombre de rounds</label>
                <div class="number-input">
                    <button type="button" onclick="stepDown('roundCount')">-</button>
                    <input type="number" id="roundCount" min="1" max="20" value="5">
                    <button type="button" onclick="stepUp('roundCount')">+</button>
                </div>
            </div>

            <div class="ag-modes-grid">
                <div class="ag-mode-card" onclick="startGame('screenshot')">
                    <span class="ag-mode-icon">🖼️</span>
                    <div class="ag-mode-title">Screenshot</div>
                    <div class="ag-mode-desc">Devine l'animé à partir d'un screenshot — débloques des indices si tu bloques.</div>
                    <span class="ag-mode-score"><i class="fa-solid fa-star"></i> <span id="screenshotScore">0</span> pts</span>
                </div>

                <div class="ag-mode-card" onclick="startGame('character')">
                    <span class="ag-mode-icon">🧑‍🎤</span>
                    <div class="ag-mode-title">Personnages</div>
                    <div class="ag-mode-desc">Identifie le personnage et l'animé dans lequel il apparaît.</div>
                    <span class="ag-mode-score"><i class="fa-solid fa-star"></i> <span id="characterScore">0</span> pts</span>
                </div>

                <div class="ag-mode-card" onclick="startGame('opening')">
                    <span class="ag-mode-icon">🎵</span>
                    <div class="ag-mode-title">Opening</div>
                    <div class="ag-mode-desc">Écoute l'opening et devine l'animé — débloques la vidéo si tu sèches.</div>
                    <span class="ag-mode-score"><i class="fa-solid fa-star"></i> <span id="openingScore">0</span> pts</span>
                </div>

                <div class="ag-mode-card" onclick="startGame('anidle')">
                    <span class="ag-mode-icon">🔍</span>
                    <div class="ag-mode-title">Anidle</div>
                    <div class="ag-mode-desc">Devine l'animé via ses indices : année, genres, thèmes, épisodes, studio.</div>
                    <span class="ag-mode-score"><i class="fa-solid fa-star"></i> <span id="anidleScore">0</span> pts</span>
                </div>
            </div>

            <div class="ag-total-score">
                <h2>Score total</h2>
                <div class="ag-total-score-value" id="totalScore">0</div>
            </div>
        </div>
    </section>

    <script>
        let animeDatabase = <?php echo json_encode($animes); ?>;
        let characterDatabase = <?php echo json_encode($characters); ?>;

        let gameState = {
            scores: {
                screenshot: parseInt(localStorage.getItem('screenshotScore') || '0'),
                character:  parseInt(localStorage.getItem('characterScore')  || '0'),
                opening:    parseInt(localStorage.getItem('openingScore')    || '0'),
                anidle:     parseInt(localStorage.getItem('anidleScore')     || '0')
            }
        };

        function updateScores() {
            document.getElementById('screenshotScore').textContent = gameState.scores.screenshot;
            document.getElementById('characterScore').textContent  = gameState.scores.character;
            document.getElementById('openingScore').textContent    = gameState.scores.opening;
            document.getElementById('anidleScore').textContent     = gameState.scores.anidle;
            const total = Object.values(gameState.scores).reduce((a, b) => a + b, 0);
            document.getElementById('totalScore').textContent = total.toLocaleString();
        }

        function startGame(mode) {
            let roundCount = parseInt(document.getElementById('roundCount').value);
            if (isNaN(roundCount) || roundCount < 1) roundCount = 1;
            if (roundCount > 20) roundCount = 20;

            const resetMap = { character: 'characterScore', screenshot: 'screenshotScore', opening: 'openingScore', anidle: 'anidleScore' };
            if (resetMap[mode]) localStorage.setItem(resetMap[mode], '0');

            window.location.href = mode + '/' + roundCount;
        }

        function stepUp(id) {
            const input = document.getElementById(id);
            if (+input.value < +input.max) input.stepUp();
        }
        function stepDown(id) {
            const input = document.getElementById(id);
            if (+input.value > +input.min) input.stepDown();
        }

        document.addEventListener('DOMContentLoaded', updateScores);
    </script>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>