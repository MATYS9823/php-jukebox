<?php

// Analyse le fichier de nom $filename
// Ce fichier contient des informations séparées par $delimiter
// Le résultat est un tableau de tableau.
// Chaque element du premier tableau est produit à partir d'une ligne.
// Chaque ligne est découpée et placée dans un tableau.
function readDelimitedData(string $filename, string $delimiter = '|'): array {
  $tab = [];

  $file = fopen($filename, 'r');
  if ($file === false) {
      return $tab;
  }

  while (($line = fgets($file)) !== false) {
      $cleanLine = rtrim($line, "\r\n");

      if ($cleanLine !== '') {
          $data = explode($delimiter, $cleanLine);
          $tab[] = $data;
      }
  }

  fclose($file);

  return $tab;
}
