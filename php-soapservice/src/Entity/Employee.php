<?php

namespace Application\Entity;




class Employee extends ActiveRecord
{
    const TABLE_NAME = 'employees';

    public int $company_id;

    public int $user_id;

    public string $first_name;

    public string $last_name;

    public float $hourly_rate;
    

    public function jsonSerialize()
    {
        return [
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'hourly_rate' => $this->hourly_rate
        ];
    }
}
