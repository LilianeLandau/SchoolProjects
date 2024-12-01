<?php



class AddRoomsRepository
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function createNewRoom(string $price_room, string $room_number, string $price_breakfast)
    {
        try {
            $request = $this->dbh->prepare("INSERT INTO rooms (price_room, room_number, price_breakfast) 
                VALUES (:price_room, :room_number, :price_breakfast)");

            $request->bindParam(':price_room', $price_room, PDO::PARAM_INT);
            $request->bindParam(':room_number', $room_number, PDO::PARAM_INT);
            $request->bindParam(':price_breakfast', $price_breakfast, PDO::PARAM_INT);

            $request->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            exit;
        }
    }

    //fonction pour afficher toutes les chambres
    public function showAllRooms()
    { //requête pour sélectionner le contenu de la table rooms
        $request = $this->dbh->prepare("SELECT * FROM rooms");
        //exécution de la requête
        $request->execute();
        //après l'exécution retourne les résultats sous forme 
        //d'un tableau associatif
        //chaque ligne du tableau correspond à une ligne de la table
        //et donc à une chambre
        //que ligne du tableau est accessible par le nom de la colonne
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }


    //SUPPRIMER UNE CHAMBRE
    //selon le room_id transmis
    public function deleteRoom($room_id)
    {
        //vérifier si room_id connu
        //requête sql pour sélectionner la chambre correspondant à ce room_id
        $sql = $this->dbh->prepare("DELETE FROM rooms WHERE room_id = :room_id");
        //bindParam assigne les valeurs 
        $sql->bindParam(':room_id', $room_id);
        //exécution de la requête
        $sql->execute();
    }


    //RECUPERER UNE CHAMBRE
    //GRACE A SON room_id
    public function getRoomById($room_id)
    {
        $sql = $this->dbh->prepare("SELECT * FROM rooms WHERE room_id = :room_id");
        $sql->bindParam(':room_id', $room_id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
        //retourne les données sous forme d'un
        //tableau associatif
    }
    //UPDATE ROOM
    public function updateRoom($room_id, $price_room, $room_number, $price_breakfast)
    {
        $sql = $this->dbh->prepare("UPDATE rooms SET price_room = :price_room, room_number = :room_number, price_breakfast = :price_breakfast WHERE room_id = :room_id");
        $sql->bindParam(':room_id', $room_id);
        $sql->bindParam(':price_room', $price_room);
        $sql->bindParam(':room_number', $room_number);
        $sql->bindParam('price_breakfast', $price_breakfast);
        $sql->execute();
    }
}
