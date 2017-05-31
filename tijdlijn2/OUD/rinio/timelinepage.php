<?php
include 'classes/config.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Timelify | Simple Timeline plugin</title>
        <link href="http://fonts.googleapis.com/css?family=Kristi|Alegreya+Sans:300,800" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/timelify.css">
    </head>
    <body>

        <div class="container">
            <div class="timeline">
                <h2>2013</h2>
                <?php
                $sql = "SELECT * FROM elementen";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <ul class="timeline-items">
                            <li class="is-hidden timeline-item centered"> <!-- Normal block, positionned to the left -->
                                
								<h3><?php echo $row["titel"]; ?></h3>
                                <hr>
                                <p><?php echo $row["beschrijving"]; ?></p>
                                <hr>
								<p><?php echo $row["afbeeldingURL"]; ?></p>
                                <hr>
                                <time><?php echo $row["jaar"]; ?></time>
                            </li>               
                        </ul>

                        <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
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

    </body>
</html>
