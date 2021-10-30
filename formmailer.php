<?php

$firstname = $lastname = $street = $plz = $email = $telefon = $kategorie = $nachricht = "";
$errors = array(
    'firstname'=>'', 'lastname'=>'', 'street'=>'', 'plz'=>'',
    'email'=>'', 'telefon'=>'', 'kategorie'=>'', 'nachricht'=>''
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['submit'])){

        //check firstname
        if(empty($_POST["firstname"])){
            $errors["firstname"] = "<span class=`errors`>Bitte geben Sie Vorname an!</span>";
        }else{
            $firstname = $_POST["firstname"];
            if(!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ]+$/", $firstname)){
                $errors["firstname"] = "Vorname darf nur Buchstaben enthalten!";
            }
        } 

        //check lastname
        if(empty($_POST["lastname"])){
            $errors["lastname"] = "Bitte geben Sie Nachname an! <br />";
        }else{
            $lastname = $_POST["lastname"];
            if(!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ]+$/", $lastname)){
                $errors["lastname"] = "Nachname darf nur Buchstaben enthalten!";
            }
        } 
        //check street
        if(empty($_POST["street"])){
            $errors["street"] = "Bitte geben Sie Street an! <br />";
        }else{
            $street = $_POST["street"];
            if(!preg_match("/[A-Za-z 0-9_äÄöÖüÜßçÇ]+/", $street)){
                $errors["street"] = "Street darf nur Buchstaben und Zahlen enthalten!";
            }
        } 
        //check plz
        if(empty($_POST["plz"])){
            $errors["plz"] = "Bitte geben Sie Plz an! <br />";
        }else{
            $plz = $_POST["plz"];
            if(!preg_match("/[A-Za-z 0-9_äÄöÖüÜßçÇ]+/", $plz)){
                $errors["plz"] = "PLZ darf nur Buchstaben und Zahlen enthalten!";
            }
        } 
        //check email
        if(empty($_POST["email"])){
            $errors["email"] = "Bitte geben Sie Ihre email an! <br />";
        }else{
            $email = $_POST["email"];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL )){
                $errors["email"] = "Email muss dem Standart entsprechen!";
            }
        } 
        //check telefon
        if(empty($_POST["telefon"])){
            $errors["telefon"] = "Bitte geben Sie Telefon an! <br />";
        }else{
            $telefon = $_POST["telefon"];
            if(!preg_match("/^[ 0-9]+/", $telefon)){
                $errors["telefon"] = "Telefon darf nur Zahlen enthalten!";
            }
        } 
        //check kategorie
        if(empty($_POST["kategorie"])){
            $errors["kategorie"] = "Bitte eine Auswahl treffen! <br />";
        }else{
            $kategorie = $_POST["kategorie"];
            if(!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ]+$/", $kategorie)){
                $errors["kategorie"] = "Kategorie dürfen nur Buchstaben enthalten! <br />";
            }
        }

    }
}