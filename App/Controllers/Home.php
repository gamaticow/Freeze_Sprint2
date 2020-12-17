<?php


namespace App\Controllers;

use Core\View;

class Home extends \Core\Controller {

    public function indexAction(){
        $data = array();
        //Récupère le nom de l'utilisateur si il est connecté
        $name = self::getName();
        if($name != null){
        	//Si il est connecté on l'ajoute au données pour que Twig affiche le bouton de déconnexion
        	$data["name"] = $name;
		}
        //Affichage de la vue avec les données pour Twig
        View::renderTemplate("Home/index.html", $data);
    }

    public function logoutAction(){
    	//Détruit la session et redirige l'utilisateur vers la page principale
    	session_destroy();
		header("Location: /~i192740/Sprint2/");
		exit();
	}

	public function postAction(){
    	//Action de test pour les paramètres dans les url
    	$data = array();
    	$data["id"] = $this->route_params["id"];
    	View::renderTemplate("Home/post.html", $data);
	}

}
