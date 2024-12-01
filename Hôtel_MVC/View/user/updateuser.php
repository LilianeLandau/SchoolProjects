<h2>Modification d'un utilisateur</h2>
<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <form action="/user/updateTheUser" method="POST">
                <!-- Champ caché pour transmettre l'ID -->
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">

                <div class="form-group">
                    <label for="username">Users' name</label>
                    <input class="form-control form-control-lg"
                        placeholder="Nom d'utilisateur"
                        type="text"
                        name="username"
                        value="<?php echo htmlspecialchars($user['username']); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Users' password</label>
                    <input class="form-control form-control-lg"
                        placeholder="Mot de passe"
                        type="password"
                        name="password">
                </div>
                <div class="form-group">
                    <button class="btn btn-info btn-lg btn-block" name="send">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>