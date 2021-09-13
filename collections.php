<?php
	require_once "functions.php";
	$title = "Коллекции";
	require 'header.php';
	$countries = getCountriesByName ();
	$dist = getDistinctCountry ();
	$collections = getCollectionsByName ();
?>
<main>
	<div class="fixed" id="fixed">
		<form method="post" action="#">
		<?php
			echo '<ul class="flex remove">';
				for ($i=1; $i < count($countries); $i++) {
					for ($j=0; $j < count($dist); $j++) {
						if ($dist[$j]["country"] == $countries[$i]["id_country"]) {
							echo '<li><input type="submit" value="'.$countries[$i]["name_country"].'" class="button b_button button_cntry" onclick="var var1 = '.$countries[$i]["id_country"].'; getID(var1);"><ul>';
							for ($l=0; $l < count($collections); $l++) { 
								if ($collections[$l]["country"] == $countries[$i]["id_country"])
									echo '<li class="h3"><input type="submit" value="'.$collections[$l]["name_coll"].'" class="button s_button button_coll" onclick="var var1 = '.$collections[$l]["id_coll"].'; getID(var1);"></li>';
							}
							echo '</ul></li>';
						}
					}
				}
				echo '<li><div class="b_button">Прочее</div><ul>';
				for ($i=0; $i < count($collections); $i++) {
					if ($collections[$i]["country"] == "0")
						echo '<li><input type="submit" value="'.$collections[$i]["name_coll"].'" class="button s_button button_coll" onclick="var var1 = '.$collections[$i]["id_coll"].'; getID(var1);"></li>';
				}
			echo '</li></ul></ul>';
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