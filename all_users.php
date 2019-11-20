<?php
	$host = 'localhost';
	$db   = 'my_activities';
	$user = 'root';
	$pass = 'root';
	$charset = 'utf8';
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];
	try {
		 $pdo = new PDO($dsn, $user, $pass, $options);
	} catch (PDOException $e) {
		 throw new PDOException($e->POSTMessage(), (int)$e->POSTCode());
	}
	$stmt = $pdo->query("select users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id where s.id = 2 and username like 'e%' order by username");
?>

<?php
	$start_letter = 'e';
	$status_id = 2;
	$sql = "select users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id where username like '$start_letter%' and status_id = $status_id order by username";
	$stmt = $pdo->query($sql);
?>

<form method="POST" action="all_users.php">

	<p>Start with letter : <input type="text" name="lettre"> and status is : 
	<select name="status">
		<option value="2">Active account</option>
		<option value="1">Waiting for account validation</option>
	</select>
	<input type="submit" value="OK"></p> 
</form>

<?php

	if (isset($_POST['status']) && isset($_POST['lettre'])) {
		
		if (strlen($_POST['lettre']) == 1) {
			$start_letter = $_POST['lettre'];
		} else {
			echo 'Erreur nb de lettres';
		}
	
		$status_id = $_POST['status'] ;
		
		
		$sql = "select users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id where username like '$start_letter%' and status_id = $status_id order by username";
		$stmt = $pdo->query($sql);
		
	} else {
		$sql = "select users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id order by username";
		$stmt = $pdo->query($sql);
	}
?>

<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
    </tr>
    <?php while ($row = $stmt->fetch()) { ?>
    <tr>
        <td><?php echo $row['user_id']?></td>
        <td><?php echo $row['username']?></td>
        <td><?php echo $row['email']?></td>
        <td><?php echo $row['status']?></td>
    </tr>
    <?php } ?>
</table>