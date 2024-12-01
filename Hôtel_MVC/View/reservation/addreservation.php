<h2>Réserver une chambre</h2>


<div class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <form action="/reservation/createNewReservation" method="POST">


                <!-- Select pour choisir la chambre -->
                <div class="form-group">
                    <select name="room_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option>Sélectionner une chambre</option>
                        <?php foreach ($rooms as $room) : ?>
                            <option value="<?= $room->getRoomId(); ?>">
                                Room_id <?= htmlspecialchars($room->getRoomId()); ?>
                                Room <?= htmlspecialchars($room->getRoomNumber()); ?>
                                Price Room <?= htmlspecialchars($room->getPriceRoom()) . '€ '; ?>
                                Price Breakfast <?= htmlspecialchars($room->getPriceBreakfast()) . '€ '; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <!-- Champ date d'arrivée (check-in) -->
                <div class="form-group">
                    <label for="check_in">Check-In Date</label>
                    <input class="form-control form-control-lg" type="date" id="check_in" name="check_in" required>
                </div>

                <!-- Champ date de départ (check-out) -->
                <div class="form-group">
                    <label for="check_out">Check-Out Date</label>
                    <input class="form-control form-control-lg" type="date" id="check_out" name="check_out" required>
                </div>

                <!-- Option petit-déjeuner -->
                <div class="form-group">
                    <label for="breakfast">Include Breakfast at € 10</label>
                    <input type="checkbox" id="breakfast" name="breakfast" value="1">
                </div>


                <!-- Bouton soumission -->
                <div class="form-group">
                    <button class="btn btn-info btn-lg btn-block" type="submit" name="send">Confirm your Reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>