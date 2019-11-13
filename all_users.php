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
		 throw new PDOException($e->getMessage(), (int)$e->getCode());
	}
	$stmt = $pdo->query('select users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id');
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