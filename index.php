<?php
	require_once("config.php");

	$con = mysqli_connect('localhost', $db_user, $db_pass,$db_name);


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

	// $res = mysqli_query($con,"SELECT redirecturl, title FROM `products` LIMIT 100");
	$res = mysqli_query($con,"SELECT * FROM `products` LIMIT 100");

	$links = array();

	while($row = mysqli_fetch_assoc($res))

	{
		// $links[] = '<a href="' . $row["redirecturl"] . '" target="_blank">' . $row["title"] . '</a>';
		$links[] = '<a href="' . $row["buyurl"] . '" target="_blank">' . $row["name"] . '</a>';
	}



	shuffle($links);

	$links = array_slice($links, 0, 8);

	$menu = implode("<br />", $links);

	$sql = "SELECT * FROM `products` WHERE productID = $p";

	$res = mysqli_query($con, $sql);

	$row = mysqli_fetch_assoc($res);

	// echo str_replace(

	// 	array("%title%", "%image%", "%redirecturl%", "%menu%"),

	// 	// array($row["title"], $row["image"], $row["redirecturl"], $menu),
	// 	array($row["title"], $row["imageurl"], $row["buyurl"], $menu),

	// 	// file_get_contents($valid_referer ? "../sitetemplate/template2.html" : "../sitetemplate/template.html")
	// 	file_get_contents("template.html")

	// );

	
	mysqli_close($con);

	include('template.php');
?>