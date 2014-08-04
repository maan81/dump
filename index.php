<?php

	require_once("config.php");



	$con = mysql_connect(localhost, $db_user, $db_pass);

	mysql_select_db($db_name, $con);



	$p = isset($_GET["p"]) ? intval($_GET["p"]) : 1;

	$valid_referer = false;

	if(isset($_SERVER["HTTP_REFERER"]))

	{

		if(($authorized = @file_get_contents("../basket/authorized.txt")) === false)

		{

			$authorized = @file_get_contents("../basket/authorized2.txt");		

		}

		$array = parse_url($_SERVER["HTTP_REFERER"]);

		if(substr($array["host"], 0, 4) == "www.")

		{

			$array["host"] = substr($array["host"], 4);

		}

		$valid_referer = (strpos(" {$authorized}", $array["host"]) !== false);

	}

	$res = mysql_query("SELECT redirecturl, title FROM `products` LIMIT 100", $con);

	$links = array();

	while($row = mysql_fetch_assoc($res))

	{

		$links[] = '<a href="' . $row["redirecturl"] . '" target="_blank">' . $row["title"] . '</a>';



	}

	shuffle($links);

	$links = array_slice($links, 0, 8);

	$menu = implode("<br />", $links);

	$res = mysql_query("SELECT * FROM `products` WHERE id = {$p}", $con);

	$row = mysql_fetch_assoc($res);

	echo str_replace(

		array("%title%", "%image%", "%redirecturl%", "%menu%"),

		array($row["title"], $row["image"], $row["redirecturl"], $menu),

		file_get_contents($valid_referer ? "../sitetemplate/template2.html" : "../sitetemplate/template.html")

	);

	

	mysql_close($con);

?>