<?php
require_once '../src/HTMLComponents.php';
$dirs = scandir('C:\laragon\www\p4e\lars');


$pages = array_filter($dirs, function ($file) {
	return preg_match('/\.(php|html)$/', $file);
});


$dirredPages = array_combine(
	array_map(fn($page) => strtok($page, '.') === "index" ? "Home" : ucfirst(strtok($page, '.')), $pages), // Remove anything after the first '.' and uppercase first letter.
	array_map(fn($page) => basename($_SERVER['PHP_SELF']) == $page ? '__CURR' : $page, $pages), // Rename to '__CURR' if it's the same page as this one.
);
?>


<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<link rel="stylesheet" href="../src/styling/stylesheet.css">
	<title>Document</title>
</head>
<body>
	<header>
		<?= HTMLComponents::NavBar($dirredPages) ?>
	</header>
	<br>
	<main>
		<section style="
			display: flex;
			width: 1250px !important;
			justify-content: center;
			justify-self: center;
			flex-direction: column;
		">
			<span style="text-align: center">Results: 0</span>
			<br>
			<?= HTMLComponents::SearchBar(styling: "width: 500px;", id: 'searchpage-searchbar', inputFirst: false) ?>
			<br>
			<table id="game-table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">Price(&euro;)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="col">10</th>
						<td>Counter-Strike</td>
						<td>8.19</td>
					</tr>
				</tbody>
			</table>
		</section>
	</main>
<script type="module" src="src/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
