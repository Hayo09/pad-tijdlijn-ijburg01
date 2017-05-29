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

$velden = '';

$sqlGetKlas = "SELECT * FROM `klas`;";
$resultGetKlas = $DB->_query($sqlGetKlas);

$sqlGetVak = "SELECT * FROM `vak`;";
$resultGetVak = $DB->_query($sqlGetVak);

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

    if (
        !isset($_POST['aantal_elementen'])
        || trim($_POST['aantal_elementen']) == ''
        || !preg_match('/^\d+$/', $_POST['aantal_elementen'])
    ) {
        $aantal_elementen  = 'error';
        $boolError = true;
    } 

    if ($boolError === false) {

        $sqlDocent = "INSERT INTO `docent` 
                SET 
                `voornaam` = '".$_POST['docent']."',
                `email` = '".$_POST['email']."'
                ";

        $DB->_query($sqlDocent);

        $getDocent = "SELECT `id` FROM `docent` ORDER BY id DESC LIMIT 0, 1";

        $docentID = $DB->_query($getDocent);
        if ($docentID->num_rows > 0) {
            while($row40 = $docentID->fetch_assoc()) {
                $docent2 = $row40['id'];}}

        $sql = "INSERT INTO `tijdlijn`
                SET `titel` = '" . $_POST['titel'] . "',
                `beschrijving` = '" . $_POST['beschrijving'] . "',
                `afbeelding_url` = '" . $_POST['afbeeldingURL'] . "',
                `jaar_start` = '" . $_POST['jaar_start'] . "',
                `jaar_eind` = '" . $_POST['jaar_eind'] . "',
                `aantal_elementen` = '" . $_POST['aantal_elementen'] . "',

                `vak_id` = '" . $_POST['vak'] . "',
                `klas_id` = '" . $_POST['klas'] . "',
                
                `docent_id` = ".$docent2.",

                `createdate` = NOW()
                ";


        $sql3 = "SELECT `id` FROM `tijdlijn` ORDER BY id DESC LIMIT 0, 1";

        if ($DB->_query($sql)) {

            $last_id = $DB->_query($sql3);

            if ($last_id->num_rows > 0) {
                while($row = $last_id->fetch_assoc()) {
                    $last_id2 = $row["id"]; }}
          
            $aantal_elementen2 = $_POST['aantal_elementen'];
            for ($x = 1; $x <= $aantal_elementen2; $x++) {
            
                $sql2 = "INSERT INTO `elementen`
                        SET `tijdlijn_id` = ".$last_id2.",
                        `docent_id` = ".$_POST['vak']."
                        ";
                $DB->_query($sql2);
            }


           // echo "0 results";
            $newURL = "tijdlijn-maken.php";
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
            include 'login.php';
        ?>
        


<form accept-charset="utf-8" class="form-nieuws col s12" id="Form1" method="post" name="Form1" style="display: none;">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <label for="naam">Naam docent:</label> <input class="validate <?= $docent ?> form-control" id="docent" name="docent" placeholder="naam" type="text" value="<?= isset($_POST['docent']) ? $_POST['docent'] : '' ?>">
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                <label for="naam">Email adres:</label> <input placeholder="email" class="validate <?= $email ?> form-control" id="email" name="email" type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
            <i class="material-icons prefix">supervisor_account</i>
                <select class="validate <?= $klas ?> form-control" id="klas" name="klas">
                    <option disabled selected value="">Kies de klas</option>
                    <?php while ($row = mysqli_fetch_assoc($resultGetKlas)) { ?>
                    <option value="<?= isset($_POST['klas']) ? $_POST['klas'] : $row['id'] ?>"><?php echo $row['naam'];?></option><?php } ?>
                </select> <label for="naam">Klas:</label>
            </div>
            <div class="input-field col s6">
            <i class="material-icons prefix">subject</i>
                <select class="validate <?= $vak ?> form-control" id="vak" name="vak">
                    <option disabled selected value="">Kies het vak</option>
                    <?php while ($row = mysqli_fetch_assoc($resultGetVak)) { ?>
                    <option value="<?= isset($_POST['vak']) ? $_POST['vak'] : $row['id'] ?>"><?php echo $row['naam'];?></option><?php } ?>
                </select> <label for="naam">Vak:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <i class="tiny material-icons prefix">info_outline</i>
                <label for="naam">Titel van de tijdlijn:</label> <input class="validate <?= $titel ?> form-control" id="titel" name="titel" type="text" value="<?= isset($_POST['titel']) ? $_POST['titel'] : '' ?>">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <i class="tiny material-icons prefix">textsms</i>
                <label for="naam">Beschrijving:</label> 
                <textarea class="materialize-textarea <?= $beschrijving ?> form-control" id="beschrijving" name="beschrijving" value="<?= isset($_POST['beschrijving']) ? $_POST['beschrijving'] : '' ?>"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
<i class="tiny material-icons prefix">perm_media</i>
                <label for="naam">URL voor afbeelding:</label> <input class="validate <?= $afbeeldingURL ?> form-control" id="afbeeldingURL" name="afbeeldingURL" type="text" value="<?= isset($_POST['afbeeldingURL']) ? $_POST['afbeeldingURL'] : '' ?>">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s4">
            <i class="tiny material-icons prefix">today</i>
                <label for="naam">Start van tijdlijn:</label> <input class="<?= $jaar_start ?> form-control" id="jaar_start" name="jaar_start" type="number" value="<?= isset($_POST['jaar_start']) ? $_POST['jaar_start'] : '' ?>">
            </div>
            <div class="input-field col s4">
            <i class="tiny material-icons prefix">today</i>
                <label for="naam">Eind van tijdlijn:</label> <input class="<?= $jaar_eind ?> form-control" id="jaar_eind" name="jaar_eind" type="number" value="<?= isset($_POST['jaar_eind']) ? $_POST['jaar_eind'] : '' ?>">
            </div>
            <div class="input-field col s4">
            <i class="tiny material-icons prefix">dialpad</i>
                <label for="naam">Aantal gebeurtenissen:</label> <input class="<?= $aantal_elementen ?> form-control" id="aantal_elementen" name="aantal_elementen" type="number" value="<?= isset($_POST['aantal_elementen']) ? $_POST['aantal_elementen'] : '' ?>">
            </div>
        </div>
        <div class="row">
            <div class="gabutton col s12">
                <button class=" btn waves-effect waves-light button" type="submit" value="Ga naar volgende stap"><i class="material-icons right">send</i> Volgende</button>
            </div><br>
            <div class="foutlabel">
                <em class="<?= ($velden) ? 'error' : '' ?>"><?= ($velden) ? $velden : '' ?>
                </em>
            </div>
        </div>
    
        <?php } ?>
        
    </form>
</div>
 </br><?php include('loguit.php'); ?>
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
