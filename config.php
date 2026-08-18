<?php
session_start();
require_once "../bd.php";

// Récupération des données depuis la base
$stmt = $pdo->query("
    SELECT * FROM animes
    WHERE titre NOT IN (
        'Fullmetal Alchemist',
        'Fullmetal Alchemist : L\'Étoile sacrée de Milos',
        'Fullmetal Alchemist: Conqueror of Shamballa',
        'Horimiya: The Missing Pieces',
        'KonoSuba - An Explosion on This Wonderful World!',
        'Rascal Does Not Dream of a Dreaming Girl',
        'Rascal Does Not Dream of a Sister Venturing Out',
        'Rascal Does Not Dream of a Knapsack Kid'
    )
    ORDER BY id ASC LIMIT 1
");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement des données pour les animes et personnages
$animeTitles = array_map('strtolower', array_filter(array_column(array_filter($results, fn($a) => $a['type'] === 'anime'), 'titre')));
$animes = [];
$characters = [];

if (!isset($_SESSION['current_character_images'])) {
    $_SESSION['current_character_images'] = [];
}

foreach ($results as $anime) {
    $titre = strtolower(trim($anime['titre']));
    $keep = ($anime['type'] === 'anime') ? true : false;

    if (!$keep) {
        foreach ($animeTitles as $aTitle) {
            if ($aTitle !== $titre && str_contains($titre, $aTitle)) {
                $keep = false;
                break;
            } else {
                $keep = true;
            }
        }
    }

    if (!$keep) continue;

    $screenshot1 = "screenshot.php?id={$anime['id']}&num=1";
    $screenshot2 = "screenshot.php?id={$anime['id']}&num=2";
    $screenshot3 = "screenshot.php?id={$anime['id']}&num=3";

    if (!function_exists('slugify')) {
        function slugify($text) {
            $text = strtolower($text);
            $text = preg_replace('/[^\p{L}\p{N}]+/u', '_', $text);
            return trim($text, '_');
        }
    }

    if (!function_exists('findOpeningFiles')) {
        function findOpeningFiles($animeName) {
            $slug = slugify($animeName);
            $audioDir = __DIR__ . "/../openings/audio/";
            $videoDir = __DIR__ . "/../openings/video/";

            $files = [
                "audio" => [],
                "video" => []
            ];

            // Recherche des fichiers audio
            foreach (glob($audioDir . "*.mp3") as $file) {
                if (strpos(basename($file), $slug) !== false) {
                    $files["audio"][] = "openings/audio/" . basename($file);
                }
            }

            // Recherche des fichiers vidéo
            foreach (glob($videoDir . "*.mp4") as $file) {
                if (strpos(basename($file), $slug) !== false) {
                    $files["video"][] = "openings/video/" . basename($file);
                }
            }

            return $files;
        }
    }

    $openings = findOpeningFiles($anime['titre']);

    $stmt2 = $pdo->prepare("
    SELECT YEAR(diffusion) AS annee
    FROM (
        SELECT episodes_s1.diffusion
        FROM episodes_s1
        WHERE id_anime = :id_anime

        UNION ALL

        SELECT episodes_sans_saisons.diffusion
        FROM episodes_sans_saisons
        WHERE id_anime = :id_anime
    ) AS toutes_les_dates
    LIMIT 1;
    ");

    $stmt2->bindValue(':id_anime', $anime['id'], PDO::PARAM_INT);

    $stmt2->execute();

    $annee = $stmt2->fetchColumn();

    $anneeFilm = [
        12 => 2016,
        13 => 2022,
        14 => 2019,
        15 => 2016,
        19 => 2018,
        64 => 2022,
        69 => 2022,
        148 => 2025,
        165 => 2006
    ];

    if (isset($anneeFilm[$anime['id']])) {
        $annee = $anneeFilm[$anime['id']];
    }

    $stmt3 = $pdo->prepare("
    SELECT SUM(nb) AS total_episodes
    FROM (
    SELECT COUNT(*) AS nb FROM episodes_s1 WHERE id_anime = :id_anime
    UNION ALL
    SELECT COUNT(*) FROM episodes_s2 WHERE id_anime = :id_anime
    UNION ALL
    SELECT COUNT(*) FROM episodes_s3 WHERE id_anime = :id_anime
    UNION ALL
    SELECT COUNT(*) FROM episodes_s4 WHERE id_anime = :id_anime
    UNION ALL
    SELECT COUNT(*) FROM episodes_s5 WHERE id_anime = :id_anime
    UNION ALL
    SELECT COUNT(*) FROM episodes_s6 WHERE id_anime = :id_anime
    UNION ALL
    SELECT COUNT(*) FROM episodes_s7 WHERE id_anime = :id_anime
    UNION ALL
    SELECT COUNT(*) FROM episodes_s8 WHERE id_anime = :id_anime
    UNION ALL
    SELECT COUNT(*) FROM episodes_sans_saisons WHERE id_anime = :id_anime
    UNION ALL
    SELECT COUNT(*) FROM episodes_speciaux WHERE id_anime = :id_anime
    ) AS t;
    ");

    $stmt3->bindValue(':id_anime', $anime['id'], PDO::PARAM_INT);

    $stmt3->execute();

    $episodes = $stmt3->fetchColumn();

    $animes[] = [
        'id' => $anime['id'],
        'name' => trim($anime['titre']),
        'image' => $screenshot1,
        'image2' => $screenshot2,
        'image3' => $screenshot3,
        'poster' => trim($anime['img']),
        'openings' => $openings,
        'annee' => $annee,
        'episodes' => $episodes,
        'studio' => $anime['studio_animation'],
        'genres' => $anime['genres'],
        'themes' => $anime['themes']
    ];

    for ($i = 1; $i <= 6; $i++) {
        $persoName = trim($anime["nom_perso$i"] ?? '');
        $persoImg = trim($anime["img_perso$i"] ?? '');

        if (!empty($persoName) && !empty($persoImg)) {
            // On crée un ID unique pour chaque image
            $uniqueId = bin2hex(random_bytes(16));

            // On stocke l'image réelle en session
            $_SESSION['current_character_images'][$uniqueId] = $persoImg;

            // On envoie seulement l'ID au front
            $characters[] = [
                'id' => $uniqueId,
                'name' => $persoName,
                'anime' => trim($anime['titre'])
            ];
        }
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.0/dist/confetti.browser.min.js"></script>
<script>
    let autocomplete = {
        selectedIndex: -1,
        filteredItems: []
    };
    
    let autocompleteInitialized = false;
        
    function setupAutocomplete() {
            const input = document.getElementById('answerInput');
            const dropdown = document.getElementById('autocompleteDropdown');

            if (autocompleteInitialized) return;

            input.addEventListener('input', function() {
                const query = this.value.trim();
                const lowerQuery = query.toLowerCase();

                const startsWith = animeDatabase
                    .filter(anime => anime.name.toLowerCase().startsWith(lowerQuery))
                    .sort((a, b) => a.name.localeCompare(b.name));

                const contains = animeDatabase
                    .filter(anime => !anime.name.toLowerCase().startsWith(lowerQuery) && anime.name.toLowerCase().includes(lowerQuery))
                    .sort((a, b) => a.name.localeCompare(b.name));

                const filtered = [...startsWith, ...contains].slice(0);

                if (filtered.length === 0) {
                    hideAutocomplete();
                    return;
                }

                autocompleteInitialized = true;

                showAutocomplete(filtered);
            });

            input.addEventListener('keydown', function(e) {
                const items = dropdown.querySelectorAll('.autocomplete-item');
                
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    autocomplete.selectedIndex++;
                    if (autocomplete.selectedIndex >= items.length) autocomplete.selectedIndex = items.length - 1;
                    updateSelection(items);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    autocomplete.selectedIndex--;
                    if (autocomplete.selectedIndex < 0) autocomplete.selectedIndex = -1;
                    updateSelection(items);
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    if (autocomplete.selectedIndex >= 0 && items[autocomplete.selectedIndex]) {
                        selectItem(items[autocomplete.selectedIndex].textContent);
                    } else {
                        submitGuess();
                    }
                } else if (e.key === 'Escape') {
                    hideAutocomplete();
                }
            });

            input.addEventListener('blur', function() {
                setTimeout(hideAutocomplete, 150);
            });
        }
        
        function showAutocomplete(items) {
            const dropdown = document.getElementById('autocompleteDropdown');
            dropdown.innerHTML = '';
            
            items.forEach((anime, index) => {
                const item = document.createElement('div');
                item.className = 'autocomplete-item';
                item.textContent = anime.name;
                item.addEventListener('click', () => selectItem(anime.name));
                dropdown.appendChild(item);
            });

            dropdown.style.display = 'block';
            autocomplete.selectedIndex = -1;
            autocomplete.filteredItems = items;
        }

        function hideAutocomplete() {
            document.getElementById('autocompleteDropdown').style.display = 'none';
            autocomplete.selectedIndex = -1;
        }

        function updateSelection(items) {
            items.forEach((item, index) => {
                item.classList.toggle('selected', index === autocomplete.selectedIndex);
            });
        }

        function selectItem(animeName) {
            document.getElementById('answerInput').value = animeName;
            hideAutocomplete();
        }

        function scrollToAndAnimate(elementId, isCorrect) {
            const element = document.getElementById(elementId);
            if (!element) return;

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        obs.disconnect();

                        if (isCorrect) {
                            launchConfettiOnElement(elementId);
                        } else {
                            // 👇 on secoue directement la div de résultat
                            element.classList.add('shake');
                            setTimeout(() => element.classList.remove('shake'), 650);
                        }
                    }
                });
            }, { threshold: 0.1 }); // attendre que l’élément soit complètement visible

            observer.observe(element);

            element.scrollIntoView({ behavior: "smooth" });
        }


        function launchConfettiOnElement(elementId) {
            const element = document.getElementById(elementId);
            if (!element) return;

            // Récupérer la position de la div dans la page
            const rect = element.getBoundingClientRect();
            const x = (rect.left + rect.width / 2) / window.innerWidth;
            const y = (rect.top + rect.height / 2) / window.innerHeight;

            // Explosion principale
            confetti({
                particleCount: 250,
                spread: 90,
                origin: { x, y },
                colors: ['#ff6f61', '#ffcc00', '#4a90e2', '#2ecc71', '#e74c3c']
            });

            // Deux petits tirs décalés
            setTimeout(() => {
                confetti({
                    particleCount: 80,
                    spread: 70,
                    angle: 60,
                    origin: { x: x - 0.2, y },
                    colors: ['#9b59b6', '#f39c12', '#e67e22']
                });
            }, 200);

            setTimeout(() => {
                confetti({
                    particleCount: 80,
                    spread: 70,
                    angle: 120,
                    origin: { x: x + 0.2, y },
                    colors: ['#3498db', '#1abc9c', '#f1c40f']
                });
            }, 400);
        }

        function createProgressBar() {
            const container = document.createElement('div');
            container.className = 'round-progress-container';
            container.id = 'progressBarContainer';
            
            container.innerHTML = `
                <div class="progress-bar-wrapper">
                    <div class="progress-line"></div>
                    <div class="progress-fill" id="progressFill"></div>
                    <div class="progress-circles" id="progressCircles"></div>
                </div>
                <div class="progress-stats">
                    <div class="progress-stat">
                        <span class="progress-stat-icon">✓</span>
                        <span class="progress-stat-value" id="correctCount">0</span>
                        <span class="progress-stat-label">Correct</span>
                    </div>
                    <div class="progress-stat">
                        <span class="progress-stat-icon">✗</span>
                        <span class="progress-stat-value" id="incorrectCount">0</span>
                        <span class="progress-stat-label">Incorrect</span>
                    </div>
                    <div class="progress-stat">
                        <span class="progress-stat-icon">!</span>
                        <span class="progress-stat-value" id="partialCount">0</span>
                        <span class="progress-stat-label">Partiel</span>
                    </div>
                    <div class="progress-stat" id="remainingDiv">
                        <span class="progress-stat-icon">●</span>
                        <span class="progress-stat-value" id="remainingCount">${gameState.maxRounds}</span>
                        <span class="progress-stat-label">Restantes</span>
                    </div>
                </div>
            `;
            
            return container;
        }

        function initProgressBar(conteneur) {

            let progressContainer = document.getElementById('progressBarContainer');
            if (!progressContainer) {
                progressContainer = createProgressBar();
            }

            if (conteneur === "gameScreen") {
                const roundInfo = document.querySelector('.round-info');
                if (roundInfo) {
                    roundInfo.parentNode.insertBefore(progressContainer, roundInfo.nextSibling);
                }
            } else if (conteneur === "summaryScreen") {
                const summaryTitle = document.querySelector('#roundSummary .game-main-title');
                if (summaryTitle) {
                    summaryTitle.parentNode.insertBefore(progressContainer, summaryTitle.nextSibling);
                }
            } else if (conteneur === "finalScoreScreen") {
                const finalScoreTitle = document.querySelector('#finalScoreScreen .game-main-title');
                if (finalScoreTitle) {
                    finalScoreTitle.parentNode.insertBefore(progressContainer, finalScoreTitle.nextSibling);
                }
            }
            updateProgressBar(conteneur);
        }



        function updateProgressBar(conteneur) {
            const circlesContainer = document.getElementById('progressCircles');
            const progressFill = document.getElementById('progressFill');
            if (!circlesContainer || !progressFill) return;

            circlesContainer.innerHTML = '';
            for (let i = 1; i <= gameState.maxRounds; i++) {
                const circle = document.createElement('div');
                circle.className = 'progress-circle';
                circle.dataset.round = i;

                // Vérifie si ce round a déjà un résultat
                const result = gameState.roundResults.find(r => r.round === i);

                if (result) {
                    // Ce round est déjà joué
                    if (result.status === "correct") {
                        circle.classList.add('correct');
                        circle.innerHTML = '✓';
                    } else if (result.status === "partial") {
                        circle.classList.add('partial');
                        circle.innerHTML = '!';
                    } else {
                        circle.classList.add('incorrect');
                        circle.innerHTML = '✗';
                    }
                } else if (i === gameState.currentRound) {
                    // Round actuel (pas encore joué)
                    circle.classList.add('current');
                    circle.textContent = i;
                } else {
                    // Round futur
                    circle.classList.add('pending');
                    circle.textContent = i;
                }
                circlesContainer.appendChild(circle);
            }

            // Calcul de la progression
            let progress = 0;
            if (gameState.maxRounds > 1) {
                progress = ((gameState.currentRound - 1) / (gameState.maxRounds - 1)) * 100;
            }
            progressFill.style.width = progress + '%';
            updateProgressStats(conteneur);
        }


        function updateProgressStats(conteneur) {
            const correctCount = document.getElementById('correctCount');
            const incorrectCount = document.getElementById('incorrectCount');
            const remainingCount = document.getElementById('remainingCount');
            const partialCount = document.getElementById('partialCount');
            const remainingDiv = document.getElementById('remainingDiv');
            
            if (!gameState.roundResults) gameState.roundResults = [];

            if (conteneur === "finalScoreScreen") {
                remainingDiv.style.display = "none";
            }
            
            const correct = gameState.roundResults.filter(r => r.status === "correct").length;
            const partial = gameState.roundResults.filter(r => r.status === "partial").length;
            const incorrect = gameState.roundResults.filter(r => r.status === "incorrect").length;
            const remaining = gameState.maxRounds - gameState.roundResults.length;
            
            if (correctCount) correctCount.textContent = correct;
            if (incorrectCount) incorrectCount.textContent = incorrect;
            if (partialCount) partialCount.textContent = partial;
            if (remainingCount) remainingCount.textContent = remaining;
        }
        
</script>