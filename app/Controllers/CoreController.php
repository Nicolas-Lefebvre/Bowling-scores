<?php

namespace App\Controllers;

class CoreController
{
    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {

        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;
        
        // Comme $viewData est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewData['currentPage'] = $viewName;
        
        // définir l'url absolue pour nos assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];
        
        // On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau
      
        

        //d(get_defined_vars());

        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../views/partials/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/partials/footer.tpl.php';
    }

    /**
     * Méthode permettant de rediriger vers n'importe quelle page de notre application
     *
     * @param string $routeName
     * @return void
     */
    protected function redirect($routeName)
    {
        // On utilise le mot clé global pour avoir accès à la variable $router contenant notre instance d'altorouter
        global $router;
        // On génère l'url vers la page ciblée
        $url = $router->generate($routeName);
        // On la transmet à header
        header('Location: ' . $url);
        // On coupe l'exécution de cette page
        exit;
    }
}
