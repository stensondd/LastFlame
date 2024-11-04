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
    transition: 2s;
}
a{
    text-decoration: none;
}
</style>
<html>
<head>
<title>Last Flame
</title>
<script type='text/javascript'>
function updateDatabase(id, val)
{
    <?php
    echo "playerId = '".$_SESSION['Profile']."'\n";
    ?>
    $.ajax(
    {
        method: 'POST',
        url: 'dataInterface.php',
        data: {
            playerId: playerId,
            id: id,
            val: val,
        },
        xhrFields: {
            withCredentials: true
        },
        crossDomain: true,
        success: function(response)
        {
            console.log(response);
        }
    });
}    

function updateSheet()
{
    <?php
    echo "playerId = '".$_SESSION['Profile']."'\n";
    ?>
    $.ajax(
    {
        method: 'POST',
        url: 'dataInterface.php',
        data: {
            playerId: playerId,
        },
        xhrFields: {
            withCredentials: true
        },
        crossDomain: true,
        success: function(response)
        {
            //stats = JSON.parse(response);
            //TODO: DELETE
                stats = [{idStat:'statMain', statValue:'50'}, {idStat:'ability', statValue: JSON.stringify(["Wand", "Coin"])}];
            stats.forEach((stat) => {
                updateObject = document.querySelector('#'+stat.idStat);
                updateObject.innerHTML = stat.statValue;
            });
            console.log(response);
            setAbilities()
            torrent();
        }
    });
}
function setAbilities()
{
    var abilityList = JSON.parse(document.querySelector('#ability').innerHTML);
    abilityList.forEach((ability) => {
        node = document.querySelector('#'+ability).closest('.node');
        $(node).find('.stat').first()[0].style.color = 'rgba(0,0,0,0)';
        node.style.backgroundColor = 'rgba(160,110,24,.6)';
    });
}
function torrent()
{
    var flameWidth = parseInt(document.getElementById("statMain").innerHTML)*15+200;
    var flameHeight = parseInt(document.getElementById("statMain").innerHTML)*15+200;
    document.getElementById("flame").style.height = flameHeight+"px";
    document.getElementById("flame").style.width = flameWidth+"px ";
    document.getElementById("flame").style.marginTop = -flameHeight/2+"px";
    document.getElementById("flame").style.marginLeft = -flameWidth/2+"px ";
    if(parseInt(document.getElementById("statMain").innerHTML) < 21){
        document.getElementById("flame").style.filter = 'hue-rotate('+(120+parseInt(document.getElementById("statMain").innerHTML)*12)+'deg) ';
        document.getElementById("flame").style.webkitFilter  = 'hue-rotate('+(120+parseInt(document.getElementById("statMain").innerHTML)*12)+'deg) grayscale('+(1-(parseInt(document.getElementById("statMain").innerHTML)/7))+')';
    }
    else
    {
        document.getElementById("flame").style.filter = 'hue-rotate(0deg)';
        document.getElementById("flame").style.webkitFilter  = 'hue-rotate(0deg)';
    }
}
</script>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<html>
<body onload='updateSheet()' style='margin:0px; overflow: hidden;'>
    <div id="night" style='width:100%; height:100%; background-color: #000; overflow:hidden;'>
    <video autoplay muted loop id="fog" style='overflow: hidden'>
    <!--<source src="img/spark-smoke.mp4" type="video/mp4">-->
    </video>
    <!--<canvas id="canvas" class='smoke' style="margin:0; height:100%; width:100%"></canvas>-->
        <div class='dotBig' style='position:absolute; top: 50%; left: 50%;'>
            <video autoplay muted loop id="flame">
            <source src="img/fire-effect-trans2.webm" type="video/webm">
            </video>
            <div class='dot' style='position:absolute; top: 50%; left: 50%;'>
                <div id='option0' class='option optionClose' style='position:absolute; top: 50%; left: 50%;'>
                    <h1 id='statMain' class='statBlack' style='position:absolute; top: 50%; left: 50%;'>0</h1>
                </div>
            </div>
        </div>
        <div class='nodeSquare'><a href='PlayerDashboard.php'><h1 class='statLoose'>Dashboard</h1></a></div>
    </div>    
</body>
<div id=ability style='display:hidden;'></div>
</html>
<script type='text/javascript' src='flameScript.js'></script>
<script>
    window.onload = function() {
        console.log("Test");
        updateSheet();
    }
</script>