<?php
// Exemple de adminer-plugins.php (à placer à côté de adminer.php).
// Adminer inclut automatiquement les fichiers de adminer-plugins/*.php :
// y placer designs.php (plugin officiel) et default-design.php (ce dépôt).
// Les chemins sont relatifs à adminer.php ; ici le dépôt est cloné dans ./adminer-styles/.
// L'ordre compte : AdminerDefaultDesign doit précéder AdminerDesigns.

if (!class_exists('Adminer\\Plugin')) { // appel direct par le web : rien à servir
	http_response_code(404);
	exit;
}

$designs = array(
	"adminer-styles/fui/adminer.css" => "FUI (néon)",
	"adminer-styles/noel/adminer.css" => "Noël",
	"adminer-styles/classic-cars/adminer.css" => "Classic cars",
	"adminer-styles/naturiste/adminer.css" => "Naturiste",
	// ajouter ici les prochains thèmes du dépôt
);

return array(
	new AdminerDefaultDesign("adminer-styles/fui/adminer.css", $designs),
	new AdminerDesigns($designs),
);
