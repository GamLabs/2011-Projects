<?php 
require_once 'includes/connect.php';
require_once 'includes/requireFile.php';
?>
<script>

    $(document).ready(function () {
	$("#addProductsSubmit").button();
    	function validateAddProducts(){
			$('#addProductsForm').validate({
				
					'rules':{
						'productCode':'required',
						'productDesc': 'required',
						'productType': 'required',
						'productPrice': {
							'required':true,
							'number':true
						}
					},
					messages: {
						productCode: "<i style='color:red;'>Code  is Required<i>",
						productDesc: "<i style='color:red;'>Description is Required<i>",
						productType: "<i style='color:red;'>Type is Required<i>",
						productPrice: {
							required: "<i style='color:red;'>Price is Required<i>",
							number: "<i style='color:red;'>Invalid  Number<i>"
						}
					},
					invalidHandler: function(form, validator) {
					      var errors = validator.numberOfInvalids();
					      if(errors){
					    	  $("#errorMessage").html('<p>Please Fill All Required Fields!</p>').dialog('open');
						    return false;
					      }else{
						      return true;
					      }
					}
			});
	}
	$('#addProductsForm').ajaxForm({
		beforeSubmit: validateAddProducts(),
		//if(confirm("Are you sure you want to make payments")){
			success:function(response){
				var res = parseInt(response);
				if(res == 0){
					$("#successMessage").html('<p>Succesfully Added Product</p>').dialog('open');
					$('#addProductsForm').resetForm();
				}else{
					$("#successMessage").html('Sorry '+response).dialog('open');

				}
				
				
			}
		//}
	});
    	
    


    
		$("#CloseProducts").click(function(){closeTab(); });
	});
</script>

<style>
<!--
.tdtext {
	 // white-space: nowrap;
	  vertical-align: top;
	  color: aqua;
	  font-size: 14px;
	}
-->
</style>
<a id="CloseProducts" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>

		
			
				<fieldset class=" ui-widget-content ui-corner-all inputStyle" >
					<legend class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" >Add Products </legend>
						<form id="addProductsForm" name="addProductsForm" method="post" action="addproducts_controller.php">
							<table>
							
							 <tr>
						  	<td><label>Code:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="productCode"  id="productCode" >
								 <?php getNominalCodes('income');?>
								
								</select>
							</td>
							</tr> 
							<tr>
						  	<td><label>Type:</label></td>
						  	<td>
								<select class=" ui-widget-content ui-corner-all inputStyle ui-widget-header"  name="productType"  id="productType" >
								<option value="">Select Status</option>
								<option value="gambian">Gambian</option>
								<option value="nongambian">Non Gambian Resident</option>
								<option value="visitor">Non Gambian Visitor</option>
								
								</select>
							</td>
							</tr>   
							<tr>
						  	<td><label>Description:</label></td>
						  	<td>
								<input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="productDesc" size="20" id="productDesc" />
							</td>
							</tr> 
							
							<tr>
						  	<td><label>Price:</label></td>
						  	<td>
								<input class=" ui-widget-content ui-corner-all inputStyle ui-widget-header" type="text" name="productPrice" size="10" id="productPrice" />
							</td>
							</tr>  
							  
							 <tr><td></td>
							 <td>
							 <input type="submit" id="addProductsSubmit" name="addProductsSubmit" value="Add Product"/ >
							</td>
							</tr>
							</table>
							</form>
					
				</fieldset>
				
			
				
			
			

