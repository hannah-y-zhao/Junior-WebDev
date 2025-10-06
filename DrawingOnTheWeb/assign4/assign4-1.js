let gData;

function fetchJSONData() {
  //https://www.geeksforgeeks.org/read-json-file-using-javascript/
  fetch("./goodreads.json")
    .then((res) => {
      if (!res.ok) {
        throw new Error(`HTTP error! Status: ${res.status}`);
      }
      return res.json();
    })
    .then(
      (data) => (gData = data)
      //   console.log(data)
    )

    .catch((error) => console.error("Unable to fetch data:", error));
}
fetchJSONData();

let body = document.querySelector("body");
let scene = document.getElementById("scene");
let readBooks = [];
let posneg = [-1, 1];
let portraitLandscape;

function baseText() {
  // let randNum=Math.floor(Math.random()*gData.length)
  // currentBook=gData[randNum]
  for (let i = 0; i < gData.length; i++) {
    if (gData[i]["Exclusive Shelf"] != "to-read") {
      readBooks.push(gData[i]["Title"] + " by " + gData[i]["Author"]);
      let newDiv = document.createElement("div");
      newDiv.style.position = "absolute";
      newDiv.innerHTML = gData[i]["Title"] + " by " + gData[i]["Author"];
      newDiv.classList.add("titles");
      scene.prepend(newDiv);
    }
  }
  console.log(readBooks);
}

function displayHeight() {
  scene.style.height = window.innerHeight + "px";
  if (window.innerHeight > window.innerWidth) {
    portraitLandscape = 5;
  } else {
    portraitLandscape = 15;
  }
}
let pastScroll = 0;
function elementTransform() {
  let pageDimensions = body.getBoundingClientRect();
  let scrollPercentage =
    Math.abs(pageDimensions.top) / (pageDimensions.height - window.innerHeight);
  let currentScroll = Math.floor(scrollPercentage * 100);
  if (readBooks.length > 0 && Math.abs(currentScroll - pastScroll) >= 3) {
    for (let i = 0; i < scene.children.length-1; i++) {
      let randX =
        Math.floor(Math.random() * currentScroll * (Math.random() * 15)) *
        posneg[Math.floor(Math.random() * posneg.length)];
      let randY =
        Math.floor(Math.random() * currentScroll * (Math.random() * 15)) *
        posneg[Math.floor(Math.random() * posneg.length)];
      scene.children[
        i
      ].style.transform = `translateX(${randX}px) translateY(${randY}px)`;
    }
    pastScroll = currentScroll;
  }
  console.log(currentScroll);
  //   plane.style.transform = `rotateX(${rotation}deg) rotateY(${rotation}deg)`;
}

window.addEventListener("load", displayHeight);
window.addEventListener("scroll", elementTransform);
window.addEventListener("resize", function () {
  displayHeight();
  elementTransform();
});

setTimeout(baseText, 100);
