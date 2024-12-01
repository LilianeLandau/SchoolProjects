<?php
//room_id
//room_number
//price_room
//price_breakfast

class Room
{

    //$room_id stocke l'identifiant unique de la chambre
    private int $room_id;
    //le numéro de la chambre
    private int $room_number;
    //le prix de la chambre
    private int $price_room;
    //prix du breakfast
    private int $price_breakfast;

    //GETTERS ET SETTERS

    public function getRoomId(): int
    {
        return $this->room_id;
    }

    public function getRoomNumber(): int
    {
        return $this->room_number;
    }
    public function setRoomNumber($room_number): self
    {
        $this->room_number = $room_number;
        return $this;
    }

    public function getPriceRoom(): int
    {
        return $this->price_room;
    }

    public function setPriceRoom($price_room): self
    {
        $this->price_room = $price_room;
        return $this;
    }
    public function getPriceBreakfast(): int
    {
        return $this->price_breakfast;
    }
    public function setPriceBreakfast($price_breakfast): self
    {
        $this->price_breakfast = $price_breakfast;
        return $this;
    }
}
