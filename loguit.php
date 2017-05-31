<div id="GoogleLoguit" style="display: none;">
      <a href="#" onclick="signOut();">Log uit</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      document.getElementById("Form1").style.display = "none";
    document.getElementById("GoogleLogin").style.display = "initial";
        document.getElementById("GoogleLoguit").style.display = "none";
    });


  }

      <?php //rick 
    /*
    session_start();
    unset($_SESSION["session_user"]);
    session_destroy();
    header("location:index.php"); */

    ?>
</script></div>
