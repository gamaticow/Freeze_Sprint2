<?php
namespace Core;


class View {

	/**
	 * @param $view String nom du fichier de la vue
	 * @param array $args paramètres de la vue
	 * @throws \Exception Ficher non trouvée
	 */
    public static function render($view, $args = []){
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/App/Views/$view";

        if(is_readable($file)){
            require $file;
        }else{
            throw new \Exception("$file not found");
        }
    }

	/**
	 * @param $template String nom du fichier de la vue
	 * @param array $args paramètres de la vue
	 * @throws \Twig\Error\LoaderError Erreur Twig
	 * @throws \Twig\Error\RuntimeError Erreur Twig
	 * @throws \Twig\Error\SyntaxError Erreur Twig
	 */
    public static function renderTemplate($template, $args = []){
        static $twig = null;

        if($twig === null){
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
        }

        echo $twig->render($template, $args);
    }

}
