<?php
// Autoriser uniquement ton domaine
header("Access-Control-Allow-Origin: https://loveanime.rf.gd");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, X-Admin-Token"); // Ajoute X-Admin-Token ici pour le CORS

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit; 
}

// Récupération alternative et robuste du Token
$token = isset($_SERVER['HTTP_X_ADMIN_TOKEN']) ? $_SERVER['HTTP_X_ADMIN_TOKEN'] : '';

// Si le token ne correspond pas (on vérifie aussi pour le GET du merge par sécurité ou on adapte)
$expectedToken = 'MonSuperMotDePasseSecret123!';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $token !== $expectedToken) {
    header('HTTP/1.0 403 Forbidden');
    exit("Accès refusé : Token invalide.");
}

// Pour la requête GET (le merge), on peut aussi passer le token dans l'URL pour être tranquille
if (isset($_GET['merge'])) {
    $getUrltoken = isset($_GET['token']) ? $_GET['token'] : '';
    if ($getUrltoken !== $expectedToken) {
        header('HTTP/1.0 403 Forbidden');
        exit("Accès refusé : Token GET invalide.");
    }
}

// ... Reste de ton code PHP pour les dossiers et les morceaux

$uploadDir = __DIR__ . "/openings/video/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $chunkFile = $uploadDir . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $chunkFile);
    exit("Chunk reçu");
}

// Assemblage des morceaux après le dernier upload
if (isset($_GET['merge']) && isset($_GET['filename'])) {
    // Récupération propre du nom de fichier
    $realFilename = basename($_GET['filename']); 
    $finalFile = $uploadDir . $realFilename;
    
    $out = fopen($finalFile, 'wb');
    
    // On récupère les morceaux
    $chunks = glob($uploadDir . "chunk_*.tmp");
    
    // Tri ultra-sécurisé basé UNIQUEMENT sur le nom du fichier (chunk_1, chunk_2...)
    usort($chunks, function($a, $b) {
        return strnatcmp(basename($a), basename($b));
    });

    if (empty($chunks)) {
        exit("Erreur : Aucun morceau trouvé.");
    }

    foreach ($chunks as $chunk) {
        $in = fopen($chunk, 'rb');
        stream_copy_to_stream($in, $out);
        fclose($in);
        unlink($chunk); // Supprime le morceau
    }
    fclose($out);

    exit("Fichier " . $realFilename . " assemblé avec succès !");
}
?>
