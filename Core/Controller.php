<?php
namespace Core;


use App\Models\User;

abstract class Controller {

    protected $route_params = [];

    public function __construct($route_params){
        session_start();
        $this->route_params = $route_params;
    }

    public function __call($name, $args){
        $method = $name.'Action';

        if(method_exists($this, $method)){
            if($this->before() !== false){
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        }
    }

	/**
	 * Exécuter avant l'action
	 * @return bool Si false l'action n'est pas exécutée
	 */
    protected function before(){

    }

	/**
	 * Méthode executer après l'action
	 */
    protected function after(){

    }

	/**
	 * @return String|null Pseudo de l'utilisateur si il est connecter
	 */
    protected function getName(){
    	//Verifie que l'utilisateur est connecter
    	if(isset($_SESSION["id"])){
    		//Si il est connecter recupère le pseudo à travers le modèle User
    		$user = new User($_SESSION["id"]);
    		return $user->getName();
		}
    	return null;
	}

}
