<?php
    class Benutzer
    {
        public string $Benutzername;
        public string $Passwort;

        public function __construct($Benutzername, $Passwort)
        {
            $this->Benutzername = $Benutzername;
            $this->Passwort = $Passwort;
        }
    }
?>

<?php
    $dateipfad[0] = "../json/Konten.json";
    $dateipfad[1] = "../txt/Namensliste.txt";

    $benutzer = $_POST["benutzer"];
    $pw = $_POST["pw"];

    $datei = fopen($dateipfad[1], "r");
    $vorhanden = false;

    while(!feof($datei))
    {
        $daten = fgets($datei);
        if($daten == $benutzer . PHP_EOL)
        {
            $vorhanden = true;
        }
    }
    fclose($datei);

    if ($vorhanden == false)
    {
        //PW hashen
        $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

        //Konstruktor aufrufen
        $Neu_Benutzer = new Benutzer($benutzer, $hashed_pw);

        //Objekt zu json
        $daten =  json_encode($Neu_Benutzer) . PHP_EOL;

        //Namensliste
        $daten2 = $benutzer . PHP_EOL;

        file_put_contents($dateipfad[0], $daten, FILE_APPEND);
        file_put_contents($dateipfad[1], $daten2, FILE_APPEND);
    }

    header('Location: ../../index.html');
    exit;
?>