<?php


class RoomController
{
    private $addRoomsRepository;

    public function __construct($dbh)
    {
        $this->addRoomsRepository = new AddRoomsRepository($dbh); // Attention à la casse !
    }

    public function show()
    {
        $title = "Room";
        $action = 'Listerooms';

        $rooms = $this->addRoomsRepository->showAllRooms();



        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/room/listrooms.php';
        include BASE_ROOT . 'View/footer.php';
    }

    public function add()
    {
        $title = "Addroom";
        $action = 'addroom';

        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/room/addroom.php';
        include BASE_ROOT . 'View/footer.php';
    }

    public function createNewRoom()
    {


        //var_dump($_POST);

        if (isset($_POST['send'])) {
            $price_room = $_POST['price_room'];
            $room_number = $_POST['room_number'];
            $price_breakfast = $_POST['price_breakfast'];

            // var_dump($_POST);

            // Vérifier les données reçues
            if (empty($price_room) || empty($room_number) || empty($price_breakfast)) {
                echo "Tous les champs sont obligatoires.";
                exit;
            }

            $this->addRoomsRepository->createNewRoom($price_room, $room_number, $price_breakfast);

            header('Location:/room');
        }
    }


    public function deleteRoom($room_id)
    {
        $this->addRoomsRepository->deleteRoom($room_id);

        header('Location: /room');
    }

    //RECUPERER LA CHAMBRE A MODIFIER
    //puis afficher les informations de la chambre
    //dans cette méthode on utlise
    //la méthode getRoomById
    public function updateRoom($room_id)
    {
        $title = 'Modifier une chambre';
        $action = 'Updateroom';
        $room = $this->addRoomsRepository->getRoomById($room_id);
        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/room/updateroom.php';
        include BASE_ROOT . 'View/footer.php';
    }

    //METHODE POUR UPDATE ROOM DANS LA BDD
    public function updateTheRoom()
    {
        if (isset($_POST['send'])  && !empty($_POST['room_id'])) {
            $room_id = $_POST['room_id'];
            $price_room = $_POST['price_room'];
            $room_number = $_POST['room_number'];
            $price_breakfast = $_POST['price_breakfast'];

            $this->addRoomsRepository->updateRoom($room_id, $price_room, $room_number, $price_breakfast);
            header('Location: /room');
        }
    }
}
