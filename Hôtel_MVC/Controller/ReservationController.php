<?php
class ReservationController
{
    private $reservationsRepository;

    public function __construct($dbh)
    {
        $this->reservationsRepository = new ReservationsRepository($dbh);
    }

    public function show()
    {
        $title = "Reservation";
        $action = "Listreservations";

        //on vérifie si l'utilisateur est connecté 
        //seul l'utilisateur connecté peut réserver
        if (!isset($_SESSION['user_id'])) {
            echo "<p class='text-danger'>Vous devez d'abord vous connecter</p>";
            exit();
        }

        //si l'utilisateur est connecté récupérer son id
        $user_id = $_SESSION['user_id'];

        $reservations = $this->reservationsRepository->showUserNameRoomReservations($user_id);

        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/reservation/listreservations.php';
        include BASE_ROOT . 'View/footer.php';
    }



    public function add()
    {
        $title = "Addreservation";
        $action = 'Addreservation';

        //cette fonction affiche les chambres dans le select du formulaire de réservation
        $rooms = $this->reservationsRepository->showAllRooms();

        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/reservation/addreservation.php';
        include BASE_ROOT . 'View/footer.php';
    }

    /*
    //la méthode a été modifiée et améliorée plus bas pour controller si la chambre est disponible
    public function createNewReservation()
    {
        //on vérifie si l'utilisateur est connecté 
        //seul l'utilisateur connecté peut réserver
        if (!isset($_SESSION['user_id'])) {
            echo "<p class='text-danger'>Vous devez d'abord vous connecter</p>";
            exit();
        }

        //si l'utilisateur est connecté récupérer son id
        $user_id = $_SESSION['user_id'];

        //var_dump($user_id);
        if (isset($_POST['send'])) {

            //si le formulaire a été envoyé
            //récupérer les données du formulaire
            $room_id = $_POST['room_id'];
            $check_in = $_POST['check_in'];
            $check_out = $_POST['check_out'];
            $breakfast = isset($_POST['breakfast']) ? 1 : 0;

            //on récupère le tableau des réservations 
            $this->reservationsRepository->createNewReservation([
                'check_in' => $check_in,
                'check_out' => $check_out,
                'room_id' => $room_id,
                'breakfast' => $breakfast,
                'user_id' => $user_id,
            ]);
        }

        header('Location: /reservation');
    }

    */
    //SUPPRIMER UNE RÉSERVATION
    public function deleteReservation($reservation_id)
    {
        $this->reservationsRepository->deleteReservation($reservation_id);
        header('Location: /reservation');
    }
    //RECUPERER LA RESERVATION A MODIFIER
    //POUR LES AFFICHER DANS LE FORMULAIRE DE MODIFICATION
    public function updateReservation($reservation_id)
    {

        $title = "Modifier une réservation";
        $action = 'Updatereservation';

        $reservation = $this->reservationsRepository->getReservationById($reservation_id);


        // Récupérer toutes les chambres pour les afficher dans le SELECT
        $rooms = $this->reservationsRepository->showAllRooms();


        include BASE_ROOT . 'View/header.php';
        include BASE_ROOT . 'View/reservation/updatereservation.php';
        include BASE_ROOT . 'View/footer.php';
    }

    //METHODE POUR ENREGISTRER LES MODIFICATIONS 
    //DE LA RESERVATION DANS LA BDD
    //champs de la table reservations
    //reservation_id, user_id, room_id, check_in, check_out, breakfast, total_price
    public function updateTheReservation()
    {
        if (isset($_POST['send']) && !empty($_POST['reservation_id'])) {
            $reservation_id = $_POST['reservation_id'];
            $user_id = $_SESSION['user_id'];
            $room_id = $_POST['room_id'];
            $check_in = $_POST['check_in'];
            $check_out = $_POST['check_out'];
            $breakfast = isset($_POST['breakfast']) ? 1 : 0;
            // Calculer le prix total à l'aide de la méthode existante
            $total = $this->reservationsRepository->calculateTotalPrice([
                'check_in' => $check_in,
                'check_out' => $check_out,
                'room_id' => $room_id,
                'breakfast' => $breakfast,
            ]);

            // Mettre à jour la réservation avec les nouvelles données
            $this->reservationsRepository->updateReservation($reservation_id, [
                'check_in' => $check_in,
                'check_out' => $check_out,
                'room_id' => $room_id,
                'breakfast' => $breakfast,
                'user_id' => $user_id,
                'total_price' => $total,
            ]);
        }
        header('Location: /reservation');
    }


    //METHODE POUR RESERVER ET VERIFIER SI UNE CHAMBRE EST DISPONIBLE

    public function createNewReservation()
    {
        if (!isset($_SESSION['user_id'])) {
            echo "<p class='text-danger'>Vous devez d'abord vous connecter</p>";
            exit();
        }

        $user_id = $_SESSION['user_id'];

        if (isset($_POST['send'])) {
            $room_id = $_POST['room_id'];
            $check_in = $_POST['check_in'];
            $check_out = $_POST['check_out'];
            $breakfast = isset($_POST['breakfast']) ? 1 : 0;

            // Vérification de la disponibilité de la chambre
            //avant d'insérer une nouvelle réservation 
            //on appelle la méthode isRoomAvailable
            //si la chambre est occupée, affichage d'un message
            //et le processus de réservation est interrompu
            if (!$this->reservationsRepository->isRoomAvailable($room_id, $check_in, $check_out)) {
                echo "<p class='text-danger'>La chambre est déjà réservée pour ces dates. Merci d'en choisir une autre.</p>";
                exit();
            }

            // Créer la réservation si la chambre est disponible
            $this->reservationsRepository->createNewReservation([
                'check_in' => $check_in,
                'check_out' => $check_out,
                'room_id' => $room_id,
                'breakfast' => $breakfast,
                'user_id' => $user_id,
            ]);

            header('Location: /reservation');
        }
    }
}
