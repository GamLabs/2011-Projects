<script>
    $(document).ready(function () {
        
	$("#myAccordion").accordion({
		active:false,
		animated: "bounceslide"
	});
	$("#submit").button();
	$("#reset").button();
	$("#checkupTab").tabs();
	$("#phyTab").tabs();
	$("#histTab").tabs();
	$("#lastMensDate").datepicker();
	$("#checkUpDate").datepicker();
	$("#followUpDate").datepicker();
	
	
    });
	
		$('#checkupForm').ajaxForm({
			target:"#content",
			success:function(response) { 
              		//  alert(response); 
           		 }
		});
</script>

<form id="checkupForm" action="checkup_controller.php" method="post">

<label>Patient Number </label><input type="text" id="fname" name="fname"/>
<label>CheckUp Date </label><input type="text" id="checkUpDate" name="checkUpdate"/>
</br> </br></br>

<div id="checkupTab">
	<ul>
   	 <li><a href="#a">General</a></li>
   	<li><a href="#b">Physical Examination</a></li>
	<li><a href="#c">History</a></li>
	<li><a href="#d">FTD</a></li>
	<li><a href="#e">Mental Examinaton</a></li>  
	<li><a href="#f">Provisional Diagnosis</a></li> 
 	 </ul>


 
<div id="a">
<table>
<tr>
<td><label>Last Mentrual Date </label></td><td><input type="text" id="lastMensDate" name="lastMensDate"/></br></td>
</tr>
<tr>
<td><label>Hypertension </label></td><td><input type="radio" name="hypertension" value="yes" /> Yes <input type="radio" name="hypertension" value="no" /> No</br></td>
</tr>
<tr>
<td><label>Diabetic </label></td><td><input type="radio" name="diabetic" value="yes" /> Yes <input type="radio" name="diabetic" value="no" /> No  </br> </td>
</tr>
<tr>
<td><label>Allergy </label></td><td><input type="radio" name="allergy" value="yes" /> Yes <input type="radio" name="allergy" value="no" /> No   </br></td>
</tr>
<tr>
<td align="top"><label>Complains</label></td><td><textarea rows="4" cols="30" id="complains" name="complains">  </textarea>   </br></td>
</tr>
<tr>
<td align="top"><label>Complain History</label></td><td><textarea rows="4" cols="30" id="complainHistory" name="complainHistory">  </textarea>   </br></td>
</tr>
<tr>
<td align="top"><label>Mental Health</label></td><td><textarea rows="4" cols="30" id="mentalHealth" name="complainHistory">  </textarea>   </br></td>
</tr>
<tr>
<td align="top"><label>Current medication</label></td><td><textarea rows="4" cols="30" id="currentMedication" name="currentMedication">  </textarea>   </br></td>
</tr>
<tr>
<td><label>Weight </label></td><td><input type="text" name="weight"  /> </br></td>
</tr>
<tr>
<td><label>Height </label></td><td><input type="text" name="height"  /></td>
</tr>
</table>
.</div>
  
<div id="b">
<div id="phyTab">
      <ul>
        <li><a href="#0"><span>Chest </span></a></li>
        <li><a href="#1"><span>CVS</span></a></li>
 	<li><a href="#2"><span>Neurology</span></a></li>
	<li><a href="#3"><span>Temperature</span></a></li>
      </ul>
      <div id="0"> 
      <table>
      <tr>
	<td><label>RR </label></td><td><input type="text" id="rr" name="rr"/></br></td>
	</tr>
	<tr>
	<td><label>SP02% </label></td><td><input type="text" id="sp02" name="sp02"/></br></td>
	</tr>
	<tr>
	<td><label>FEV1 </label></td><td><input type="text" id="fev1" name="fev1"/></br></td>
	</tr>
	<tr>
	<td><label>Wheezing </label></td><td><input type="text" id="wheezing" name="wheezing"/></br></td>
	</tr>
	<tr>
	<td><label>Crepitation </label></td><td><input type="text" id="crepitation" name="crepitation"/></br></td>
	</tr>
	<tr>
	<td><label>Air Entry </label></td><td><input type="text" id="airentry" name="airentry"/></br></td>
	</tr>
      
      </table>
        
      </div>
      <div id="1">
      
      <table>
      <tr>
	<td><label>BP </label></td><td><input type="text" name="bp" /></br></td>
	</tr><tr>
	<td><label>Pluse%</label></td><td><input type="text" name="rr" /></br></td>
	</tr><tr>
	<td><label>JVP </label></td><td><input type="text" name="jvp" /></br></td>
	</tr><tr>
	<td><label>Oedema </label></td><td><input type="text" name="oedema" /></br></td>
	</tr>
      
      
      </table>
      
      </div>
	<div id="2">
	<table>
	
	<tr>
	<td><label>Cranial Nerves </label></td><td><input type="text" name="cranialNerves" /></br></td>
	</tr><tr>
	<td><label>Swallowing & Speech </label></td><td><input type="text" name="swallowingSpeech" /></br></td>
	</tr><tr>
	<td><label>Reflexes </label></td><td><input type="text" name="reflexes" /></br></td>
	</tr><tr>
	<td><label>power </label></td><td><input type="text" name="power" /></br></td>
	</tr><tr>
	<td><label>Tones </label></td><td><input type="text" name="tones" /></br></td>
	</tr><tr>
	<td><label>Sensation </label></td><td><input type="text" name="sensation" /></br></td>
	</tr><tr>
	<td><label>Babinsky </label></td><td><input type="text" name="babinsky" /></br></td>
	</tr>
	
	</table>
	</div>
	<div id="3">
	
	<table>
	
	<tr>
	<td><label>Pallor </label></td><td><input type="text" name="pallor" /></br></td>
	</tr><tr>
	<td><label>Hydration </label></td><td><input type="text" name="hydration" /></br></td>
	</tr><tr>
	<td><label>Jaundice </label></td><td><input type="text" name="jaundice" /></br></td>
	</tr><tr>
	<td><label>Fnger Clubbing </label></td><td><input type="text" name="fingerClubbing" /></br></td>
	</tr><tr>
	<td><label>Skin Rash </label></td><td><input type="text" name="skinRash" /></br></td>
	</tr><tr>
	<td><label>Lymphnodes </label></td><td><input type="text" name="lymphnodes" /></br></td>
	</tr><tr>
	<td><label>Other </label></td><td><input type="text" name="other" /></br></td>
	</tr>
	
	</table>
	</div>
    </div>
</div>
  
  <div id="c">

    <div id="histTab">
      <ul>
        <li><a href="#0"><span>Personel History</span></a></li>
        <li><a href="#1"><span>Family History</span></a></li>
 	<li><a href="#2"><span>Past Medical History</span></a></li>
	
      </ul>
      <div id="0"> 
      
      <table>
      <tr>
	<td><label>Smoking </label></td><td><input type="radio" name="smoking" value="yes" /> Yes <input type="radio" name="smoking" value="no" /> No</br></td>
	</tr>
	<tr>
	<td><label>Alcohol </label></td><td><input type="radio" name="alcohol" value="yes" /> Yes <input type="radio" name="alcohol" value="no" /> No</br></td>
	</tr>
      
      </table>
      
      </div>
      <div id="1">
      
      <table>
      <tr>
		<td><label>Diabetic </label></td><td><input type="radio" name="diabetic" value="yes" /> Yes <input type="radio" name="diabetic" value="no" /> No</br></td>
		</tr><tr>
		<td><label>Hypertension </label></td><td><input type="radio" name="hypertension" value="yes" /> Yes <input type="radio" name="hypertension" value="no" /> No</br></td>
		</tr><tr>
		<td><label>Cancer </label></td><td><input type="radio" name="cancer" value="yes" /> Yes <input type="radio" name="cancer" value="no" /> No</br></td>
		</tr><tr>
		<td><label>Heart Problem </label></td><td><input type="radio" name="heartProblem" value="yes" /> Yes <input type="radio" name="heartProblem" value="no" /> No</br></td>
		</tr><tr>
		<td><label>Sickle Cell </label></td><td><input type="radio" name="sicklecell" value="yes" /> Yes <input type="radio" name="sicklecell" value="no" /> No</br></td>
		</tr><tr>
		<td><label>ASthma </label></td><td><input type="radio" name="asthma" value="yes" /> Yes <input type="radio" name="asthma" value="no" /> No</br></td>
		</tr>
      
      </table>
      </div>
	<div id="2">
	
	<table>
	
	<tr>
		<td><label>Asthma </label></td><td><input type="radio" name="asthma" value="yes" /> Yes <input type="radio" name="asthma" value="no" /> No</br></td>
		</tr><tr>
		<td><label>Admission </label></td><td><input type="radio" name="admission" value="yes" /> Yes <input type="radio" name="admission" value="no" /> No</br></td>
		</tr><tr>
		<td><label>Surgery </label></td><td><input type="radio" name="surgery" value="yes" /> Yes <input type="radio" name="surgery" value="no" /> No</br></td>
		</tr><tr>
		<td><label>Cholesterol </label></td><td><input type="radio" name="cholesterol" value="yes" /> Yes <input type="radio" name="cholesterol" value="no" /> No</br></td>
		</tr>
	
	</table>
	</div>
	
    </div>
  </div>

 <div id="d">
 <table>
<tr>
		<td><label> Paranoia </label></td><td><input type="text" name="paranoia" /></br></td>
		</tr><tr>
		<td><label>Delusions </label></td><td><input type="text" name="delusions" /></br></td>
		</tr><tr>
		<td><label>Hallucinations </label></td><td><input type="text" name="hallucinations" /></br></td>
		</tr><tr>
		<td><label>Cognition & memory </label></td><td><input type="text" name="cognition" /></br></td>
		</tr><tr>
		<td><label>Abnormal Beliefs</label></td><td><input type="text" name="abnormalBeliefs" /></br></td>
		</tr><tr>
		<td><label>Insights</label></td><td><input type="text" name="insights" /></br></td>
</tr>
</table>
</div>


<div id="e">
<table>

		<tr>
		<td><label>A+B </label></td><td><input type="text" name="ab" /></br></td>
		</tr><tr>
		<td><label>Speech </label></td><td><input type="text" name="speech" /></br></td>
		</tr><tr>
		<td><label>Homicidal </label></td><td><input type="text" name="homicidal" /></br></td>
		</tr><tr>
		<td><label>Suicidal </label></td><td><input type="text" name="suicidal" /></br></td>
		</tr>


</table>
</div> 

<div id="f">

<table>

		<tr>
		<td align="top"><label>Investigations</label></td><td><textarea rows="4" cols="30" name="investigations">  </textarea>   </br></td>
		</tr>
		<tr>
		<td align="top"><label>Treatment</label></td><td><textarea rows="4" cols="30" name="treatment">  </textarea>   </br></td>
		</tr>
		<tr>
		<td><label>FollowUp Date </label></td><td><input type="text" id="followUpDate" name="followUpDate" /></br></td>
		</tr>

</table>
</div> 



 </div>






<input id="submit" type="submit" value="Submit"><input id="reset" type="reset" value="Reset">
</form>



<div class="ui-widget">
  <div class="ui-widget-header ui-corner-top">
    <h4>Output</h2></div>
  <div id="content" class="ui-widget-content ui-corner-bottom">
  
 </div>