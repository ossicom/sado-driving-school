<!--unten ist die porsche hintergrund bild-->
<div class="home-hintergrund"></div>
<div class="solid1">
    <h1 class="">IHRE FAHRSCHULE IN ST.GALLEN, WIL, APPENZELL UND BODENSEE </h1>
</div>

<?php 
include("./websitecounter/counter.php");
?>

<div class="solid1">
    <h3 class="solid" id="aktuelleinfos">AKTUELLE INFOS</h3>
</div>
<!------------------------------- INFOS DIV ----------------------------------->
<!------------------------------- INFOS DIV ----------------------------------->

<?php
 //ANZEIGEN db from sql
 require_once ("db_verbinden.php"); 

 if ($stmt = $mysqli->prepare('SELECT id, titel, text FROM begriffe')) {
    $stmt->execute();
    $stmt->bind_result($id, $titel, $text);
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
       
        while ($stmt->fetch()) {
            $titel = htmlspecialchars($titel);
            $text = htmlspecialchars($text);
            $id = (int)$id;
            
            echo "<div class='solid1'>".
                        "<div class='solid'>".
                                // "<h3 id='aktuelleinfos'>AKTUELLE INFOS!</h3> ".
                                 "<p> $titel </p>".
                                 "<p class='infotext'>  $text </p>".
                        "</div>".
                "</div>";
                 
?>
<?php
        }
        $stmt->close();
        ?>
<?php
    }
}
$mysqli->close();

?>
<!-------------------------------ENDE INFOS DIV ---------------------------------->
<!-------------------------------ENDE INFOS DIV ----------------------------------->

<main class="cards">
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="nothelfer.php">
            <img src="./images/erstehilfe.webp" alt="erstehilfe koffer" /></a>
        <div class="text">
            <h3>NOTHELFERKURS</h3><br>
            <h4>
                • Erster Schritt<br><br>
                • Erste Hilfe<br><br>
                • Obligatorisch<br><br>
                • Dauer 10 Stunden<br><br>
                • Gültigkeit: 6 Jahre<br><br>
                • Im Notfall<br><br>
                • Wissen was tun<br><br>
                • Leben retten<br><br>
            </h4>
        </div>
        <a href="nothelfer.php"><button class="button2">DETAILS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="vrt.php">
            <img src="./images/vrt.webp" alt="verkehrskunde tafeln" /></a>
        <div class="text">
            <h3>THEORIE</h3><br>
            <h4>
                • Vorbereitung zur Theorieprüfung<br><br>
                • VRT Auto, Kat. B<br><br>
                • Zusatztheorie LKW, BUS, Kat. C / D<br><br>
                • CZV Grundausbildung<br><br>
                • Einzelunterricht möglich<br><br>
                • Detaillierter Unterricht<br><br>
                • Lernen und Verstehen!<br><br>
                • Prüfungsfragen üben<br><br>
            </h4>
        </div>
        <a href="vrt.php"><button class="button2">DETAILS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="verkehrskunde.php">
            <img src="./images/VKU.webp" alt="verkehrskunde tafeln" /></a>
        <div class="text">
            <h3>VKU VERKEHRSKUNDE</h3><br>
            <h4>
                • Verkehrssinnbildung<br><br>
                • Verhalten im Verkehr<br><br>
                • Gefahrensituationen<br><br>
                • VKU für Auto und Motorrad<br><br>
                • Obligatorisch<br><br>
                • Dauer 8 Stunden<br><br>
                • Gültigkeit: Unbegrenzt<br><br>
                • Tipps und Tricks für die Praxis<br><br>
            </h4>
        </div>
        <a href="verkehrskunde.php"><button class="button2">DETAILS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="fahrstunden.php">
            <img data-src="./images/fahrstunden.webp" class="lazyload" alt="lernfahrer" /></a>
        <div class="text">
            <h3>AUTO FAHRSTUNDEN</h3><br>
            <h4>
                • Lernen fürs Leben<br><br>
                • Optimales Fahrzeug Golf 7<br><br>
                • Fahrkompetenz gewinnen<br><br>
                • Vorbereitung für die praktische Prüfung<br><br>
                • Kontrollfahrten mit ehemaligen Experten<br><br>
                • Taxi BPT - 121<br><br>
                • Qualität ist bei uns Garantiert<br><br>
                • Probelektionen möglich<br><br>
            </h4>
        </div>
        <a href="fahrstunden.php"><button class="button2">DETAILS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="anhaenger.php">
            <img data-src="./images/anhaenger.webp" class="lazyload" alt="auto anhänger" /></a>
        <div class="text">
            <h3>ANHÄNGER KAT. BE / CE</h3><br>
            <h4>
                • Anhänger – Kat. BE bis 3.5t<br><br>
                • LKW Anhänger – Kat. CE<br><br>
                • Wissen erweitern<br><br>
                • Manövrieren lernen<br><br>
                • Didaktische Methoden lernen<br><br>
                • Lernen fürs Leben<br><br>
                • Vorbereitung für die praktische Prüfung<br><br>
                • Tipps & Tricks<br><br>
            </h4>
        </div>
        <a href="anhaenger.php"><button class="button2">DETAILS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="kontrollfahrt.php">
            <img data-src="./images/kontrollfahrt.webp" class="lazyload" alt="auto auf strasse" /></a>
        <div class="text">
            <h3>KONTROLLFAHRT</h3><br>
            <h4>
                • Ausländische Führerausweise…<br><br>
                • Auffrischungsfahrt für jedes Alter<br><br>
                • Vorbereitung für Prüfung / Kontrollfahrt<br><br>
                • Wissen erweitern<br><br>
                • Sicherheit gewinnen!<br><br>
                • Manöver festigen<br><br>
                • Regeln und Vorschriften auffrischen<br><br>
                • Tipps und Tricks<br><br>
            </h4>
        </div>
        <a href="kontrollfahrt.php"><button class="button2">DETAILS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="lkw.php">
            <img data-src="./images/iveco.webp" class="lazyload" alt="lastwagen" /></a>
        <div class="text">
            <h3>LKW</h3>
            <br>
            <h4>
                • Gehören Sie zu den Grössten<br><br>
                • Lastwagen fahren Lernen<br><br>
                • IVECO, Automat<br><br>
                • Eine Ausbildung mit Zukunft<br><br>
                • Qualität und Sicherheit ist bei uns alles<br><br>
                • Erfahrene Fahrlehrer im Einsatz<br><br>
                • Kontrollfahrten mit ehemaligen Experten<br><br>
                • Tipps & Tricks nicht nur für die Prüfung<br><br>
            </h4>
        </div>
        <a href="lkw.php"><button class="button2">DETAILS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="car-bus.php">
            <img data-src="./images/car-mercedes.webp" class="lazyload" alt="lastwagen" /></a>
        <div class="text">
            <h3>BUS / CAR</h3>
            <br>
            <h4>
                • Wollen Sie in der Königsklasse einsteigen?<br><br>
                • Personentransport ist mehr als ein Beruf<br><br>
                • Lernen Sie die Welt kennen, werden Sie Carfahrer<br><br>
                • Erfahrene Fahrlehrer im Einsatz<br><br>
                • Kontrollfahrten mit ehemaligen Experten<br><br>
                • Qualität und Sicherheit ist bei uns alles<br><br>
                • Tipps & Tricks nicht nur für die Prüfung<br><br>
            </h4>
        </div>
        <a href="car-bus.php"><button class="button2">DETAILS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="czv.php"> <img data-src="./images/czv.webp" class="lazyload" alt="czv kurs" /></a>
        <div class="text">
            <h3>CZV</h3>
            <br>
            <h4>
                • Chauffeurzulassungsverordnung<br><br>
                • Grundausbildung Gütertransport<br><br>
                • Grundausbildung Personentransport<br><br>
                • Für die Kat. C/C1 und D/D1<br><br>
                • Weiterbildungskurse<br><br>
                • Erfahrene Referenten<br><br>
                • Prüfungsvorbereitung<br><br>
                • Praktische Aufgaben direkt am Fahrzeug<br><br>
            </h4>
        </div>
        <a href="czv.php"><button class="button2">DETAILS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="preise.php">
            <img data-src="./images/preise.webp" class="lazyload" alt="preiliste" /></a>
        <div class="text">
            <h3>UNSERE PREISE</h3>
            <br>
            <h4>
                • Garantiert, faire Preise!<br><br>
                • Für Theorieunterricht!<br><br>
                • Für Fahrunterricht!<br><br>
            </h4>
        </div>
        <a href="preise.php" class="btn-bot"><button class="button2">PREISE</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="ueberuns.php">
            <img data-src="./images/ueberunsfoto.webp" class="lazyload" alt="ueberuns" />
        </a>
        <div class="text">
            <h3>ÜBER UNS</h3>
            <br>
            <h4>
                • Sicher<br><br>
                • Kompetent<br><br>
                • Qualitativ<br><br>
            </h4>
        </div>
        <a href="ueberuns.php"><button class="button2">ÜBER UNS</button></a>
    </article>
    <!------------------------------------------------------------------------->
    <article class="card">
        <a href="kontakt.php">
            <img data-src="./images/kontakt.webp" class="lazyload" alt="kontakt" /></a>
        <div class="text kontaktflex kontakttel">
            <h3> INFORMATIONEN <br><br></h3>
            <a href="tel:+41794887700">
                <h3><i class="fas fa-phone-square-alt kontakttel"> 079 488 77 00</i> </h3>
            </a><br>
            <a href="mailto:info@sado.ch">
                <h3><i class="far fa-envelope kontakttel"> info@sado.ch</i></h3>
            </a>
        </div>
        <a href="kontakt.php"><button class="button2">KONTAKT</button></a>
    </article>
</main>
</main>