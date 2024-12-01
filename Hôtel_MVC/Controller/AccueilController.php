<?php
class AccueilController
{
    public function accueil()
    {

        include 'C:/wamp64/www/21_donkey_mvc_hotel/accueil.php';
    }


    public function show()
    {
        $title = "Accueil";
        $action = 'accueil';

        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/accueil.php';
        include BASE_ROOT . 'View/footer.php';
    }
}
