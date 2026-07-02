<?php

require_once "Command.php";

$command = new Command();

while (true) {

    $line = readline("Entrez votre commande : ");

    if ($line === "help") {

        $command->help();

    } elseif ($line === "list") {

        $command->list();

    } elseif (preg_match('/^detail\s+(\d+)$/', $line, $matches)) {

        $command->detail((int)$matches[1]);

    } elseif (preg_match('/^create\s+([^,]+),([^,]+),([^,]+)$/', $line, $matches)) {

        $command->create(
            trim($matches[1]),
            trim($matches[2]),
            trim($matches[3])
        );

    } elseif (preg_match('/^modify\s+(\d+),([^,]+),([^,]+),([^,]+)$/', $line, $matches)) {

            $command->modify(
                (int)$matches[1],
                trim($matches[2]),
                trim($matches[3]),
                trim($matches[4])
            );

    } elseif (preg_match('/^delete\s+(\d+)$/', $line, $matches)) {

        $command->delete((int)$matches[1]);

    } else {

        echo "Commande inconnue\n";

    }
}
