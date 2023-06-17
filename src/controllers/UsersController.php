<?php

include_once 'src/models/Users.php';

class UsersController
{
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function init()
    {
        $users = $this->users->getUsers();
        include "src/view/viewTable.php";
    }
}
