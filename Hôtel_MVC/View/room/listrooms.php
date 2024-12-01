<!-- Afficher la liste des chambres -->
<h2>Liste des chambres</h2>
<ul class="list-group">
    <?php foreach ($rooms as $room) : ?>
        <li class="list-group-item">
            <?php
            echo 'room_id_ <b>' . htmlspecialchars($room['room_id']) . '</b> 
                      Room number <b>' . htmlspecialchars($room['room_number']) . '</b> 
                      Room price <b>' . htmlspecialchars($room['price_room']) . '</b> 
                      Breakfast\'s price <b>' . htmlspecialchars($room['price_breakfast']) . '</b>'
                . '<a href="room/deleteRoom/' . $room['room_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette chambre ?\');">Supprimer</a>'
                . '<a href="room/updateRoom/' . $room['room_id'] . '" class="btn btn-warning btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir modifier cette chambre ?\');">Modifier</a>'; ?>

        </li>
    <?php endforeach; ?>
    <div class="mt-3">
        <a href="/room/add" class="btn btn-primary">Ajouter une chambre</a>
    </div>
</ul>