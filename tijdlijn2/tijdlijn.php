<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

$tijdlijn_id = $_GET['tid'];

$url3 = 'element-edit.php?tid='.$tijdlijn_id;

$sqlGetTijdlijn = "SELECT * FROM tijdlijn WHERE id = ".$tijdlijn_id."";
 $result2 = $DB->_query($sqlGetTijdlijn);
        if ($result2->num_rows > 0) {
            while($row = $result2->fetch_assoc()) {
                $titel = $row["titel"];
                $beschrijving = $row["beschrijving"];
                $url = $row["url_id"];
                $vak = $row["vak_id"];
                $klas = $row["klas_id"];
                $afbeelding = $row["afbeelding_url"];
                $docent = $row["docent_id"];
                $jaarstart = $row["jaar_start"];
                $jaareind = $row["jaar_eind"]; 

        }
}

$getURL = "SELECT url FROM url_tijdlijn WHERE id = ".$url." LIMIT 1";
$result3 = $DB->_query($getURL);
        if ($result3->num_rows > 0) {
            while($row3 = $result3->fetch_assoc()) {
                $url2 = $row3["url"]; }}

$getDocent = "SELECT voornaam, email FROM docent WHERE id = ".$docent."";
$result4 = $DB->_query($getDocent);
        if ($result4->num_rows > 0) {
            while($row4 = $result4->fetch_assoc()) {
                $docent2 = $row4["voornaam"];
                $docent3 = $row4["email"]; }}


$getVak = "SELECT * FROM vak WHERE id = ".$vak."";
$result5 = $DB->_query($getVak);
        if ($result5->num_rows > 0) {
            while($row5 = $result5->fetch_assoc()) {
                $vak2 = $row5["naam"]; }}

$getKlas = "SELECT * FROM klas WHERE id = ".$klas."";
$result5 = $DB->_query($getKlas);
        if ($result5->num_rows > 0) {
            while($row5 = $result5->fetch_assoc()) {
                $klas2 = $row5["naam"]; }}

if (!isset($afbeelding) || trim($afbeelding) == '') {
    $tijdlijn_img  = '<p>Geen afbeelding</p>';
} else {
    $tijdlijn_img = '<div class="tijdlijn-afb"><img src="'.$afbeelding.'"></div>';
                        }


include ('header.php');
?>
 <div class="container">
                <?php echo $tijdlijn_img; ?>
                <h2><?php echo $titel; ?></h2>
                <p><?php echo $beschrijving; ?></p>
                <p>Gemaakt voor het vak: <?php echo $vak2; ?></p>
                <p>Gemaakt voor de klas: <?php echo $klas2; ?></p>
                <p>Gemaakt door: <?php echo $docent2; ?> (<a href="mailto:<?php echo $docent3; ?>"><?php echo $docent3; ?></a>)</p>
                <p>Deel de volgende url: <a href="<?php echo $url2; ?>"><?php echo $_SERVER['HTTP_HOST'].'/tijdlijn'.'/'. $url2; ?></a></p>
                <p><a href="<?php echo $url3; ?>">Bewerk elementen</a></p>

            <div class="timeline">
                <h2><?php echo $jaarstart; ?></h2>
                <?php
                $sql = "SELECT * FROM elementen WHERE `tijdlijn_id` = ".$tijdlijn_id."";
                $result = $DB->_query($sql);

                if ($result->num_rows > 0) {
                    while($row2 = $result->fetch_assoc()) {

                        if (!isset($row2["afbeelding_url"]) || trim($row2["afbeelding_url"]) == '') {
                            $element_img  = 'Geen afbeelding';
                        } else {
                            $element_img = '<div class="element-afb">
                            <img src="'.$row2["afbeelding_url"].'"></div>';
                        }

                        ?>

                        <ul class="timeline-items">
                            <li class="is-hidden timeline-item centered"> <!-- Normal block, positionned to the left -->
                                
								<h3><?php echo $row2["titel"]; ?></h3>
                                <hr>
                                <p><?php echo $row2["beschrijving"]; ?></p>
                                <hr>
								<p><?php echo $element_img ?></p>
                                <hr>
                                <time><?php echo $row2["jaar"]; ?></time>
                            </li>               
                        </ul>

                        <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
                <h2><?php echo $jaareind; ?></h2>
            </div>
        </div>



       <script src="js/jquery.js"></script>
        <script src="js/jquery.timelify.js"></script>
        <script>
            $('.timeline').timelify({
                animLeft: "fadeInLeft",
                animCenter: "fadeInUp",
                animRight: "fadeInRight",
                animSpeed: 600,
                offset: 150
            });
        </script>
