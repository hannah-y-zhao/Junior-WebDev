let gData

function fetchJSONData() { //https://www.geeksforgeeks.org/read-json-file-using-javascript/
    fetch("./goodreads.json")
        .then((res) => {
            if (!res.ok) {
                throw new Error
                    (`HTTP error! Status: ${res.status}`);
            }
            return res.json();
        })
        .then((data) => 
            gData=data
            //   console.log(data)
              )
              
        .catch((error) => 
               console.error("Unable to fetch data:", error));
}
fetchJSONData();

let button=document.getElementById("newRead")
let body=document.querySelector("body")
let currentBook
let xpos,ypos
let title=document.getElementById("title")
button.style.cursor="pointer"
let counter=0

getPosition=(event)=>{
     xpos=event.clientX
     ypos=event.clientY
    // console.log(xpos,ypos)
  }

button.onclick=function(){
    let randNum=Math.floor(Math.random()*gData.length)
    currentBook=gData[randNum]
    while(currentBook["Exclusive Shelf"]!="to-read"){
        randNum=Math.floor(Math.random()*gData.length)
        currentBook=gData[randNum]
    }
    title.querySelectorAll("span")[1].innerHTML=currentBook["Title"]
    title.querySelectorAll("span")[0].innerHTML="By "+currentBook["Author"]

    // console.log(currentBook)
    // console.log(gData[randNum]["Exclusive Shelf"])
    counter=0
}


body.addEventListener("click",function(){
    if (currentBook&&counter>0){
        let newDiv=document.createElement("div")
        newDiv.innerHTML=currentBook["Title"]
        newDiv.style.position="absolute"

        document.addEventListener("click",getPosition)
        newDiv.style.top=Math.floor(ypos)+"px"
        newDiv.style.left=Math.floor(xpos)+"px"
        newDiv.classList.add("opacity")
        body.insertBefore(newDiv,body.firstChild)
    
    }
    counter++
})

document.addEventListener("pointermove",getPosition)