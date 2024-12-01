<h2 class="mb-4">Voici vos Réservations <b><?php echo htmlspecialchars($_SESSION['username']); ?></b></h2>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th>Réservation_id</th>
                <th>Utilisateur</th>
                <th>Numéro de chambre</th>
                <th>Prix par nuit €</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Petit-déjeuner</th>
                <th>Prix total €</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($reservation['reservation_id']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['username']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['room_number']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['price_room']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['check_in']); ?></td>
                    <td><?php echo htmlspecialchars($reservation['check_out']); ?></td>
                    <td><?php echo $reservation['breakfast'] ? 'Oui' : 'Non'; ?></td>
                    <td><?php echo htmlspecialchars($reservation['total_price']); ?></td>
                    <td>
                        <a href="/reservation/deleteReservation/<?php echo $reservation['reservation_id']; ?>"
                            class="btn btn-danger btn-sm mb-1"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                            Supprimer
                        </a>
                        <a href="/reservation/updateReservation/<?php echo $reservation['reservation_id']; ?>"
                            class="btn btn-warning btn-sm mb-1"
                            onclick="return confirm('Êtes-vous sûr de vouloir modifier cette réservation ?');">
                            Modifier
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="mt-3">
    <a href="/reservation/add" class="btn btn-primary">Réserver une chambre</a>
</div>














<?php
// Boucle pour afficher chaque réservation
/*
foreach ($reservations as $reservation) {
    echo "Réservation ID: " . htmlspecialchars($reservation['reservation_id']) . "<br>";
    echo "Utilisateur: " . htmlspecialchars($reservation['username']) . "<br>";
    echo "Numéro de chambre: " . htmlspecialchars($reservation['room_number']) . "<br>";
    echo "Prix de la chambre: " . htmlspecialchars($reservation['price_room']) . " €<br>";
    echo "Check-in: " . htmlspecialchars($reservation['check_in']) . "<br>";
    echo "Check-out: " . htmlspecialchars($reservation['check_out']) . "<br>";
    echo "Petit-déjeuner: " . ($reservation['breakfast'] ? 'Oui' : 'Non') . "<br>";
    echo "Prix total: " . htmlspecialchars($reservation['total_price']) . " €<br><br>";
}*/
?>