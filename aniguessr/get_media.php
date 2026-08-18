<?php
session_start();

$token = $_GET['token'] ?? '';
$type = $_GET['type'] ?? 'audio'; // 'audio' ou 'video'

// Vérifier si le token existe dans la session
if (!isset($_SESSION['media_tokens'][$token])) {
    http_response_code(404);
    exit('Token invalide');
}

$tokenData = $_SESSION['media_tokens'][$token];
$filename = is_array($tokenData) ? $tokenData['filename'] : $tokenData;

// Vérifier si la vidéo est demandée mais n'existe pas
if ($type === 'video' && is_array($tokenData) && !$tokenData['has_video']) {
    http_response_code(404);
    exit('Fichier vidéo non disponible');
}

$extension = ($type === 'video') ? '.mp4' : '.mp3';
$filepath = __DIR__ . "/openings/{$type}/" . $filename . $extension;

if (!file_exists($filepath)) {
    http_response_code(404);
    error_log("Fichier non trouvé: " . $filepath);
    exit('Fichier non trouvé: ' . basename($filepath));
}

// Vérifier que le fichier est lisible
if (!is_readable($filepath)) {
    http_response_code(403);
    error_log("Fichier non lisible: " . $filepath);
    exit('Fichier non accessible');
}

$filesize = filesize($filepath);
if ($filesize === false) {
    http_response_code(500);
    error_log("Impossible de lire la taille du fichier: " . $filepath);
    exit('Erreur serveur');
}

// Gestion des requêtes Range pour le streaming vidéo
$range = $_SERVER['HTTP_RANGE'] ?? '';

if ($range && $type === 'video') {
    // Parse Range header
    if (preg_match('/bytes=(\d+)-(\d*)/', $range, $matches)) {
        $start = intval($matches[1]);
        $end = !empty($matches[2]) ? intval($matches[2]) : $filesize - 1;
        
        if ($start >= $filesize) {
            http_response_code(416);
            header("Content-Range: bytes */$filesize");
            exit('Range non satisfiable');
        }
        
        $end = min($end, $filesize - 1);
        $length = $end - $start + 1;
        
        http_response_code(206);
        header("Content-Range: bytes $start-$end/$filesize");
        header("Content-Length: $length");
    } else {
        http_response_code(200);
        header("Content-Length: $filesize");
        $start = 0;
        $length = $filesize;
    }
} else {
    http_response_code(200);
    header("Content-Length: $filesize");
    $start = 0;
    $length = $filesize;
}

// Headers communs
$mime_type = ($type === 'video') ? 'video/mp4' : 'audio/mpeg';
header('Content-Type: ' . $mime_type);
header('Accept-Ranges: bytes');
header('Cache-Control: public, max-age=3600');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($filepath)) . ' GMT');

// Empêcher l'output buffering pour les gros fichiers
if (ob_get_level()) {
    ob_end_clean();
}

// Servir le fichier par chunks pour éviter les problèmes de mémoire
$handle = fopen($filepath, 'rb');
if ($handle === false) {
    http_response_code(500);
    error_log("Impossible d'ouvrir le fichier: " . $filepath);
    exit('Erreur lors de l\'ouverture du fichier');
}

if ($start > 0) {
    fseek($handle, $start);
}

$chunkSize = 8192; // 8KB chunks
$bytesRemaining = $length;

while (!feof($handle) && $bytesRemaining > 0) {
    $readSize = min($chunkSize, $bytesRemaining);
    $chunk = fread($handle, $readSize);
    
    if ($chunk === false) {
        break;
    }
    
    echo $chunk;
    $bytesRemaining -= strlen($chunk);
    
    // Forcer l'envoi du buffer
    if (ob_get_level()) {
        ob_flush();
    }
    flush();
}

fclose($handle);
?>