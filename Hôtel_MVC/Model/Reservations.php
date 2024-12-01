<?php
//reservation_id
//user_id
//room_id
//checkin_date
//checkout_date
//breakfast
//total_price

class Reservation
{
    private int $reservation_id;
    //identifiant utilisateur - foreign key
    private int $user_id;
    //identifiant de la chambre - foreign key
    private int $room_id;
    private string $check_in;
    private  string $check_out;
    private bool $breakfast;
    private int $total_price;

    //GETTERS ET SETTERS
    public function getReservationId(): int
    {
        return $this->reservation_id;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function getRoomId(): int
    {
        return $this->room_id;
    }
    public function getCheckIn(): string
    {
        return $this->check_in;
    }
    public function setCheckIn($check_in): self
    {
        $this->check_in = $check_in;
        return $this;
    }
    public function getCheckOut(): string
    {
        return $this->check_out;
    }
    public function setCheckOut($check_out): self
    {
        $this->check_out = $check_out;
        return $this;
    }
    public function getBreakfast(): bool
    {
        return $this->breakfast;
    }
    public function setBreakfast($breakfast): self
    {
        $this->breakfast = $breakfast;
        return $this;
    }
    public function getTotalPrice(): int
    {
        return $this->total_price;
    }
    public function setTotalPrice($total_price): self
    {
        $this->total_price = $total_price;
        return $this;
    }
}
