<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>Admin Access</h1>
    <hr>
    <pre>
<?php
    if (isset($_POST['user'])&&isset($_POST['password'])&&$_POST['user']=="pikachu"&&$_POST['password']=="pokemon"){
        print_r( $_SERVER );
    }else{
?></pre>
<form method="POST">
    <label for="username">Username:</label>
    <input type="text" name="user" id="user">
    <label for="password">Password:</label>
    <input type="text" name="password" id="password">
    <input type="submit" value="Submit" id="button">
</form>
<?php
    }
    ?>
    </script>
</body>
</html>