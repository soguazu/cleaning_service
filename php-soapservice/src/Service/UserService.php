<?php

namespace Application\Service;

use Application\Entity\User;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class UserService extends BaseService
{

    public function createUser()
    {
        try {
            $user = new User();
            $this->params['password'] = password_hash($this->params['password'], PASSWORD_DEFAULT);

            $ok = $user->save($this->params);

            if ($ok) return "Created user successfully";

            http_response_code(ResponseCode::BAD_REQUEST);
            
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    public function getUserById()
    {
        try {
            return User::find($this->params['id']);
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }

    public function getAllUsers()
    {
        return User::findAll();
    }
}
