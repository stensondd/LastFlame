<?php
session_start();
if(isset($_SESSION['Profile']))
{
    header('Location: PlayerDashboard.php');
}
else
{
    echo '<form id="playerForm" action="PlayerDashboard.php" method="post" target="_self">';
    $players = ['Matt', 'Chad', 'Drew', 'Isaac'];
    echo "<select id='profile' onchange='setPlayer()' name='Profile'>";
    echo "<option value=''></option>";
    foreach($players as $ind => $player)
    {
        echo "<option value=".$ind.">".$player."</option>";
    }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function setPlayer()
    {
        val = document.getElementById("profile").value;
        console.log(val);
        document.getElementById("playerForm").submit();
    }
</script>
<html id="fold">
</html>
<?php
/*if(!isset(($_SESSION['Profile'])))
{

    function fetchIt (serializedData)
    {
        request = $.ajax(
        {
            url: "LastFlame.php",
            type: "post",
            data: serializedData,
        }).done(function(data, status, response)
        {
            console.log(response); 
            ech = response.responseText;
            document.getElementById("fold").innerHTML = response.responseText;
        }
        ).fail(function(status) {
            alert(status);
        });
    }
    echo 
    '<script>
    exit();
}*/
?>