<!DOCTYPE html>

<html lang="en">
    <head>
        <!--
        Author: Hazel Parys, Logan Allender, Anthony Bychowski
        Date: 4/10/2024
        -->
        <meta charset="UTF-8">
        <meta name="author" content="Hazel Parys, Logan Allender, Anthony Bychowski">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
        <!-- Bootstrap css -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="./assess/css/styles.css">
        <title><?php echo (isset($pageTitle)) ? $pageTitle : 'Some Content Site'; ?></title>
    </head>
    <body>
		<div class="header">
			<img src="./assess/img/logo.png" alt="Company Logo">
			<nav>
				<a href="index.php">Home</a>
				<a href="prediction.php">Prediction</a>
				<a href="stats.php">Statistics</a>
				<a href="repo.php">Repositories</a>
			</nav>
		</div>