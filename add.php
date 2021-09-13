<?php
	require_once "functions.php";
	$title = "Добавить";
	require 'header.php';
?>
<main>
	<div class="fixed">
		<form method="post" action="#">
			<input type="text" name="name" class="nameField" placeholder="Введите имя">
			<input type="text" name="surname" class="surnameField" placeholder="Введите фамилию">
			<input type="text" name="age" class="ageField" placeholder="Введите возраст"> 
			<input type="submit" value="enter" class="button">
		</form>

		<table class="rows"></table>
	</div>
</main>
<?php
	require 'footer.php';
?>