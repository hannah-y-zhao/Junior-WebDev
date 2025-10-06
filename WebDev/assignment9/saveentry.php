<?php

  // file path
  include("config.php");

  // grab the incoming data
  $message = $_POST['message'];
  $nickname = $_POST['nickname'];

  // make sure we have both values
  if ($message && $nickname) {

    // construct SQL to store this message
    $sql = "INSERT INTO messages (nickname, message) VALUES (:nickname, :message)";
    $statement = $db->prepare($sql);
    $statement->bindParam(':nickname', $nickname);
    $statement->bindParam(':message', $message);

    // store the message
    $statement->execute();

    // get the 'id' value that was just inserted
    $id = $db->lastInsertRowID();

    // close the database
    $db->close();
    unset($db);

    // print this back to the calling page
    print ($id);
    exit();
  }

  print ("ERROR");
  exit();

 ?>