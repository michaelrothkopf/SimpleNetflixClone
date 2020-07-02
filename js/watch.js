video = document.getElementById("video");
filename = window.location.search.substr(1);
video.src = "video/" + filename.substr(6) + ".MOV";