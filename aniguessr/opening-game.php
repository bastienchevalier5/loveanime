<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoveAniGuessr — Opening Mode</title>
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
            <h1 class="game-main-title"><i class="fa-solid fa-music"></i> GUESS THE OPENING</h1>
            <div class="round-info">
                <span class="round-title">Round <span id="roundNumber">1</span></span>
            </div>

            <div id="openingInterface">
                <div class="audio-container">
                    <div class="aWrap" data-src="">
                        <button class="aPlay" disabled><span class="aPlayIco"><i class="fa fa-play"></i></span></button>
                        <div class="range">
                            <span class="under-ranger"></span>
                            <input class="aSeek exclus" type="range" min="0" value="0" step="0.01" max="100" disabled>
                            <span class="change-range"></span>
                        </div>
                        <div class="volume-container">
                            <span class="aVolIco"><i class="fa fa-volume-up"></i></span>
                            <div class="range-volume">
                                <span class="under-ranger"></span>
                                <input class="aVolume" type="range" min="0" max="1" value="1" step="0.05" disabled>
                                <span class="change-range"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clues-container">
                    <button class="clue-btn used" id="audioBtn" onclick="switchToAudio()">
                        <span class="clue-icon">🔓</span><span>AUDIO UNIQUEMENT</span>
                    </button>
                    <button class="clue-btn locked" id="videoClueBtn" onclick="useClue('video')">
                        <span class="clue-icon">🔒</span><span>DÉBLOQUER LA VIDÉO</span>
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
        <div class="round-header">
            <h1 class="game-main-title"><i class="fa-solid fa-music"></i> GUESS THE OPENING</h1>
            <span class="round-title">Round <span id="summaryRoundNumber">1</span></span>
        </div>
        <div class="result-container">
            <div>
                <img id="summaryPoster" src="" alt="Affiche" class="anime-poster">
                <a href="#" class="mal-link" id="malLink"><i class="fa-solid fa-arrow-up-right-from-square"></i> LoveAnime</a>
            </div>
            <div class="result-info">
                <h2 id="summaryTitle" class="anime-title">Titre</h2>
                <div class="annee-container"><span id="annee">Année</span></div>
                <div class="song-info" id="songInfo"><span id="songTitle">Titre de la chanson</span></div>
                <div class="score-section"><div id="summaryPoints" class="score-value">0 pts</div></div>
                <div class="audio-container">
                    <div class="aWrap" style="margin:0" data-src="">
                        <button class="aPlay" disabled><span class="aPlayIco"><i class="fa fa-play"></i></span></button>
                        <div class="range">
                            <span class="under-ranger"></span>
                            <input class="aSeek" type="range" min="0" value="0" step="0.01" max="100" disabled>
                            <span class="change-range"></span>
                        </div>
                        <div class="volume-container">
                            <span class="aVolIco"><i class="fa fa-volume-up"></i></span>
                            <div class="range-volume">
                                <span class="under-ranger"></span>
                                <input class="aVolume" type="range" min="0" max="1" value="1" step="0.05" disabled>
                                <span class="change-range"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="nextRoundBtn" class="next-round-btn">PROCHAIN ROUND →</button>
            </div>
        </div>
        <button onclick="goToMenu()" class="menu-btn">← Revenir au menu</button>
    </div>

    <!-- FINAL SCORE -->
    <div id="finalScoreScreen" class="final-score-screen" style="display:none;">
        <div class="final-score-container">
            <h1 class="game-main-title"><i class="fa-solid fa-music"></i> GUESS THE OPENING</h1>
            <h1 class="final-score-title">Score Final</h1>
            <div class="total-score-card">
                <div class="total-score-value" id="finalTotalScore">0 pts</div>
            </div>
            <div class="rounds-summary" id="roundsSummaryList"></div>
            <button onclick="goToMenu()" class="menu-btn">← Revenir au menu</button>
        </div>
    </div>

    <script>
        let animeDatabase = <?php echo json_encode($animes ?? []); ?>;

        const excludedTitles = ["Les Enfants du Temps", "Bubble", "Tunnel to Summer", "B: The Beginning", "KPop Demon Hunters"];
        animeDatabase = animeDatabase.filter(a => !excludedTitles.includes(a.name));

        const POINTS = { audioOnly: 10000, withVideo: 5000 };

        let gameState = {
            currentRound: 1,
            maxRounds: 3,
            currentAnime: null,
            videoUnlocked: false,
            answered: false,
            currentOpeningFile: '',
            scores: { opening: parseInt(localStorage.getItem('openingScore') || '0') },
            mode: 'opening',
            mediaCurrentTime: 0,
            roundResults: []
        };

        const pathParts = window.location.pathname.split('/').filter(Boolean);
        gameState.maxRounds = parseInt(pathParts[pathParts.length - 1]) || 3;

        function generateFileName(animeName) {
            return animeName.toLowerCase()
                .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                .replace(/[^a-z0-9]/g, '')
                .replace(/\s+/g, '');
        }

        function extractOpeningTitle(fileName) {
            const replacements = { "deuxpoints": ":", "exclamation": "!", "virgule": ", ", "point": ".", "apostrophe": "'", "tiret": "-", "slash": "/", "esperluette": "&", "parenthese_ouvrante": "(", "parenthese_fermante": ")", "interrogation": "?" };
            const parts = fileName.split('_');
            if (parts.length >= 2) {
                return parts.slice(1).map(word => replacements[word] || word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()).join(' ');
            }
            return 'Opening';
        }

        function startNewRound() {
            gameState.currentOpeningFile = '';
            gameState.answered = false;
            gameState.videoUnlocked = false;
            document.getElementById('roundNumber').textContent = gameState.currentRound;

            const MAX_COOLDOWN = 10;
            let recentAnimes = JSON.parse(localStorage.getItem('recentOpeningAnimes') || '[]');
            const available = animeDatabase.filter(a => a && a.name && !recentAnimes.includes(a.name));
            const pool = available.length > 0 ? available : animeDatabase.filter(a => a && a.name);
            const chosen = pool[Math.floor(Math.random() * pool.length)];
            recentAnimes.push(chosen.name);
            if (recentAnimes.length > MAX_COOLDOWN) recentAnimes.shift();
            localStorage.setItem('recentOpeningAnimes', JSON.stringify(recentAnimes));
            gameState.currentAnime = chosen;

            loadAudioFile();
            document.getElementById('answerInput').value = '';
            resetClueButtons();
            setupAutocomplete();
            initProgressBar("gameScreen");
        }

        function loadAudioFile() {
            let baseFileName = generateFileName(gameState.currentAnime.name);
            fetch(`/aniguessr/list_files.php?base=${baseFileName}`)
                .then(res => { if (!res.ok) throw new Error(); return res.json(); })
                .then(data => {
                    if (data.error || !data.token || !data.filename) throw new Error('No media');
                    gameState.currentOpeningFile = data.filename;
                    gameState.mediaToken = data.token;
                    gameState.hasVideo = data.has_video;
                    gameState.currentAnime.opening_title = extractOpeningTitle(data.filename);
                    resetMedia();
                    initCustomPlayers();

                    const videoBtn = document.getElementById('videoClueBtn');
                    if (!gameState.hasVideo) {
                        videoBtn.classList.add('disabled');
                        videoBtn.onclick = null;
                        videoBtn.innerHTML = '<span class="clue-icon">❌</span><span>VIDÉO INDISPONIBLE</span>';
                    }
                })
                .catch(() => setTimeout(() => startNewRound(), 1000));
        }

        function resetClueButtons() {
            const videoBtn = document.getElementById('videoClueBtn');
            videoBtn.classList.remove('used');
            videoBtn.classList.add('locked');
            videoBtn.innerHTML = '<span class="clue-icon">🔒</span><span>DÉBLOQUER LA VIDÉO</span>';
            videoBtn.onclick = () => useClue('video');

            const audioBtn = document.getElementById('audioBtn');
            audioBtn.classList.add('used');
            audioBtn.classList.remove('available', 'locked');
            audioBtn.onclick = () => switchToAudio();
        }

        function switchToAudio() {
            if (gameState.answered) return;
            const videoWrapper = document.querySelector('.vWrap');
            let currentTime = 0;
            if (videoWrapper) { const v = videoWrapper.querySelector('video'); if (v) currentTime = v.currentTime; }
            stopAllMedia();
            gameState.mediaCurrentTime = currentTime;

            document.getElementById('audioBtn').classList.add('used');
            document.getElementById('audioBtn').classList.remove('available');
            if (gameState.videoUnlocked) {
                document.getElementById('videoClueBtn').classList.remove('used');
                document.getElementById('videoClueBtn').classList.add('available');
            }
            resetMedia();
            initCustomPlayers();
            const aw = document.querySelector('.aWrap');
            if (aw && aw.audio) aw.audio.currentTime = gameState.mediaCurrentTime;
        }

        function switchToVideo() {
            if (gameState.answered || !gameState.videoUnlocked) return;
            const aw = document.querySelector('.aWrap');
            let currentTime = 0;
            if (aw && aw.audio) currentTime = aw.audio.currentTime;
            stopAllMedia();
            gameState.mediaCurrentTime = currentTime;

            document.getElementById('videoClueBtn').classList.add('used');
            document.getElementById('videoClueBtn').classList.remove('available');
            document.getElementById('audioBtn').classList.remove('used');
            document.getElementById('audioBtn').classList.add('available');
            replaceAudioWithVideo(gameState.currentOpeningFile, currentTime);
        }

        function useClue(clueType) {
            if (gameState.answered || clueType !== 'video' || gameState.videoUnlocked || !gameState.hasVideo) return;
            gameState.videoUnlocked = true;

            const aw = document.querySelector('.aWrap');
            let currentTime = 0;
            if (aw && aw.audio) currentTime = aw.audio.currentTime;
            stopAllMedia();
            gameState.mediaCurrentTime = currentTime;

            const videoBtn = document.getElementById('videoClueBtn');
            videoBtn.classList.add('used');
            videoBtn.classList.remove('locked');
            videoBtn.innerHTML = '<span class="clue-icon">🔓</span><span>VIDÉO DÉBLOQUÉE</span>';
            videoBtn.onclick = () => switchToVideo();
            document.getElementById('audioBtn').classList.remove('used');
            document.getElementById('audioBtn').classList.add('available');

            replaceAudioWithVideo(gameState.currentOpeningFile, currentTime);
        }

        function replaceAudioWithVideo(fileName, startTime = 0) {
            if (!gameState.hasVideo || !gameState.mediaToken) return;
            const audioContainer = document.querySelector('.audio-container');
            const token = gameState.mediaToken;
            audioContainer.innerHTML = `
                <div class="video-container">
                    <div class="vWrap" data-src="/aniguessr/get_media.php?token=${token}&type=video">
                        <video class="video-element blurred-video" preload="metadata">
                            <source src="/aniguessr/get_media.php?token=${token}&type=video" type="video/mp4">
                        </video>
                        <div class="loading" style="display:none;"><div class="spinner"></div>Chargement...</div>
                        <div class="video-controls">
                            <div class="vWrap-controls">
                                <button class="vPlay" disabled><span class="vPlayIco"><i class="fa fa-play"></i></span></button>
                                <div class="vol-fullscreen">
                                    <div class="volume-container-video">
                                        <span class="vVolIco"><i class="fa fa-volume-up"></i></span>
                                        <div class="range-volume-video">
                                            <span class="under-ranger-video"></span>
                                            <input class="vVolume" type="range" min="0" max="1" value="1" step="0.1" disabled>
                                            <span class="change-range"></span>
                                        </div>
                                    </div>
                                    <button class="fullscreen-btn"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            const wrapper = document.querySelector('.vWrap');
            const video = wrapper.querySelector('video');
            video.addEventListener('canplay', () => { if (isFinite(startTime)) video.currentTime = startTime; }, { once: true });
            initCustomVideoPlayer(startTime);
        }

        function initCustomVideoPlayer() {
            const wrapper = document.querySelector('.vWrap');
            if (!wrapper || wrapper.dataset.initialized) return;
            wrapper.dataset.initialized = true;

            const video = wrapper.querySelector('video');
            const loading = wrapper.querySelector('.loading');
            const vPlay = wrapper.querySelector('.vPlay');
            const vPlayIco = wrapper.querySelector('.vPlayIco');
            const vVolume = wrapper.querySelector('.vVolume');
            const vVolIco = wrapper.querySelector('.vVolIco');
            const fullscreenBtn = wrapper.querySelector('.fullscreen-btn');

            function setProgress(el) {
                if (!el) return;
                const w = Math.floor(el.value / (el.getAttribute('max') / 100));
                const cr = el.nextElementSibling;
                if (cr && cr.classList.contains('change-range')) cr.style.width = (w > 95 ? 95 : w) + '%';
            }

            vPlay.onclick = () => video.paused ? video.play() : video.pause();
            video.onplay  = () => vPlayIco.innerHTML = '<i class="fa fa-pause"></i>';
            video.onpause = () => vPlayIco.innerHTML = '<i class="fa fa-play"></i>';

            video.onloadstart    = () => { loading.style.display = 'block'; vPlay.disabled = true; vVolume.disabled = true; };
            video.oncanplaythrough = () => { loading.style.display = 'none'; vPlay.disabled = false; vVolume.disabled = false; };
            video.onwaiting = () => loading.style.display = 'block';
            video.oncanplay = () => loading.style.display = 'none';

            vVolIco.onclick = () => {
                video.volume = video.volume === 0 ? 1 : 0;
                vVolume.value = video.volume;
                vVolIco.innerHTML = `<i class="fa fa-volume-${video.volume === 0 ? 'off' : 'up'}"></i>`;
                setProgress(vVolume);
            };
            vVolume.oninput = () => {
                video.volume = vVolume.value;
                vVolIco.innerHTML = `<i class="fa fa-volume-${vVolume.value == 0 ? 'off' : vVolume.value < 0.5 ? 'down' : 'up'}"></i>`;
                setProgress(vVolume);
            };

            fullscreenBtn.onclick = async () => {
                if (!document.fullscreenElement) {
                    try { await wrapper.requestFullscreen(); if (screen.orientation?.lock) await screen.orientation.lock('landscape').catch(() => {}); } catch(e) {}
                } else document.exitFullscreen();
            };
            document.onfullscreenchange = () => {
                const icon = fullscreenBtn.querySelector('i');
                icon.className = document.fullscreenElement ? 'fa-solid fa-down-left-and-up-right-to-center' : 'fa-solid fa-up-right-and-down-left-from-center';
            };
            video.onerror = () => { loading.style.display = 'none'; if (typeof switchToAudio === 'function') setTimeout(switchToAudio, 2000); };
            setProgress(vVolume);
        }

        function calculatePoints() {
            return gameState.videoUnlocked ? POINTS.withVideo : POINTS.audioOnly;
        }

        function submitGuess() {
            stopAllMedia();
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
                gameState.scores.opening += points;
                localStorage.setItem('openingScore', gameState.scores.opening);
            }
            showResult(isCorrect, points, isCorrect ? 'correct' : 'incorrect');
        }

        function showResult(isCorrect, points, status) {
            const summary = document.getElementById('roundSummary');
            const gameScreen = document.getElementById('gameScreen');
            summary.style.display = window.innerWidth <= 768 ? 'block' : 'flex';
            gameScreen.style.display = 'none';

            document.getElementById('summaryRoundNumber').textContent = gameState.currentRound;
            document.getElementById('summaryPoster').src = gameState.currentAnime.poster;
            document.getElementById('summaryTitle').textContent = gameState.currentAnime.name;
            document.getElementById('annee').textContent = gameState.currentAnime.annee;

            const songTitle = document.getElementById('songTitle');
            songTitle.textContent = gameState.currentAnime.opening_title || gameState.currentAnime.name + ' - Opening';

            document.getElementById('malLink').href = `https://loveanime.rf.gd/anime/${gameState.currentAnime.id}`;
            document.getElementById('summaryPoints').textContent = points + ' pts';

            const summaryAudioWrap = document.querySelector('#roundSummary .audio-container .aWrap');
            if (summaryAudioWrap) summaryAudioWrap.setAttribute('data-src', `/aniguessr/get_media.php?token=${gameState.mediaToken}&type=audio`);

            scrollToAndAnimate('roundSummary', isCorrect);

            gameState.roundResults.push({ round: gameState.currentRound, anime: gameState.currentAnime, points, isCorrect, status, mode: 'opening', openingFile: gameState.currentOpeningFile, mediaToken: gameState.mediaToken });
            updateProgressBar();

            const nextBtn = document.getElementById('nextRoundBtn');
            if (gameState.currentRound >= gameState.maxRounds) {
                nextBtn.textContent = 'SCORE FINAL →';
                nextBtn.onclick = () => { stopAllMedia(); summary.style.display = 'none'; showFinalScore(); };
            } else {
                nextBtn.textContent = 'PROCHAIN ROUND →';
                nextBtn.onclick = () => { stopAllMedia(); summary.style.display = 'none'; gameScreen.style.display = 'block'; gameState.currentRound++; nextRound(); };
            }
            initCustomPlayers();
            initProgressBar("summaryScreen");
        }

        function nextRound() {
            resetMedia();
            if (gameState.currentRound > gameState.maxRounds) { showFinalScore(); return; }
            startNewRound();
        }

        function resetMedia() {
            const audioContainer = document.querySelector('.audio-container');
            if (!audioContainer) return;
            const token = gameState.mediaToken;
            audioContainer.innerHTML = `
                <div class="aWrap" data-src="/aniguessr/get_media.php?token=${token}&type=audio">
                    <button class="aPlay" disabled><span class="aPlayIco"><i class="fa fa-play"></i></span></button>
                    <div class="range">
                        <span class="under-ranger"></span>
                        <input class="aSeek exclus" type="range" min="0" value="0" step="1" disabled><span class="change-range"></span>
                    </div>
                    <div class="volume-container">
                        <span class="aVolIco"><i class="fa fa-volume-up"></i></span>
                        <div class="range-volume">
                            <span class="under-ranger"></span>
                            <input class="aVolume" type="range" min="0" max="1" value="1" step="0.1" disabled><span class="change-range"></span>
                        </div>
                    </div>
                </div>
            `;
        }

        function stopAllMedia() {
            document.querySelectorAll('.aWrap').forEach(w => { if (w.audio) { w.audio.pause(); w.audio.currentTime = 0; } });
            document.querySelectorAll('.vWrap video').forEach(v => { v.pause(); v.currentTime = 0; });
        }

        function showFinalScore() {
            const finalScreen = document.getElementById('finalScoreScreen');
            finalScreen.style.display = window.innerWidth <= 768 ? 'block' : 'flex';
            document.getElementById('finalTotalScore').textContent = gameState.scores.opening + ' pts';

            const roundsList = document.getElementById('roundsSummaryList');
            roundsList.innerHTML = '';
            gameState.roundResults.forEach(result => {
                const div = document.createElement('div');
                div.className = 'round-item';
                const audioToken = result.mediaToken || gameState.mediaToken;
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
                            <div class="song-info"><span>${result.anime.opening_title || result.anime.name + ' - Opening'}</span></div>
                            <div class="audio-player">
                                <div class="aWrap" data-src="/aniguessr/get_media.php?token=${audioToken}&type=audio">
                                    <button class="aPlay" disabled><span class="aPlayIco"><i class="fa fa-play"></i></span></button>
                                    <div class="range">
                                        <span class="under-ranger"></span>
                                        <input class="aSeek" type="range" min="0" value="0" step="0.01" max="100" disabled><span class="change-range"></span>
                                    </div>
                                    <div class="volume-container-finalscore">
                                        <span class="aVolIco"><i class="fa fa-volume-up"></i></span>
                                        <div class="range-volume">
                                            <span class="under-ranger"></span>
                                            <input class="aVolume" type="range" min="0" max="1" value="1" step="0.05" disabled><span class="change-range"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                roundsList.appendChild(div);
            });
            setTimeout(() => initCustomPlayers(), 100);
            initProgressBar("finalScoreScreen");
        }

        function goToMenu() { window.location.href = "/aniguessr"; }

        function initCustomPlayers() {
            function setProgress(el) {
                if (!el) return;
                const w = Math.floor(el.value / (el.getAttribute('max') / 100));
                const cr = el.nextElementSibling;
                if (cr && cr.classList.contains('change-range')) cr.style.width = (w > 95 ? 95 : w) + '%';
            }

            document.querySelectorAll('.aWrap').forEach(wrapper => {
                const src = wrapper.dataset.src;
                if (!src || wrapper.dataset.initialized) return;
                wrapper.dataset.initialized = true;

                wrapper.audio = new Audio(encodeURI(src));
                wrapper.audio.preload = 'metadata';

                const aPlay = wrapper.querySelector('.aPlay');
                const aPlayIco = wrapper.querySelector('.aPlayIco');
                const aSeek = wrapper.querySelector('.aSeek');
                const aVolume = wrapper.querySelector('.aVolume');
                const aVolIco = wrapper.querySelector('.aVolIco');

                if (!aPlay || !aPlayIco || !aSeek || !aVolume || !aVolIco) return;

                Object.assign(wrapper, { aPlay, aPlayIco, aSeek, aVolume, aVolIco, seeking: false });
                aPlay.disabled = true;

                aPlay.onclick = () => wrapper.audio.paused ? wrapper.audio.play().catch(console.error) : wrapper.audio.pause();
                wrapper.audio.onplay  = () => aPlayIco.innerHTML = '<i class="fa fa-pause"></i>';
                wrapper.audio.onpause = () => aPlayIco.innerHTML = '<i class="fa fa-play"></i>';

                wrapper.audio.onloadedmetadata = () => {
                    aSeek.max = Math.floor(wrapper.audio.duration);
                    aSeek.oninput = () => {
                        wrapper.seeking = true;
                        const pct = (aSeek.value / aSeek.max) * 100;
                        const cr = aSeek.nextElementSibling;
                        if (cr && cr.classList.contains('change-range')) cr.style.width = pct + '%';
                    };
                    aSeek.onchange = () => { wrapper.audio.currentTime = aSeek.value; wrapper.seeking = false; };
                    wrapper.audio.ontimeupdate = () => {
                        if (!wrapper.seeking) {
                            aSeek.value = Math.floor(wrapper.audio.currentTime);
                            const pct = (aSeek.value / aSeek.max) * 100;
                            const cr = aSeek.nextElementSibling;
                            if (cr && cr.classList.contains('change-range')) cr.style.width = pct + '%';
                        }
                    };
                };

                aVolIco.onclick = () => {
                    wrapper.audio.volume = wrapper.audio.volume === 0 ? 1 : 0;
                    aVolume.value = wrapper.audio.volume;
                    aVolIco.innerHTML = `<i class="fa fa-volume-${wrapper.audio.volume === 0 ? 'off' : 'up'}"></i>`;
                    setProgress(aVolume);
                };
                aVolume.oninput = () => {
                    wrapper.audio.volume = aVolume.value;
                    aVolIco.innerHTML = `<i class="fa fa-volume-${aVolume.value == 0 ? 'off' : aVolume.value < 0.5 ? 'down' : 'up'}"></i>`;
                    setProgress(aVolume);
                };

                wrapper.audio.oncanplaythrough = () => { aPlay.disabled = false; aSeek.disabled = false; aVolume.disabled = false; };
                wrapper.audio.onwaiting = () => { aPlay.disabled = true; aSeek.disabled = true; aVolume.disabled = true; };
                wrapper.audio.onerror  = () => { aPlay.disabled = true; aSeek.disabled = true; aVolume.disabled = true; };

                setProgress(aSeek);
                setProgress(aVolume);
            });
        }

        document.addEventListener('DOMContentLoaded', () => startNewRound());
    </script>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>