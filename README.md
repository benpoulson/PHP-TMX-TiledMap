TiledMap-PHP-Class
==================

A simple loader for Tiled TMX maps in PHP

```PHP
<?php

/*
 *  BRIEF EXAMPLE
 */
 
require_once('TMXMap.class.php');
$map = new TMXMap('level.tmx');
$layer = $map->getLayer('Collision');

$x = 0;
$y = 0;
foreach($layer['Collision'] as $tile)
{
	$x++;
	echo $tile;
	if($x == $map->getWidth())
	{
		$x = 0;
		$y++;
		echo PHP_EOL;
	}
}

?>
```
