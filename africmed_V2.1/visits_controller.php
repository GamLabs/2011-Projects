<?php
require_once 'includes/connect.php';


?>
 <?php
if(isset($_POST['submit'])){
   $number = $_POST['fname'];
   $date = $_POST['date'];
  if(empty($_POST['date'])){
		$getVisitNumber = mysql_query("SELECT visitNumber, date FROM visits WHERE pnumber = '".$_POST['fname']."'") or die(mysql_error());
		echo "<h1>All Transactions for Sheriffo Ceesay by Date</h1>";
	echo "<div id=\"accordion\">";
		$visitNum = "";
		while($row = mysql_fetch_array($getVisitNumber)){
			$visitNum = $row['visitNumber'];
			$fdate = $row['date'];
			$formateddate = date("d-F-Y", strtotime($fdate));
      
			echo " <h3><a href=\"#\">$formateddate</a></h3>";
			echo "<div>";
				echo "<table border = 1 style=\"border-spacing:0; border-style:solid; border-width:1px; border-collapse:collapse\">";
					echo "<tr>";
						echo "<td>"; 
							echo "<h3>Lab Transactions</h3>";
							echo "<table border = 1 style=\"border-spacing:0; border-style:solid; border-width:1px; border-collapse:collapse\">";   
							echo "<tr><td> Visit Number </td> <td>Test Type </td> <td> Amount </td></tr>";
							$getLabBookings = mysql_query("SELECT * FROM labbooking WHERE pnumber = '".$_POST['fname']."' and visitNumber = '$visitNum'") or die(mysql_error());
							while($row1 = mysql_fetch_array($getLabBookings)){
								echo "<tr>";
									echo "<td>".$row1['visitNumber']."</td>";
									echo "<td>".$row1['testType']."</td>";
									echo "<td>".$row1['amount']."</td>";
								echo "</tr>";
							}
							echo "</table>";
						echo "</td>";
						echo "<td>";
							$getPharBookings = mysql_query("SELECT * FROM pharbooking WHERE pnumber = '".$_POST['fname']."' and visitNumber = '$visitNum'") or die(mysql_error());
						if(mysql_affected_rows() <= 0){
								echo "No Pharmacy booking for this patient";
						}else{ 
							echo "<h3>Pharmacy Transactions</h3>";
							echo "<table border = 1 style=\"border-spacing:0; border-style:solid; border-width:1px; border-collapse:collapse\">";  
								echo "<tr><td> Visit Number </td> <td>Medication</td> <td> Amount</td></tr>";
								while($row2 = mysql_fetch_array($getPharBookings)){
									echo "<tr>";
										echo "<td>".$row2['visitNumber']."</td>";
										echo "<td>".$row2['medication']."</td>";
										echo "<td>".$row2['amount']."</td>";
									echo "</tr>";
								}
						}
						echo "</table>";
					echo "</td>";
					echo "</tr>";
				echo "</table>";
			echo"</div>";
      
		}
	echo "</div>";
  }else{
     $getVD = mysql_query("SELECT visitNumber, date FROM visits WHERE pnumber = '".$_POST['fname']."' and date = '".$_POST['date']."'") or die(mysql_error());
     if(mysql_affected_rows()<=0){
     	echo "<div id=\"notfound\" title=\"Information\" style=\"display:none;\">";
			echo "<p>";
				echo "<span class=\"ui-icon ui-icon-circle-check\" style=\"float:left; margin:0 7px 50px 0;\"></span>
					No visit on this date or invalid patient number </p>";
		echo "</div>";
     }else{
		$row = mysql_fetch_array($getVD);
		$visitNum = $row['visitNumber'];
		$fdate = $_POST['date'];
		$formateddate = date("d-F-Y", strtotime($fdate));
       echo "<div id=\"accordion\">";
			echo " <h3><a href=\"#\">$formateddate</a></h3>";
			echo "<div>";
				echo "<table>";
					echo "<tr><td>";
					echo "<h3>Lab Transactions</h3>";
						echo "<table border = 1 style=\"border-spacing:0; border-style:solid; border-width:1px; border-collapse:collapse\">";    
							echo "<tr><td> Visit Number </td> <td>Test Type </td> <td> Amount </td></tr>";
							$getLabBookings = mysql_query("SELECT * FROM labbooking WHERE pnumber = '".$_POST['fname']."' and visitNumber = '$visitNum'") or die(mysql_error());
								while($row1 = mysql_fetch_array($getLabBookings)){
									echo "<tr>";
										echo "<td>".$row1['visitNumber']."</td>";
										echo "<td>".$row1['testType']."</td>";
										echo "<td>".$row1['amount']."</td>";
									echo "</tr>";
								}
						echo "</table>";
					echo"</td>";
					echo"<td>";
						echo "<h3>Pharmacy Transactions</h3>";
							echo "<table border = 1>";  
							echo "<tr><td> Visit Number </td> <td>Test Type </td> <td> Amount </td></tr>";
							$getLabBookings = mysql_query("SELECT * FROM pharbooking WHERE pnumber = '".$_POST['fname']."' and visitNumber = '$visitNum'") or die(mysql_error());
							while($row1 = mysql_fetch_array($getLabBookings)){
								echo "<tr>";
									echo "<td>".$row1['visitNumber']."</td>";
									echo "<td>".$row1['medication']."</td>";
									echo "<td>".$row1['amount']."</td>";
								echo "</tr>";
							}
					echo"</td>";
				echo "</table>";
			echo"</tr>";
		echo "</table>";
	 echo "</div>";
	echo "</div>";
  }
}
?>

 <div class="demo">
	<div id="dialog-message" title="Information" style="display:none;">
		<p>
		<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
		Patient Registered Successfully
	    </p>
		<p>
		The Patient number is <?php echo "$number"; ?> please keep this save</b>.
		</p>
	</div>
	
 <script>
 $(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog-message" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});

 $(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#notfound" ).dialog({
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
?>
   
   <!--  END #PORTLETS -->  </div>
<script>
	$(function() {
		$( "#accordion" ).accordion({
			collapsible: true,
			autoHeight: false,
		});
	});
</script>