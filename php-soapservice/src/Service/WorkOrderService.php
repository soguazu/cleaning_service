<?php

namespace Application\Service;

use Application\Entity\WorkOrder;
use Application\Entity\ServiceRequest;
use Application\Entity\Employee;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class WorkOrderService extends BaseService
{
    public function createWorkOrder()
    {
        try {
            $rows = $this->isEmployeeFixed($this->params);
            
            if ($rows) {
                return "Employee is already fixed"; 
            }

            $work_order = new WorkOrder();
            $ok = $work_order->save($this->params);

            if ($ok) return "Created work order successfully";

            http_response_code(ResponseCode::BAD_REQUEST);

        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    public function updateWorkOrderById()
    {
        try {
            $work_order = new WorkOrder();
            $ok = $work_order->save($this->params);
            
            if ($ok) return "Updated work order successfully";

            http_response_code(ResponseCode::BAD_REQUEST);
            die("Bad request");

        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    public function getWorkOrderById()
    {
        try {
            return WorkOrder::find($this->params['id']);
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }

    public function getAllWorkOrders()
    {
        return WorkOrder::findAll();
    }

    public function isEmployeeFixed($payload)
    {
        $service_request = ServiceRequest::find($payload['service_request_id']);
        return Employee::checkEmployeeStatus($service_request, $payload['employee_id']);
        
    }
}
