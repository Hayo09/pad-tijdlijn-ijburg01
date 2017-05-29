<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

$titel = '';
$element_id = '';
$sql3 = "SELECT `id` , `aantal_elementen` FROM `tijdlijn` ORDER BY id DESC LIMIT 0, 1";
$last_id = $DB->_query($sql3);

if ($last_id->num_rows > 0) {
    while($row = $last_id->fetch_assoc()) {
        $last_id2 = $row["id"]; 
        $aantal_elementen3 = $row["aantal_elementen"];
    }
}

$sql4 = "SELECT * FROM `elementen` WHERE `tijdlijn_id` = ".$last_id2."";
       
$last_id3 = $DB->_query($sql4);



if (isset($_POST) && !empty($_POST)) {

        for ($i = 0; $i < count($_POST['titel']); $i++){
            echo $_POST['titel'][$i];
            echo $_POST['element_id'][$i];

             $sql = "UPDATE `elementen`
                SET
                `titel` = '" . $_POST['titel'][$i] . "'
                WHERE `id` = ".$_POST['element_id'][$i]."
        "; 

            $DB->_query($sql); 
         }
    
}
    if ($last_id3->num_rows > 0) {
       while($row2 = $last_id3->fetch_assoc()) {
           $last_id4 = $row2["id"]; 
?>
       
        <form class="form-nieuws" method="post">
            <?php //echo $last_id4 ?>
            <input id="titel2" class="<?= $titel ?> form-control" type="text" placeholder="Titel tijdlijn" name="titel[]" value="<?= isset($_POST['titel']) ? $_POST['titel'] : '' ?>">
             <input id="element_id"  class="<?= $element_id ?> form-control" type="text" " name="element_id[]" value="<?= isset($_POST['element_id'])?$last_id4:'' ?>">   
            
            
            
           

         
        <?php } } ?> <input type="submit" value="Creeer tijdlijn"></form>
      