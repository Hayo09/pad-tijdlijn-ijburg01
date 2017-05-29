<?php

//session_start();
//if (!isset($_SESSION["session_user"])) {
 //       header("location:index.php");
 //   } else {
    # code...
//}
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

include ('header.php');

?>
<div class="row">

 <?php
$sqlGetTijdlijn = "SELECT * FROM `tijdlijn` ORDER BY id DESC";
 $result2 = $DB->_query($sqlGetTijdlijn);
        if ($result2->num_rows > 0) {
            while($row = $result2->fetch_assoc()) {
                $tid = $row["id"];
                $titel = $row["titel"];
                $beschrijving = $row["beschrijving"];
                $afbeelding = $row["afbeelding_url"];
                $url = $row["url_id"];
                $vak = $row["vak_id"];
                $klas = $row["klas_id"];
                $docent = $row["docent_id"];
                $jaarstart = $row["jaar_start"];
                $jaareind = $row["jaar_eind"]; 

        if ($afbeelding == NULL) { $afbeelding = "img/placeholder.png";} 
          else {}

$getURL = "SELECT url FROM url_tijdlijn WHERE id = ".$url." LIMIT 1";
$result3 = $DB->_query($getURL);
        if ($result3->num_rows > 0) {
            while($row3 = $result3->fetch_assoc()) {
                $url2 = $row3["url"]; 

$getDocent = "SELECT voornaam, email FROM docent WHERE id = ".$docent."";
$result4 = $DB->_query($getDocent);
        if ($result4->num_rows > 0) {
            while($row4 = $result4->fetch_assoc()) {
                $docent2 = $row4["voornaam"];
                $docent3 = $row4["email"]; 


$getVak = "SELECT * FROM vak WHERE id = ".$vak."";
$result5 = $DB->_query($getVak);
        if ($result5->num_rows > 0) {
            while($row5 = $result5->fetch_assoc()) {
                $vak2 = $row5["naam"]; 

$getKlas = "SELECT * FROM klas WHERE id = ".$klas."";
$result6 = $DB->_query($getKlas);
        if ($result6->num_rows > 0) {
            while($row6 = $result6->fetch_assoc()) {
                $klas2 = $row6["naam"]; 

?>

   <div class="col s4">
          <div class="card">
          

    <div class="card-image waves-effect waves-block waves-light">

      <img class="activator" src="<?php echo $afbeelding; ?>">
    </div>
    <div class="card-content">

      <span class="card-title activator grey-text text-darken-4"><?php echo $titel; ?><i class="material-icons right">more_vert</i></span>
      <p><a href="<?php echo $url2; ?>">Bekijk tijdlijn</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4"><?php echo $titel; ?><i class="material-icons right">close</i></span>
                      <p><?php echo $beschrijving; ?></p>
                  
                  <div class="chip light-green">
                    <i class="close2 material-icons">subject</i>
                    <?php echo $vak2; ?>
                  </div>
                  <div class="chip amber">
                    <i class="close2 material-icons">supervisor_account</i>
                    <?php echo $klas2; ?> 
                  </div>
                  <div class="chip red">
                    <i class="close2 material-icons">account_circle</i>
                    <?php echo $docent2; ?> 
                  </div>
                
                <p><a href="tijdlijn-edit.php?tid=<?php echo $tid; ?>">Bewerk tijdlijn</a></p> 
    </div>
                                        
     </div>
     </div>
                 

                        <?php
                    }}}}}}}}}
}
                ?>
                
            </div>
     </div>

<?php include('footer.php') ?>
