# Jukebox Dynamique en PHP

Application web légère développée en PHP natif permettant de parcourir un catalogue musical et de lancer l'écoute de morceaux via un lecteur audio dédié.

##  Fonctionnalités

* **Catalogue dynamique :** lecture et parsing d'un fichier délimité (`jukeboxData.txt`) au format `Artiste|Titre`.
* **Interface sombre responsive :** affichage en grille type carte avec jaquettes, effets de survol et compteur de morceaux disponibles.
* **Lecteur audio dédié :** page de lecture (`playPath.php`) avec lecteur HTML5 natif, affichage des métadonnées et lien de retour contextuel.
* **Gestion d'URL :** encodage robuste des caractères spéciaux et des espaces pour les médias.

## Structure du projet

```text
├── data/                      # Données médias organisées par artiste
│   └── [Nom Artiste]/         # Contient les fichiers .mp3 et .jpeg
├── dynamicJukebox.php         # Page d'accueil et catalogue des musiques
├── playPath.php               # Lecteur audio et affichage du morceau
├── readDelimitedData.php      # Fonction d'analyse du fichier texte délimité
├── jukeboxData.txt            # Base de données texte (Artiste|Titre)
├── style2.css                 # Feuille de styles principale (thème sombre)
