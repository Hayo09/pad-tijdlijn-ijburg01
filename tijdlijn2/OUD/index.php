<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');
require('classes/recaptchalib.php');

$DB = Database::getInstance();


?>

<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <meta name="google-signin-client_id" content="574675912556-cu7gce09im23lanaf05nn1hpk4euib9m.apps.googleusercontent.com">
    <meta http-equiv="content-type" content="application/xhtml-xml; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta http-equiv="content-language" content="NL" />
    <meta name="language" content="NL" />
    <meta name="robots" content="index, follow">
    <title>Tijdlijn Ijburg College - PAD IJBURG01</title>
    <meta name="title" content="Tijdlijn Ijburg College - PAD IJBURG01" />
    <script src="js/signin.js"></script>
</head>

<body>
    <header>
        <nav>
            <li>
                <a href="#">
                   Alle tijdlijnen
                </a>
            </li>
            <li>
                <a href="#">
                    Maak een tijdlijn
                </a>
            </li>
        </nav>
    </header>

    <aside style="margin: 0 auto; width: 50%;">
        <h1>Maak een tijdlijn!</h1>
       

       <?php   
      
        include 'form1.php'; ?>           

    </aside>
            

    <footer> 
        <p>Copyright © 2017 LTKort.nl.</p>
    </footer>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
</body>
</html> 
