<?php


class UsersRepository
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    //créer nouveau user
    //la fonction sert à insérer un nouvel utilisateur
    public function createNewUser(string $username, string $password)
    {
        //ici requête SQL préparée pour éviter injections SQL
        //la requête prépare l'insertion de username et password
        //dans la requête INSERT, username (sans $) est le nom de la colonne
        //et password (sans $) est le nom de la colonne dans la base de données
        //:username et :password sont des marqueurs de remplacement
        //ce sont des paramètres
        //ce sont des espaces réservés dans la requête
        //auxquels on liera la valeur de $this->username et $this->password
        $request = $this->dbh->prepare("INSERT INTO users (username, password) VALUES(:username, :password)");
        //bindParam associe les valeurs de $this->username au paramètre :username
        $request->bindParam(':username', $username);
        //bindParam associe les valeurs de $this->password au paramètre :password
        $request->bindParam(':password', $password);
        //exécution de la requête
        $request->execute();
    }

    //afficher les utilisateurs
    //la fonction récupère tous les utilisateurs de la table users
    public function showAllUsers()
    {
        //prépare une requête SQL pour sélectionner
        //tous les utilisateurs de la table users
        $request = $this->dbh->prepare("SELECT * FROM users");
        //exécuter la requête
        $request->execute();
        //retourner tous les résultats sous forme de tableau associatif
        //chaque ligne du tableau correspond à un utilisateur
        //chaque ligne du tableau est accessible par le nom de la colonne
        return $request->fetchALl(PDO::FETCH_ASSOC);
    }



    //SUPPRIMER UTILISATEUR
    //selon le user_id transmis
    public function deleteUser($user_id)
    {
        //vérifier si user_id connu
        //requête sql pour sélectionner l'utilisateur correspondant à ce user_id
        $sql = $this->dbh->prepare("DELETE FROM users WHERE user_id = :user_id");
        //bindParam assigne les valeurs de $this->user_id au paramètre :user_id
        $sql->bindParam(':user_id', $user_id);
        //exécution de la requête
        $sql->execute();
    }



    //vérifier le login
    //vérifier si informations de connexion correctes
    public function checkUserLogin(string $username, string $password)
    {
        //vérifier si nom utiilsateur connu
        //requête sql pour sélectionner l'utilisateur
        //dont le nom et le mot de passe correspondent aux paramètres
        $sql = $this->dbh->prepare("SELECT * FROM users WHERE username = :username AND password=:password");
        //bindParam assigne les valeurs de $this->username au paramètre :username
        $sql->bindParam(':username', $username);
        //bindParam assigne les valeurs de $this->password au paramètre :password
        $sql->bindParam(':password', $password);
        //exécution de la requête
        $sql->execute();
        //on récpère les résultats dans $user
        //la requête retourne les données de l'utilisateur
        //sour la forme d'un tableau associatif
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        //vérifier que c'est bien le nom et le mot de passe
        if ($user) {
            //on retourne le user_id de l'utilisateur trouvé
            return $user['user_id']; //ok utilisateur trouvé
        } else {
            //sinon on retourne false
            //car on n'a pas trouvé l'utilisateur
            return false; //si le mot de passe est incorrect
        }
    }

    //RECUPERER UN USER 
    //GRACE A SON user_id
    public function getUserById($user_id)
    {
        $sql = $this->dbh->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $sql->bindParam(':user_id', $user_id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
        //retourne les données du user sous forme d'un
        //tableau associatif
    }

    //METTRE A JOUR UN USER 
    //METHODE UPDATE
    public function updateUser($user_id, $username, $password)
    {
        $sql = $this->dbh->prepare("UPDATE users SET username = :username, password = :password WHERE user_id = :user_id");
        $sql->bindParam(':user_id', $user_id);
        $sql->bindParam(':username', $username);
        $sql->bindParam(':password', $password);
        $sql->execute();
    }

    //SUPPRIMER L'UTILISATEUR ET SES RESERVATIONS
    public function deleteUserWithReservations($user_id)
    {
        // Supprimer les réservations associées
        $sql = $this->dbh->prepare("DELETE FROM reservations WHERE user_id = :user_id");
        $sql->bindParam(':user_id', $user_id);
        $sql->execute();

        // Supprimer l'utilisateur
        $sql = $this->dbh->prepare("DELETE FROM users WHERE user_id = :user_id");
        $sql->bindParam(':user_id', $user_id);
        $sql->execute();
    }
}
