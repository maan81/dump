<?php

	// echo str_replace(

	// 	array("%title%", "%image%", "%redirecturl%", "%menu%"),

	// 	// array($row["title"], $row["image"], $row["redirecturl"], $menu),
	// 	array($row["title"], $row["imageurl"], $row["buyurl"], $menu),

	// 	// file_get_contents($valid_referer ? "../sitetemplate/template2.html" : "../sitetemplate/template.html")
	// 	file_get_contents("template.html")

	// );


?>

<table>
	<tr>
		<td>productID</td>
		<td><?=$row['productID']?></td>
	</tr><tr>
		<td>name</td>
		<td><?=$row['name']?></td>
	</tr><tr>
		<td>description</td>
		<td><?=$row['description']?></td>
	</tr><tr>
		<td>price</td>
		<td><?=$row['price']?></td>
	</tr><tr>
		<td>buyurl</td>
		<td><?=$row['buyurl']?></td>
	</tr><tr>
		<td>imageurl</td>
		<td><?=$row['imageurl']?></td>
	</tr><tr>
		<td>programname</td>
		<td><?=$row['programname']?></td>
	</tr><tr>
		<td>sku</td>
		<td><?=$row['sku']?></td>
	</tr><tr>
		<td>impressionurl</td>
		<td><?=$row['impressionurl']?></td>
	</tr>

</table>



<?php print_r($menu)?>