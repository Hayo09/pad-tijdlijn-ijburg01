function onSignIn(googleUser) {
    console.log("Succes");
    document.getElementById("Form1").style.display = "initial";
    document.getElementById("GoogleLogin").style.display = "none";
    document.getElementById("GoogleLoguit").style.display = "initial";
    var profile = googleUser.getBasicProfile();

    //var naam = profile.getName();
    //var email = profile.getEmail();
    
    document.getElementById('docent').value = profile.getName();
    document.getElementById('email').value = profile.getEmail();

    var id_token = googleUser.getAuthResponse().id_token;
    console.log("ID Token: " + id_token);
}