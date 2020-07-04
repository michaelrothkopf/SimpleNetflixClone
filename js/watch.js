var http = new XMLHttpRequest();
key = localStorage.getItem("LOGIN_KEY");
username = localStorage.getItem("USERNAME");
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
        
        if (this.responseText.substring(0, 3) == "900") {
            console.log("0");
            video = document.getElementById("video");
            filename = window.location.search.substr(1);
            video.src = "video/" + filename.substr(6) + ".MOV";
        } else {
            console.log("1");
            document.getElementById("errorText").innerHTML = "Login error: it seems you aren't logged in :(";
        }
    }
}
http.send("username="+username+"&key="+key+"&mode=-1");