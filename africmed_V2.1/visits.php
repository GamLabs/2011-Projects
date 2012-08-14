<form id="form-id" action="visits_controller.php" method="POST">

    <fieldset>

       <legend id="legendid">View Patient Visits</legend>

   	<center><table cellpadding="5">

   		<tr>

   			<td><label>Patient Number : </label></td><td><input type="text" name="fname" id="fname" class="validate[required,custom[onlyNumberSp]]" /></td>

   			<td><label>Date of Visit : </label></td><td><input type="text" name="date" id="date" /></td>

			<td><input type="submit" name="submit" id="submit" value="Submit" /></td>

   		</tr>

   	</table></center>

       </fieldset>

   </form>





<div id="content">





</div>

   

   <script>

            jQuery(document).ready( function() {

                // binds form submission and fields to the validation engine

                jQuery("#form-id").validationEngine();



		$('#form-id').ajaxForm({

			target:"#content",

			success:function(response) { 

              		//  alert(response); 

           		 }

		});



            });

   </script>

   

<script>

	$(function() {

		var availableTags = [

			"ActionScript",

			"AppleScript",

			"Asp",

			"BASIC",

			"C",

			"C++",

			"Clojure",

			"COBOL",

			"ColdFusion",

			"Erlang",

			"Fortran",

			"Groovy",

			"Haskell",

			"Java",

			"JavaScript",

			"Lisp",

			"Perl",

			"PHP",

			"Python",

			"Ruby",

			"Scala",

			"Scheme"

		];

		$( "#fname" ).autocomplete({

			source: availableTags

		});

	});





		$(function() {

		$( "#date" ).datepicker({

			changeMonth: true,

			changeYear: true,

			



			dateFormat: 'yy-mm-dd'

			//yearRange: '1900:2010',

			//showButtonPanel: true

			

		});

	});



</script>



  



   

   

  