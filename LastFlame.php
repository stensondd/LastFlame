<style>
.dotBig {
    height: 900px;
    width: 900px;
    margin-top: -450px;
    margin-left: -450px;
    border-radius: 50%;
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    /*background-image: url("img/fire-effect.gif");
    background-size: 19.2px 10.8px;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    /*margin-top: 10px;
    /*background-image: radial-gradient(rgba(255,255,135,1) 10%, rgba(255,255,235,0) 60%, rgba(0,0,0,0) 20%);*/
}
.dot {
    position: absolute;
    height: 80px;
    width: 80px;
    margin-top: -40px;
    margin-left: -40px;
    border-radius: 50%;
    display: inline-block;
    /*background-image: radial-gradient(rgba(255,255,135,1) 10%, rgba(255,255,235,0) 60%, rgba(0,0,0,0) 20%);*/
    background-color: rgba(0,0,0,0);
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
    height: 60px;
    width: 60px;
    margin-top: -33px;
    margin-left: -33px;
    border-radius: 50%;
    border: 3px solid rgba(200,160,36,100); 
    display: inline-block;
    background-color: rgba(0,0,0,.4);
}
.nodeCircle {
    position: absolute;
    height: 60px;
    width: 60px;
    margin-top: -33px;
    margin-left: -33px;
    border-radius: 50%;
    border: 3px solid rgba(200,160,36,100); 
    display: inline-block;
    background-color: rgba(0,0,0,.4);
}
.glow {
    -webkit-box-shadow:0 0 50px white; 
    -moz-box-shadow: 0 0 50px white; 
    box-shadow:0 0 50px white;
}
.stat {
    position: absolute;
    height: 50px;
    width: 50px;
    margin-top: -25px;
    margin-left: -25px;
    line-height: 50px;
    border-radius: 50%; 
    color: lightgray;
    text-align: center;

    vertical-align: middle;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-decoration: none;
}
.stat:hover {
    cursor: pointer;
}
.statBlack {
    position: absolute;
    height: 50px;
    width: 50px;
    margin-top: -25px;
    margin-left: -25px;
    line-height: 50px;
    border-radius: 50%; 
    color: black;
    text-align: center;

    vertical-align: middle;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-decoration: none;
}
.statBlack:hover {
    cursor: pointer;
}
.option{
    cursor: pointer;
    border-radius: 50%;
}
.optionClose{
    height:0px;
    width:0px;
    margin-top: -10px;
    margin-left: -10px;
    border: 10px solid rgba(255,255,255,0);
    transition: 0.5s linear
}
.optionExpand{
    height:80px;
    width:80px;
    margin-top: -50px;
    margin-left: -50px;
    border: 10px solid rgba(200,160,36,100);
    /*box-shadow:0 0 0 2px,
    inset 0 0 0 2px;*/
    transition: 0.5s linear
}
.smoke {
    background-repeat: no-repeat;
    background-position: center;
}
#fog{
    position: fixed;
    right: 0;
    bottom: 0;
    min-width: 100%;
    min-height: 100%;
}
#flame{
    top: 50%;
    left: 50%;
    position: absolute;
    border-radius: 50%;
}
</style>
<?php
session_start();

if(isset($_POST))
{
    echo print_r($_POST);
}
if(!isset(($_SESSION['Profile'])))
{
    buildScreen();
    exit();
}
//include "../TalentTree/loginScreen.php";
?>
<?php
function buildScreen()
{
    echo 
    '<script>
    function setPlayer()
    {
        val = document.getElementById("player").value;
        console.log(val);
    }
    </script>';
    $players = ['David', 'Matt'];
    echo "<select id='player' onchange='setPlayer()' name='nameChoice'>";
    foreach($players as $player)
    {
        echo "<option value=".$player.">".$player."</option>";
    }
}
?>
<html>
<head>
<title>Last Flame
</title>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script type="text/javascript">
</script>
<html>
<body style='margin:0px'>
    <div id="night" style='width:100%; height:100%; background-color: #000;'>
    <video autoplay muted loop id="fog">
    <source src="img/spark-smoke.mp4" type="video/mp4">
    </video>
    <canvas id="canvas" class='smoke' style="margin:0; height:100%; width:100%"></canvas>
        <div class='dotBig' style='position:absolute; top: 50%; left: 50%;'>
            <video autoplay muted loop id="flame">
            <source src="img/fire-effect-trans2.webm" type="video/webm">
            </video>
            <div class='dot' style='position:absolute; top: 50%; left: 50%;'>
                <div id='option0' class='option optionClose' style='position:absolute; top: 50%; left: 50%;'>
                    <h1 id='stat0' class='statBlack' style='position:absolute; top: 50%; left: 50%;'>200</h1>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>
<script type='text/javascript' src='flameScript.js'></script>