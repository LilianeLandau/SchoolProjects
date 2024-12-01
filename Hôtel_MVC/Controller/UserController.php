<?php


class UserController
{

    private $usersRepository;


    public function __construct($dbh)
    {
        $this->usersRepository = new UsersRepository($dbh);
    }

    public function show()
    {
        $title = "User";
        $action = 'Listeusers';


        $users = $this->usersRepository->showAllUsers();

        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/user/listeusers.php';
        include BASE_ROOT . 'View/footer.php';
    }

    public function add()
    {
        $title = "Adduser";
        $action = 'Adduser';
        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/user/adduser.php';
        include BASE_ROOT . 'View/footer.php';
    }

    public function login()
    {
        $title = "Loginuser";
        $action = 'Loginuser';
        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/user/loginuser.php';
        include BASE_ROOT . 'View/footer.php';
    }



    public function createNewUser()
    {
        if (isset($_POST['send'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->usersRepository->createNewUser($username, $password);
            header('Location: /user');
        }
    }

    public function deleteUser($user_id)
    {
        $this->usersRepository->deleteUser($user_id);

        header('Location: /user');
    }


    //action pour supprimer l'utilisaeur et ses réservations
    public function deleteUserWithReservations($user_id)

    {
        $this->usersRepository->deleteUserWithReservations($user_id);
        header('Location: /user');
    }





    public function checkUserLogin()
    {
        if (isset($_POST['send'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user_id = $this->usersRepository->checkUserLogin($username, $password);

            if ($user_id) {
                //on enregistre son user_id et son username dans 
                //les variables de session      
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                echo "<p class='text-danger'>Bienvenue à vous <b>" . $username . '</b>';
                "</p>";
            } else {
                echo "<p class='text-danger'>Votre identifiant ou alors votre mot de passe est incorrect</p>";
            }
        }

        //    var_dump($_SESSION);


        header('Location: /user');
    }

    public function userLogout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);

        $_SESSION['message'] = 'Vous êtes bien deconnecté';

        header('Location: /user/login');
    }

    //RECUPERER LE USER A MODIFIER
    //puis afficher les informations du user
    //dans cette méthode on utlise
    //la méthode getUserById
    public function updateUser($user_id)
    {
        $title = "Modifier un utilisateur";
        $action = 'Updateuser';
        //récupérer les données de l'utilisateur correspondant à l'id
        $user = $this->usersRepository->getUserById($user_id);

        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/user/updateuser.php';
        include BASE_ROOT . 'View/footer.php';
    }

    //METHODE POUR UPDATE USER DANS LA BDD
    public function updateTheUser()
    {
        if (isset($_POST['send'])  && !empty($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->usersRepository->updateUser($user_id, $username, $password);
            header('Location: /user');
        }
    }
}
