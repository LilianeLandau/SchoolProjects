<h2>Modifier une chambre</h2>

<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <form action="/room/updateTheRoom" method="POST">

                <!-- Champ caché pour transmettre l'ID -->
                <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room['room_id']); ?>">


                <div class="form-group">
                    <label for="price_room">Room's price</label>
                    <input _ngcontent-c0="" class="form-control form-control-lg" type="number" name="price_room"
                        value="<?php echo htmlspecialchars($room['price_room']); ?>">
                </div>
                <div class="form-group">
                    <label for="room_number">Room's number</label>
                    <input class="form-control form-control-lg" type="number" name="room_number"
                        value="<?php echo htmlspecialchars($room['price_room']); ?>">
                </div>
                <div class="form-group">
                    <label for="price_breakfast">Breakfast's price</label>
                    <input class="form-control form-control-lg" type="number" name="price_breakfast"
                        value="<?php echo htmlspecialchars($room['price_breakfast']); ?>">
                </div>

                <div class="form-group">
                    <button class="btn btn-info btn-lg btn-block" name="send">Update Room</button>
                </div>
            </form>
        </div>
    </div>
</div>