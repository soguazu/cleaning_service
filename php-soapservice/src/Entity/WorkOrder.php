<?php

namespace Application\Entity;




class WorkOrder extends ActiveRecord
{
    const TABLE_NAME = 'work_orders';

    public int $service_request_id;

    public int $employee_id;

    public string $status;
    

    public function jsonSerialize()
    {
        return [
            'service_request_id' => $this->service_request_id,
            'employee_id' => $this->employee_id,
            'status' => $this->status,
        ];
    }
}
