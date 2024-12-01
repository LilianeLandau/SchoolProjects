<?php


class ReservationsRepository
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    //cette fonction sert à afficher les chambres dans le formulaire de réservation
    public function showAllRooms(): array
    {
        $request = $this->dbh->prepare("SELECT * FROM rooms");
        $request->execute();

        return $request->fetchAll(PDO::FETCH_CLASS, Room::class);
    }


    //fonction pour calculer le prix total du séjour
    public function calculateTotalPrice(array $informations)
    {
        //initialiser le prix total 
        $total = 0;

        //récupérer les prix de la chambre et du petit-déjeuner
        //$this est l'objet courant, l'instance de la classe
        //$this->bdd est l'objet PDO de connexion à la base de données
        //prepare () permet de préparer la requête SQL
        $request = $this->dbh->prepare("SELECT * FROM rooms WHERE room_id = :room_id");
        $request->bindParam(':room_id', $informations['room_id']);
        $request->execute();
        $room = $request->fetch(PDO::FETCH_ASSOC); //fetch() permet de récupérer les données de la requête
        //si cette chambre existe alors on peut calculer le prix du séjour :
        if ($room) {
            //pour calculer le nombre de jours entre la date de départ et la date d'arrivée
            //on utilise strtotime () qui permet de convertir une chaîne de caractères en un timestamp
            //ensuite on divise par le nombre de secondes dans une journée (86400) pour obtenir le nombre de jours
            $days = (strtotime($informations['check_out']) - strtotime($informations['check_in'])) / (60 * 60 * 24);
            //calculer le prix total
            $total = $room['price_room'] * $days;
            //si l'utlisateur a choisi aussi le petit-déjeuner 
            if ($informations['breakfast'] === 1) {
                $total += $room['price_breakfast'] * $days;
            }
        }

        //la fonction retourne le prix total calculé
        return $total;
    }


    //FONCTION POUR INSERER UNE RESERVATION DANS LA BDD
    //le prix du séjour est calculé dans la fonction calculateTotalPrice()
    //on peut l'utiliser dans une nouvelle fonction qui insère la réservation dans la bdd 
    //toutes les informations de la réservation sont dans l'array $informations

    public function createNewReservation(array $informations)
    {
        //pour calculer le prix total du séjour on utilise la fonction
        $total = $this->calculateTotalPrice($informations);

        //préparer la requête pour insérer dans la bdd
        $request = $this->dbh->prepare("INSERT INTO reservations 
    ( user_id, room_id, check_in, check_out, breakfast, total_price)
    VALUES (:user_id, :room_id, :check_in, :check_out, :breakfast, :total_price) ");
        // Lier les paramètres
        $request->bindParam(':user_id', $informations['user_id']);
        $request->bindParam(':room_id', $informations['room_id']);
        $request->bindParam(':check_in', $informations['check_in']);
        $request->bindParam(':check_out', $informations['check_out']);
        $request->bindParam(':breakfast', $informations['breakfast']);
        $request->bindParam(':total_price', $total);
        $request->execute();
    }



    //FONCTION POUR AFFICHER LES RESERVATION PAR USER_ID 
    //ET EN PLUS AFFICHER LE NOM DU USER ET LE NUMERO DE LA CHAMBRE
    public function showUserNameRoomReservations($user_id)
    {
        $request = $this->dbh->prepare("SELECT reservations.*, users.username, rooms.room_number,rooms.price_room
        FROM reservations
    LEFT JOIN users on reservations.user_id =users.user_id
    LEFT JOIN rooms on rooms.room_id = reservations.room_id
      WHERE reservations.user_id = :user_id");
        $request->bindParam(':user_id', $user_id);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }
    //SUPPRIMER UNE RESERVATION
    //SELON SON ID
    public function deleteReservation($reservation_id)
    {
        //requête pour sélectionner la réservation correspondant au id
        $sql = $this->dbh->prepare("DELETE FROM reservations WHERE reservation_id=:reservation_id");
        $sql->bindParam(':reservation_id', $reservation_id);
        $sql->execute();
    }

    //METHODE POUR RECUPERER UNE RESERVATION
    //SELON le reservation_id
    /*
    public function getReservationById($reservation_id)
    {
        $sql = $this->dbh->prepare("SELECT * FROM reservations WHERE reservation_id=:reservation_id");
        $sql->bindParam('reservation_id', $reservation_id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
        //retourne les données de le reservation sous forme d'un tableau associatif
    }
*/
    //NOUVELLE METHODE POUR RECUPERER UNE RESERVATION
    //SELON LE ID ET -  EN PLUS -
    //AFFICHER LE NUMERO DE LA CHAMBRE RESERVEE 
    //DANS LE FORMULAIRE updatereservation.php
    //au lieu de faire un select sur reservations uniquement comme dans la methode precedente en commentaire
    //ici on fait un select sur reservations et rooms
    //de cette façon on peut recuperer les informations de la reservation et AUSSI le numero de la chambre reservee
    public function getReservationById($reservation_id)
    {
        $sql = $this->dbh->prepare("
            SELECT reservations.*, rooms.room_number 
            FROM reservations
            LEFT JOIN rooms ON reservations.room_id = rooms.room_id
            WHERE reservation_id = :reservation_id
        ");
        $sql->bindParam(':reservation_id', $reservation_id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }




    //METHODE POUR UPDATE UNE RESERVATION
    //champs de la table reservations
    //reservation_id, user_id, room_id, check_in, check_out, breakfast, total_price
    public function updateReservation($reservation_id, $informations)
    {
        //pour calculer le prix total du séjour on utilise la fonction
        $total = $this->calculateTotalPrice($informations);

        $sql = $this->dbh->prepare("UPDATE reservations SET 
        user_id=:user_id, room_id=:room_id,check_in=:check_in, check_out=:check_out, breakfast=:breakfast, total_price=:total_price 
        WHERE reservation_id=:reservation_id");
        // Lier les paramètres
        $sql->bindParam(':reservation_id', $reservation_id);
        $sql->bindParam(':user_id', $informations['user_id']);
        $sql->bindParam(':room_id', $informations['room_id']);
        $sql->bindParam(':check_in', $informations['check_in']);
        $sql->bindParam(':check_out', $informations['check_out']);
        $sql->bindParam(':breakfast', $informations['breakfast']);
        $sql->bindParam(':total_price', $total);
        $sql->execute();
    }


    //RESERVER ET VERIFIER SI UNE CHAMBRE EST DISPONIBLE
    // POUR UNE DATE SPECIFIQUE
    //la requête SQL compare les places des dates pour déterminer
    //si elles se chevauchent avec des réservations existantes
    public function isRoomAvailable(int $room_id, string $check_in, string $check_out): bool
    {
        $sql = $this->dbh->prepare("SELECT COUNT(*) as count 
            FROM reservations
            WHERE room_id = :room_id
            AND (
                (check_in <= :check_out AND check_out >= :check_in)
            )
        ");
        $sql->bindParam(':room_id', $room_id);
        $sql->bindParam(':check_in', $check_in);
        $sql->bindParam(':check_out', $check_out);
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result['count'] == 0; // Retourne true si la chambre est disponible
    }
}
