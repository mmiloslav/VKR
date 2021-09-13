<?php
	require_once "functions.php";
	$title = "Страны";
	require 'header.php';
	$continents = getContinentsByName();
	$countries = getCountriesByName();
	$coins = getCoinsByID();
	$countriesid = getCountriesById();
	$qualities = getQualitiesById();
?>
<main>
	<div class="fixed" id="fixed">
		<form method="post" action="#">
		<?php
			echo '<ul class="flex remove">';
			for ($i=1; $i < count($continents); $i++) {
				echo '<li><input type="submit" value="'.$continents[$i]["name_cont"].'" class="button b_button button_cont" onclick="var var1 = '.$continents[$i]["id_continent"].'; getID(var1);"><ul>';
				for ($j=0; $j < count($countries); $j++) { 
					if ($countries[$j]["continent"]  == $continents[$i]["id_continent"])
						echo '<li><img class="flag" src="img/flags/'.$countries[$j]['id_country'].'.png"><input type="submit" value="'.$countries[$j]["name_country"].'" class="button s_button button_cntry" onclick="var var1 = '.$countries[$j]["id_country"].'; getID(var1);"></li>';
				}
				echo '</ul></li>';
			}
			echo '</ul>';
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