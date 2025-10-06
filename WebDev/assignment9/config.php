<?php
   $path = getcwd() . '/data';

   // open database
   $db = new SQLite3($path.'/messages.db');
?>