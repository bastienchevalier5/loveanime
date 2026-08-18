<?php
// Récupération des paramètres
$id = $_GET['id'] ?? '';
$num = $_GET['num'] ?? 1;

if (!$id) exit('ID missing');

require_once '../bd.php';

// Récupérer le titre de l'anime
$stmt = $pdo->prepare("SELECT titre FROM animes WHERE id = ?");
$stmt->execute([$id]);
$anime = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$anime) exit('Anime not found');

// Normalisation du titre pour le nom de fichier
function normalizeFileName($title) {
    $title = strtolower(trim($title));

    // Remplacer certains caractères spéciaux par des équivalents sûrs
    $replace = [
        '×' => 'x',
        ':' => '_',
        '\'' => '_',
        '"' => '',
        '!' => '',
        '?' => '',
        '.' => '_',
        ',' => '',
        '-' => '_',
        ' ' => '_'
    ];

    $title = strtr($title, $replace);

    // Remplacer les accents par leur équivalent ASCII
    $title = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $title);

    // Supprimer tous les autres caractères non alphanumériques ou underscores
    $title = preg_replace('/[^a-z0-9_]+/', '_', $title);

    // Supprimer les underscores superflus au début et à la fin
    $title = trim($title, '_');

    $title = preg_replace('/_+/', '_', $title);


    return $title;
}

$animeName = normalizeFileName($anime['titre']);

// Extensions possibles
$extensions = ['jpg','jpeg','png','webp'];

foreach ($extensions as $ext) {
    $file = "../img/{$animeName}_{$num}.{$ext}";
    if (file_exists($file)) {
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp'
        ];
        header('Content-Type: ' . $mimeTypes[$ext]);
        readfile($file);
        exit;
    }
}

exit('Image not found');
