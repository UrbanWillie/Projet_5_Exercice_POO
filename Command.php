<?php

require_once "ContactManager.php";

class Command
{
    private ContactManager $manager;
    
    public function __construct()
    {
        $this->manager = new ContactManager();

    }

    public function list(): void
    {

        $contacts = $this->manager->findAll();

        foreach ($contacts as $contact) {
            echo $contact;
            echo PHP_EOL;
        }
    }

    public function detail(int $id): void
    {
        $contact = $this->manager->findById($id);

        if ($contact === null) {
            echo "Aucun contact trouvé.\n";
            return;
        }
        echo $contact;
    }

    public function create(string $name, string $email, string $phoneNumber): void
    {
        $contact = new Contact();
        $contact->setName($name);
        $contact->setEmail($email);
        $contact->setPhoneNumber($phoneNumber);

        $this->manager->create($contact);

        echo "Contact créé avec succès.\n";
    }

    public function delete(int $id): void
    {
        $contact = $this->manager->findById($id);

        if ($contact === null) {
            echo "Aucun contact trouvé.\n";
            return;
        }

        $this->manager->delete($id);

        echo "Contact supprimé avec succès.\n";
    }

    public function help(): void
    {
        echo "Commandes disponibles :\n";
        echo "list                           : Affiche tous les contacts.\n";
        echo "detail <id>                    : Affiche un contact.\n";
        echo "create <nom>,<email>,<tel>     : Crée un contact.\n";
        echo "delete <id>                    : Supprime un contact.\n";
        echo "modify <id>,<nom>,<email>,<tel>: Modifie un contact.\n";
        echo "help                           : Affiche cette aide.\n";
    }

    public function modify(
        int $id,
        string $name,
        string $email,
        string $phoneNumber
    ): void {

        $contact = $this->manager->findById($id);

        if ($contact === null) {
            echo "Aucun contact trouvé.\n";
            return;
        }

        $contact->setName($name);
        $contact->setEmail($email);
        $contact->setPhoneNumber($phoneNumber);

        $this->manager->modify($contact);

        echo "Contact modifié avec succès.\n";
    }
}
