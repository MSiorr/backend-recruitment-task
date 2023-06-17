<?php

class Users
{

    private $dataJSON = __DIR__ . "/../../dataset/users.json";

    public function getUsers(bool $assoc = true)
    {
        $json = file_get_contents($this->dataJSON, true);
        $users = json_decode($json, $assoc);

        return $users;
    }

    public function removeUser(int $id)
    {
        $users = $this->getUsers();
        $users = array_filter(
            $users,
            fn ($el) => $el["id"] !== $id
        );

        file_put_contents($this->dataJSON, json_encode(array_values($users)));
    }

    public function addUser(array $data)
    {
        $users = $this->getUsers();
        $lastId = $users[count($users) - 1]["id"];

        $data = array_merge(["id" => $lastId + 1], $data);

        array_push($users, $data);

        // var_dump($users);
        file_put_contents($this->dataJSON, json_encode(array_values($users)));
    }
}
