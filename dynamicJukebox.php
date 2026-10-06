<?php
require_once __DIR__ . '/readDelimitedData.php';
// Lecture de toutes les musiques depuis le fichier jukeboxData.txt
$musics = readDelimitedData(__DIR__ . '/jukeboxData.txt');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>&#x1F399; Mon jukebox dynamique</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
  <header>
    <h1>Ma musique dans mon Jukebox</h1>
  </header>
  <main>
    <section class="jukebox-grid">
      <?php foreach ($musics as $music): ?>
        <?php
          $artist = $music[0] ?? '';
          $title = $music[1] ?? '';
          $imageName = $title . '.jpeg';
          $audioName = $title . '.mp3';
        ?>
        <figure class="music-item">
          <!-- rawurlencode encode proprement les espaces et caractères spéciaux pour les URLs -->
          <img src="data/<?= rawurlencode($artist) ?>/<?= rawurlencode($imageName) ?>" alt="<?= htmlspecialchars($artist . ' - ' . $title) ?>">

          <figcaption>
            <strong><?= htmlspecialchars($title) ?></strong><br>
            <span><?= htmlspecialchars($artist) ?></span>
          </figcaption>

          <!-- Le formulaire pointe vers la page du lecteur : playPath.php -->
          <form action="playPath.php" method="GET">
            <input type="hidden" name="audio" value="data/<?= rawurlencode($artist) ?>/<?= rawurlencode($audioName) ?>">
            <button type="submit" class="play-button" title="Écouter la musique">▶ Jouer</button>
          </form>
        </figure>
      <?php endforeach; ?>
    </section>
  </main>
  <footer>
    <p>Nombre de musiques disponibles : <?= count($musics) ?></p>
  </footer>
</body>
</html>