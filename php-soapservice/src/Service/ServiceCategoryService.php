<?php

namespace Application\Service;

use Application\Entity\ServiceCategory;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class ServiceCategoryService extends BaseService
{


    public function createServiceCategory()
    {
        try {
            $company = new ServiceCategory();
            $ok = $company->save($this->params);

            if ($ok) return "Created service category successfully";

            http_response_code(ResponseCode::BAD_REQUEST);
            
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    

    public function getAllServiceCategories()
    {
        return ServiceCategory::findAll();
    }
}
