function wait(ms){
    var start = new Date().getTime();
    var end = start;
    while(end < start + ms) {
      end = new Date().getTime();
   }
 }

function login() {
    /*
    For the purposes of the front-end only simple clone that I am creating, I have decided to opt for 
    a simple redirect. Below is the code to query the server to prove I know how.
    */
    /*
    _username = document.getElementById("username");
    _password = document.getElementById("password");

    username = _username.value;
    password = _password.value;

    var http = new XMLHttpRequest();
    http.open("POST", 'php/login.php', true);
    http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "true") {
                window.location.href = "App.html";
            }
        }
    }
    http.send("username="+username+"&password="+password);
    */
   window.location.href = "App.html";
}