<?php

/*
Author: David
Fecha: 15/05/2024
*/

namespace App\api\contacts\domain;
use App\api\core\shared\contracts\domain\BaseDomain;


class Contact extends BaseDomain
{
    public int $id;
    public string $name;
    public string $lastName;
    public string $email;
    public string $birth_date;
    public string $phone;
    public string $phone2;
    public string $photo;
    public string $address;
    public int $user_id;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;


    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPhone2(): string
    {
        return $this->phone2;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

}
