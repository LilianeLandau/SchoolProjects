<!-- Afficher la liste des utilisateurs inscrits -->
<h2>Utilisateurs inscrits</h2>
<ul class="list-group">
    <?php



    foreach ($users as $user) : ?>
        <li class="list-group-item">
            <?php echo 'user_id_ <b>' . ($user['user_id']) . ' </b>user name <b>'
                . htmlspecialchars($user['username']) . '</b>'
                . '<a href="user/deleteUser/' . $user['user_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\');">Supprimer</a>'
                . '<a href="user/updateUser/' . $user['user_id'] . '" class="btn btn-warning btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir modifier cet utilisateur ?\');">Modifier</a>'
                . '<a href="user/deleteUserWithReservations/' . $user['user_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ET les réservations ET cet utilisateur ?\');">Supprimer Réservations Et Utilisateur</a>'; ?>
        </li>
    <?php endforeach; ?>
</ul>

<div class="mt-3">
    <a href="/user/add" class="btn btn-primary">Ajouter un utilisateur</a>
</div>