<?php

require_once "DBConnect.php";
require_once "Contact.php";

class ContactManager
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new DBConnect();
        $this->pdo = $db->getPDO();
    }

    public function findAll(): array
    {
        $statement = $this->pdo->query("SELECT * FROM contact");

        $contacts = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $contact = new Contact();

            $contact->setId((int)$row["id"]);
            $contact->setName($row["name"]);
            $contact->setEmail($row["email"]);
            $contact->setPhoneNumber($row["phone_number"]);

            $contacts[] = $contact;
        }

        return $contacts;
    }
}