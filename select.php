<?php
	require_once "functions.php";
	$title = "Выбрать";
	require 'header.php';
	$countriesn = getCountriesByName ();
	$denom = getDistinctDenom ();
	$coll = getCollectionsByName ();
	$metal = getMetalsByName ();
	$qua = getQualitiesById ();
	$mint = getMintsByName ();
?>
<main>
	<div class="fixed">
		<?php
			// country 
			echo '<form method="post" action="#"> <div class="formdiv">';
			echo '<input type="checkbox" id="country" name="select" value="country">';
			echo '<label for="country">Страна</label>';
			echo ' <select class="select">';
			for ($i=1; $i < count($countriesn); $i++) { 
				echo '<option>'.$countriesn[$i]["name_country"].'</option>';
			}
			echo "</select>";
			echo "</div>";
			// denom
			echo '<div class="formdiv"><input type="checkbox" id="denom" name="select" value="denom">';
			echo '<label for="denom">Номинал</label>';
			echo " <select>";
			for ($i=0; $i < count($denom); $i++) { 
				echo '<option>'.$denom[$i]["denom"].'</option>';
			}
			echo "</select>";
			echo "</div>";
			// collection
			echo '<div class="formdiv"><input type="checkbox" id="coll" name="select" value="coll">';
			echo '<label for="coll">Коллекция</label>';
			echo " <select>";
			for ($i=0; $i < count($coll); $i++) { 
				echo '<option>'.$coll[$i]["name_coll"].'</option>';
			}
			echo "</select>";
			echo "</div>";
			// year
			echo '<div class="formdiv"><input type="checkbox" id="year" name="select" value="year">';
			echo '<label for="year">Год</label>';
			echo ' <select class="math"> <option>=</option> <option><</option> <option>></option> </select> &nbsp;';
			echo '<input class="year"> </input>';
			echo "</div>";
			// mint
			echo '<div class="formdiv"><input type="checkbox" id="mint" name="select" value="mint">';
			echo '<label for="mint">Монетный двор</label>';
			echo " <select>";
			for ($i=0; $i < count($mint); $i++) { 
				echo '<option>'.$mint[$i]["longname"].'</option>';
			}
			echo "</select>";
			echo "</div>";
			// metal
			echo '<div class="formdiv"><input type="checkbox" id="metal" name="select" value="metal">';
			echo '<label for="metal">Металл</label>';
			echo " <select>";
			for ($i=0; $i < count($metal); $i++) { 
				echo '<option>'.$metal[$i]["name_metal"].'</option>';
			}
			echo "</select>";
			echo "</div>";
			// quality
			echo '<div class="formdiv"><input type="checkbox" id="qua" name="select" value="qua">';
			echo '<label for="qua">Состояние</label>';
			echo " <select>";
			for ($i=0; $i < count($qua); $i++) { 
				echo '<option>'.$qua[$i]["name_q"].'</option>';
			}
			echo "</select>";
			echo "</div>";
			// price
			echo '<div class="formdiv"><input type="checkbox" id="price" name="select" value="price">';
			echo '<label for="price">Цена</label>';
			echo ' <select class="math"> <option>=</option> <option><</option> <option>></option> </select> &nbsp;';
			echo '<input class="year"> </input>';
			echo "</div>";
			// quantity
			echo '<div class="formdiv"><input type="checkbox" id="k" name="select" value="k">';
			echo '<label for="k">Количество</label>';
			echo ' <select class="math"> <option>=</option> <option><</option> <option>></option> </select> &nbsp;';
			echo '<input class="year"> </input>';
			echo "</div>";
			// button
			echo '<div class="formdiv"><input type="submit" value="search" onclick="selectCoin();"></div>';
			echo "</form>";
		?>
		<div class="rows"></div>
		<script src="script/script.js"></script>
		<!-- modal -->
		<div class="modal"></div>
	</div>
</main>
<?php
	require 'footer.php';
?>