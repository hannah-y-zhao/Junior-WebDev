<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_GET["message"])){
            $message=$_GET["message"];
            print "<p style='background-color:red;width:fit-content;padding:.5rem;'>$message</p>";
        }elseif(isset($_GET["success"])){
            $success=$_GET["success"];
            print "<p style='background-color:lime;width:fit-content;padding:.5rem;'>$success</p>";
        };
    ?>
    <form action="micro06_process.php" method="POST">
        Enter your username: <input type="text" name="username">
        Enter your password: <input type="text" name="password">
        <input type="submit" value="Enter">
    </form>
</body>
</html>