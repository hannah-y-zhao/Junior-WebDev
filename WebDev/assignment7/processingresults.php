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
            background-color:#FFDE02;
        }
        body{
            padding:2rem;
            width:100%;
            height:100vh;
            display:flex;
            flex-flow:column;
            justify-content:center;
            align-items:center;
            overflow:hidden;
        }
    </style>
</head>
<body>
<?php
    if (isset($_POST['submit'])) {
        $job=$_POST["job"];
        $food=$_POST["food"];
        $hobby=$_POST["hobby"];
        $fear=$_POST["fear"];
        if ($job=="none"||$food=="none"||$hobby=="none"||$fear=="none"){
            header('Location: index.php?message=error');
            exit();
        }else{
            $marge=array("tutor","pie","read","spiders");
            $margeCount=0;
            $homer=array("professor","donuts","tv","clowns");
            $homerCount=0;
            $bart=array("prank","ramen","skate","flying");
            $bartCount=0;
            $lisa=array("baker","broccoli","crochet","failure");
            $lisaCount=0;
            $options=array($job,$food,$hobby,$fear);
            foreach($options as $option){
                if(in_array($option,$marge)){
                    $margeCount++;
                    // print "<p>margecount: $margeCount $option</p>";
                }elseif(in_array($option,$homer)){
                    $homerCount++;
                    // print "<p>homercount: $homerCount $option</p>";
                }elseif(in_array($option,$bart)){
                    $bartCount++;
                    // print "<p>bartcount: $bartCount $option</p>";
                }elseif(in_array($option,$lisa)){
                    $lisaCount++;
                    // print "<p>lisacount: $lisaCount $option</p>";
                }
            }
            $people=array("marge"=>$margeCount,"bart"=>$bartCount,"homer"=>$homerCount,"lisa"=>$lisaCount);
            $max=0;
            $person;
            foreach($people as $currentPerson => $count){
                if($count>$max){
                    $max=$count;
                    $person=$currentPerson;
                }
            }

            $data = "$person\n";
            $path = getcwd();
            file_put_contents($path.'/data.txt', $data, FILE_APPEND);
            setcookie('result', $person);
            
            header("Location: index.php");
            exit();

        }
    }
    if(isset($_GET['cookie'])){
        setcookie('result',"null");
        header("Location: index.php");
            exit();
    }
?>
</body>
</html>

