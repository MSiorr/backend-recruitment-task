<?php

// Please add your logic here
echo "<h1 class='starting-title'>Nice to see you too! &#128075;</h1>";

include_once __DIR__ . '/../src/controllers/UsersController.php';

$c = new UsersController();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['event'])) {

    $event = $_POST["event"];
    if ($event === "add") {
        $c->addUser();
    } else if ($event === "remove") {
        $c->removeUser();
    } else {
        $c->showTable();
    }
} else {

    $c->showTable();
}
