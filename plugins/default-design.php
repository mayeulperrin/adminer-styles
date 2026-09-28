<?php

/** Thème par défaut pour le plugin officiel AdminerDesigns.
*
* Sans ce plugin, AdminerDesigns n'applique aucun thème tant que rien n'est choisi dans son
* sélecteur (et Adminer n'auto-charge plus adminer.css dès qu'un plugin fournit du CSS).
* Celui-ci applique le thème par défaut quand la session ne contient aucun choix, ou un choix
* qui n'est plus proposé.
*
* À déclarer AVANT AdminerDesigns dans adminer-plugins.php : Adminer garde le premier css() non nul.
* @link https://github.com/mayeulperrin/adminer-styles
*/
class AdminerDefaultDesign extends Adminer\Plugin {
	protected $default;
	protected $designs;

	/**
	* @param string $default URL du fichier CSS par défaut
	* @param array<string, string> $designs mêmes clés que la liste passée à AdminerDesigns
	*   (URL => nom) ; si vide, seul un choix vide déclenche le thème par défaut
	*/
	function __construct(string $default, array $designs = array()) {
		$this->default = $default;
		$this->designs = $designs;
	}

	function css() {
		$design = isset($_SESSION["design"]) ? $_SESSION["design"] : "";
		if ($design === "" || ($this->designs && !array_key_exists($design, $this->designs))) {
			return array($this->default => (preg_match('~-dark~', $this->default) ? "dark" : "light"));
		}
		return null; // un thème valide a été choisi : AdminerDesigns prend la main
	}

	protected $translations = array(
		'fr' => array('' => 'Thème par défaut tant qu’aucun design n’est choisi'),
	);
}
