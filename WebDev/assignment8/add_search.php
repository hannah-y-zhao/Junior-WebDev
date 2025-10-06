<?php
$path=getcwd();
$db=new SQLite3($path."/movies.db");
    if (isset($_POST['submit'])) {
        $title=$_POST["title"];
        $year=$_POST["year"];
        
        if (!$title||!$year){
            header('Location: add_form.php?message=error');
            exit();
        }else{
            

            // step 3: construct an INSERT query
            $sql = "INSERT INTO movies (title, year) VALUES (:substitution, :substitution2)";

            // step 4: prepare a SQL statement object
            $statement = $db->prepare($sql);

            // step 5: safely substitute variables into our statement
            $statement->bindValue(':substitution', $title);
            $statement->bindValue(':substitution2', $year);

            // step 6: run our query
            $result = $statement->execute();

            $db->close();
            unset($db);

            // done!
            
            header('Location: add_form.php?message=success');
            exit();
        }
    }elseif(isset($_GET['delete'])){
        $id=$_GET['delete'];
        $sql = "DELETE FROM movies WHERE id = $id";

        // step 4: prepare a SQL statement object
        $statement = $db->prepare($sql);

        // step 5: run the query
        $result = $statement->execute();

        $db->close();
        unset($db);
        header('Location: index-starter.php?deleted=success');
        exit();
    }elseif (isset($_POST['submit2'])){
        $title=$_POST["title"];
        $year=$_POST["year"];
        $sql;
        if (!$title&&!$year){
            header('Location: search_form.php?message=error');
            exit();
        }elseif($title&&$year){
            $sql = "SELECT * FROM movies WHERE title LIKE '%$title%' AND year=$year";
        }elseif ($title){
            $sql = "SELECT * FROM movies WHERE title LIKE '%$title%'";
        }elseif ($year){
            $sql = "SELECT * FROM movies WHERE year = $year";
        }
        header("Location: search_form.php?sql=$sql");
        exit();
        // $statement = $db->prepare($sql);

        // // step 5: run the query
        // $result = $statement->execute();

        // // step 6: iterate over the results
        // while ($row = $result->fetchArray()) {
        //     // extract the relevant info from the query into some variables
        //     $title = $row[1];
        //     $year = $row[2];

        //     print "<ul><li>$title, $year</li></ul>";
        // }

        // // step 7: if we are done with the database we should close it
        // // this allows Apache to use it again quickly, rather than waiting for
        // // the database's natural timeout to occur
        // $db->close();
        // unset($db);
    }
?>