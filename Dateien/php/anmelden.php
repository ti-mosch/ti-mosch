<?php
    session_start();

    $dateipfad[0] = "../json/Konten.json";

    $benutzer = $_POST["benutzer"];
    $pw = $_POST["pw"];

    $datei = fopen($dateipfad[0], "r");

    while(!feof($datei))
    {
        $json = fgets($datei);
        $daten = json_decode($json);

        if($daten->Benutzername == $benutzer)
        {
            if(password_verify($pw, $daten->Passwort) == true)
            {
                $_SESSION["benutzer"] = $daten;
                header('Location: ../../index.html');
            }
            else
            {
                
            }
        }
    }
    fclose($datei);

    header('Location: ../../index.html');
    exit;
?>