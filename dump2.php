<?php
ini_set('max_execution_time',900);
/**
 * @author zerokavn@gmail.com
 * **/

require_once('config.php');



function parse_xml($str){

	$tmparr = ['name','description','price','buyurl','imageurl','programname','sku','impressionurl','productID'];

	foreach($tmparr as $val){
	
		$tmp = explode('<'.$val.'>', $str)[1];
		$data[$val] = addslashes(explode('</'.$val.'>', $tmp)[0]);
		$str = explode('</'.$val.'>', $tmp)[1];

	}

	return $data;
}





$handle = @fopen("./54/file.xml", "r");
if ($handle) {

	$con = mysql_connect("localhost", 'root', 'password');
	mysql_select_db('woy_91ee1d631', $con);

	$i=0;
    while (($buffer = fgets($handle, 4096)) !== false) {

        $data =  parse_xml($buffer);

		$sql = "INSERT INTO `products`(`name`,`description`,`price`,`buyurl`,`imageurl`,`programname`,`sku`,`impressionurl`,`productID`) ".
				"VALUES ('".$data['name']."','".$data['description']."','".$data['price']."','".$data['buyurl']."','".
							$data['imageurl']."','".$data['programname']."','".$data['sku']."','".$data['impressionurl']."','".
							$data['productID']."')";
		mysql_query($sql, $con);

		// echo $sql;

		// if($i==10) break;

		echo $i.'    ';

        $i++;
    }


    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
	mysql_close($con);
}









// 	$con = mysql_connect("localhost", $db_user, $db_pass);
// 	mysql_select_db($db_name, $con);
		


// 	$lines = explode(PHP_EOL, file_get_contents("./54/".$file));

// 	foreach ($lines as $line) {

// print_r($line);die;

// $xml = simplexml_load_string($line);

// echo $xml;

// $json = json_encode($xml);
// echo $json;

// $data = json_decode($json,TRUE);



// 		// $data = split("[|]", $line);
			
// echo '<pre>';			
// print_r($data);
// echo '</pre>';			

// break;

// 			// $sql = "INSERT INTO `products`(`name`,`description`,`price`,`buyurl`,`imageurl`,`programname`,`sku`,`impressionurl`,`productID`) ".
// 			// 		"VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".
// 			// 					$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."')";
// 			// mysql_query($sql, $con);


// 		@ob_flush();
// 	    flush();
// 	    set_time_limit(0);
// 	}
// 	mysql_close($con);

// }

