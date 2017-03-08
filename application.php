<?php
	require_once(',/dbinfo.inc.php')
	session_start();

	if(!isset($_SESSION['username'])){
		echo<<<EOD
		<h2>Unauthorized</h2>
		<p>You are not Authorized<br>
		Only Luna and Mirana are Authorized to use the application. </p>

	 	<p><a href="login.php">Login Page</a></p>
EOD;
		exit;
	}
	$c = oci_pconnect(ORA_CON_UN,ORA_CON_PW, ORA_CON_DB);
	oci_set_client_identifier($c, $_SESSION['username]']);

	$username = htmlentities($_SESSION['username'], ENT_QUOTES);
	echo<<<EOD
	 
?>	