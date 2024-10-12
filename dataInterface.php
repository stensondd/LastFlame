<?php
session_start();
if(isset($_SESSION['Profile']))
{
    $db = new PDO('mysql:host=127.0.0.1:3306;dbname=lastFlame;charset=utf8mb4', 'root', 'NCC-1701');
    $selectQuery = $db->prepare("SELECT * FROM stat WHERE idPlayer=?");
    $selectInput = array($_SESSION['Profile']);
    $selectQuery->execute($selectInput);
    $select = $selectQuery->fetchAll(PDO::FETCH_ASSOC);

    $update = false;

    if(isset($_POST['id']) && isset($_POST['val']))
    {
        foreach($select as $selectLine)
        {
            if($selectLine['idStat'] == $_POST['id'])
            {
                $update = true;
            }    
        }
        if($update)
        {
            $updateQuery = $db->prepare("UPDATE stat SET statValue=? WHERE idPlayer=? AND idStat=?");
            $updateInput = array($_POST['val'], $_SESSION['Profile'], $_POST['id']);
            $updateQuery->execute($updateInput);
            echo "UPDATE";
        }
        else
        {
            $createQuery = $db->prepare("INSERT stat (idPlayer, idStat, statValue) VALUES (?, ?, ?)");
            $createInput = array($_SESSION['Profile'], $_POST['id'], $_POST['val']);
            $createQuery->execute($createInput);
            echo "INSERT";
        }

    }
    else
    {
        echo json_encode($select); 
    }
}
?>