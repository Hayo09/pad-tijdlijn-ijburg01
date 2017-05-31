<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

$docent = '';
$email = '';
$klas = '';
$vak = '';

$titel = '';
$beschrijving = '';
$afbeeldingURL = '';
$jaar_start = '';
$jaar_eind = '';

$velden = '';

if (isset($_POST) && !empty($_POST)) {

    $boolError = false;

    foreach ($_POST as $k => $v) {
        $_POST[$k] = trim($v);
    }

    if (!isset($_POST['docent']) || trim($_POST['docent']) == '') {
        $docent  = 'error';
        $boolError = true;
    }

    if (
        !isset($_POST['email'])
        || trim($_POST['email']) == ''
        || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    ) {
        $email      = 'error';
        $boolError = true;
    }

    if (!isset($_POST['klas']) || trim($_POST['klas']) == '') {
        $klas    = 'error';
        $boolError = true;
    }

    if (!isset($_POST['vak']) || trim($_POST['vak']) == '') {
        $vak    = 'error';
        $boolError = true;
    }

    if (!isset($_POST['titel']) || trim($_POST['titel']) == '') {
        $titel    = 'error';
        $boolError = true;
    }

    if (!isset($_POST['beschrijving']) || trim($_POST['beschrijving']) == '') {
        $beschrijving = 'error';
        $boolError = true;
    } 

    if (!isset($_POST['afbeeldingURL']) || trim($_POST['afbeeldingURL']) == '') {
        //niet verplicht
    } 

    if (!isset($_POST['jaar_start']) || trim($_POST['jaar_start']) == '') {
        $jaar_start  = 'error';
        $boolError = true;
    } 

    if (!isset($_POST['jaar_eind']) || trim($_POST['jaar_eind']) == '') {
        $jaar_eind  = 'error';
        $boolError = true;
    } 

    if (
        !isset($_POST['aantal_elementen'])
        || trim($_POST['aantal_elementen']) == ''
        || !preg_match('/^\d+$/', $_POST['aantal_elementen'])
    ) {
        $aantal_elementen  = 'error';
        $boolError = true;
    } 

    if ($boolError === false) {

        $sql = "INSERT INTO `tijdlijn`
                SET
                `titel` = '" . $_POST['titel'] . "',
                `beschrijving` = '" . $_POST['beschrijving'] . "',
                `afbeelding_url` = '" . $_POST['afbeeldingURL'] . "',
                `jaar_start` = '" . $_POST['jaar_start'] . "',
                `jaar_eind` = '" . $_POST['jaar_eind'] . "',
                `aantal_elementen` = '" . $_POST['aantal_elementen'] . "',

                `url_id` = '" . $_POST['klas'] . "',
                `vak_id` = '" . $_POST['vak'] . "',
                `klas_id` = '" . $_POST['klas'] . "',
                `docent_id` = '" . $_POST['vak'] . "',

                `createdate` = NOW()
                ";

        $sql3 = "SELECT `id` FROM `tijdlijn` ORDER BY id DESC LIMIT 0, 1";
       
        if ($DB->_query($sql)) {

            $last_id = $DB->_query($sql3);

            if ($last_id->num_rows > 0) {
                while($row = $last_id->fetch_assoc()) {
                    $last_id2 = $row["id"]; }}
           // $last_id = var_dump($DB->mysqli->insert_id);
            $aantal_elementen2 = $_POST['aantal_elementen'];
            for ($x = 0; $x <= $aantal_elementen2; $x++) {
            
                $sql2 = "INSERT INTO `elementen`
                        SET `tijdlijn_id` = ".$last_id2.",
                        `docent_id` = ".$_POST['vak']."
                        ";
                $DB->_query($sql2);
            }


           // echo "0 results";
            //header('Location: ?succes');
 include 'tijdlijn.php'; 
            exit;

        } else {

            header('Location: ?oops');
            exit;

        }

    } else {
        $velden = "Ff alles invullen he";
    }

} 

        if (isset($_GET['oops'])) { 
        ?>
            <span class="error">
                Oeps, iets ging fout.
            </span>

        <?php 
        } else if (isset($_GET['succes'])) { 
        ?>
            <p class="error">
                Yes, het ging goed.
                      
            </p>

        <?php
        } else {
           
        ?> <p>Vul het formulier hier onder in en maak een tijdlijn!</p>

        <form class="form-nieuws" method="post">
            
            <input id="docent" class="<?= $docent ?> form-control" type="text" placeholder="Naam docent" name="docent" value="<?= isset($_POST['docent']) ? $_POST['docent'] : '' ?>">
            <br>
            <input id="email" class="<?= $email ?> form-control" type="email" placeholder="Email adres docent" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
            <br>
            <select id="klas" class="<?= $klas ?> form-control" name="klas">
                <option value="<?= isset($_POST['klas']) ? $_POST['klas'] : '0' ?>">
                    IS108
                </option>
                <option value="<?= isset($_POST['klas']) ? $_POST['klas'] : '1' ?>">
                    IS108 GOED
                </option>
            </select>
            <br>
            <select id="vak" class="<?= $vak ?> form-control" name="vak">
                <option value="<?= isset($_POST['vak']) ? $_POST['vak'] : '0' ?>">
                    Geschiedenis
                </option>
                <option value="<?= isset($_POST['vak']) ? $_POST['vak'] : '1' ?>">
                    Geschiedenis GOED
                </option>
            </select>
            </br></br>
            <input id="titel" class="<?= $titel ?> form-control" type="text" placeholder="Titel tijdlijn" name="titel" value="<?= isset($_POST['titel']) ? $_POST['titel'] : '' ?>">
            <br>
            <textarea id="beschrijving" class="<?= $beschrijving ?> form-control" rows="3" placeholder="Beschrijving over tijdlijn" name="beschrijving" value="<?= isset($_POST['beschrijving']) ? $_POST['beschrijving'] : '' ?>"></textarea>
            <br>
            <input id="afbeeldingURL" class="<?= $afbeeldingURL ?> form-control" type="text" placeholder="URL voor afbeelding" name="afbeeldingURL" value="<?= isset($_POST['afbeeldingURL']) ? $_POST['afbeeldingURL'] : '' ?>">
            <br>            
            <input id="jaar_start" class="<?= $jaar_start ?> form-control" type="text" placeholder="Start jaar tijdlijn" name="jaar_start" value="<?= isset($_POST['jaar_start']) ? $_POST['jaar_start'] : '' ?>">
            <br>
            <input id="jaar_eind" class="<?= $jaar_eind ?> form-control" type="text" placeholder="Eind jaar tijdlijn" name="jaar_eind" value="<?= isset($_POST['jaar_eind']) ? $_POST['jaar_eind'] : '' ?>">
            <br>
            <input id="aantal_elementen" class="<?= $aantal_elementen ?> form-control" type="number" placeholder="Aantal elementen in tijdlijn" name="aantal_elementen" value="<?= isset($_POST['aantal_elementen']) ? $_POST['aantal_elementen'] : '' ?>">
            </br></br>

            <div class="foutlabel">
                <em class="<?= ($velden) ? 'error' : '' ?>"><?= ($velden) ? $velden : '' ?>
                </em>
            </div>
            </br>    
            <div class="gabutton">
                <input type="submit" value="Creeer tijdlijn">
            </div>
            
            <?php } ?>
        
        </form>
