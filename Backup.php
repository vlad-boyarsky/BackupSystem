<?php

namespace Backup;

class Backup
{

    const VALUES_COUNT = 8;

    public function start(): void
    {
        $fileContent = "[" . $this->getDate() . "] \n" . file_get_contents(pathinfo(__FILE__, PATHINFO_FILENAME) . ".php");
        $file = fopen($_SERVER["DOCUMENT_ROOT"] . "/" . pathinfo(__FILE__, PATHINFO_FILENAME) . ".backup." . $this->generateSecureString() . ".txt", "wb");

        fwrite($file, $fileContent);
        fclose($file);
    }

    public function getDate(): string
    {
        return date("Y/m/d H:i:s");
    }

    public function generateSecureString(): string
    {
        $symbols = "!@#$%^&*()_+,=-0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $symbolsLength = strlen($symbols);
        $generateString = '';

        for ($i = 0; $i < self::VALUES_COUNT; $i++) {
            $generateString .= $symbols[rand(0, $symbolsLength - 1)];
        }

        return $generateString;
    }

}

$backup = new Backup();

$backup->start();