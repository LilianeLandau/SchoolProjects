<h2>Ajouter une chambre</h2>

<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <form action="/room/createNewRoom" method="POST">
                <div class="form-group">
                    <label for="price_room">Room's price</label>
                    <input _ngcontent-c0="" class="form-control form-control-lg" placeholder="Room's price" type="number" name="price_room">
                </div>
                <div class="form-group">
                    <label for="room_number">Room's number</label>
                    <input class="form-control form-control-lg" placeholder="Room's number" type="number" name="room_number">
                </div>
                <div class="form-group">
                    <label for="price_breakfast">Breakfast's price</label>
                    <input class="form-control form-control-lg" placeholder="Breakfast's price" type="number" name="price_breakfast">
                </div>
                <div class="form-group">
                    <button class="btn btn-info btn-lg btn-block" name="send">Insert Room</button>
                </div>
            </form>
        </div>
    </div>
</div>