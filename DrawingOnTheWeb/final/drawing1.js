let width, height;
let canvas;
let context;
let pxScale = window.devicePixelRatio;

let body = document.querySelector("body");
const alphabet = [
    "a",
    "b",
    "c",
    "d",
    "e",
    "f",
    "g",
    "h",
    "i",
    "j",
    "k",
    "l",
    "m",
    "n",
    "o",
    "p",
    "q",
    "r",
    "s",
    "t",
    "u",
    "v",
    "w",
    "x",
    "y",
    "z",
];
let counter = 0;
function setup() {
    width = window.innerWidth;
    height = window.innerHeight;
    let fontSize = 20;
    for (let i = 0; i < width / fontSize; i++) {
        for (let j = 0; j < height / fontSize; j++) {
            let newdiv = document.createElement("div");
            newdiv.style.display = "inline-block";
            newdiv.style.padding = "0 5px 0 5px";
            newdiv.style.boxSizing = "border-box";
            newdiv.addEventListener("mouseover", change);
            newdiv.innerHTML = alphabet[Math.floor(Math.random() * alphabet.length)];
            body.appendChild(newdiv);
        }
    }
    // console.log(body.children)
}

function makeCanvas() {
    if (counter > 500) {
        console.log("kjfdal");
        body.innerHTML = `<canvas></canvas>`;
        canvas = document.querySelector("canvas");
        context = canvas.getContext("2d");
        // fixed canvas size
        width = window.innerWidth;
        height = window.innerHeight;

        // set the CSS display size
        canvas.style.width = width + "px";
        canvas.style.height = height + "px";

        // set the canvas pixel density
        canvas.width = width * pxScale;
        canvas.height = height * pxScale;

        // normalize the coordinate system
        context.scale(pxScale, pxScale);
        context.fillStyle = "black";
        context.font = "20px sans-serif";
        context.fillRect(0, 0, width, height);
        for (let i = 0; i < width; i += 15) {
            for (let j = 0; j < height; j += 15) {
                context.fillStyle = "white";
                let rand = Math.floor(Math.random() * 3);
                if (rand == 0) {
                    context.fillText("0", i, j);
                } else if (rand == 1) {
                    context.fillText("1", i, j);
                }
            }
        }
    } else {
        return;
    }
}
function change(e) {
    e.currentTarget.innerHTML =
        alphabet[Math.floor(Math.random() * alphabet.length)] + " ";
    counter++;
    makeCanvas();
}
window.addEventListener("load", function () {
    setup();
});
window.addEventListener("resize", function () {
    if (canvas) {
        width = window.innerWidth;
        height = window.innerHeight;

        // set the CSS display size
        canvas.style.width = width + "px";
        canvas.style.height = height + "px";

        // set the canvas pixel density
        canvas.width = width * pxScale;
        canvas.height = height * pxScale;

        // normalize the coordinate system
        context.scale(pxScale, pxScale);
    }
});
