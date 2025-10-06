let pastY = -10;
let pastX = -10;
let scale = Math.floor(Math.random() * 21) / 10;
const body = document.querySelector("body");
let isDown = false;
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
window.addEventListener("mousedown", function () {
    isDown = true;
    scale = Math.floor(Math.random() * 21) / 10;
});
window.addEventListener("mousemove", function (e) {
    if (isDown) {
        let xpos = e.clientX;
        let ypos = e.clientY;
        if (Math.abs(pastX - xpos) > 2 && Math.abs(pastY - ypos) > 2) {
            let newLetter = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "svg"
            );
            let randLetter = alphabet[Math.floor(Math.random() * alphabet.length)];
            newLetter.innerHTML = `<use href="letters.svg#${randLetter}"/>`;
            newLetter.style.top = `${ypos}px`;
            newLetter.style.left = `${xpos}px`;
            newLetter.style.scale = `${scale}`;

            let r = Math.floor(Math.random() * 256);
            let g = Math.floor(Math.random() * 256);
            let b = Math.floor(Math.random() * 256);
            newLetter.style.fill = `rgb(${r}, ${g}, ${b})`;
            body.prepend(newLetter);
            pastX = xpos;
            pastY = ypos;
        }
    }
});
window.addEventListener("mouseup", function () {
    isDown = false;
});
