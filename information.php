<?php
    session_start();
    if(isset($_SESSION['Ime'])){
        echo "Welcome " . $_SESSION['Ime'];
        echo "<br>";
        echo "In tvoje geslo je " . $_SESSION['Geslo'];
        echo "<br>";
        echo "In tvoj email je " . $_SESSION['Email'];
    }else{
        echo "Prosim da se ponovno prijavite";
    }
?>