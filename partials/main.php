<?php

// Please add your logic here
echo "<h1 class='starting-title'>Nice to see you too! &#128075;</h1>";

include_once 'src/controllers/UsersController.php';

$c = new UsersController();
$c->init();
