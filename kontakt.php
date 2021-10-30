<?php include("./head.php"); ?>
<?php include("./header.php"); ?>
<?php include("./nav.php"); ?>
<?php include("./phpmailer.php"); ?>

<div id="alert-success"><?php echo $alertSuccess; ?></div>
<div id="alert-error"><?php echo $alertError; ?></div>

<div class="solid1">
    <h1 class="solid">KONTAKT FORMULAR</h1>
</div>

<div class="container">

    <article class="card nothelfer">
        <div class="text">

            <form method="post" action="" name="form" id="form">

                <label for="anrede">ANREDE</label>
                <select id="anrede" name="anrede">
                    <option value="FRAU">
                        FRAU</option>
                    <option value="HERR">
                        HERR</option>
                </select>

                <label for="firstname">VORNAME *</label>
                <?php echo $errors["firstname"]; ?>
                <input type="text" id="firstname" name="firstname" required
                    value="<?php htmlspecialchars($firstname) ?>" minlength="3" maxlength="20" placeholder="VORNAME">


                <label for="lastname">NACHNAME *</label>
                <?php echo $errors["lastname"]; ?>
                <input type="text" id="lastname" name="lastname" required value="<?php htmlspecialchars($lastname )?>"
                    minlength="3" maxlength="20" placeholder="NACHNAME">


                <label for="street">STRASSE / NR. *</label>
                <?php echo $errors["street"]; ?>
                <input type="text" id="street" name="street" required value="<?php htmlspecialchars($street) ?>"
                    minlength="5" maxlength="50" placeholder="STRASSE / NR.">


                <label for="plz">PLZ / ORT *</label>
                <?php echo $errors["plz"]; ?>
                <input type="text" id="plz" name="plz" required value="<?php htmlspecialchars($plz) ?>" minlength="5"
                    maxlength="40" placeholder="PLZ / ORT">

                </span>
                <label for="email">EMAIL @ *</label>
                <?php echo $errors["email"]; ?>
                <input type="email" id="email" name="email" required value="<?php htmlspecialchars($email) ?>"
                    minlength="5" maxlength="45" placeholder="IHRE EMAIL ADRESSE">


                <label for="telefon">TELEFON *</label>
                <?php echo $errors["telefon"]; ?>
                <input type="tel" id="telefon" name="telefon" required value="<?php  htmlspecialchars($telefon) ?>"
                    minlength="9" maxlength="20" placeholder="TELEFON NR.">


                <label for="kategorie">ICH INTERESSIERE MICH FÜR *</label>
                <?php echo $errors["kategorie"]; ?>
                <select id="kategorie" name="kategorie" required aria-required="true"
                    value="<?php  htmlspecialchars($kategorie) ?>">

                    <option value="" selected>BITTE EINE AUSWAHL TREFFEN!</option>
                    <option value="NOTHELFER"
                        <?php if (isset($_POST["kategorie"]) && $_POST["kategorie"] == "NOTHELFER") { print ("selected"); } ?>>
                        NOTHELFER</option>
                    <option value="VRT"
                        <?php if (isset($_POST["kategorie"]) && $_POST["kategorie"] == "VRT") { print ("selected"); } ?>>
                        VRT
                    </option>
                    <option value="VKU"
                        <?php if (isset($_POST["kategorie"]) && $_POST["kategorie"] == "VKU") { print ("selected"); } ?>>
                        VKU
                    </option>
                    <option value="AUTO KAT B"
                        <?php if (isset($_POST["kategorie"]) && $_POST["kategorie"] == "AUTO KAT B") { print ("selected"); } ?>>
                        AUTO KAT B</option>
                    <option value="ANHAENGER KAT BE"
                        <?php if (isset($_POST["kategorie"]) && $_POST["kategorie"] == "ANHAENGER KAT BE") { print ("selected"); } ?>>
                        ANHÄNGER KAT BE
                    </option>
                    <option value="KONTROLLFAHRT"
                        <?php if (isset($_POST["kategorie"]) && $_POST["kategorie"] == "KONTROLLFAHRT") { print ("selected"); } ?>>
                        KONTROLLFAHRT
                    </option>
                    <option value="LKW BUS"
                        <?php if (isset($_POST["kategorie"]) && $_POST["kategorie"] == "LKW BUS") { print ("selected"); } ?>>
                        LKW BUS</option>
                    <option value="CZV"
                        <?php if (isset($_POST["kategorie"]) && $_POST["kategorie"] == "CZV") { print ("selected"); } ?>>
                        CZV</option>
                </select>

                <label for="nachricht">NACHRICHT</label>
                <?php echo $errors["nachricht"]; ?>
                <textarea id="nachricht" name="nachricht" maxlength="500" placeholder="NACHRICHT"
                    value="<?php htmlspecialchars($nachricht) ?>"
                    style="height:125px"><?php  strip_tags(nl2br(htmlspecialchars($nachricht))) ? $nachricht : '' ?></textarea>

                <div class="captcha">
                    <div class="g-recaptcha" data-sitekey="6LcBLQQcAAAAAIF-36vrGX2gHz5FweUVgFwipSUN">
                    </div>
                </div>

                <a href="#"><button class="button2" type="submit" name="submit" value="SENDEN">SENDEN</button></a>

            </form>

        </div>
    </article>
</div>


<?php include("./footer.php"); ?>