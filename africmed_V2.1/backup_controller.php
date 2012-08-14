<?php
if(isset($_GET['doBackup'])&& $_GET['doBackup'] == "true"){
	$date = date('Ymd');
	$str = "mysqldump -h 127.0.0.1 --user=root -pgamlabs africmed > backups/africmed_$date.sql";
	system($str);
	exit(0);
}

$path = "backups/"; 
$fullPath = $path.$_GET['download_file'];

if ($fd = fopen ($fullPath, "r")) {
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "pdf":
        header("Content-type: application/pdf"); 
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); 
        break;
        default;
        header("Content-type: application/octet-stream");
        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
    }
    header("Content-length: $fsize");
    header("Cache-control: private"); 
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
fclose ($fd);
exit;

?>