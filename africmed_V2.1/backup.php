

<script>
$(document).ready(function () {
$("#createBackupBtn").button();
$("#refreshBackupBtn").button();
$("#createBackupBtn").click(function(){
	$("#doBackup").empty().load("backup_controller.php?doBackup=true");
	

});
$("#refreshBackupBtn").click(function(){
	
	refreshTab();

});
$("#CloseBackup").click(function(){closeTab(); });


});

</script>
<a id="CloseBackup" style="float: right;" href="#"><img src="images/Close.gif"></img></a><br>
 <button id="createBackupBtn">Create New Backup</button><button id="refreshBackupBtn">Refresh List</button>
<div id="doBackup">

</div>
<br><br>
<div>
<?php

  function getDirectoryList ($directory) 
  {
    $results = array();
    $handler = opendir($directory);
    while ($file = readdir($handler)) {
      if ($file != "." && $file != "..") {
        $results[] = $file;
      }
    }

    closedir($handler);

    return $results;
  }

/*
function listdir_by_date($path){
    $dir = opendir($path);
    $list = array();
    while($file = readdir($dir)){
        if ($file != '.' and $file != '..'){
            // add the filename, to be sure not to
            // overwrite a array key
            $ctime = filectime($path . $file) . ',' . $file;
            $list[$ctime] = $file;
        }
    }
    closedir($dir);
    krsort($list);
    return $list;
}

*/

  $result = getDirectoryList("backups");
  rsort($result);
  $counter = 0;
  //$result = listdir_by_date("backups");
  echo "<table>";
  echo "<tr class=' ui-widget-content ui-corner-all inputStyle ui-widget-header'><th>File Name</th><th>Size</th><th>Download</th></tr>";
  foreach ($result as $value) {
  	$size = round((filesize("backups/".$value)/1048576),2)."MB";
  //	<a href="download.php?download_file=some_file.pdf">Download here</a>
  	echo '<tr style="color:cyan;"><td>'.$value .'</td><td>'.$size.'</td><td><a style="color:red" href="backup_controller.php?download_file='.$value.'">Download</a> </td></tr>';
  	$counter++;
  	if($counter == 30){
  		break;
  	}
  }
  
  echo "</table>";

?>

</div>