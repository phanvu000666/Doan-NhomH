<?php

namespace SmartWeb\Controller;

use SmartWeb\Models\ObjectAssembler;
use SmartWeb\Models\User;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}include{$ds}function.php");
include_once("{$base_dir}model{$ds}update-file.php");

class UserController
{
    private User $user;
    public function __construct(string $conf)
    {
        $assembler = new ObjectAssembler($conf);
        $this->user = $assembler->getComponent(User::class);
    }

    public function updateUser($user)
    {
        $data = $this->user->updateUser($user);

        if ($data === true) {
            return [
                'success' => true,
                'message' => 'User updated successfully'
            ];
        } else if ($data === false) {
            return [
                'success' => false,
                'message' => 'Error updating user'
            ];
        } else {
            return [
                'success' => false,
                'message' => $data
            ];
        }
        return $data;
    }

    public function createNewUser($user)
    {
        $data = $this->user->addUser($user);

        if ($data === true) {
            return [
                'success' => true,
                'message' => 'User created successfully'
            ];
        } else if ($data === false) {
            return [
                'success' => false,
                'message' => 'Error creating user'
            ];
        } else {
            return [
                'success' => false,
                'message' => $data
            ];
        }
        return $data;
    }

    public function showGroups()
    {
        if ($this->user->getGroups() !== null) {
            return $this->user->getGroups();
        }
        return null;
    }

    public function showUserData()
    {
        if ($this->user->getListUser() !== null) {
            return $this->user->getListUser();
        }
        return null;
    }

    public function deleteUserByID($id)
    {
        $data = $this->user->deleteUser($id);
        if ($data === true) {
            return header("Location: /admin/user-management-page");
        } else if ($data === null) {
            return [
                'success' => false,
                'message' => 'Error deleting user'
            ];
        }
        return null;
    }

    public function getFormUserInfo($id)
    {
        if ($id == null) {
            $result = $this->user->getFormUserInfo(null);
        } else {
            $result = $this->user->getFormUserInfo(['UserID' => $id]);
        }

        if ($result === null) {
            return [
                'success' => false,
                'message' => 'Error get user'
            ];
        }
        return [
            'success' => true,
            'data' => $result
        ];
    }
}
