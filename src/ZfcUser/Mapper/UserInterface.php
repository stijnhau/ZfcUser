<?php

namespace ZfcUser\Mapper;

use ZfcUser\Entity\UserInterface as UserEntity;

interface UserInterface
{
    public function findByEmail($email);

    public function findByUsername($username);

    public function findById($id);

    public function insert(UserEntity $user);

    public function update(UserEntity $user);

    public function delete(UserEntity $user);
}
