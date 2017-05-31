<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

$titel = '';
$beschrijving = '';
$afbeeldingURL = '';
$jaar = '';
$element_id = '';

$tijdlijn_id = $_GET['tid'];

$velden = '';
$boolError2 = '';
$sql3 = "SELECT `id` , `titel`, `aantal_elementen` FROM `tijdlijn` WHERE id = ".$tijdlijn_id."";
$last_id = $DB->_query($sql3);

if ($last_id->num_rows > 0) {
    while($row = $last_id->fetch_assoc()) {
        $last_id2 = $row["id"]; 
        $titelTijd = $row["titel"];
        $aantal_elementen3 = $row["aantal_elementen"];
    }
}

$sql4 = "SELECT * FROM `elementen` WHERE `tijdlijn_id` = ".$tijdlijn_id."";
$last_id3 = $DB->_query($sql4);

if (isset($_POST) && !empty($_POST)) {
 $boolError2 = false;
    for ($i = 0; $i < count($_POST['titel']); $i++){

    $boolError = false;

    if (!isset($_POST['titel'][$i]) || trim($_POST['titel'][$i]) == '') {
       $titel    = 'error';
       $boolError = true;
    }

    if (!isset($_POST['beschrijving'][$i]) || trim($_POST['beschrijving'][$i]) == '') {
        $beschrijving = 'error';
        $boolError = true;
    } 

    if (!isset($_POST['afbeeldingURL'][$i]) || trim($_POST['afbeeldingURL'][$i]) == '') {
    } 

    if (
        !isset($_POST['jaar'][$i])
        || trim($_POST['jaar'][$i]) == ''
        || !preg_match('/^\d+$/', $_POST['jaar'][$i])
    ) {
        $jaar  = 'error';
        $boolError = true;
    } 

    


    if ($boolError === false) {

        $sql = "UPDATE `elementen`
                SET
                `titel` = '" . $_POST['titel'][$i] . "',
                `beschrijving` = '" . $_POST['beschrijving'][$i] . "',
                `afbeelding_url` = '" . $_POST['afbeeldingURL'][$i] . "',
                `jaar` = '" . $_POST['jaar'][$i] . "'
                WHERE `id` = ".$_POST['element_id'][$i].";
        ";
       
        if ($DB->_query($sql)) {
         $boolError2 = false;
        // exit;
         $newURL = "succes2.php?tid=".$tijdlijn_id;
            header('Location: '.$newURL);

        } else {
            $boolError2 = true;
         

        }

    } else {
        $velden = "Niet alle velden zijn ingevuld!";
    } }} 
?> <?php
include ('header.php');
?>

        <p>Bewerk hier de gebeurtenissen voor de tijdlijn: <strong><?php echo $titelTijd ?></strong>.</p><?php
             if ($last_id3->num_rows > 0) {
                while($row2 = $last_id3->fetch_assoc()) {
                    $last_id4 = $row2["id"]; 
                    $titelP = $row2["titel"]; 
                    $beschrijvingP = $row2["beschrijving"]; 
                    $afbeeldingURLP= $row2["afbeelding_url"]; 
                    $jaarP = $row2["jaar"]; 

                if (isset($_GET['oops'])) { 
                ?> <span class="error">Oeps, iets ging fout.</span> <?php 
            
                } else {

                ?>
        <form accept-charset="utf-8" class="form-nieuws col s12" method="post">
            <div class="row">
                <div class="col s12">
                    <h5>Element #<?php echo $last_id4 ?></h5>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label for="naam">Titel van gebeurtenis:</label> <input class="<?= $titel ?> form-control" id="titel" name="titel[]" type="text" value="<?= isset($_POST['titel[]']) ? $_POST['titel[]'] : $titelP ?>">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label for="naam">Beschrijving van gebeurtenis:</label> 
                    <textarea class="materialize-textarea <?= $beschrijving ?> form-control" id="beschrijving2" name="beschrijving[]" rows="4"><?php echo $beschrijvingP ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label for="naam">URL voor afbeelding:</label> <input class="<?= $afbeeldingURL ?> form-control" id="afbeeldingURL2" name="afbeeldingURL[]" type="text" value="<?= isset($_POST['afbeeldingURL[]']) ? $_POST['afbeeldingURL[]'] : $afbeeldingURLP ?>">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label for="naam">Jaar van gebeurtenis:</label> <input class="<?= $jaar ?> form-control" id="jaar" name="jaar[]" type="number" value="<?= isset($_POST['jaar[]']) ? $_POST['jaar[]'] : $jaarP ?>">
                </div>
            </div><input id="element_id" name="element_id[]" type="hidden" value="<?= isset($_POST['element_id[]']) ? $_POST['element_id[]'] : $last_id4 ?>"><br>
            <br>
            <?php }

                                 } ?>
            <p><em style="font-size: 0.8em;">* = verplichte velden</em></p>
            <div class="gabutton">
                <button class=" btn waves-effect waves-light button" type="submit" value="Bewerk tijdlijn"><i class="material-icons right">send</i> Bewerk tijdlijn</button>
            </div><br>
            <div class="foutlabel">
                <em class="<?= ($velden) ? 'error' : '' ?>"><?= ($velden) ? $velden : '' ?>
                </em>
            </div>
        </form>
   <?php } include('footer.php') ?>