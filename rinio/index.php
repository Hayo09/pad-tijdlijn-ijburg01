<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>TimelineJS Example</title>
    <meta charset="utf-8">
    <meta name="description" content="TimelineJS Embed">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- CSS-->
    <link rel="stylesheet" href="css/timeline.css?v1">
    <!--FONT-->
    <link rel="stylesheet" href="css/fonts/font.default.css?v1">
    <!-- Style-->
    <style>
      html, body {
      	height:100%;
      	width:100%;
      	padding: 0px;
      	margin: 0px;
      }
      .tl-timeline {
      	
      }
      
    </style>
 
  </head>
  <body>
    <div id="timeline"></div>
    <!-- JavaScript-->
    <script src="js/timeline.js"></script>
      <!-- 3 -->
        <script type="text/javascript">
          
          window.timeline = new TL.Timeline('timeline', './empdata.json');
        </script>
  </body>
</html>