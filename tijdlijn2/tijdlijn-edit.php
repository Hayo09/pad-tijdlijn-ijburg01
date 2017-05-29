<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');
require('classes/recaptchalib.php');

$DB = Database::getInstance();

$docent = '';
$docent2 = '';
$email = '';
$klas = '';
$vak = '';

$titel = '';
$beschrijving = '';
$afbeeldingURL = '';
$jaar_start = '';
$jaar_eind = '';

$klasXX = '';
$vakXX = '';

$titelX = '';
$beschrijvingX = '';
$afbeeldingX = '';
$jaarstartX = '';
$jaareindX = '';


$velden = '';

$tijdlijn_id = $_GET['tid'];
$sqlTijdlijn = "SELECT * FROM `tijdlijn` WHERE id = ".$tijdlijn_id."";
$last_id = $DB->_query($sqlTijdlijn);

if ($last_id->num_rows > 0) {
    while($row = $last_id->fetch_assoc()) {
        $titelX = $row["titel"];
        $vakX = $row["vak_id"];
        $klasX = $row["klas_id"];
        $beschrijvingX = $row["beschrijving"];
        $afbeeldingX = $row["afbeelding_url"];
        $jaarstartX = $row["jaar_start"];
        $jaareindX = $row["jaar_eind"];
    }
} else {echo "SQL Error";}

$sqlKlasX = "SELECT naam FROM klas WHERE id = ".$klasX."";
$sqlVakX = "SELECT naam FROM vak WHERE id = ".$vakX."";
$resultGetVakX = $DB->_query($sqlVakX);
$resultGetKlasX = $DB->_query($sqlKlasX);

if ($resultGetVakX->num_rows > 0) {
    while($row = $resultGetVakX->fetch_assoc()) {
        $vakXX = $row["naam"];
    }
} else {echo "SQL Error";}

if ($resultGetKlasX->num_rows > 0) {
    while($row = $resultGetKlasX->fetch_assoc()) {
        $klasXX = $row["naam"];
    }
} else {echo "SQL Error";}


$sqlGetKlas = "SELECT * FROM `klas`;";
$resultGetKlas = $DB->_query($sqlGetKlas);

$sqlGetVak = "SELECT * FROM `vak`;";
$resultGetVak = $DB->_query($sqlGetVak);

if (isset($_POST) && !empty($_POST)) {

    $boolError = false;

    foreach ($_POST as $k => $v) {
        $_POST[$k] = trim($v);
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

    if (
        !isset($_POST['jaar_start'])
        || trim($_POST['jaar_start']) == ''
        || !preg_match('/^\d+$/', $_POST['jaar_start'])
    ) {
        $jaar_start  = 'error';
        $boolError = true;
    } 
    if (
        !isset($_POST['jaar_eind'])
        || trim($_POST['jaar_eind']) == ''
        || !preg_match('/^\d+$/', $_POST['jaar_eind'])
    ) {
        $jaar_eind  = 'error';
        $boolError = true;
    } 

    if ($boolError === false) {

        $sql = "UPDATE `tijdlijn`
                SET `titel` = '" . $_POST['titel'] . "',
                `beschrijving` = '" . $_POST['beschrijving'] . "',
                `afbeelding_url` = '" . $_POST['afbeeldingURL'] . "',
                `jaar_start` = '" . $_POST['jaar_start'] . "',
                `jaar_eind` = '" . $_POST['jaar_eind'] . "',
                `vak_id` = '" . $_POST['vak'] . "',
                `klas_id` = '" . $_POST['klas'] . "'
                WHERE id = ".$tijdlijn_id."
                ";

        if ($DB->_query($sql)) {

         $newURL = "succes2.php?tid=".$tijdlijn_id;
            header('Location: '.$newURL);
            exit;

        } else {

            header('Location: ?oops');
            exit;

        }

    } else {
        $velden = "Niet alle verplichte velden zijn ingevuld!";
    }

} 

include ('header.php'); ?>
<div class="row">
<?php

        if (isset($_GET['oops'])) { 
        ?>
            <span class="error">
                Oeps, iets ging fout.
            </span>

        <?php 
        } else {
        ?>
    

<form accept-charset="utf-8" class="form-nieuws col s12" id="Form1" method="post" name="Form1" >
        <div class="row">
            <div class="input-field col s6">
                <select class="validate <?= $klas ?> form-control" id="klas" name="klas">
                    <option selected value=""><?php echo $klasXX;?></option>
                    <?php while ($row = mysqli_fetch_assoc($resultGetKlas)) { ?>
                    <option value="<?= isset($_POST['klas']) ? $_POST['klas'] : $row['id'] ?>"><?php echo $row['naam'];?></option><?php } ?>
                </select> <label for="naam">Klas:</label>
            </div>
            <div class="input-field col s6">
                <select class="validate <?= $vak ?> form-control" id="vak" name="vak">
                    <option selected value=""><?php echo $vakXX;?></option>
                    <?php while ($row = mysqli_fetch_assoc($resultGetVak)) { ?>
                    <option value="<?= isset($_POST['vak']) ? $_POST['vak'] : $row['id'] ?>"><?php echo $row['naam'];?></option><?php } ?>
                </select> <label for="naam">Vak:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <label for="naam">Titel van de tijdlijn:</label> <input class="validate <?= $titel ?> form-control" id="titel" name="titel" type="text" value="<?= isset($_POST['titel']) ? $_POST['titel'] : $titelX ?>" placeholder="<?php echo $titelX ?>"><br>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <label for="naam">Beschrijving:</label> 
                <textarea class="materialize-textarea <?= $beschrijving ?> form-control" id="beschrijving" name="beschrijving" value="<?= isset($_POST['beschrijving']) ? $_POST['beschrijving'] : $beschrijvingX ?>"> <?php echo $beschrijvingX ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <label for="naam">URL voor afbeelding:</label> <input class="validate <?= $afbeeldingURL ?> form-control" id="afbeeldingURL" name="afbeeldingURL" type="text" value="<?= isset($_POST['afbeeldingURL']) ? $_POST['afbeeldingURL'] : $afbeeldingX ?>">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <label for="naam">Start van tijdlijn:</label> <input class="<?= $jaar_start ?> form-control" id="jaar_start" name="jaar_start" type="number" value="<?= isset($_POST['jaar_start']) ? $_POST['jaar_start'] : $jaarstartX ?>">
            </div>
            <div class="input-field col s6">
                <label for="naam">Eind van tijdlijn:</label> <input class="<?= $jaar_eind ?> form-control" id="jaar_eind" name="jaar_eind" type="number" value="<?= isset($_POST['jaar_eind']) ? $_POST['jaar_eind'] : $jaareindX ?>">
            </div>
        </div>
        <div class="row">
            <div class="gabutton col s12">
                <button class=" btn waves-effect waves-light button" type="submit" value="Ga naar volgende stap"><i class="material-icons right">send</i>Update</button>
            </div><br>
            <div class="foutlabel">
                <em class="<?= ($velden) ? 'error' : '' ?>"><?= ($velden) ? $velden : '' ?>
                </em>
            </div>
        </div>
    
        <?php } ?>
        
    </form>
</div>
 </br>
</br></aside>
 <?php include('footer.php'); ?> 

 <script>
  $(document).ready(function() {
    $('select').material_select();
  });

   $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100,
    format: 'yyyy-mm-dd' // Creates a dropdown of 15 years to control year
  });
 </script>
