<?php

// workout path to database so sqlite/pdo can connect
$root = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;

// Connect to database, quert, handle errors
$pdo = new PDO($dsn);
$stmt = $pdo->query(
	'SELECT
		title, created_at, body
	FROM
		post
	ORDER BY
		created_at DESC'
);
if ($stmt === false)
{
	throw new Exception('There was a problem running this query');
}
?>

<!DOCTYPE html>

<html>

<head>
	<title>George's Blog</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>

<body>

	<h1>George's Blog</h1>

	<p>Follow me as I learn web dev and build stuff.</p>


	<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
		<h2 class="title">
			<?php echo htmlspecialchars($row['title'], ENT_HTML5, 'UTF-8') ?>
		</h2>
		<div class="date">
			<?php echo $row['created_at'] ?>
		</div>
		<p class="sum">
			<?php echo htmlspecialchars($row['body'], ENT_HTML5, 'UTF-8') ?>
		</p>
		<p class="link-p"><a href="#">Read more...</a></p>
	<?php endwhile ?>

</body>

</html>