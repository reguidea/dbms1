<?php
require_once('./dbinfo.inc.php');
session_start();

if(!isset($_SESSION['username'])) {
	echo <<<EOD
	<h2>Unauthorized </h2>
	<p>You are not authorized <br>
	only Luna and Mirana are authorized to use the application.</p>
	
	<p><a href="login.php">Login Page</a></p>
EOD;
	exit;
	
}
	$c = oci_pconnect(ORA_CON_UN, ORA_CON_PW,ORA_CON_DB);
	oci_set_Client_identifier($c, $_SESSION['username']);
	echo 
	$username = htmlentities($_SESSION['username'], ENT_QOUTES);
	echo <<<EOD
	<body style="font-family: Arial, sans-serif:">
	<table border="1">

	<caption><b>Inventory for $username </b></caption>
EOD;
	$s = oci_parse($c, "select * from parts order by id");
	oci_execute($s);
	while(($row = oci_fetch_array($c, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		echo "<tr>\n";
	foreach($row as $item) {
		echo "<td>" . ($item!==null?htmlentities($item,ENT_QOUTES): "&nbsp") . 	"</td>\n";
	}
		
}
	echo "</tr>\n";
	echo <<<EOD
	</table>
	<p><a href="logout.php">logout</a></p>
	</body>
EOD;

?>