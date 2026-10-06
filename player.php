<?php
$audioParam = $_GET['audio'] ?? '';
$audioPath = '';
$artist = 'Inconnu';
$title = 'Titre inconnu';

if ($audioParam !== '') {
    $decoded = rawurldecode($audioParam);
    $audioPath = ltrim($decoded, '/');
    $fullPath = __DIR__ . '/' . $audioPath;
    $realFullPath = realpath($fullPath);
    $projectRoot = realpath(__DIR__);

    if ($realFullPath !== false && $projectRoot !== false && strpos($realFullPath, $projectRoot . DIRECTORY_SEPARATOR) === 0 && is_file($realFullPath)) {
        $audioPath = $decoded;
        $pathParts = explode('/', trim($decoded, '/'));
        if (count($pathParts) >= 3) {
            $artist = urldecode($pathParts[1]);
            $fileName = $pathParts[2] ?? '';
            $title = pathinfo($fileName, PATHINFO_FILENAME);
        }
    }
}

if ($audioPath === '') {
    $audioPath = 'data/Dads/Groin%20Twerk.mp3';
    $artist = 'Dads';
    $title = 'Groin Twerk';
}

$coverPath = str_replace('/' . basename($audioPath), '/' . basename($audioPath, '.mp3') . '.jpeg', $audioPath);
$coverFile = __DIR__ . '/' . ltrim(rawurldecode($coverPath), '/');
if (!is_file($coverFile)) {
    $coverPath = 'data/placeholder.jpeg';
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title) ?> - <?= htmlspecialchars($artist) ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="player-body">
  <main class="player-page">
    <section class="player-card">
      <img class="player-cover" src="<?= htmlspecialchars($coverPath) ?>" alt="<?= htmlspecialchars($artist . ' - ' . $title) ?>">

      <div class="player-meta">
        <h1><?= htmlspecialchars($title) ?></h1>
        <div class="artist"><?= htmlspecialchars($artist) ?></div>
      </div>

      <audio class="player-audio" controls autoplay>
        <source src="playPath.php?audio=<?= rawurlencode($audioPath) ?>" type="audio/mpeg">
        Votre navigateur ne prend pas en charge l'audio HTML5.
      </audio>

      <a class="player-back" href="dynamicJukebox.php">← Retour à la jukebox</a>
    </section>
  </main>
</body>
</html>
