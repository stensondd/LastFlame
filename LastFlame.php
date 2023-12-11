<?php
session_start();
//include "../TalentTree/loginScreen.php";
//buildScreen();
?>
<style>
.dotBig {
    height: 400px;
    width: 400px;
    margin-top: -200px;
    margin-left: -200px;
    border-radius: 50%;
    display: inline-block;
    background-image: radial-gradient(rgba(255,255,135,1) 10%, rgba(255,255,235,0) 60%, rgba(0,0,0,0) 20%);
}
.dot {
    position: absolute;
    height: 150px;
    width: 150px;
    margin-top: -75px;
    margin-left: -75px;
    border-radius: 50%;
    display: inline-block;
    
    background-image: radial-gradient(rgba(255,255,135,1) 10%, rgba(255,255,235,0) 60%, rgba(0,0,0,0) 20%);
}
.dotMed {
    position: absolute;
    height: 250px;
    width: 250px;
    margin-top: -125px;
    margin-left: -125px;
    border-radius: 50%;
    display: inline-block; 
    background-image: radial-gradient(rgba(255,255,135,1) 10%, rgba(255,255,235,0) 60%, rgba(0,0,0,0) 20%);
}
.hidden {
    display: none
}
.node {
    position: absolute;
    height: 50px;
    width: 50px;
    margin-top: -28px;
    margin-left: -28px;
    border-radius: 50%;
    border: 3px solid rgb(201,201,201);
    display: inline-block;
    background-color: rgba(255,255,255,.4);
}
.glow {
    -webkit-box-shadow:0 0 50px white; 
    -moz-box-shadow: 0 0 50px white; 
    box-shadow:0 0 50px white;
}
</style>
<html>
<head>
<title>Last Flame
</title>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script type="text/javascript">
</script>
<html>
<body style='margin:0px'>
    <div id="night" style='width:100%; height:100%; background-color: #002;'>
    <canvas id="canvas" style="margin:0; height:100%; width:100%"></canvas>
        <div class='dotBig' style='position:absolute; top: 50%;
                    left: 50%;
                    '></div>
    </div>    
</body>
</html>
<script type='text/javascript' src='flameScript.js'></script>