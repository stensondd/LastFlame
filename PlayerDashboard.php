<?php
session_start();
if(isset($_POST['Profile']) || isset($_SESSION['Profile']))
{
    $_SESSION['Profile'] = $_POST['Profile'] ?? $_SESSION['Profile'];
    echo '<p id="Profile" hidden value="'.$_SESSION['Profile'].'"></p>';
}
else
{
    session_destroy();
    header('Location: Login.php');
    exit();
}
?>

<link rel="stylesheet" type="text/css" href="font.css">
<link rel="stylesheet" type="text/css" href="style.css">
<style>
.dotBig {
    height: 600px;
    width: 600px;
    margin-top: -0px;
    margin-left: -0px;
    border-radius: 50%;
    display: inline-block;
    text-align: center;
    vertical-align: middle;
}
.dot {
    position: absolute;
    height: 80px;
    width: 80px;
    margin-top: -40px;
    margin-left: -40px;
    border-radius: 50%;
    display: inline-block;
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
    border: 3px solid rgba(160,110,24,100); 
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
    border: 3px solid rgba(160,110,24,100); 
    display: inline-block;
    background-color: rgba(0,0,0,.4);
}
.nodeSquare {
    position: absolute;
    border: 3px solid rgba(160,110,24,100); 
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
.statLoose {
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
    margin:10px;
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
    border: 10px solid rgba(160,110,24,100);
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
    position:absolute;
    border-radius: 50%;
    top:50%;
    left: 50%;
    margin-top: -162px;
    margin-left: -288px;
    height: 324px;
    width: 576px;
}
a{
    text-decoration: none;
}
.statCell{
    padding:10px;
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
<body style='margin:0px; overflow: hidden;'>
    <div id="night" style='width:100%; height:100%; background-color: #000; overflow:hidden;'>
    <video autoplay muted loop id="fog" style='overflow: hidden'>
    <source src="img/spark-smoke.mp4" type="video/mp4">
    </video>
    <!--<canvas id="canvas" class='smoke' style="margin:0; height:100%; width:100%"></canvas>-->
        <div class='dotBig' style='position:absolute; top: -60px; left: -100px;'>
            <video autoplay muted loop id="flame">
            <source src="img/fire-effect-trans2.webm" type="video/webm">
            </video>
            <div class='dot' style='position:absolute; top: 50%; left: 50%;'>
                <div id='option0' class='option optionClose' style='position:absolute; top: 50%; left: 50%;'>
                    <h1 id='stat0' class='statBlack' style='position:absolute; top: 50%; left: 50%;'>200</h1>
                </div>
            </div>
        </div>
        <table id='statRow' style='position: absolute; top:160px; left: 320px; width: 20px; height: 20px;'>
            <tr>
                
                    <?php
                    $statList = ['VITALITY', 'ENDURANCE', 'FINESSE', 'INSTINCT', 'WIT', 'RESOLVE'];
                    foreach($statList as $stat)
                    {
                        echo "<td class='statCell'><table class='borderStat'><tr><td><h1 class='statNum'>0</h1></td></tr><tr><td><h1 class='statHead'>".$stat."</h1></td></tr></table></td>";
                    }
                    ?>
            </tr>
        </table>
        <div class='nodeSquare'><a href='LastFlame.php'><h1 class='statLoose'>Bonfire</h1></a></div>
    </div>    
</body>
</html>
<script>
</script>