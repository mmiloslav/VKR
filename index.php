<?php
	require_once "functions.php";
	$title = "Главная";
	require 'header.php';
	$coins = getCoinsById ();
	$countries = getCountriesById();
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
		<div class="fixed"><div class="fixed flex top_block">
			<?php
				echo "<div> <div class='index-head'>Статистика</div>";
				echo "<div>"; 
				$total = 0;
				for ($i=0; $i < count($coins); $i++) { 
					$total = $total + $coins[$i]["quantity"];
				}
				$repeated = $total - count($coins);
				$kcountries = count($countries) - 1;
				$kcollections = count($collections) - 1;
				echo '<div class="index-info">Всего монет:&nbsp;<div class="b_button">'.$total.'</div></div>';
				echo '<div class="index-info">Уникальных:&nbsp;<div class="b_button">'.count($coins).'</div></div>';
				echo '<div class="index-info">Повторных:&nbsp;<div class="b_button">'.$repeated.'</div></div>';
				echo "<br>";
				$sum = 0;
				for ($i=0; $i < count($coins); $i++) { 
					$sum = $sum + $coins[$i]["price"] * $coins[$i]["quantity"];
				}
				echo '<div class="index-info">Стоимость:&nbsp;<div class="b_button">'.$sum.'$</div></div>';
				// dollar rate
				$content = get_content();
	  			$pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
	  			preg_match_all($pattern, $content, $out, PREG_SET_ORDER);
	  			$dollar = "";
	  			foreach($out as $cur) {
	    			if($cur[2] == 840) $dollar = str_replace(",",".",$cur[4]);
	  			}

				function get_content() {
	    			$date = date("d/m/Y"); // Формируем сегодняшнюю дату
	    			$link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date; // Формируем ссылку
	    			$fd = @fopen($link, "r"); // Загружаем HTML-страницу
	   				$text="";
	    			if (!$fd) echo "Сервер ЦБ не отвечает";
	    			else {
	      				while (!feof ($fd)) $text .= fgets($fd, 4096); // Чтение содержимого файла в переменную $text
	      				fclose ($fd); // Закрыть открытый файловый дескриптор
	    			}
	    			return $text;
				}
				// 
				$dollar = round($dollar, 2);
				echo '<div class="index-info">Курс доллара:&nbsp;<div class="b_button">'.$dollar.' RUB</div></div>';
				$rsum = round($sum * $dollar, 0);
				echo '<div class="index-info">Стоимость:&nbsp;<div class="b_button">'.$rsum.' RUB</div></div>';
				echo "<br>";
				echo '<div class="index-info">Страны:&nbsp;<div class="b_button">'.$kcountries.'</div></div>';
				echo '<div class="index-info">Коллекции:&nbsp;<div class="b_button">'.$kcollections.'</div></div>';
				echo '</div></div><div><div class="index-head">Материки</div><div>';
				// материки
				$k = 0;
				for ($c=1; $c < count($continents); $c++) { 
					for ($i=0; $i < count($countries); $i++) {
						if($countries[$i]['continent'] == $c) {
							for ($j=0; $j < count($coins); $j++) { 
					 			if ($coins[$j]['country'] == $countries[$i]['id_country']) {
					 				$k++;
					 			}
					 		}
						}
				 	}
				 	$n[$c] = $k;
				 	echo '<div class="index-info">'.$continents[$c]['name_cont'].':&nbsp;<div class="b_button nc'.$continents[$c]['id_continent'].'">'.$n[$c].'</div></div>';
				 	$k = 0;
				}
				?>
				<!-- запись количества монет по материкам в скрытый блок -->
				<div class="diagram-data"
					data-na='<?= $n[1] ?>'
  					data-sa='<?= $n[2] ?>'
  					data-eu='<?= $n[3] ?>'
  					data-as='<?= $n[4] ?>'
  					data-af='<?= $n[5] ?>'
  					data-au='<?= $n[6] ?>'

  				></div>
				<?php
				echo '</div><div class="diagram" id="air"></div></div><div><div class="index-head">Альбомы</div><div>';
				// echo '</div></div><div><div class="index-head">Альбомы</div><div>';
				// альбомы
				$k = 0;
				for ($i=1; $i < count($albums); $i++) { 
					if ($albums[$i]['level'] == 1) {
						for ($j=0; $j < count($coins); $j++) { 
							if($coins[$j]['album'] == $i) {
								$k++;
							}
						}
						echo '<div class="flex"><div class="index-info">'.$albums[$i]['name_album'].'</div><div class="h1_g">&nbsp;|&nbsp;'.$k.'&nbsp;/&nbsp;'.$albums[$i]['space'].'</div></div>';
						$k = 0;
					}
				}
				echo '</div></div>'
			?>
		</div>
		<!-- <div class="diagram" id="air"></div> -->
		<div class="h1-line h1-line-index flex">
			<div class="index-head lc">Последняя монета</div>
			<div class="font"><form method="post" action="#" class="font-size-form"><button type="button" name="12px" onclick="make12();">12px</button><button type="button" name="14px" onclick="make14();">14px</button><button type="button" name="16px" onclick="make16();">16px</button></form></div>
		</div>
		</div>
		<div class="fixed_wide">
			<?php
			// последняя монета
				echo '<table class="table"><tr><th>id</th><th>Страна</th><th>Номинал</th><th>Название</th><th>Коллекция</th><th>Год</th><th>МД</th><th>Тираж</th><th>Металл</th><th>к-во</th><th>Альбом</th><th>Цена</th><th>k</th><th>Сумма</th></tr>';
				echo '<tr><td>'.$lastCoin[0]['id_coin'].'</td><td>'.$countries[$lastCoin[0]['country']]['name_country'].'</td><td>'.$lastCoin[0]['denom'].'</td><td>'.$lastCoin[0]['name'].'</td><td>'.$collections[$lastCoin[0]['collection']]['name_coll'].'</td><td>'.$lastCoin[0]['year'].'</td><td>'.$mints[$lastCoin[0]['mint']]['name_mint'].'</td><td>'.$lastCoin[0]['circulation'].'</td><td>'.$metals[$lastCoin[0]['metal']-1]['name_metal'].'</td><td>'.$qualities[$lastCoin[0]['quality']-1]['name_q'].'</td><td>'.$albums[$lastCoin[0]['album']]['name_album'].'</td><td>'.$lastCoin[0]['price'].'$</td><td>'.$lastCoin[0]['quantity'].'</td><td>'.$lastCoin[0]['price']*$lastCoin[0]['quantity'].'$</td></tr></table>';

			// фото
				echo '<div class="fixed"><img onclick="openModal();" class="last_coin_ph" src=img/coins_ph/'.$lastCoin[0]['id_coin'].'.jpeg alt="'.$lastCoin[0]['id_coin'].'"></div>';
			?>
		</div>
		<!-- modal -->
		<div class="modal-overlay" id="modal-overlay">
			<div class="modal_div" id="modal_div">
				<div class="flex">
					<div class="x"><img onclick="closeModal();" src="img/x.png"></div>
					<div class="modal_text">
						<?php
							echo $countries[$lastCoin[0]['country']]['name_country'].'&nbsp;|&nbsp;'.$lastCoin[0]['denom'].'&nbsp;|&nbsp;'.$lastCoin[0]['name'].'&nbsp;|&nbsp;'.$lastCoin[0]['year'].'&nbsp;|&nbsp;'.$qualities[$lastCoin[0]['quality']-1]['name_q'];
						?>
					</div>
				</div>
				<?php
					echo '<img class="modal_photo" src=img/coins_ph/'.$lastCoin[0]['id_coin'].'.jpeg alt="'.$lastCoin[0]['id_coin'].'">';
				?>
			</div>
		</div>
	</div>
	<script src="https://www.google.com/jsapi"></script>
	<script src="script/script.js"></script>
</main>
<?php
	require 'footer.php';
?>