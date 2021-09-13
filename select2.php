<?php
	require_once "functions.php";
	$title = "Выбрать";
	require 'header.php';
	$coins = getCoinsById ();
	$countries = getCountriesById();
	$countriesn = getCountriesByName();
	$albums = getAlbumsById ();
	$collections = getCollectionsById();
	$mints = getMintsByID();
	$metals = getMetalsByID();
	$qualities = getQualitiesById();
	$lastCoin = getLastCoin();
	$continents = getContinentsById();
?>
<main>
	<div class="fixed_wide">
		<div class="flex">
			<div class="result-country h1">All</div>
			<!-- <div class="result-countr h1">All</div> -->
		</div>
		<div class="rows">
			<table class="table">
				<form method="post" action="#">
					<tr>
						<th>#</th>
						<th>id</th>
						<th>Страна<select class="select-country" name="select-country" onchange="var var1 = '.$countriesn[$i]['id_country'].'; getID(var1);">
							<option>All</option>
							<?php
							for ($i=1; $i < count($countriesn); $i++) { 
								echo '<option>'.$countriesn[$i]["name_country"].' | '.$countriesn[$i]["id_country"].'</option>';
							}
							?>
						</select></th>
						<th>Номинал</th>
						<th>Название</th>
						<th>Коллекция</th>
						<th>Год</th>
						<th>МД</th>
						<th>Тираж</th>
						<th>Металл</th>
						<th>к-во</th>
						<th>Альбом</th>
						<th>Цена</th>
						<th>k</th>
						<th>Сумма</th>
					</tr>
				</form>
				<?php
					for ($i=1; $i <= count($coins); $i++) { 
						echo "<tr class='remove'><td>".$i."</td><td onclick='var var1=".$coins[$i-1]["id_coin"]."; getID(var1); openModal2();' class='pointer'>".$coins[$i-1]['id_coin']."</td><td>".$countries[$coins[$i-1]['country']]['name_country']."</td><td>".$coins[$i-1]['denom']."</td><td>".$coins[$i-1]['name']."</td><td>".$collections[$coins[$i-1]['collection']]['name_coll']."</td><td>".$coins[$i-1]['year']."</td><td>".$mints[$coins[$i-1]['mint']]['name_mint']."</td><td>".$coins[$i-1]['circulation']."</td><td>".$metals[$coins[$i-1]['metal']-1]['name_metal']."</td><td>".$qualities[$coins[$i-1]['quality']-1]['name_q']."</td><td>".$albums[$coins[$i-1]['album']]['name_album']."</td><td>".$coins[$i-1]['price']."$</td><td>".$coins[$i-1]['quantity']."</td><td>".$coins[$i-1]['price']*$coins[$i-1]['quantity']."$</td></tr>";
					}
				?>
			</table>
			<div class="select-data"
				data-countryID='<?= $countriesn[$i]["id_country"] ?>'
  			></div>
		</div>	
	</div>
	<script src="script/script.js"></script>
	<div class="modal"></div>
</main>
<?php
	require 'footer.php';
?>