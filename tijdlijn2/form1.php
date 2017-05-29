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


include ('header.php'); ?>

<div class="container">
<div class="row">
    <form class="form-nieuws col s12" method="post" id="Form1" accept-charset="utf-8" style="display: initial;">
        <div class="row">
            <div class="input-field col s6">
                <label for="naam">Naam docent:</label> 
                <input id="docent" class="validate <?= $docent ?> form-control" type="text" name="docent" value="<?= isset($_POST['docent']) ? $_POST['docent'] : '' ?>">
            </div>
            <div class="input-field col s6">
                <label for="naam">Email adres:</label> 
                <input id="email" class="validate <?= $email ?> form-control" type="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
           </div>
        </div>
        
        <div class="row">
            <div class="input-field col s6">
                <select id="klas" class="validate <?= $klas ?> form-control" name="klas">
                    <option value="" disabled selected>Kies de klas</option>
                    <?php while ($row = mysqli_fetch_assoc($resultGetKlas)) { ?>
                        <option value="<?= isset($_POST['klas']) ? $_POST['klas'] : $row['id'] ?>">
                            <?php echo $row['naam'];?>
                        </option>
                    <?php } ?>
                </select>
                <label for="naam">Klas:</label>
            </div>
            
            <div class="input-field col s6">
                <select id="vak" class="validate <?= $vak ?> form-control" name="vak">
                    <option value="" disabled selected>Kies het vak</option>
                    <?php while ($row = mysqli_fetch_assoc($resultGetVak)) { ?>
                        <option value="<?= isset($_POST['vak']) ? $_POST['vak'] : $row['id'] ?>">
                            <?php echo $row['naam'];?>
                        </option>
                    <?php } ?>
                </select>
                <label for="naam">Vak:</label>
            </div>
        </div>
        
        <div class="row">
            <div class="input-field col s12">
                <label for="naam">Titel van de tijdlijn:</label>
                <input id="titel" class="validate <?= $titel ?> form-control" type="text" name="titel" value="<?= isset($_POST['titel']) ? $_POST['titel'] : '' ?>">
                <br>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <label for="naam">Beschrijving:</label>
                <textarea id="beschrijving" class="materialize-textarea <?= $beschrijving ?> form-control"   name="beschrijving" value="<?= isset($_POST['beschrijving']) ? $_POST['beschrijving'] : '' ?>">
                </textarea>
            </div>
        </div>
        
        <div class="row">
            <div class="input-field col s12">
                <label for="naam">URL voor afbeelding:</label>
                <input id="afbeeldingURL" class="validate <?= $afbeeldingURL ?> form-control" type="text"  name="afbeeldingURL" value="<?= isset($_POST['afbeeldingURL']) ? $_POST['afbeeldingURL'] : '' ?>">
            </div>  
        </div>

        <div class="row">
            <div class="input-field col s4">
                <label for="naam">Start van tijdlijn:</label>         
                <input id="jaar_start" class="validate datepicker <?= $jaar_start ?> form-control" type="date"  name="jaar_start" value="<?= isset($_POST['jaar_start']) ? $_POST['jaar_start'] : '' ?>">
            </div>
            <div class="input-field col s4">
                <label for="naam">Eind van tijdlijn:</label>
                <input id="jaar_eind" class="validate datepicker <?= $jaar_eind ?> form-control" type="date" name="jaar_eind" value="<?= isset($_POST['jaar_eind']) ? $_POST['jaar_eind'] : '' ?>">
            </div>
            <div class="input-field col s4">
                <label for="naam">Aantal gebeurtenissen op tijdlijn:</label>
                <input id="aantal_elementen" class="validate <?= $aantal_elementen ?> form-control" type="number"  name="aantal_elementen" value="<?= isset($_POST['aantal_elementen']) ? $_POST['aantal_elementen'] : '' ?>">
            </div>
        </div>

        <div class="row">
            <div class="gabutton col s12">
                <button type="submit" class=" btn waves-effect waves-light button" value="Ga naar volgende stap">
                    <i class="material-icons right">send</i> Volgende 
                </button>
            </div>
            </br>
            <div class="foutlabel">
                <em class="<?= ($velden) ? 'error' : '' ?>"><?= ($velden) ? $velden : '' ?>
                </em>
            </div>
        </div>
            
        <?php //} ?>
        
    </form>
</div>
</div>

<?php include ('footer.php'); ?>
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
