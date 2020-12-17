<?php


namespace App\Controllers;


use Core\View;

class User extends \Core\Controller {

    public function loginAction(){
        $data = array();
        // Formulaire déjà envoyé
        if(isset($_POST["name"]) && isset($_POST["passwd"])){
        	//Demande du compte auprès du modèle utilisateur
            $account = \App\Models\User::connect($_POST["name"], $_POST["passwd"]);
            if($account != null){
            	//Si les identifiants sont bon, on l'ajoute a sa session et on le redirige vers la page principale
                $_SESSION["id"] = $account->getId();
                header("Location: /~i192740/Sprint2/");
                exit();
            }else{
            	//Sinon on ajoute l'erreur dans le tableau et on affiche la vue (ligne 29)
                $data["error"] = "Pseudo ou mot de passe incorrect";
            }
        }

        //On affiche la vue à l'utilisateur
        View::renderTemplate("User/login.html", $data);
    }

    public function registerAction(){
    	$data = array();
		if(isset($_POST["name"]) && isset($_POST["passwd"]) && isset($_POST["c-passwd"])){
			$name = $_POST["name"];
			$passwd = $_POST["passwd"];
			// Vérification de la longueur du nom de l'utilisateur
			if(strlen($name) > 2 && strlen($name) < 26){
				//Vérification de la correspondance entre le mot de passe et la confirmation
				if(strcmp($passwd, $_POST["c-passwd"]) === 0){
					//Vérification de la longueur du mot de passe
					if(strlen($passwd) > 5 && strlen($passwd) < 33){
						$account = \App\Models\User::register($name, $passwd);
						//Vérification que le pseudo n'est pas déjà utilisé
						if($account != null){
							$_SESSION["id"] = $account->getId();
							header("Location: /~i192740/Sprint2/");
							exit();
						}else{
							$data["error"] = "Ce pseudo est déjà utilisé";
						}
					}else{
						$data["error"] = "La longueur du mot de passe doit être comprise 6 et 32 caractères";
					}
				}else{
					$data["error"] = "Les mots de passes ne sont pas identiques";
				}
			}else{
				$data["error"] = "La longueur du pseudo doit être comprise entre 3 et 25 caractères";
			}
		}

		View::renderTemplate("User/register.html", $data);
    }

    protected function before(){
    	//Vérification de la connexion de l'utilisateur
		if (isset($_SESSION["id"])){
			//S'il est connecté on le redirige vers la page principale
			header("Location: /~i192740/Sprint2/");
			//Et on exécute pas l'action
			return false;
		}
		//Sinon on exécute l'action
		return true;
	}

}
