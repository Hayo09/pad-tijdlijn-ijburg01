<?php


session_start();
if (!isset($_SESSION["session_user"])) {
        header("location:index.php");
    } else {

        
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

$titel = '';
$beschrijving = '';
$afbeeldingURL = '';
$jaar = '';
$element_id = '';

$velden = '';
$boolError2 = '';
$sql3 = "SELECT `id` , `titel`, `aantal_elementen` FROM `tijdlijn` ORDER BY id DESC LIMIT 0, 1";
$last_id = $DB->_query($sql3);

if ($last_id->num_rows > 0) {
    while($row = $last_id->fetch_assoc()) {
        $last_id2 = $row["id"]; 
        $titelTijd = $row["titel"];
        $aantal_elementen3 = $row["aantal_elementen"];
    }
}

$sql4 = "SELECT * FROM `elementen` WHERE `tijdlijn_id` = ".$last_id2."";

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
         $newURL = "succes.php";
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
<aside>
<p> Vul hier de gebeurtenissen voor de tijdlijn: <strong><?php echo $titelTijd ?></strong> in.</p> <?php
     if ($last_id3->num_rows > 0) {
        while($row2 = $last_id3->fetch_assoc()) {
            $last_id4 = $row2["id"]; 

        if (isset($_GET['oops'])) { 
        ?>
            <span class="error">
                Oeps, iets ging fout.
            </span>
    
        <?php 
    
        } else {

        ?>

        <form class="form-nieuws" method="post" accept-charset="utf-8">
            <fieldset class="form-group">
                <label for="naam">Titel van gebeurtenis:</label> *
            <input id="titel" class="<?= $titel ?> form-control" type="text" name="titel[]" value="<?= isset($_POST['titel[]']) ? $_POST['titel[]'] : '' ?>">
            </fieldset>
<fieldset class="form-group">
                <label for="naam">Beschrijving van gebeurtenis:</label> * </br>
            <textarea id="beschrijving2" class="<?= $beschrijving ?> form-control" rows="3" name="beschrijving[]" value="<?= isset($_POST['beschrijving[]']) ? $_POST['beschrijving[]'] : '' ?>">
           </textarea></fieldset>
           <fieldset class="form-group">
                <label for="naam">URL voor afbeelding:</label>
            <input id="afbeeldingURL2" class="<?= $afbeeldingURL ?> form-control" type="text" name="afbeeldingURL[]" value="<?= isset($_POST['afbeeldingURL[]']) ? $_POST['afbeeldingURL[]'] : '' ?>">
            </fieldset>
            <fieldset class="form-group">
                <label for="naam">Jaar van gebeurtenis:</label> *  
            <input id="jaar" class="<?= $jaar ?> form-control" type="number" name="jaar[]" value="<?= isset($_POST['jaar[]']) ? $_POST['jaar[]'] : '' ?>">
            </fieldset>
            <input id="element_id" type="hidden" name="element_id[]" value="<?= isset($_POST['element_id[]']) ? $_POST['element_id[]'] : $last_id4 ?>">
            
            </br>     </br>    

                     <?php }

                     } ?>   <p><em style="font-size: 0.8em;">* = verplichte velden</em></p><div class="gabutton">
                <input type="submit" class="button" value="Creeër tijdlijn">
            </div>
            </br>
            <div class="foutlabel">
                <em class="<?= ($velden) ? 'error' : '' ?>"><?= ($velden) ? $velden : '' ?>
                </em>
            </div>
            
     
        </form> </aside>
      <?php } include('footer.php') ?>