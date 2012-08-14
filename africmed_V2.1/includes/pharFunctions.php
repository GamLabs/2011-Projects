<?php
function displayPharSales($date){
	$str="SELECT date_format(date,'%e %M, %Y') as date, pnumber,category,medication,amount
		   from pharbooking where date='$date'";

	$sql=mysql_query($str) or die(mysql_error());
	
	$counter=false;
	$html = "<center><b><i><font color=blue, size=3> ALL DRUGS SOLED ON $date</font></i></b></center><br>";
	$html  .= "<center><table border='1'><tr class='ui-widget-header'>
				<th>Date</th>
				<th>Name</th>
				<th>Type</th>
				<th>Medication </th>
				<th>Amount</th>
			</tr>";
	while ($row=mysql_fetch_array($sql)){
		$counter=true;
		$name=getName($row['pnumber']);
		$html .= "<tr>";
		$html .= "<td>".$row['date']."</td>";
		$html .= "<td>".$name."</td>";
		$html .= "<td>".$row['category']."</td>";
		$html .= "<td>".$row['medication']."</td>";
		$html .= "<td>D".$row['amount']."</td>";
		$html .= "</tr>";
	}
	
	$str="select sum(amount) as total from pharbooking where date='$date'";

	$sql=mysql_query($str) or die("second ".mysql_error());
	$row=mysql_fetch_array($sql);
	//$month=strtoupper(monthName($month));
	$html.= "<tr class='ui-widget-header'>";
	$html.= "<td><b><i> TOTAL</i></b></td>";
	$html.= "<td></td>";
	$html.= "<td></td>";
	$html.= "<td></td>";
	$html.= "<td><span>D $row[total]</span></td>";


	$html.= "</tr>";

	$html.= "</table></div></center>";
	if ($counter){
		echo $html;
	}else{
		echo 0;
	}
	
	
}

function availableStock($cat,$type){
	if ($cat == "Tablets"){
		$str="select quantity from tablet_config where type='$type'";
	}else if ($cat == "Non Tablets"){
		$str="select quantity from nontablet_config where type='$type'";
	}
	$sql=mysql_query($str);
	$row=mysql_fetch_array($sql);
	$quantity=$row['quantity'];
	return $quantity;
}
function updateAvailabbleStock($number,$cat,$type){
if ($cat == "Tablets"){
		$str="UPDATE tablet_config set quantity='$number' where type='$type'";
	}else if ($cat == "Non Tablets"){
		$str="UPDATE nontablet_config set quantity='$number' where type='$type'";
	}
	mysql_query($str);
}
function insertPharBooking($pn,$vnumber,$date,$cat,$subCat,$amount){
		$sql=mysql_query("INSERT INTO pharbooking(pnumber,visitNumber,category,medication,amount,date) 
						VALUES('$pn','$vnumber','$subCat','$cat','$amount','$date')") or die("Cannot Insert Phar booking ".mysql_error());
		updateFee($pn, $vnumber, $amount);
}

function completePharBooking($pn){
	$sql=mysql_query("UPDATE pharbooking set bookingCompleted='YES' where pnumber='$pn'");
	if($sql){
		return true;
	}else 
		return false;
}

/*function getTreatmentCategory($vnumber){
	$sql=mysql_query("SELECT distinct(category) as cat from treatments where visitNumber='$vnumber'");
	
	$html="";
	while($row=mysql_fetch_array($sql)){
		if($row['cat']=="Tablets"){
			$html .= <option value="tablets">Tablets</option>;
		}else if ($row['cat']=="Non Tablets"){
			$html .= <option value="nontablets">Non Tablets</option>;
		}
	}
	echo $html;
}*/


function getMedPrice($package,$name){
		$sql = "select amount from drug_names where type = '$package' and name= '$name' limit 1";
		$result = mysql_query($sql);
		if(mysql_affected_rows() > 0){
		$row = mysql_fetch_array($result);
		return  $row['amount'];
		}else{
			return 0;
		}
	
}
function displayTreatments($vnumber){
		$sql= "select id,category, type,prescription,quantity from treatments where visitNumber='$vnumber' AND ready='NO'";
		
		$result=mysql_query($sql) ;
		if(mysql_affected_rows() > 0){

		$html  = "<center><table border='1'><tr class='ui-widget-header'><th>ID</th><th>Drug Name</th><th>Type</th><th>Prescription</th><th>Quantity </th><th>Cost</th><th>Action</th></tr>";
		while ($row=mysql_fetch_array($result)){
			$price = getMedPrice($row['category'],$row['type'])  * $row['quantity'];
			$html .= "<tr style='color:cyan;'>";
			$html .= "<td>".$row['id']."</td>";
			$html .= "<td>".$row['type']."</td>";
			$html .= "<td>".$row['category']."</td>";
			$html .= "<td>".$row['prescription']."</td>";
			$html .= "<td>".$row['quantity']."</td>";
			$html .= "<td>".$price ."</td>";
			$html .= "<td><a class='addPrescriptionTP' href='#'><img src='images/add.png'></img></a></td>";
			$html .= "</tr>";
		}
		$html .= "</table></center>";
		echo $html;
		}else{
			echo "<p style='color:red'>Sorry: No Current Prescriptions this For this Patient</p>";
		}
}

function updateTreatmentById($id){
	
	$sql = "update treatments set ready='YES' where id = $id";
	$result=mysql_query($sql) or die("Treatment Table Error: "+mysql_error());
}


function updateTreamentStatus($vnumber){
	$sql=mysql_query("update treatments set ready='YES' where visitNumber='$vnumber' ");
	
	if($sql)
		return true;
	else
		 return false;
}



/* THIS WILL SHOW ONLY THE PRESCRIBED TREATMENTS IN THE DETAILS DROP DOWN LIST*/
function displayTreatmentForPatient($vnumber,$cat){
	$sql  = "select type from treatments where visitNumber ='$vnumber' AND category='$cat' AND ready='NO'";
	$record= dbAll($sql);
	echo "<option value=''></option>";
	foreach ($record as $value) {
		echo '<option value="'.$value["type"].'">'.$value["type"].'</option>';
	}
}
// THIS FUNCTION DISPLAYS ALL AVAILABLE DRUGS AT THE PHARMACY(BOTH TABS AND NON TABS)
function displayAllDrugs($tableName){
	$sql  = "select type from $tableName";
	$record= dbAll($sql);
	echo "<option value=''></option>";
	foreach ($record as $value) {
		echo '<option value="'.$value["type"].'">'.$value["type"].'</option>';
	}
}
function displayPharBooking($vnumber){
		$sql= "select pnumber, category ,medication, amount, date from pharbooking where visitNumber='$vnumber' AND bookingCompleted='NO'";
		$result=mysql_query($sql) ;
		if(mysql_affected_rows() > 0){
		$html  = "<br><fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' >";
		$html .= "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' >Added Prescriptions </legend>";
		$html .= "<center><table>";
		$html .= "<tr class='ui-widget-header'><th>P Number</th><th>Name</th><th>Type</th><th>Amount</th><th>Date</th></tr>";
		while($row=mysql_fetch_array($result)){			
			$html .= "<tr style='color:cyan;'>";
			$html .= "<td>".$row['pnumber']."</td>";
			$html .= "<td>".$row['category']."</td>";
			$html .= "<td>".$row['medication']."</td>";
			$html .= "<td>".$row['amount']."</td>";
			$html .= "<td>D".$row['date']."</td>";
			$html .= "</tr>";
		}
		$html .= "</table></center></fieldset>";
		
		echo $html;
		}else{
			echo "<p style='color:red'>Sorry: No Current Prescriptions this Patient</p>";
		}
}
// FUNCTIONS FROM JARRA
function tabletNotExist($tabname){
$check = mysql_query("SELECT dname FROM phar_store_config WHERE dname = '$tabname'");
     if(mysql_affected_rows()<=0)
     return true;
}

function getDrugPrice($tabname){
$gettab = mysql_query("SELECT selling_price FROM phar_store_config WHERE dname = '$tabname'");
$row = mysql_fetch_array($gettab);
$value = $row['selling_price'];
return $value;
}

function tabType($tabname){
$gettab = mysql_query("SELECT dtype FROM phar_store_config WHERE dname = '$tabname'");
$row = mysql_fetch_array($gettab);
$value = $row['dtype'];
return $value;
}

function deleteMedication($drugname){
$delete = mysql_query("DELETE FROM phar_store_config WHERE dname = '$drugname'");
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
	}else if($addedamount > $oldquantity && $oldquantity > -1){
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
if(tabletNotExist($name)){
  echo "<div id=\"wrongtab\" title=\"Information\" style=\"display:none;\">";
	echo "<p>";
	echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
	\"$name\" is not in the Pharmacy, please add more</p>";
echo "</div>";
?>
<script>	
	$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#wrongtab" ).dialog({
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
}else if(isExpired($name)){
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
	$inserted = mysql_query("INSERT INTO tablet_config (type, amount, quantity, user) VALUES ('$name', '$price', '$quantity', '$user')")or die(mysql_error());
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
	$inserted = mysql_query("INSERT INTO nontablet_config (type, amount, quantity, user) VALUES ('$name', '$price', '$quantity', '$user')")or die(mysql_error());
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
  $select = mysql_query("SELECT dname FROM drug_name where quantity > 1");
  while($row =  mysql_fetch_array($select)){
    $med[] = $row['dname'];
  }
  return $med;
}

function getDrugNames(){
	$sql = "select distinct(name) from drug_names";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
	echo "<option value=''>Select Drug</option>";
	while ($records = mysql_fetch_array($result)){
		echo "<option value='".$records['name']."'>".$records['name']."</option>";

	}
	
	}
}

function getDrugNamesInStore(){
	$sql = "select dname from phar_store_config";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
	echo "<option value=''>Select Drug</option>";
	while ($records = mysql_fetch_array($result)){
		echo "<option value='".$records['dname']."'>".$records['dname']."</option>";

	}
	
	}
}

function getDrugType($name){
	$dname = trim($name);
	$sql = "select type from drug_names where name='$dname'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
		$records = mysql_fetch_array($result);
		echo $records['type'];
	}
}

function getDrugTypeName($name){
	$dname = trim($name);
	$sql = "select type from drug_names where name='$name'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
		$records = mysql_fetch_array($result);
		return $records['type'];
	}
}

function getDrugSellingPrice($name,$type){
	$dname = trim($name);
	$sql = "select selling_price from phar_store_config where dname='$name' and dtype='$type'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
		$records = mysql_fetch_array($result);
		return $records['selling_price'];
	}
}

function getDrugExpiry($name,$type){
	$dname = trim($name);
	$sql = "select expiry_date from phar_store_config where dname='$name' and dtype='$type'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
		$records = mysql_fetch_array($result);
		return $records['expiry_date'];
	}
}

function getDrugReorderLevel($name,$type){
	$dname = trim($name);
	$sql = "select reorder_level from phar_store_config where dname='$name' and dtype='$type'";
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
		$records = mysql_fetch_array($result);
		return $records['reorder_level'];
	}
}

function getDrugProperties($name,$type){
	$dname = trim($name);
	$sql = "select dname as 'Drug Name',dtype as 'Drug Type',quantity as 'Quantity In Store',expiry_date as 'Expiry Date',reorder_level as 'Re-Order Level' from phar_store_config where dname='$dname' and dtype='$type'";
	//echo $sql;
	
	$result = mysql_query($sql);
	
	if(mysql_affected_rows() > 0 ){
		
		while($assoc = mysql_fetch_assoc($result)){

		
			echo "<fieldset class=' ui-widget ui-widget-content ui-corner-all inputStyle ' style='background-color: grey;'>";
			
			echo "<legend class=' ui-widget-content ui-corner-all inputStyle ui-widget-header' style='background-color: blue;font-size:20;'><a href='#' style='text-decoration:none'>+". $assoc['Drug Name']."</a> </legend>";
			echo "<table border='0' style='color:aqua;font-size:19'>";
			foreach ($assoc as $key => $value){
				$value = trim($value);
				if(!empty($value) && ($value != "0000-00-00")){
					echo "<tr>";
					echo "<td style='white-space:nowrap;vertical-align:top;text-align:right;color:orange;'>" .$key.":</td><td> ".ucfirst($value)."</td>";
					echo  "</tr>";
				}
			}
			echo "</table>";
			echo "</fieldset>";
			echo "<br>";
			

		}
	}else{
		echo "<span style='color:orange;font-size:19'>Out of stock</span>";
	}
}

function drugTypeExist($name,$type){
	
	$sql = "select id from drug_names where name='$name' and type='$type'";
	//echo $sql;
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result) > 0 ){
		return true;
	}else{
		return false;
	}
	
}

function drugInStore($name,$type){
	$dname = trim($name);
	$sql = "select dname from phar_store_config where dname='$dname' and dtype='$type'";
	//echo $sql;
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result) > 0 ){
		return true;
	}else{
		return false;
	}
	
}
function getQuantityInStore($name,$type){
	$dname = trim($name);
	$sql = "select quantity from phar_store_config where dname='$name' and dtype='$type'";
	$result = mysql_query($sql);	
	if(mysql_affected_rows() > 0 ){
		$records = mysql_fetch_array($result);
		return $records['quantity'];
	}
	
}


//END THE FUNCTIONS

?>