<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

$titel = '';
$beschrijving = '';
$afbeeldingURL = '';
$jaar = '';

$velden = '';

if (isset($_POST) && !empty($_POST)) {

    $boolError = false;

    foreach ($_POST as $k => $v) {
        $_POST[$k] = trim($v);
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

    if (!isset($_POST['jaar']) || trim($_POST['jaar']) == '') {
        $jaar_start  = 'error';
        $boolError = true;
    } 


    if ($boolError === false) {
        $sql = "UPDATE `elementen`
                SET
                `titel` = '" . $_POST['titel'] . "',
                `beschrijving` = '" . $_POST['beschrijving'] . "',
                `afbeelding_url` = '" . $_POST['afbeeldingURL'] . "',
                `jaar` = '" . $_POST['jaar'] . "'
                WHERE `id` = ".$_POST['element_id'].";
        ";

       
        if ($DB->_query($sql)) {


           // echo "0 results";
            header('Location: ?succes');
            exit;

        } else {

            header('Location: ?oops');
            exit;

        }

    } else {
        $velden = "Ff alles invullen he";
    }

} 
            $sql3 = "SELECT `id` , `aantal_elementen` FROM `tijdlijn` ORDER BY id DESC LIMIT 0, 1";

        
            $last_id = $DB->_query($sql3);

            if ($last_id->num_rows > 0) {
                while($row = $last_id->fetch_assoc()) {
                    $last_id2 = $row["id"]; 
                    $aantal_elementen3 = $row["aantal_elementen"];}}
         
            $sql4 = "SELECT * FROM `elementen` WHERE `tijdlijn_id` = ".$last_id2."";
            
            $last_id3 = $DB->_query($sql4);
            if ($last_id3->num_rows > 0) {
                while($row2 = $last_id3->fetch_assoc()) {
                    $last_id4 = $row2["id"]; 
                    

?>

                
        <form class="form-nieuws" method="post">

            </br></br>
            <?php echo $last_id2; ?>
            <?php echo $last_id4; ?>
            <input id="titel" class="<?= $titel ?> form-control" type="text" placeholder="Titel tijdlijn" name="titel" value="<?= isset($_POST['titel']) ? $_POST['titel'] : '' ?>">
            <br>
            <textarea id="beschrijving" class="<?= $beschrijving ?> form-control" rows="3" placeholder="Beschrijving over tijdlijn" name="beschrijving" value="<?= isset($_POST['beschrijving']) ? $_POST['beschrijving'] : '' ?>"></textarea>
            <br>
            <input id="afbeeldingURL" class="<?= $afbeeldingURL ?> form-control" type="text" placeholder="URL voor afbeelding" name="afbeeldingURL" value="<?= isset($_POST['afbeeldingURL']) ? $_POST['afbeeldingURL'] : '' ?>">
            <br>            
            <input id="jaar" class="<?= $jaar ?> form-control" type="text" placeholder="Start jaar tijdlijn" name="jaar" value="<?= isset($_POST['jaar']) ? $_POST['jaar'] : '' ?>">
             <input id="jaar" class="<?= $element_id ?> form-control" type="text" placeholder="<?php $last_id4 ?>" name="jaar" value="<?php $last_id4 ?>">
            
            <div class="foutlabel">
                <em class="<?= ($velden) ? 'error' : '' ?>"><?= ($velden) ? $velden : '' ?>
                </em>
            </div>
            </br>    
             <?php }} ?>
            <div class="gabutton">
                <input type="submit" value="Creeer tijdlijn">
            </div>
            
              
        </form>
        