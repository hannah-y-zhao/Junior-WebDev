<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
            font-family: fantasy;
            background-color:#FFDE02
        }
        body{
            padding:2rem;
        }
        hr{
            margin:1rem 0 2rem 0;
        }
        select{
            margin:1rem 0 1rem 0;
        }
        input{
            padding:1rem;
        }
    </style>
</head>
<body>
    <h1>Which Simpson's Character Am I?</h1>
    <hr>
    <?php
        if ($_COOKIE['result']=="null") {
            ?>
            <form action="processingresults.php" method="POST">
            What is your ideal job?
            <select id="job" name="job">
                <option name="none" value="none">Select a job</option>
                <option name="baker" value="baker">Baker</option>
                <option name="tutor" value="tutor">French tutor</option>
                <option name="prank" value="prank">Prank phone call specialist</option>
                <option name="professor" value="professor">College professor</option>
            </select>
            <br>
            What is your favorite food?
            <select id="food" name="food">
                <option name="none" value="none">Select a food</option>
                <option name="pie" value="pie">Apple pie</option>
                <option name="donuts" value="donuts">Donuts</option>
                <option name="ramen" value="ramen">Ramen</option>
                <option name="broccoli" value="broccoli">Broccoli</option>
            </select>    
            <br>
            What is your favorite hobby?
            <select id="hobby" name="hobby">
                <option name="none" value="none">Select a hobby</option>
                <option name="TV" value="TV">Watching TV</option>
                <option name="crochet" value="crochet">Crocheting</option>
                <option name="read" value="read">Reading</option>
                <option name="skate" value="skate">Skateboarding</option>
            </select>    
            <br>
            What is your greatest fear?
            <select id="fear" name="fear">
                <option name="none" value="none">Select a fear</option>
                <option name="clowns" value="clowns">Clowns</option>
                <option name="spiders" value="spiders">Spiders</option>
                <option name="flying" value="flying">Flying</option>
                <option name="failure" value="failure">FAILURE</option>
            </select>    
            <br>

            <input name="submit" type="submit" value="Submit">
    </form>
    <?php
        }else{
            $person=$_COOKIE['result'];
            print "<h2>You got $person!</h2><img src='assets/$person.png'><br><p><a href='processingresults.php?cookie=clear'>Take Again?</a></p>";

        }

        if(isset($_GET["message"])){
            $message=$_GET["message"];
            print "<p style='background-color:red;width:fit-content;padding:1rem;margin:1rem 0 1rem 0;'>Please fill out all options</p>";
        }
    ?>
    <hr>
    <p style="text-align:center"><a href="results.php">See all past results</a></p>
</body>
</html>