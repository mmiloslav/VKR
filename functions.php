<?php
	$mysqli = false;
	function connectDB () {
		global $mysqli;
		global $orderby;
		$mysqli = new mysqli("localhost", "root", "123", "coins_db");
		$mysqli->query("SET NAMES 'utf-8'");
	}

	function closeDB () {
		global $mysqli;
		$mysqli->close ();
	}

	// albums

	function getAlbumsById () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `albums` ORDER BY `id_album`");

		closeDB();

		return resultToArray ($result);
	}

	function getAlbumsByLevelName () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `albums` ORDER BY `level`, `name_album`");

		closeDB();

		return resultToArray ($result);
	}

	// coins

	function getCoinsById () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `coins` ORDER BY `id_coin`");

		closeDB();

		return resultToArray ($result);
	}

	function getDistinctDenom () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT DISTINCT `denom` FROM `coins`");

		closeDB();

		return resultToArray ($result);
	}

	function getLastCoin () {
		global $mysqli;
		connectDB();
		// $result = $mysqli->query("SELECT * FROM `coins` WHERE `id_coin`=(SELECT max(`id_coin`) FROM `coins`)");
		$result = $mysqli->query("SELECT * FROM `coins` ORDER BY `id_coin` DESC LIMIT 1");

		closeDB();

		return resultToArray ($result);
	}

	// collections

	function getCollectionsById () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `collections` ORDER BY `id_coll`");

		closeDB();

		return resultToArray ($result);
	}

	function getCollectionsByName () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `collections` ORDER BY `name_coll`");

		closeDB();

		return resultToArray ($result);
	}

	function getDistinctCountry () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT DISTINCT `country` FROM `collections`");

		closeDB();

		return resultToArray ($result);
	}

	// continents

	function getContinentsById () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `Continents` ORDER BY `id_continent`");

		closeDB();

		return resultToArray ($result);
	}

	function getContinentsByName () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `Continents` ORDER BY `name_cont`");

		closeDB();

		return resultToArray ($result);
	}

	// countries

	function getCountriesById () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `countries` ORDER BY `id_country`");

		closeDB();

		return resultToArray ($result);
	}

	function getCountriesByName () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `countries` ORDER BY `name_country`");

		closeDB();

		return resultToArray ($result);
	}

	// metals

	function getMetalsById () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `metals` ORDER BY `id_metal`");

		closeDB();

		return resultToArray ($result);
	}

	function getMetalsByName () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `metals` ORDER BY `name_metal`");

		closeDB();

		return resultToArray ($result);
	}

	// mints

	function getMintsById () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `mints` ORDER BY `id_mint`");

		closeDB();

		return resultToArray ($result);
	}

	function getMintsByName () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `mints` ORDER BY `name_mint`");

		closeDB();

		return resultToArray ($result);
	}

	// qualities

	function getQualitiesById () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `qualities` ORDER BY `id_q`");

		closeDB();

		return resultToArray ($result);
	}

	// others

	function resultToArray ($result) {
		$array = array ();
		while (($row = $result->fetch_assoc()) != false)
			$array[] = $row;
		return $array;
	}
?>