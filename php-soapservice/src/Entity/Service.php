<?php

namespace Application\Entity;

class Service extends ActiveRecord
{
    const TABLE_NAME = 'services';

    public string $name;

    public int $service_category_id;

    public int $company_id;

    

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'company_id' => $this->company_id,
            'service_category_id' => $this->service_category_id
        ];
    }
}
