<?php

include_once __DIR__ . '/../models/Users.php';
include_once __DIR__ . "/../views/viewTable.php";

class UsersController
{
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function showTable()
    {
        $users = $this->users->getUsers();
        echo displayIndex($users);
    }

    public function addUser()
    {

        $errMsg = '';
        $status = true;

        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        if (!preg_match("/^[a-zA-z\s]*$/", $name)) {
            $errMsg = "Error in name";
            $status = false;
        }

        $emailPattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if (!preg_match($emailPattern, $email)) {
            $errMsg = "Error in email";
            $status = false;
        }

        if (!preg_match("/^\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?x?\d{1,9}$/", $phone)) {
            $errMsg = "Error in phone";
            $status = false;
        }

        if ($this->commaPos($address) !== 0)
            $street = substr($address, 0, $this->commaPos($address));
        else
            $street = substr($address, 0);

        $zipcode = substr($address, $this->firstNumPos($address), $this->lastNumPos($address) - $this->firstNumPos($address) + 1);
        $city = substr($address, $this->lastNumPos($address) + 2);

        $data = [
            "name" => $name,
            "username" => $_POST["username"],
            "email" => $email,
            "address" => [
                "street" => $street,
                "zipcode" => $zipcode,
                "city" => $city
            ],
            "phone" => $phone,
            "company" => [
                "name" => $_POST["company"]
            ]
        ];

        $this->users->addUser($data);

        echo json_encode([
            "status" => $status,
            "error" => $errMsg
        ]);
    }

    public function removeUser()
    {

        $id = $_POST["id"];
        if (intval($id)) {
            $this->users->removeUser($id);
        }
    }

    private function commaPos(string $string): int
    {
        $pos = strpos($string, ",");
        return $pos !== false ? $pos : 0;
    }

    private function firstNumPos(string $string): int
    {
        return strcspn($string, '0123456789');
    }

    private function lastNumPos(string $string): int
    {
        preg_match('{[0-9]([^0-9]*)$}', $string, $matches);
        return strlen($string) - strlen(count($matches) > 0 ? $matches[0] : '');
    }
}
