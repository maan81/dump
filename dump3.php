<?php
ini_set('max_execution_time',900);
/**
 * @author zerokavn@gmail.com
 * **/

// require_once('config.php');


function filter($str){

	$str = explode('<![CDATA[', $str)[1];
	$str = explode(']]>', $str)[0];
	
	// <![CDATA[Concord Women's Delirium Watch]]>

	// Concord Women's Delirium Watch]]>

	return $str;
}



$con = mysqli_connect("localhost", 'root', 'password','woy_91ee1d631');


$res = mysqli_query($con,"SELECT * FROM `products`");

$data = array();

while($row = mysqli_fetch_assoc($res)){

	$data[] = array(
				'productID' => $row['productID'],
				'name'=> filter($row['name'])	,
				'description'=> substr(filter($row['description']), 1,-1)   ,
				'price'=>	$row['price'],
				'buyurl'=> filter($row['buyurl'])	,
				'imageurl'=> filter($row['imageurl']),
				'programname'=>$row['programname'],
				'sku'=>$row['sku'],
				'impressionurl'=> filter($row['impressionurl']),
			);
}



$res = mysqli_query($con,"TRUNCATE `products`");


$sql = 	'INSERT INTO `products` ('.

		'	productID, name, description, '.
		'	price, buyurl, imageurl, '.
		'	programname, sku, impressionurl ' .

		') VALUES ';

$i=0;
foreach($data as $key=>$val){ //if($i==5) break; $i++;

	if($i) $sql .= ', '; else $i++;

	$sql .= '('.

				$val['productID'].', '.
				'"'.$val['name'].'", '.
				'"'.$val['description'].'", '.
				'"'.$val['price'].'", '.
				'"'.$val['buyurl'].'", '.
				'"'.$val['imageurl'].'", '.
				'"'.$val['programname'].'", '.
				'"'.$val['sku'].'", '.
				'"'.$val['impressionurl'].'" '.

			')' ;
}

// echo $sql; die;


mysqli_query($con,$sql);


mysqli_close($con);
