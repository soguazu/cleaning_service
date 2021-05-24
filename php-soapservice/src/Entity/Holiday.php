<?php

namespace Application\Entity;

class Holiday extends ActiveRecord
{
    const TABLE_NAME = 'holidays';

    public int $employee_id;

    public int $company_id;

    public $start_date;

    public $end_date;

    public bool $approved;
    

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'employee_id' => $this->employee_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'approved' => $this->approved
        ];
    }
}
