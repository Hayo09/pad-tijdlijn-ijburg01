<?php
include 'db.php';
include ('header.php');
?>
    <div id="timeline"></div>
    <!-- JavaScript-->
    <script src="js/timeline.js"></script>
      <!-- 3 -->
        <script type="text/javascript">
          
          window.timeline = new TL.Timeline('timeline', './empdata.json');
        </script>
<?php
include ('footer.php');
?>
