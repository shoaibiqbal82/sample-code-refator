<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($id);
    public function getUserType($id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
