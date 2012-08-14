<?php
function deleteMedication($drugname){
$delete = mysql_query("DELETE FROM phar_store_config WHERE dname = '$drugname'");
}

function insertInStore($name, $type, $quantity, $expirydate, $reorderlevel, $sellingprice){
$inserted = mysql_query("INSERT INTO phar_store_config (dname, dtype, quantity, expiry_date, reorder_level, selling_price) VALUES ('$name', '$type', '$quantity', '$expirydate', '$reorderlevel', '$sellingprice')")or die(mysql_error());
if ($inserted){
echo "<div id=\"success\" title=\"Information\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	Drug \"$name\" expiring $expirydate added successfully</p>";
echo "</div>";
?>
<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#success" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>
<?php
}else{
echo "<div id=\"error\" title=\"Information\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	$name$type$quantity$expirydate $reorderlevel</p>";
echo "</div>";

}
}
//The function returns true if drug is not expired or still good
function isExpired($drugname){
$getexp =  mysql_query("SELECT expiry_date FROM phar_store_config WHERE dname = '$drugname'");
$row = mysql_fetch_array($getexp);
$expdate = $row['expiry_date'];
$today = date('Y,m,d'); 
if($expdate <= $today){
return true;
}
return false;
}

function checkQuantity($drugname){
$getquantity = mysql_query("SELECT quantity FROM phar_store_config where dname = '$drugname'");
$row = mysql_fetch_array($getquantity);
$quantity = $row['quantity'];

return $quantity;
}

function checkReorderLevel($drugname){
$getreorderlevel = mysql_query("SELECT reorder_level, dname FROM phar_store_config where dname = '$drugname'");
$row = mysql_fetch_array($getreorderlevel);
$reorderlevel = $row['reorder_level'];

return $reorderlevel;
}

function updateQuantity($drugname, $addedamount){
	$oldquantity = checkQuantity($drugname);
	$newquantity = $oldquantity - $addedamount;
	if($oldquantity>=$addedamount){
	mysql_query("UPDATE phar_store_config SET quantity = '$newquantity' WHERE dname = '$drugname'");
	}else{
	echo "<div id=\"outofstock1\" title=\"Information\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	$drugname is out of stock, Please order more.</p>";
	echo "</div>";
	?>
	<script>	
	$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#outofstock1" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>
<?php
	}
}



function insertInPhar($name, $price, $quantity, $user, $type){
if(isExpired($name)){
echo "<div id=\"expired\" title=\"Information\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	Tablet Expired you can't take this to the pharmacy</p>";
echo "</div>";
?>
<script>	
	$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#expired" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>	
<?php
}else if($type =="Tablet" and checkQuantity($name)>= $quantity){
	$inserted = mysql_query("INSERT INTO tablet_config (name, price, quantity, user) VALUES ('$name', '$price', '$quantity', '$user')")or die(mysql_error());
	if($inserted){
	echo "<div id=\"drgtab\" title=\"Information\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	Tablet added successfully</p>";
echo "</div>";
?>
<script>	
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#drgtab" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>	
<?php
}
}else if($type =="Non Tablet" and checkQuantity($name)>= $quantity){
	$inserted = mysql_query("INSERT INTO nontablet_config (name, price, quantity, user) VALUES ('$name', '$price', '$quantity', '$user')")or die(mysql_error());
	echo "<div id=\"drgnontab\" title=\"Information\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	Non tablet added successfully</p>";
echo "</div>";
?>
<script>	
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#drgnontab" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>
<?php
}
return true;
}
?>

<?php
function getAllDrugs(){
  $med = array();
  $select = mysql_query("SELECT dname FROM phar_store_config where quantity > 1");
  while($row =  mysql_fetch_array($select)){
    $med[] = $row['dname'];
  }
  return $med;
}
?>