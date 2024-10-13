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
.noteText
{
  font-size: 16px;
  text-align: left;
  margin: 5px;
  line-height: 16px;    
  width: 94%;
}

.noteText:hover{
    cursor: pointer;
}

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
.statNum:hover {
    cursor: pointer;
}
.statHead:hover {
    cursor: pointer;
}
.skillNum:hover {
    cursor: pointer;
}
.damNum {
    margin:0px;
}
.damNum:hover {
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
.statRow{
    border-color: rgba(0, 69, 183, 0.4);
    border-top: 1px dotted slategray;
    border-width: 1px;
}
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
.highlight {
    color: grey;
}
.operation {
    border: 1px solid #718191;
    border-radius: 4px;
}
.highlight {
    color: #A06E18;
}
</style>
<html>
<head>
<title>Last Flame
</title>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script type="text/javascript">
    let editObject = null;
    function incStat(ev, index)
    {
        let mod = 0
        ev.preventDefault();
        if(ev.which == 1)
            mod = 1;
        else
            mod = -1; 
        let statList = document.querySelectorAll('.'+index);
        console.log(statList);  
        statList.forEach((stat)=>{
            stat.innerHTML =  Math.max(parseInt(stat.innerHTML)+mod, 0);
            if(stat.id.includes('primeskill'))
            {
                stat.innerHTML = '+'+stat.innerHTML;
            }
            updateDatabase(stat.id, stat.innerHTML); 
        });
    }
    function makeEdit()
    {
        updateDatabase(event.target.id, event.target.innerHTML);
    }
    function exitEdit()
    {
        if(event.key == 'Enter')
        {
            event.preventDefault();
            editObject.blur();
        }
    }
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
    function highlightStat(update)
    {
        let statList = document.querySelectorAll('.'+update);
        statList.forEach((stat)=>{
            stat.classList.add('highlight');
        });
    }
    function highlightClear(update)
    {
        let statList = document.querySelectorAll('.'+update);
        statList.forEach((stat)=>{
            stat.classList.remove('highlight');
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
                stats = JSON.parse(response);
                stats.forEach((stat) => {
                    /*if(stat.idStat.includes('weap'))
                    {
                        weapSplit = stat.idStat.split('-');
                        if(!isset(document.querySelector('#'+weapSplit[0])))
                        {
                            addWeaponRow();
                        }
                    }*/
                    updateObject = document.querySelector('#'+stat.idStat);
                    updateObject.innerHTML = stat.statValue;
                    
                });
                console.log(response);
            }
        });
    }
    function addWeaponRow()
    {

    }
    function fireUpdate(type)
    {
        fire = document.querySelector('#statMain');
        change = document.querySelector('#fireInput');
        if(type == "ADD")
            fire.innerHTML = parseInt(fire.innerHTML)+parseInt(change.innerHTML);
        else
            fire.innerHTML = parseInt(fire.innerHTML)-parseInt(change.innerHTML);
        change.innerHTML = 0;
        torrent();
    }
</script>
<html>
<body onload='updateSheet()' style='margin:0px; overflow: hidden; user-select: none; -webkit-user-select: none;' oncontextmenu='return false;'>
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
                    <h1 id='statMain' class='statBlack statMain' onmousedown='incStat(event, "statMain"); torrent();' style='position:absolute; top: 50%; left: 50%;'>1</h1>
                </div>
            </div>
        </div>
        <table id='statRow' style='position: absolute; top:160px; left: 320px; width: 20px; height: 20px;'>
            <tr>
                    <?php
                    $statList = ['VITALITY', 'ENDURANCE', 'FINESSE', 'INSTINCT', 'WIT', 'RESOLVE'];
                    foreach($statList as $statInd => $stat)
                    {
                        $statClass = 'stat'.$statInd;
                        echo "<td class='statCell'><table onmousedown='incStat(event, \"".$statClass."\")' onmouseenter='highlightStat(\"".$statClass."\")' onmouseleave='highlightClear(\"".$statClass."\")' class='borderStat'><tr><td><h1 id='prime".$statClass."' class='".$statClass." statNum'>0</h1></td></tr><tr><td><h1 class='statHead'>".$stat."</h1></td></tr></table></td>";
                    }
                    ?>
            </tr>
        </table>
        <table id='skillList' class='skillTable' style='position: absolute; top:300px; left: 330px; width:400px; height: 300px;'>
            <tbody>
            <?php
                    $statList = ['VITALITY', 'ENDURANCE', 'FINESSE', 'INSTINCT', 'WIT', 'RESOLVE'];
                    $skillList = [
                        'Attack'=>[0, 2], 
                        'Block'=>[1, 2], 
                        'Command'=>[0, 4], 
                        'Convince'=>[1, 4],
                        'Discover'=>[3, 5],
                        'Dodge'=>[1, 3],
                        'Exert'=>[0, 1],
                        'Focus'=>[1, 5],
                        'Manipulate'=>[2, 4],
                        'Parry'=>[2, 5],
                        'Scheme'=>[3, 4],
                        'Sense'=>[0, 3],
                        'Sneak'=>[2, 3],
                        'Strive'=>[0, 5]
                    ];
                    $index = 0;
                    echo "<tr><th><h2 class='skillTitle' style='text-align:left'>Skill</h2></td><td><h2 class='skillTitle'>First</h2></td><td><h2 class='skillTitle'>Second</h2></td><td><h2 class='skillTitle'>Bonus</h2></td></tr>";
                    foreach($skillList as $skillInd => $skill)
                    {
                        $skillClass = 'skill'.$index;
                        echo "<tr class='skillLine'><td onmousedown='incStat(event, \"".$skillClass."\")'><h2 class='statHead' style='text-align:left' >".$skillInd."</h2></td><td><h2 id='".$skillClass."-".$skill[0]."' class='stat".$skill[0]." skillNumWide'>0</h2></td><td><h2 id='".$skillClass."-".$skill[1]."' class='stat".$skill[1]." skillNumWide'>0</h2></td><td><h2 id='prime".$skillClass."' class='".$skillClass." skillNumWide'>+0</h2></td></tr>";
                        $index++;
                    }
                ?>
            </tbody>
        </table>
        <table id='statRow' style='position: absolute; top:360px; left: 100px; width: 20px; height: 20px;'>
            <?php
            echo "<tr class='statCell'><td><table style='width:100%' class='borderResource'><tr>
            <td style='width:40px' rowspan='2'><h1 contenteditable id='fireInput' class='statNum operation'>0</h1></td><td>
            <h1 onclick='fireUpdate(\"ADD\")' class='statHead operation'>ADD</h1></td></tr><tr><td>
            <h1 onclick='fireUpdate(\"REMOVE\")' class='statHead operation'>REMOVE</h1>
            </td></tr></table></td></tr>";
            $statList = [['BURN', 'BLAZE', 7, 5], ['STAMINA', 'MAX', 1, 10], ['BULWARK', 'MAX', 0, 0]];
            foreach($statList as $statInd => $stat)
            {
                $statClass = 'resource'.$statInd;
                $statMaxClass = 'resourceMax'.$statInd;
                echo "<tr class='statCell'><td><table class='borderResource'><tr><td onmousedown='incStat(event, \"".$statClass."\")'><h1 id='prime".$statClass."' class='".$statClass." statNum'>0</h1></td><td onmousedown='incStat(event, \"".$statMaxClass."\")'><h1 id='prime".$statMaxClass."' class='".$statMaxClass." statNum stat".$stat[2]."'>".$stat[3]."</h1></td></tr><tr><td><h1 class='statHead'>".$stat[0]."</h1></td><td><h1 class='statHead'>".$stat[1]."</h1></td></tr></table></td></tr>";
            }
            ?>
        </table>
        <table id='weaponTable' style='position: absolute; top:300px; left: 820px; width: 20px; height: 20px;'>
            <?php
            $weapList = [
                [['NAME', 'Torch'], ['DAMAGE', 0], ['HEFT', 0], ['REACH', 0], ['SPECIAL', 'Burn']],
                [['NAME', 'Torch'], ['DAMAGE', 0], ['HEFT', 0], ['REACH', 0], ['SPECIAL', 'Burn']],
                [['NAME', 'Torch'], ['DAMAGE', 0], ['HEFT', 0], ['REACH', 0], ['SPECIAL', 'Burn']]];
            echo "<tr class='statCell'><td><table class='borderResource'><tr>";
            $top = "<tr>";
            $bot = "<tr>";
            $topFirst = true;
            foreach($weapList as $weaponInd => $weapon)
            {
                foreach($weapon as $subInd => $weap)
                {
                    $weapInd = 'weap'.$weaponInd.'-'.$subInd;
                    $weaponClassNum = $weapInd.'Num';
                    $weaponClassDie = $weapInd.'Die';
                    $top= $top."<td><h1 style='width:100%' class='statHead'>".$weap[0]."</h1></td>";
                    if($weap[0] == 'DAMAGE'){
                        $bot= $bot."<td><table><tr id='weap".$weaponInd."'><td><h1 id='prime".$weaponClassNum."' class='".$weaponClassNum." damNum' onmousedown='incStat(event, \"".($weaponClassNum)."\")'>".$weap[1]."</h1></td><td><h1 class='damNum'>d</h1></td><td><h1 id='prime".$weaponClassDie."' class='".$weaponClassDie." damNum' onmousedown='incStat(event, \"".($weaponClassDie)."\")'>".$weap[1]."</h1></td></tr></table></td>";
                    }
                    else
                    {
                        if(($weap[0] == 'NAME') || ($weap[0] == 'SPECIAL'))
                            $bot= $bot."<td onmouseup='edit(event, \"prime".$weapInd."\")'><h1 contenteditable id='prime".$weapInd."' style='width:100px; ' class='".$weapInd." skillNum'  onkeyup='exitEdit()' oninput='makeEdit()'>".$weap[1]."</h1></td>";
                        else
                            $bot= $bot."<td onmousedown='incStat(event, \"".$weapInd."\")'><h1 id='prime".$weapInd."' style='width:100%; ' class='".$weapInd." skillNum'>".$weap[1]."</h1></td>";
                    }
                }
                if($topFirst)
                    echo $top;
                else
                    echo "</tr>";
                $top = null;
                $topFirst = false;
                echo $bot;
                $bot = null;
            }
            echo "</tr><tr><td colspan='5'><h1 id='".$weaponInd."' onclick='addWeaponRow()' class='noteText' style='text-align: center; color:grey'>Add Row</h1></td></tr></table></td>";
            ?>
        </table>

        <div id='noteTable' class='borderResource' style='position: absolute; top:523px; left: 820px; width: 760px; height: 324px' onkeyup='exitEdit()' oninput='makeEdit()'>
            <h1 class='statHead'>Notes</h1>    
            <h1 id='note' class='note noteText' contenteditable>Notes</h1>
        </div>

        <div id='abilityTable' class='borderResource' style='position: absolute; top:303px; left: 1220px; width: 360px; height: 175px'>
            <h1 class='statHead'>Abilities</h1>   
            <p id='ability' class='noteText'><b>Burst</b> - Increase <b>Burn</b> level up to your <b>Blaze</b>. Gain <b>Stamina</b> equal to: Change in <b>Burn</b> level + <b class='burnDie'>Burn Die</b></p>
        </div>
        <!--<div class='nodeSquare'><a href='LastFlame.php'><h1 class='statLoose'>Bonfire</h1></a></div>-->
    </div>
</body>
</html>
<script>
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
    torrent();
</script>