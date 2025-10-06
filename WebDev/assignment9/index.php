<!doctype html>
<html>
  <head>
    <title>Web Development</title>

    <!-- bring in our helpers library, which will make available the 'performFetch' function -->
    <script src="helpers.js"></script>
    <style>
        *{
            margin:0;
            padding:0
        }
        body{
            width:100%;
            height:100vh;
            display:flex;
            flex-flow:column;
            padding:2rem;
            box-sizing:border-box;
        }
        #login{
            /* width:100%; */
            /* display:flex; */
            flex-flow:column;
            justify-content:center;
            align-items:flex-start;
            /* padding:2rem; */
        }
        #chat{
            display:none;
        }
        input{
            padding:1rem;
        }
        .hidden{
            display:none;
        }
        #messages{
            width:100%;
            height:25rem;
            border: 1px solid black;
            overflow:scroll;
        }
        #messages2{
            width:100%;
            height:25rem;
            border: 1px solid black;
            overflow:scroll;
        }
        .msg{
          font-family:monospace;
          padding:0.5em;
        }
    </style>
  </head>
  <body>
    <h1>Let's Chat</h1>
    <hr>
    <br>
      <div id="login">
          <h4>Please write a nickname:</h4>
          <br>
          <input type="text" id="name" name="name">
          <br><br>
          <input type="submit" id="button" name="button" value="Start Chatting">
      </div>
    <div id="chat">
        <label for="room">Chat Room:</label>
            <select id="room" name="room">
                <option value="chat1">Chat Room 1</option>
                <option value="chat2">Chat Room 2</option>
            </select>
            <input type="submit" id="changeRoom" name="changeRoom" value="Change Room">
        <br><br>
        <div id="messages"></div>
        <div id="messages2"></div>
        <br>
        <input type="text" id="newMessage" name="newMessage">
        <input type="submit" id="sendMessage" name="sendMessage" value="Send Message">
    </div>
    <a href="admin.php">Admin</a>

    <!-- custom application code -->
    <script>
      let currentNickname;
      let currentMessage=document.getElementById("newMessage");
      let allMessages=document.getElementById("messages");
      let allMessages2=document.getElementById("messages2");
      allMessages2.style.display="none";
      let hovered=false;
      let roomDropdown=document.getElementById("room");
      let changeRoom=document.getElementById("changeRoom");

      changeRoom.onclick=function(){
        if(roomDropdown.value=="chat2"){
          allMessages2.style.display="inline-block"
          allMessages.style.display="none"
        }else{
          allMessages2.style.display="none"
          allMessages.style.display="inline-block"
        }
        getAllMessages()
      }

      allMessages.addEventListener("mouseover",function(){
        hovered=true;
      })
      allMessages.addEventListener("mouseout",function(){
        hovered=false;
      })

      document.getElementById("button").onclick=function(){
        if(document.getElementById("name").value){
          document.getElementById("login").style.display="none";
          document.getElementById("chat").style.display="inline-block";
          currentNickname=document.getElementById("name").value
          getAllMessages()
        }
      }
      function getAllMessages(){
        performFetch({
          method: 'GET',
          url: `getentries.php?room=${roomDropdown.value}`,
          success: function(data, status) {
            let arrayData = JSON.parse(data);
            for (let i = 0; i < arrayData.length; i++) {
                if (!document.getElementById(arrayData[i]['id'])) {
                  createMessage(arrayData[i]['id'], arrayData[i]['nickname'], arrayData[i]['message']);
              }
            }
            setTimeout(getAllMessages, 3000);
          },
          error: function(req, data, status) {
            console.log("Error, couldn't get file");
          }
        })
      }
      function createMessage(id,nickname,message){
        let tempDiv=document.createElement("div")
        tempDiv.id=id;
        tempDiv.classList.add("msg");
        tempDiv.innerHTML=nickname+": "+message;
        if(roomDropdown.value=="chat1"){
          allMessages.appendChild(tempDiv);
        }else{
          allMessages2.appendChild(tempDiv);
        }

        if (!hovered){
          allMessages.scrollTop=allMessages.scrollHeight;
          allMessages2.scrollTop=allMessages2.scrollHeight;
        }
      }

      document.getElementById("sendMessage").onclick=function(){
        let thisMessage = currentMessage.value;
        currentMessage.value="";

        // make a fetch request to the server
        performFetch({
          method: 'POST',
          url: 'saveentry.php',
          data: {
            nickname: currentNickname,
            message: thisMessage
          },
          success: function(data, status) {
            console.log("Success! Received this data from the server: ", data);
            createMessage(data, currentNickname, thisMessage);
          },
          error: function(req, data, status) {
            console.log("Error!");
          }
        })

      

      }

    </script>


  </body>
</html>
