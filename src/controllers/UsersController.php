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

        var_dump($_POST);

        if (!$this->validateName($name)) {
            $status = false;
            $errMsg = "Error in name";
        }

        if ($status && !$this->validateEmail($email)) {
            $status = false;
            $errMsg = "Error in email";
        }

        if ($status && !$this->validatePhone($phone)) {
            $status = false;
            $errMsg = "Error in phone";
        }

        if ($status) {

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
        }

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

    private function validatePhone(string $string): bool
    {
        return preg_match("/^\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?x?\d{1,9}\s?$/", $string);
    }

    private function validateEmail(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_EMAIL);
    }

    private function validateName(string $string): bool
    {
        return preg_match("/^[a-zA-z\s]*$/", $string);
    }
}
