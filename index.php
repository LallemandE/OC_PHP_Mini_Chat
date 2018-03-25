<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Mini Chat</title>
</head>
<body>
	<form action="minichat_post.php" method="POST">
		<label for="pseudo">Pseudonyme</label>
		<input type="text" name="pseudo" id="pseudo" />
		<label for="message">Message</label>
		<input type="text" id="message" name="msg" />		
		<input type="submit" value="SEND" />
	</form>
	
<?php 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
	
}
catch (Exception $e)
{
        die ('Error = ' . $e->getMessage());
}

$chatStatement = $bdd->prepare('SELECT id, pseudo, msg FROM chat ORDER BY id DESC LIMIT 0,10');

$chat = $chatStatement->execute();


if (! $chat){
	echo '$chat est FALSE<br>';
	$arr = $chatStatement->errorInfo(); 
	print_r($arr);

	die("mince alors !");
}

?>

	<table>
		<tr><td>ID</td><td>PSEUDO</td><td>Message</td></tr>

<?php 

	while($chatContent = $chatStatement->fetch()) {


	echo '<tr><td>'. $chatContent['id'] . '</td><td>'. htmlspecialchars($chatContent['pseudo']) . '</td><td>' . htmlspecialchars($chatContent['msg']) . '</td></tr>';
    
}
$chatStatement->closeCursor();
?>	

	</table>	
</body>
</html>
