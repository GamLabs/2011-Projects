<?php
	$myip = $_SERVER['REMOTE_ADDR']
    	$country=file_get_contents('http://api.hostip.info/country.php?ip=4.2.2.2');
	//echo $country;
	// Reformat the data returned (Keep only country and country abbr.)
	$only_country=explode (" ", $country);
	echo $only_country[1];
?>
