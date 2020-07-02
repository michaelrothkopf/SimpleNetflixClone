var video_showcase = document.getElementById("video_showcase");
videos = {
    1:["img/large.png","White Screen"],
    2:["img/large.png","White Screen 2"],
    3:["img/large.png","White Screen: Maybe Something Interesting?"]
}
blocks = [];

for (const [key, value] of Object.entries(videos)) {
    // To avoid overwriting previous elements, container is the container element, 
    // img is the image, and title is the title text.
    // There are 2 ways of doing this, and I opted for always showing the title. However, you can
    // also make it so that the title only shows up on hover by using an img as the main element.
    var container = document.createElement("div");
    container.id = key;
    container.className = "showcase";
    var img = document.createElement("img");
    img.src = value[0];
    container.appendChild(img);
    var title = document.createElement("h3");
    title.innerText = value[1];
    container.appendChild(title);
    container.title = value[1];
    container.addEventListener("click", function() {
        window.location.href = "Watch.html?video=" + key;
    });
    video_showcase.appendChild(container);
}