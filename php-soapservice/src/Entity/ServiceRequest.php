<?php

namespace Application\Entity;




class ServiceRequest extends ActiveRecord
{
    const TABLE_NAME = 'service_requests';

    public int $customer_id;

    public int $service_id;

    public $proposed_start_date;

    public $proposed_end_date;

    public $actual_start_date;

    public $actual_end_date;

    public string $title;

    public string $status;

    public float $adjustment;

    public float $total;

    public string $unit;
    

    public function jsonSerialize()
    {
        return [
            'customer_id' => $this->customer_id,
            'service_id' => $this->service_id,
            'proposed_start_date' => $this->proposed_start_date,
            'proposed_end_date' => $this->proposed_end_date,
            'actual_start_date' => $this->actual_start_date,
            'actual_end_date' => $this->actual_end_date,
            'title' => $this->title,
            'status' => $this->status,
            'adjustment' => $this->adjustment,
            'unit' => $this->unit,
            'total' => $this->total
        ];
    }
}
