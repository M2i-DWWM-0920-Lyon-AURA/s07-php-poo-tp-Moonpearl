<?php

namespace App\Controller;

class MainController
{
    public function home()
    {
        // Inclue les templates nécessaires à l'affichage de la page d'accueil
        require './templates/head.php';
        require './templates/home.php';
        require './templates/foot.php';
    }
}
