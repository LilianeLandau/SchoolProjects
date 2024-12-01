<h2>Login User</h2>

<?php
if (!empty($_SESSION['message'])) {
    echo '<p style="color: red;">' . $_SESSION['message'] . '</p>';

    unset($_SESSION['message']);
}
?>

<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <form action="/user/checkUserLogin" method="POST">
                <div class="form-group">
                    <input _ngcontent-c0="" class="form-control form-control-lg" placeholder="User's name" type="text" name="username">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" placeholder="User's Password" type="password" name="password">
                </div>
                <div class="form-group">
                    <button class="btn btn-info btn-lg btn-block" name="send">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>