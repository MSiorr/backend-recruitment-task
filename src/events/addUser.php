<?php

include_once '../models/Users.php';

$errMsg;

if (isset($_POST) && $_POST["event"] === "add") {

    $status = addUser();
    echo json_encode([
        "status" => $status,
        "error" => $errMsg
    ]);
}

function commaPos(string $string): int
{
    $pos = strpos($string, ",");
    return $pos !== false ? $pos : 0;
}

function firstNumPos(string $string): int
{
    return strcspn($string, '0123456789');
}

function lastNumPos(string $string): int
{
    preg_match('{[0-9]([^0-9]*)$}', $string, $matches);
    return strlen($string) - strlen(count($matches) > 0 ? $matches[0] : '');
}

function addUser(): bool
{
    global $errMsg;

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $address = $_POST["address"];

    if (!preg_match("/^[a-zA-z\s]*$/", $name)) {
        $errMsg = "Error in name";
        return false;
    }

    $emailPattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    if (!preg_match($emailPattern, $email)) {
        $errMsg = "Error in email";
        return false;
    }

    if (!preg_match("/^\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?x?\d{1,9}$/", $phone)) {
        $errMsg = "Error in phone";
        return false;
    }

    if (commaPos($address) !== 0)
        $street = substr($address, 0, commaPos($address));
    else
        $street = substr($address, 0);

    $zipcode = substr($address, firstNumPos($address), lastNumPos($address) - firstNumPos($address) + 1);
    $city = substr($address, lastNumPos($address) + 2);

    $users = new Users();

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

    $users->addUser($data);

    return true;
}
