<?php

require_once "ContactManager.php";

class Command
{
    public function list(): void
    {
        $manager = new ContactManager();

        $contacts = $manager->findAll();

        foreach ($contacts as $contact) {
            echo $contact;
            echo PHP_EOL;
        }
    }
}