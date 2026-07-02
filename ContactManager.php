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

    public function findById(int $id): ?Contact
    {
        $statement = $this->pdo->prepare("SELECT * FROM contact WHERE id = ?");
        $statement->execute([$id]);

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        $contact = new Contact();

        $contact->setId((int)$row["id"]);
        $contact->setName($row["name"]);
        $contact->setEmail($row["email"]);
        $contact->setPhoneNumber($row["phone_number"]);

        return $contact;
    }

    public function create(Contact $contact): void
    {
        $statement = $this->pdo->prepare("INSERT INTO contact (name, email, phone_number) VALUES (?, ?, ?)");
        $statement->execute([$contact->getName(), $contact->getEmail(), $contact->getPhoneNumber()]);
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM contact WHERE id = ?");
        $statement->execute([$id]);
    }

    public function modify(Contact $contact): void
    {
        $statement = $this->pdo->prepare(
            "UPDATE contact
            SET name = ?, email = ?, phone_number = ?
            WHERE id = ?"
        );

        $statement->execute([
            $contact->getName(),
            $contact->getEmail(),
            $contact->getPhoneNumber(),
            $contact->getId()
        ]);
    }
}
