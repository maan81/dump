<?php
ini_set('max_execution_time',900);
/**
 * @author zerokavn@gmail.com
 * **/

require_once('config.php');

$files = scandir("./");
foreach ($files as $file) {
	$ext = substr($file, strrpos($file, '.') + 1);
	if($ext == 'txt')
	{
		$con = mysql_connect("localhost", $db_user, $db_pass);
		mysql_select_db($db_name, $con);
		
		// create talbe if not exists
		$sql = "CREATE TABLE IF NOT EXISTS `products` (
			`id` bigint(20) NOT NULL auto_increment,
			`title` varchar(8000) NOT NULL,
			`image` varchar(20000) NOT NULL,
			`redirecturl` varchar(20000) NOT NULL,
			 PRIMARY KEY  (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			";
		mysql_query($sql, $con);
		
		$lines = explode("\n", file_get_contents($file));
		foreach ($lines as $line) {
			$data = split("[|]", $line);
			if($data[0] != '')
			{
				if(!isset($data[1])) $data[1] = '';
				if(!isset($data[2])) $data[2] = '';
				
				$sql = "INSERT INTO `products`(`title`, `image`, `redirecturl`) VALUES ('" . addslashes($data[0]) . "', '" . $data[1] . "', '" . $data[2] . "')";
				mysql_query($sql, $con);
			}
			@ob_flush();
		    flush();
		    set_time_limit(0);
		}
		mysql_close($con);
	}
}


?>