<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();


$tijdlijn_id = $_GET['tid']; 

$createURL = "tijdlijn.php?tid=".$tijdlijn_id;

include ('header.php');

?>
<aside>
       <p> De tijdlijn is met succes bewerkt! </p>
		<a href="<?php echo $createURL ?>" target="_blank">Klik hier om naar je tijdlijn te gaan.</a>

     </aside>  
      <?php include('footer.php') ?>