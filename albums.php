<?php
	require_once "functions.php";
	$title = "Альбомы";
	require 'header.php';
	$albums = getAlbumsByLevelName ();
?>
<main>
	<div class="fixed" id="fixed">
		<form method="post" action="#">
		<?php
			echo '<ul class="flex remove"><li><div class="b_button">Основные</div><ul>';
			for ($i=0; $i < count($albums); $i++) { 
				if ($albums[$i]["level"] == "1")
					echo '<li><input type="submit" value="'.$albums[$i]["name_album"].'" class="button s_button button_alb" onclick="var var1 = '.$albums[$i]["id_album"].'; getID(var1);"></li>';
			}
			echo '</ul></li>';
			echo '<li><div class="b_button">Коллекционные</div><ul>';
			for ($i=0; $i < count($albums); $i++) { 
				if ($albums[$i]["level"] == "2")
					echo '<li><input type="submit" value="'.$albums[$i]["name_album"].'" class="button s_button button_alb" onclick="var var1 = '.$albums[$i]["id_album"].'; getID(var1);"></li>';
			}
			echo '</ul></li><li><input type="submit" value="Без альбома" class="button b_button button_alb" onclick="var var1 = 0; getID(var1);"></li></ul>';

		?>
		</form>
		<div class="rows"></div>
		<script src="script/script.js"></script>
		<!-- modal -->
		<div class="modal"></div>
	</div>
</main>
<?php
	require 'footer.php';
?>