<?php

require_once "Command.php";

$command = new Command();

while (true) {

    $line = readline("Entrez votre commande : ");

    if ($line === "list") {

        $command->list();

    } else {

        echo "Commande inconnue\n";

    }
}