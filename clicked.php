<?
$mysqli = new Mysqli('localhost', 'root', '123', 'coins_db');

/** Получаем наш ID статьи из запроса */
$countryID = intval($_POST['ID']);

/** Если нам передали ID то обновляем */

//извлекаем все записи из таблицы
$query1 = $mysqli->query("SELECT * FROM `coins` ORDER BY `id_coin`");
$query2 = $mysqli->query("SELECT * FROM `countries` ORDER BY `id_country`");
$query3 = $mysqli->query("SELECT * FROM `collections` ORDER BY `id_coll`");
$query4 = $mysqli->query("SELECT * FROM `mints` ORDER BY `id_mint`");
$query5 = $mysqli->query("SELECT * FROM `metals` ORDER BY `id_metal`");
$query6 = $mysqli->query("SELECT * FROM `qualities` ORDER BY `id_q`");
$query7 = $mysqli->query("SELECT * FROM `albums` ORDER BY `id_album`");
$query8 = $mysqli->query("SELECT * FROM `Continents` ORDER BY `id_continent`");


while($row1 = $query1->fetch_assoc()){
	$coins['id_coin'][] = $row1['id_coin'];
	$coins['country'][] = $row1['country'];
	$coins['denom'][] = $row1['denom'];
	$coins['name'][] = $row1['name'];
	$coins['collection'][] = $row1['collection'];
	$coins['year'][] = $row1['year'];
	$coins['mint'][] = $row1['mint'];
	$coins['circulation'][] = $row1['circulation'];
	$coins['metal'][] = $row1['metal'];
	$coins['quality'][] = $row1['quality'];
	$coins['album'][] = $row1['album'];
	$coins['price'][] = $row1['price'];
	$coins['quantity'][] = $row1['quantity'];
}

while($row2 = $query2->fetch_assoc()){
	$countries['id_country'][] = $row2['id_country'];
	$countries['name_country'][] = $row2['name_country'];
	$countries['continent'][] = $row2['continent'];
}

while($row3 = $query3->fetch_assoc()){
	$collections['name_coll'][] = $row3['name_coll'];
}

while($row4 = $query4->fetch_assoc()){
	$mints['name_mint'][] = $row4['name_mint'];
	$mints['longname'][] = $row4['longname'];
}

while($row5 = $query5->fetch_assoc()){
	$metals['name_metal'][] = $row5['name_metal'];
}

while($row6 = $query6->fetch_assoc()){
	$qualities['name_q'][] = $row6['name_q'];
}

while($row7 = $query7->fetch_assoc()){
	$albums['name_album'][] = $row7['name_album'];
}

while($row8 = $query8->fetch_assoc()){
	$continents['name_cont'][] = $row8['name_cont'];
}

// 
$message = 'Все хорошо';

/** Возвращаем ответ скрипту */

// Формируем масив данных для отправки
$out = array(
	'message' => $message,
	'coins' => $coins,
	'countries' => $countries,
	'collections' => $collections,
	'mints' => $mints,
	'metals' => $metals,
	'qualities' => $qualities,
	'albums' => $albums,
	'continents' => $continents
);

// Устанавливаем заголовот ответа в формате json
header('Content-Type: text/json; charset=utf-8');

// Кодируем данные в формат json и отправляем
echo json_encode($out);