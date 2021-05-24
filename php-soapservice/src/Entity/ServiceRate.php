<?php

namespace Application\Entity;

class ServiceRate extends ActiveRecord
{
    const TABLE_NAME = 'service_rates';

    public int $service__id;

    public float $unit;

    public float $amount;

    public float $duration;

    public float $supply_markup;

    public float $overhead_markup;

    public float $misc_markup;
    

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'service_id' => $this->service_id,
            'unit' => $this->unit,
            'amount' => $this->amount,
            'duration' => $this->duration,
            'supply_markup' => $this->supply_markup,
            'overhead_markup' => $this->overhead_markup,
            'misc_markup' => $this->misc_markup
        ];
    }
}
