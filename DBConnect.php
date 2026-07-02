<?php

class DBConnect
{
    private string $host = "127.0.0.1";
    private string $dbname = "exercice_poo";
    private string $user = "root";
    private string $password = "";

    public function getPDO(): PDO
    {
        return new PDO(
            "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
            $this->user,
            $this->password
        );
    }
}
