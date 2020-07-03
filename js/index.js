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
    
    _username = document.getElementById("username");
    _password = document.getElementById("password");

    username = _username.value;
    password = _password.value;
    
    iscreatingnewaccount = 0;
    checkbox = document.getElementById("createnewaccount");
    if (checkbox.checked == true) {
        iscreatingnewaccount = 1;
    }
    

    var http = new XMLHttpRequest();
    http.open("POST", 'php/login.php', true);
    http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function () {
        if (this.readyState == 4) {
            /*
            if (this.status == 200) {
                if (this.responseText == "true") {
                    //window.location.href = "App.html";
                }
            } else if (this.status == 403) {
                document.getElementById("errorText").innerHTML = "Error! Incorrect password.";
                wait(3000);
                document.getElementById("errorText").innerHTML = "";
            }
            */
           
            switch(this.status) {
                case 900:
                    window.location.href = "App.html";
                case 901:
                    document.getElementById("errorText").innerHTML = "Error! Incorrect username or password.";
                case 905:
                    document.getElementById("errorText").innerHTML = "Account doesn't exist.";
                case 912:
                    document.getElementById("errorText").innerHTML = "Error! Username already taken.";
            }
        }
        
    }
    http.send("username="+username+"&password="+password+"&newaccount="+toString(iscreatingnewaccount));
}