const body = document.querySelector("body");
let width;
let height;
const links = document.querySelectorAll("a")
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

function setup() {
    width = window.innerWidth;
    height = window.innerHeight;

    for (let i = 0; i < 30; i++) {
        let newDiv = document.createElement("div");
        let randLetter = alphabet[Math.floor(Math.random() * alphabet.length)];
        newDiv.innerHTML = randLetter;

        newDiv.classList.add("random");

        body.prepend(newDiv);
        newDiv.style.top = Math.floor(Math.random() * height) + "px";
        newDiv.style.left = Math.random() * width + "px";
    }

    body.addEventListener("click", function () {
        console.log(body.children)
        for (let i = 0; i < body.children.length; i++) {
            if (body.children[i].tagName == "A") {
                body.children[i].style.backgroundColor = "aqua"
            } else {
                body.children[i].style.backgroundColor = "red"
            }
        }
        setTimeout(() => {
            for (let i = 0; i < body.children.length; i++) {
                body.children[i].style.backgroundColor = "transparent"
            }
        }, 1000);
    })
}

function sizing() {
    width = window.innerWidth;
    height = window.innerHeight;
    if (width < height) {
        let randDivs = document.querySelectorAll(".random");
        let linkedDivs = document.querySelectorAll(".linked");
        if (randDivs) {
            for (let i = 0; i < randDivs.length; i++) {
                randDivs[i].classList.remove("random");
                randDivs[i].classList.add("random-mobile");
            }
        }
        if (linkedDivs) {
            for (let i = 0; i < linkedDivs.length; i++) {
                linkedDivs[i].classList.remove("linked");
                linkedDivs[i].classList.add("linked-mobile");
            }
        }
    } else {
        let randDivs = document.querySelectorAll(".random-mobile");
        let linkedDivs = document.querySelectorAll(".linked-mobile");
        if (randDivs) {
            for (let i = 0; i < randDivs.length; i++) {
                randDivs[i].classList.add("random");
                randDivs[i].classList.remove("random-mobile");
            }
        }
        if (linkedDivs) {
            for (let i = 0; i < linkedDivs.length; i++) {
                linkedDivs[i].classList.add("linked");
                linkedDivs[i].classList.remove("linked-mobile");
            }
        }
    }
}
window.addEventListener("load", function () {
    setup();
    sizing()
});
window.addEventListener("resize", function () {
    sizing()
});
