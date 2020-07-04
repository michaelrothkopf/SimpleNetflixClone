function wait(ms){
    var start = new Date().getTime();
    var end = start;
    while(end < start + ms) {
      end = new Date().getTime();
   }
 }

function login() {
    
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
           
            switch(this.responseText.substring(0, 3)) {
                case "900":
                    window.localStorage.setItem("LOGIN_KEY", this.responseText.substring(3));
                    window.localStorage.setItem("USERNAME", username);
                    window.location.href = "App.html";
                case "901":
                    document.getElementById("errorText").innerHTML = "Error! Incorrect username or password.";
                case "905":
                    document.getElementById("errorText").innerHTML = "Account doesn't exist.";
                case "912":
                    document.getElementById("errorText").innerHTML = "Error! Username already taken.";
                default:
                    console.log(this.responseText);
            }
        }
        
    }
    http.send("username="+username+"&password="+password+"&newaccount="+iscreatingnewaccount+"&mode="+1);
}