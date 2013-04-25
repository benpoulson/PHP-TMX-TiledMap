<?php

/*
 * Created 2013 -- Ben Poulson
 * Feel free to use how you wish
 * http://www.netikan.com
 */

class TMXMap
{
	var $map;

	function __construct($mapFile)
	{
		$this->map = simplexml_load_file($mapFile);
	}

	function getWidth()
	{
		return (String) $this->map->attributes()->width;
	}

	function getHeight()
	{
		return (String) $this->map->attributes()->height;
	}

	function getTileWidth()
	{
		return (String) $this->map->attributes()->tilewidth;
	}

	function getTileHeight()
	{
		return (String) $this->map->attributes()->tileheight;
	}

	function getOrientation()
	{
		return (String) $this->map->attributes()->orientation;
	}

	function getBackgroundColor()
	{
		return (String) $this->map->attributes()->backgroundcolor;
	}

	function getLayer($getLayerName = '')
	{
		$values = array();
		foreach($this->map->layer as $child)
		{
			$name = $child->attributes()->name;

			if(!empty($getLayerName))
				if($name != $getLayerName)
					continue;
			
			$data = gzinflate(substr(base64_decode(trim($child->data)), 10));
			$chars = str_split($data);
			$i = 0;
			foreach($chars as $char)
			{
				$charID = ord($char);
				if($i % 4 == 0) // I'm only interested in the tile IDs
				{
					$values[(String) $name][] = $charID;
				}
				$i++;
			}
		}
		return $values;
	}
}

?>