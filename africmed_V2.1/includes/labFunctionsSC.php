<?php
function stockLabExist($typ, $amoun){
mysql_query("SELECT type, amount FROM lab_config where type = '$typ' AND amount = '$amoun'");
if(mysql_affected_rows() > 0){
return true;
}
return false;
}

function insertLabStock($type, $amount, $user){
if(stockLabExist($type, $amount)){
echo "<div id=\"lduplicate\" title=\"Duplicate Error\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	Sorry \"$type\" costing D$amount already exist</p>";
echo "</div>";
?>
<script>
$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#lduplicate" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>
<?
}else{
$done = mysql_query("INSERT INTO lab_config (type, amount, user) VALUES (TRIM('$type'), TRIM('$amount'), TRIM('$user'))") or die("Error Inserting". mysql_error());
if($done){
echo "<div id=\"lsuccess\" title=\"Information\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	Test \"$type\" costing D$amount added successfully</p>";
echo "</div>";
?>
<script>
$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#lsuccess" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
</script>
<?
}else{
echo "Problem Inserting";
}
}
}
?>