<?php

class Users
{

    private $dataJSON = __DIR__ . "/../../dataset/users.json";

    private $users;

    public function __construct(bool $assoc = true)
    {
        $json = file_get_contents($this->dataJSON, true);
        $this->users = json_decode($json, $assoc);
    }

    public function getUsers(bool $assoc = true)
    {
        return $this->users;
    }

    public function removeUser(int $id)
    {
        $this->users = array_filter(
            $this->users,
            fn ($el) => $el["id"] !== $id
        );

        file_put_contents($this->dataJSON, json_encode(array_values($this->users)));
    }

    public function addUser(array $data)
    {
        $lastId = $this->users[count($this->users) - 1]["id"];

        $data = array_merge(["id" => $lastId + 1], $data);

        array_push($this->users, $data);

        file_put_contents($this->dataJSON, json_encode(array_values($this->users)));
    }
}
