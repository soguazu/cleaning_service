<?php

namespace Application\Entity;

class Customer extends ActiveRecord
{
    const TABLE_NAME = 'customers';

    public string $name;

    public string $address;

    public string $phone;

    public int $user_id;
    

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'user_id' => $this->user_id
        ];
    }
}
