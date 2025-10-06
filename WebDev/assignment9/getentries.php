<?php

  // file path
  include("config.php");

  // extract all messages from the database
  if ($_GET['room']=="chat2"){
    $sql = "SELECT * FROM messages2";
  }else{
    $sql = "SELECT * FROM messages";
  }
  
  $statement = $db->prepare($sql);
  $result = $statement->execute();

  // store all results in an associative array that we will send back to the HTML page
  $send_back = array();

  // visit all records
  while ($row = $result->fetchArray()) {

    // create a mini-array to hold this record
    $record = array();
    $record['id'] = $row['id'];
    $record['nickname'] = $row['nickname'];
    $record['message'] = $row['message'];

    // add record to the main array
    array_push($send_back, $record);
  }

  // close the database
  $db->close();
  unset($db);

  // turn the array into a JSON object and print it to the browser
  print json_encode($send_back);
  exit();

 ?>