const video = document.querySelector("video");
//webcam
const mediaConstraints = {
    audio: false,
    video: true,
};
function webcamAccess(stream) {
    window.stream = stream;
    video.srcObject = stream;
}
function webcamError(error) {
    console.log(error.name, error.message);
    // video.src='escalator.mp4'
}

const vid = document.querySelector("video");
const canvas = document.querySelector("canvas");
const context = canvas.getContext("2d");

let width;
let height;

// get ratio of the resolution in physical pixels to the resolution in CSS pixels
let pxScale = window.devicePixelRatio;

function setup() {
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
    navigator.mediaDevices
        .getUserMedia(mediaConstraints)
        .then(webcamAccess)
        .catch(webcamError);
}

let imgScale = 10;
let scaleFactor = imgScale * pxScale;

function draw() {
    //draw video image
    context.drawImage(video, 0, 0, width / scaleFactor, height / scaleFactor);

    //access vid data
    let imageData = context.getImageData(
        0,
        0,
        width / imgScale,
        height / imgScale
    );
    let data = imageData.data;

    //clear original video
    context.clearRect(0, 0, width, height);

    for (let y = 0; y < imageData.height; y++) {
        for (let x = 0; x < imageData.width; x++) {
            let index = (x + y * imageData.width) * 4; //index position of every pixel

            let r = data[index];
            let g = data[index + 1];
            let b = data[index + 2];
            let a = data[index + 3];

            let gridIndex = index / 4; //index position of each checkbox
            context.fillStyle = `black`;
            context.font = 15 + "px sans-serif";

            context.save();
            context.translate(imgScale / 2 - 5, imgScale / 2 + 10);
            context.beginPath();
            if ((r + g + b) / 3 < 90) {
                context.fillText("w", x * imgScale, y * imgScale);
            } else if ((r + g + b) / 3 < 127) {
                context.fillText("o", x * imgScale, y * imgScale);
            } else if ((r + g + b) / 3 < 160) {
                context.fillText("u", x * imgScale, y * imgScale);
            } else if ((r + g + b) / 3 < 200) {
                context.fillText("i", x * imgScale, y * imgScale);
            }

            context.fill();
            context.restore();
        }
    }
    requestAnimationFrame(draw);
}

// wait for DOM to load before drawing to the canvas
window.addEventListener("load", () => {
    setup();
    draw();
});
window.addEventListener("resize", () => {
    setup();
});
