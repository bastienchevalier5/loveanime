<?php
session_start();

$maxAge = 60; // validité du lien en secondes

if (!isset($_GET['id']) || !isset($_GET['t'])) {
    http_response_code(404);
    exit;
}

$id = $_GET['id'];
$timestamp = intval($_GET['t']);

// Vérifie l'expiration
if (time() - intval($timestamp / 1000) > $maxAge) {
    http_response_code(403);
    exit('Lien expiré');
}

// Vérifie si l'image existe dans la session
if (!isset($_SESSION['current_character_images'][$id])) {
    http_response_code(404);
    exit('Image introuvable');
}

$sessionPath = trim($_SESSION['current_character_images'][$id], '/');
$sessionPath = str_replace('../', '', $sessionPath); // Supprime TOUS les ../
$sessionPath = ltrim($sessionPath, '/'); // Supprime / en début
$originalImagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $sessionPath;

// Vérifie que le fichier existe
if (!file_exists($originalImagePath)) {
    http_response_code(404);
    exit('Fichier non trouvé');
}

// Renvoie l'image
$imageInfo = getimagesize($originalImagePath);
header('Content-Type: ' . $imageInfo['mime']);
header("Cache-Control: public, max-age=$maxAge");
readfile($originalImagePath);
exit;
?>
