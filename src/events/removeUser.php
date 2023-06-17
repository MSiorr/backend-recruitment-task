<?php

include_once '../models/Users.php';

function removeUser(int $id)
{
    $users = new Users();
    $users->removeUser($id);
}


if (isset($_POST["event"]) && $_POST["event"] === "remove" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    removeUser($id);
}
