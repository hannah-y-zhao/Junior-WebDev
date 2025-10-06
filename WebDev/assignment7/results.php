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
            margin:2rem;
        }
        #container{
            width:100%;
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
        .row{
            padding:0;
            margin:1rem 0 1rem 0;
            box-sizing:border-box;
        }
    </style>
</head>
<body>
    <h1>Total Quiz Results</h1>
    <hr>
    <?php
        
        $path = getcwd()."/data.txt";

        // // open the file for reading
        // // read in the all of the data
        $data = file_get_contents($path);

        // // display each story to the user

        // // isolate each line from the file
        $lines = explode("\n", $data);
        $marge=0;
        $homer=0;
        $bart=0;
        $lisa=0;
        $total=0;

        for ($i = 0; $i < sizeof($lines)-1; $i++) {
            if($lines[$i]=="marge"){
                $marge++;
            }elseif($lines[$i]=="homer"){
                $homer++;
            }elseif($lines[$i]=="bart"){
                $bart++;
            }else{
                $lisa++;
            }
            $total++;              
        }
        print "In total there have been $total quiz submissions.<br>";

        function checkIfZeroPercent($percent){
            if ($percent==0){
                return "0px";
            }else{
                return $percent."%";
            }
        }
        ?>
        <div id="container">
        <?php
        if ($total>0){
            $mPercent=($marge/$total)*100;
            $hPercent=($homer/$total)*100;
            $bPercent=($bart/$total)*100;
            $lPercent=($lisa/$total)*100;
            $mWidth=checkIfZeroPercent($mPercent);
            $hWidth=checkIfZeroPercent($hPercent);
            $bWidth=checkIfZeroPercent($bPercent);
            $lWidth=checkIfZeroPercent($lPercent);
            print "<div class='row' style='width:$mWidth;padding:1.5rem;background-color:aqua'>Marge: $mPercent%</div>";
            print "<div class='row' style='width:$hWidth;padding:1.5rem;background-color:lime'>Homer: $hPercent%</div>";
            print "<div class='row' style='width:$bWidth;padding:1.5rem;background-color:yellow'>Bart: $bPercent%</div>";
            print "<div class='row' style='width:$lWidth;padding:1.5rem;background-color:pink'>Lisa: $lPercent%</div>";
        }
        
        ?>
        </div>
        <hr>
        <p style="text-align:center"><a href="processingresults.php?cookie=clear">Back to quiz</a></p>
</body>
</html>