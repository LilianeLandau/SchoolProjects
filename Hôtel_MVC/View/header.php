  <!-- HEADER -->
  <!doctype html>
  <html lang="fr">

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>21donkey_mvc_hôtel <?php echo $title;
                                ?></title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="/">Donkey Hôtel</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">

              <?php
                // Définition des routes
                $routes = [
                    'Accueil' => '/',
                    'Login utilisateur' => '/user/login',

                    'Liste des utilisateurs' => '/user',

                    'Ajouter un utilisateur' => '/user/add',


                    'Liste des chambres' => '/room',

                    'Ajouter Chambre' => '/room/add',

                    'Réserver une chambre' => '/reservation/add',

                    'Vos réservations' => '/reservation'


                ];

                // Affichage dynamique des liens
                echo '<nav>';
                echo '  <ul class="navbar-nav">';
                foreach ($routes as $controllerTmp => $actionTmp) {
                    //echo '<li>' . ucfirst($controller);
                    if (is_array($actionTmp)) {
                        echo '  <ul class="navbar-nav">';
                        foreach ($actionTmp as $name => $route) {
                            echo '<li class="nav-item active"><a class="nav-link" href="' . $route . '">' . $name . '</a></li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<li class="nav-item active"><a class="nav-link" href="' . $actionTmp . '">' . $controllerTmp . '</a></li>';
                    }
                    echo '</li>';
                }

                if (!empty($_SESSION['user_id'])) {
                    echo '<li class="nav-item active"><a  class="nav-link" href="/user/userLogout">Déconnexion</a></li>';
                }

                echo '</ul>';
                echo '</nav>';
                ?>
          </div>
      </nav>


      <h1><?php echo $title; ?> - Controller : <?php echo $action; ?></h1>


      <!-- HEADER -->