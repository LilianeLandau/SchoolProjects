<h2>Inscription d'un nouvel utilisateur</h2>
<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <form action="/user/createNewUser" method="POST">
                <div class="form-group">
                    <label for="username">Users' name</label>
                    <input _ngcontent-c0="" class="form-control form-control-lg" placeholder="User's name" type="text" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Users' password</label>
                    <input class="form-control form-control-lg" placeholder="User's Password" type="password" name="password">
                </div>
                <div class="form-group">
                    <button class="btn btn-info btn-lg btn-block" name="send">Inscription</button>
                </div>
            </form>
        </div>
    </div>
</div>