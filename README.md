# adminer-styles

Thèmes CSS maison pour [Adminer](https://www.adminer.org/), avec un sélecteur de thème dans l'interface. Le dépôt ne contient que des thèmes créés ici (pas de copie des designs officiels d'Adminer).

Testé avec **Adminer 6.1.0** (MySQL/MariaDB), sur Chrome, Firefox et Safari mobile.

## Thèmes

| Dossier | Thème |
|---|---|
| `fui/adminer.css` | **FUI (néon)** — *Futuristic User Interface*, style HUD de science-fiction |
| `noel/adminer.css` | **Noël** — nuit de sapin, or et rouge houx, neige et guirlande lumineuse |
| `classic-cars/adminer.css` | **Classic cars** — thème clair : cockpit en cuir, chrome, damier, vert anglais |
| `naturiste/adminer.css` | **Naturiste** — thème clair « dénudé » : sable, lin, bord de mer, galets, pins |

### Le thème FUI

- Fond abyssal quadrillé, cyan néon, filets fins, cadres à coins en équerre, boutons chanfreinés, scanlines fixes discrètes.
- Actions destructrices (supprimer, tronquer, déconnexion) en rouge ; action principale pleine.
- Menu latéral et barre supérieure (fil d'Ariane, utilisateur, déconnexion) fixes ; en-têtes de tableaux collants.
- Éditeur SQL façon terminal, coloration syntaxique (jush) adaptée au fond sombre.
- Écran de connexion en carte centrée « Access terminal ».
- **Responsive** : sous 800 px, barre fixe + bouton menu ≡/✕ ouvrant un tiroir avec voile ; tableaux défilants horizontalement ; champs en 16 px (pas de zoom automatique sur iOS).
- **Lisibilité** : les noms de bases, tables et colonnes ne sont jamais mis en capitales ; animations coupées si le système demande moins de mouvement (`prefers-reduced-motion`).
- **Aucune ressource externe** (compatible avec la CSP d'Adminer) : polices système, icônes en `data:` URI.

### Le thème Noël

Même ossature que FUI (menu et barre fixes, tiroir mobile, écran de connexion), ambiance festive :

- Fond vert sapin, liens et actions en or, titres de section en rouge houx, texte blanc neige.
- **Neige** qui tombe lentement, **derrière** le contenu (jamais par-dessus) ; immobile si le système demande moins de mouvement.
- Guirlande lumineuse sous la barre du haut, étoile scintillante après les titres, étiquettes en ruban rouge, boutons et cadres arrondis.
- Carte de connexion à bordure sucre d'orge.
- Titres en serif, interface en sans-serif, code SQL en chasse fixe.

### Le thème Classic cars

Même ossature que FUI, mais **clair**, ambiance automobile ancienne, en **matières réalistes** (textures générées en SVG, sans image externe) :

- **Cockpit** : menu en cuir grainé en relief, surpiqûre à double fil, en-tête en ronce de noyer vernie souligné d'un jonc chromé, lettrage « Adminer » chromé ; combiné de jauges d'époque (essence, eau) en bas du menu.
- **Chrome brossé** : bandeau supérieur à rivet et damier émaillé ; boutons biseautés qui s'enfoncent au clic.
- **Émail vitrifié** cerclé de chrome : action principale en vert « British racing green », actions destructrices en rouge, badges des cadres en bordeaux.
- **Papier de carnet d'entretien** grainé pour le fond et les cadres ; en-têtes de tableaux laqués vert anglais ; drapeau à damier ondulant après les titres, rivets chromés devant les sections, voyant vert pour l'utilisateur connecté.
- Écran de connexion « Mettez le contact » : **compteur de vitesse** façon années 60 (cadran noir 0–200 km/h, compteur kilométrique, verre bombé) dont l'aiguille fait un seul balayage au chargement.
- Titres en slab-serif d'époque, interface en sans-serif géométrique, code SQL en chasse fixe. Aucune animation en boucle.

### Le thème Naturiste

Même ossature que FUI, **clair**, dans l'esprit du naturisme : nature, plein air, simplicité. Un design **« dénudé »**, débarrassé du superflu :

- Pas de bordures dures : cadres sans contour, tableaux sans traits verticaux ; boutons en **galets polis** (bleu-vert océan pour l'action principale, terre cuite pour les actions destructrices).
- Fond de **sable** sous un ciel pâle et un halo de soleil ; menu et cadres en **toile de lin**.
- En-tête du menu : bord de mer au soleil ; en pied : pins, dunes et mer. Vague le long de la barre du haut, soleil après les titres, feuille d'olivier devant les sections et étiquettes vert olive.
- Écran de connexion : « Rien à cacher… sauf votre mot de passe ».
- Aucune animation.

## Installation

### A. Un seul thème, sans sélecteur

Copier le fichier à côté de `adminer.php`, sous le nom `adminer.css` :

```sh
cp adminer-styles/fui/adminer.css /chemin/vers/adminer/adminer.css
```

Adminer le charge automatiquement. **Supprimer tout `adminer-dark.css` voisin** : s'il existe, Adminer n'applique plus `adminer.css` qu'en mode clair et superpose son propre thème sombre.

### B. Plusieurs thèmes avec sélecteur (recommandé)

Cloner le dépôt à côté de `adminer.php`, puis utiliser le plugin officiel [`designs`](https://www.adminer.org/plugins/) associé au plugin `default-design.php` de ce dépôt :

```sh
cd /chemin/vers/adminer
git clone https://github.com/mayeulperrin/adminer-styles.git
mkdir -p adminer-plugins
# plugin officiel, version identique à celle d'Adminer (ici 6.1.0)
curl -sSfL -o adminer-plugins/designs.php \
  https://raw.githubusercontent.com/vrana/adminer/v6.1.0/plugins/designs.php
# plugin « thème par défaut » de ce dépôt
ln -s ../adminer-styles/plugins/default-design.php adminer-plugins/default-design.php
# configuration des plugins
cp adminer-styles/adminer-plugins.example.php adminer-plugins.php
```

Adminer inclut tout seul les fichiers `adminer-plugins/*.php`, puis lit `adminer-plugins.php` (voir [`adminer-plugins.example.php`](adminer-plugins.example.php)). Un sélecteur « Thème » apparaît alors dans le menu ; le choix est mémorisé **pour la session** (retour au thème par défaut après déconnexion).

Dans cette configuration, `adminer.css` à côté de `adminer.php` n'est plus utilisé : dès qu'un plugin fournit du CSS, Adminer ne charge plus ce fichier automatiquement.

#### Pourquoi `default-design.php` ?

Le plugin officiel `designs` n'applique **aucun** thème tant que rien n'est choisi dans son sélecteur : on retomberait sur l'apparence brute d'Adminer. `AdminerDefaultDesign` applique le thème par défaut quand la session ne contient aucun choix, ou un choix qui n'est plus proposé. Il doit être déclaré **avant** `AdminerDesigns` : Adminer retient le premier plugin dont `css()` renvoie une valeur non nulle.

Il rend aussi le sélecteur utilisable **sur l'écran de connexion** : le plugin officiel n'enregistre le choix qu'une fois connecté, si bien qu'après une déconnexion on restait bloqué sur le dernier thème choisi.

### Sécurité quand le dépôt est dans la racine web

Le fichier [`.htaccess`](.htaccess) du dépôt (Apache, `AllowOverride` requis) refuse les `.php` et masque `.git` en HTTP ; seules les feuilles de style sont servies. Adminer inclut les plugins par le système de fichiers, ce blocage ne le gêne pas.

## Personnaliser le thème FUI

Les couleurs et dimensions sont des variables CSS en tête de `fui/adminer.css` (section « Jetons ») :

| Variable | Rôle |
|---|---|
| `--cyan`, `--cyan-2` | couleur principale et sa version claire |
| `--amber`, `--red`, `--green`, `--violet` | titres de section, danger, succès, dates |
| `--void`, `--deep`, `--panel` | fonds (page, surfaces, panneaux) |
| `--text`, `--muted` | texte courant et secondaire |
| `--menu-w`, `--bar-h` | largeur du menu, hauteur de la barre supérieure |
| `--cut` | taille des chanfreins des boutons |

Deux règles à respecter en modifiant le thème :

1. **N'écrire nulle part la chaîne `prefers-color-scheme: dark`** (même en commentaire) : Adminer la détecte et reclasse alors le fichier en thème « clair et sombre », ce qui recharge son `dark.css` par-dessus.
2. Ne pas passer en capitales les éléments qui affichent des identifiants (en-têtes de colonnes, noms de tables, fil d'Ariane) : dans un outil SQL, la casse compte.

Pour ajouter un nouveau thème : créer `mon-theme/adminer.css` (ou `…-dark.css` pour un thème sombre), l'ajouter au tableau « Thèmes » ci-dessus, puis à la liste `$designs` de `adminer-plugins.php`.

## Licence

Thèmes et `plugins/default-design.php` : © Mayeul Perrin.
