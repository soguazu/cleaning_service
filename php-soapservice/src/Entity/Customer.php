<?php

namespace Application\Entity;

class Customer extends ActiveRecord
{
    const TABLE_NAME = 'customers';

    public string $name;

    public string $email;

    public string $address;

    public string $phone;
    

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->address,
            'phone' => $this->phone,
            'address' => $this->address
        ];
    }
}
