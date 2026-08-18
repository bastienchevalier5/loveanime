<?php
session_start();

$base = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['base'] ?? '');
if (empty($base)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Base filename required']);
    exit;
}

$audioDir = __DIR__ . "/openings/audio/";
$videoDir = __DIR__ . "/openings/video/";

// Chercher les fichiers audio
$audioFiles = glob($audioDir . $base . "_*.mp3");

if (empty($audioFiles)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No audio files found']);
    exit;
}

// Prendre le premier fichier audio trouvé
$audioFile = basename($audioFiles[0], '.mp3');
$videoFile = $videoDir . $audioFile . '.mp4';

// Vérifier si le fichier vidéo correspondant existe
$hasVideo = file_exists($videoFile);

// Générer un token unique
$token = bin2hex(random_bytes(16));

// Stocker le mapping token -> filename en session avec timestamp
if (!isset($_SESSION['media_tokens'])) {
    $_SESSION['media_tokens'] = [];
}

$_SESSION['media_tokens'][$token] = [
    'filename' => $audioFile,
    'has_video' => $hasVideo,
    'timestamp' => time()
];

// Nettoyer les anciens tokens (plus de 1 heure)
$currentTime = time();
foreach ($_SESSION['media_tokens'] as $oldToken => $data) {
    if (isset($data['timestamp']) && $currentTime - $data['timestamp'] > 3600) {
        unset($_SESSION['media_tokens'][$oldToken]);
    }
}

header('Content-Type: application/json');
echo json_encode([
    'token' => $token, 
    'filename' => $audioFile,
    'has_video' => $hasVideo
]);
?>