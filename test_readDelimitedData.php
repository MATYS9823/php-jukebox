<?php
// Test de la lecture du fichier des données de musiques
include('readDelimitedData.php');

$musics = readDelimitedData('jukeboxData.txt');

if (count($musics) !== 9) {
    throw new RuntimeException('Le fichier jukeboxData.txt ne contient pas 9 musiques attendues.');
}

$expectedFirst = ['Dads', 'Groin Twerk'];
if ($musics[0][0] !== $expectedFirst[0] || $musics[0][1] !== $expectedFirst[1]) {
    throw new RuntimeException('La première entrée ne correspond pas à la donnée attendue.');
}

ob_start();
include 'dynamicJukebox.php';
$html = ob_get_clean();

if (!str_contains($html, 'data/Dads/Groin%20Twerk.jpeg')) {
    throw new RuntimeException('Le rendu HTML utilise des chemins de fichier incorrects pour la pochette Dads.');
}

if (!str_contains($html, 'data/The%20Black%20Eyed%20Peas/I%20Gotta%20Feeling.jpeg')) {
    throw new RuntimeException('Le rendu HTML utilise des chemins de fichier incorrects pour The Black Eyed Peas.');
}

echo "OK\n";

