<?php
include("ftp_config.php");
$con = ftp_connect($ftp_host);
if(ftp_login($con, $ftp_user, $ftp_password)){
	echo "connected\n";
	chdir($local_path);
	echo "directory changed\n";
	$local_file_array = glob("*.php");
	if(sizeof($local_file_array) >0){
		foreach($local_file_array as $file){
			$res = ftp_nb_put($con, $ftp_path.$file, $file, FTP_ASCII);
			while($res == FTP_MOREDATA){
				echo ".";
				$res = ftp_nb_continue($con);
			}
			if ($res != FTP_FINISHED) {
				echo "There was an error uploading the file...";
				exit(1);
			}
		}
	}
}
?>
