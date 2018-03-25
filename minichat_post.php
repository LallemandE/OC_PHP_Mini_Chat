<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die ('Error = ' . $e->getMessage());
}



$sqlQuery = 'INSERT INTO chat (pseudo, msg) VALUES (:pseudo , :msg)';
$req = $bdd->prepare($sqlQuery);
$req->bindValue('pseudo', $_POST['pseudo'] ?? null);
$req->bindValue('msg', $_POST['msg'] ?? null);
$req->execute();

header('location: index.php');
?>
