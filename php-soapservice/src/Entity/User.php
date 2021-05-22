<?php

namespace Application\Entity;




class User extends ActiveRecord
{
    const TABLE_NAME = 'users';

    public string $password;

    public string $email;

    public string $avatar_url;

    public string $role;
    

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'avatar_url' => $this->avatar_url,
            'role' => $this->role,
            'password' => $this->password
        ];
    }
}
