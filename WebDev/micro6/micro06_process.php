<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $username=$_POST["username"];
        $password=$_POST["password"];
        if($username=="pikachu"&&$password=="pokemon"){
            header('Location: micro06.php?success=success');
        }else if (empty($username)&&!empty($password)){
            header('Location: micro06.php?message=username is empty');
        }else if (!empty($username)&&empty($password)){
            header('Location: micro06.php?message=password is empty');
        }else if ($username!="pikachu"||$password!="pokemon"){
            header('Location: micro06.php?message=incorrect combination');
        }
    ?>
</body>
</html>