<h2>Inscription d'un nouvel utilisateur</h2>
<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <form action="inscription/createNewUser" method="POST">
                <div class="form-group">
                    <input _ngcontent-c0="" class="form-control form-control-lg" placeholder="User's name" type="text" name="username">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" placeholder="User's Password" type="password" name="password">
                </div>
                <div class="form-group">
                    <button class="btn btn-info btn-lg btn-block" name="send">Inscription</button>
                </div>
            </form>
        </div>
    </div>
</div>


<p><a href="/21_donkey_mvc_hotel/addroom">addroom</a></p>



<!-- Afficher la liste des utilisateurs inscrits -->
<h2>Utilisateurs inscrits</h2>
<ul class="list-group">
    <?php



    foreach ($users as $user) : ?>
        <li class="list-group-item">
            <?php echo 'user_id_ <b>' . ($user['user_id']) . ' </b>user name <b>'
                . htmlspecialchars($user['username']) . '</b>'
                . '<a href="inscription/deleteUser/' . $user['user_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\');">Supprimer</a>'; ?>
        </li>
    <?php endforeach; ?>
</ul>