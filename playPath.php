<?php
// Récupération du chemin du fichier audio envoyé par le formulaire
$audioPath = $_GET['audio'] ?? '';

// Variables par défaut
$artist = "Artiste inconnu";
$title = "Titre inconnu";
$imagePath = "default.jpeg";

// Décoder le chemin de l'audio pour extraire l'artiste et le titre
// Exemple de chemin reçu : data/The%20Black%20Eyed%20Peas/I%20Gotta%20Feeling.mp3
if (!empty($audioPath)) {
    $pathParts = explode('/', urldecode($audioPath));
    
    // Si le chemin respecte bien la structure data/Artiste/Fichier.mp3
    if (count($pathParts) >= 3) {
        $artist = $pathParts[1]; // Dossier de l'artiste
        $fileName = $pathParts[2]; // Fichier (ex: Titre.mp3)
        
        // On enlève ".mp3" pour récupérer le titre
        $title = str_replace('.mp3', '', $fileName);
        
        // On reconstruit le chemin de l'image (en .jpeg)
        $imagePath = 'data/' . rawurlencode($artist) . '/' . rawurlencode(str_replace('.mp3', '.jpeg', $fileName));
    }
}

// Gestion du retour à la page précédente (Question bonus / consigne du TP)
// S'il n'y a pas de page précédente reconnue, on retourne par défaut vers dynamicJukebox.php
$referer = $_SERVER['HTTP_REFERER'] ?? 'dynamicJukebox.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Lecteur - <?= htmlspecialchars($title) ?></title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
  <main class="player-page">
    <div class="player-container">
      
      <!-- Image de la pochette -->
      <img src="<?= htmlspecialchars($imagePath) ?>" alt="Pochette de <?= htmlspecialchars($title) ?>">
      
      <!-- Titre de la musique -->
      <h1><?= htmlspecialchars($title) ?></h1>
      
      <!-- Nom de l'artiste -->
      <div class="artist"><?= htmlspecialchars($artist) ?></div>
      
      <!-- Lecteur audio -->
      <audio controls autoplay>
        <source src="<?= htmlspecialchars($audioPath) ?>" type="audio/mpeg">
        Votre navigateur ne supporte pas l'élément audio.
      </audio>
      
      <!-- Lien de retour -->
      <a href="<?= htmlspecialchars($referer) ?>" class="back-link">← Retour au Jukebox</a>
      
    </div>
  </main>
  
  <footer>
    <p>En cours de lecture : <?= htmlspecialchars($title) ?></p>
  </footer>
</body>
</html>