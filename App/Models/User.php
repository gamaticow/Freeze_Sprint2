<?php


namespace App\Models;


use Core\Model;

class User extends \Core\Model {

	private $id;
	private $name;

	/**
	 * User constructor.
	 * @param $id int Identifiant de l'utilisateur dans la base de données
	 */
	public function __construct($id){
		$db = self::getDB();
		$sql = "SELECT Pseudo_Cli FROM CLIENT WHERE Id_Cli=:id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		$this->id = $id;
		while ($row = $stmt->fetch()){
			$this->name = $row["Pseudo_Cli"];
		}
	}

	/**
	 * @return int Identifiant de l'utilisateur
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * @return String Pseudo de l'utilisateur
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Demande de la connection
	 * @param $name String Pseudo de l'utilisateur
	 * @param $password String Mot de passe de l'utilisateur
	 * @return User|null Retourne User si les identifiants sont correct, null sinon
	 */
	static function connect($name, $password){
        $password = md5($password);

        $db = self::getDB();
        $sql = "SELECT Id_Cli FROM CLIENT WHERE Pseudo_Cli=:pseudo AND Mdp_Cli=:mdp";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':pseudo', $name);
        $stmt->bindParam(':mdp', $password);
        $stmt->execute();

        $id = null;
        while ($row = $stmt->fetch()) {
            $id = $row["Id_Cli"];
        }

        return $id == null ? null : new User($id);
    }

	/**
	 * Création d'un compte
	 * @param $name String Pseudo de l'utilisateur
	 * @param $passwd String Mot de passe de l'utilisateur
	 * @return User|null Retourne User si le compte a été creer, null sinon
	 */
    static function register($name, $passwd){
		$db = self::getDB();
		$passwd = md5($passwd);
		if(self::nameExists($name)){
			return null;
		}

		$sql = "INSERT INTO CLIENT(Pseudo_Cli, Mdp_Cli) VALUES (:pseudo, :passwd)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":pseudo", $name);
		$stmt->bindParam(":passwd", $passwd);
		$stmt->execute();

		return new User($db->lastInsertId());
	}

	/**
	 * vérifie qu'un pseudo n'est pas dèjà dans la base de données
	 * @param $name String Nom à vérifier dans la base de données
	 * @return bool Si le pseudo existe ou nom
	 */
	private static function nameExists($name){
		$db = self::getDB();
		$sql = "SELECT Pseudo_Cli FROM CLIENT WHERE Pseudo_Cli=:pseudo";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":pseudo", $name);
		$stmt->execute();

		$name = null;
		while ($row = $stmt->fetch()){
			$name = $row["Pseudo_Cli"];
		}

		return $name != null;
	}

}
