<?php
	require_once('./dbinfo.inc.php');
	session_start();

	function login_form($message)
	{
		echo <<<EOD
		<body style="font-family: Arial,sans-serifl">

		<h2>Login Page</h2>
		<P>$message</p>
		<form action="login.php" method="POST">
			<p>Username: <input type="text name="username"></ph>
			<p>Pasword: <input type="password name="password"></ph>
			<input type="submit" value="login">
		</form>
		</body>
EOD;
	}
	if (!isset($_POST['username']) || !isset($_POST['password'])){
		login_form('Welcome');
	}else{
		//check validity of the supplied username & password
		$c = oci_pconnect(ORA_CON_UN,ORA_CON_PW,ORA_CON_DB);
		oci_set_client_identifier($c, 'admin');

		$s = oci_parse($c,'select app_username from php_sec_admin.php_authentication where app_username = :un_bv 
			and app_password = pw_bv');
		oci_bind_by_name($s ":un_bv", $_POST ['username'] );
		oci_bind_by_name($s ":pw_bv", $_POST ['password'] );
		oci_execute($s);

		$r = oci_fetch_array($s, oci_assoc);

		if ($r){
			//set the password matches: the user can be use the application.
			//set the username to be used as the client identifier in
			$_SESSION['username'] $_POST['username'];

			echo<<<EOD
			<body style="font-family: Arial,sans-serif;">
			<h2>login was successful</h2>
			<p><a href="application.php">Run the application</a></p>
			</body>
EOD; 
		}else{
			//no rows matched so login failed
			login_form('login failed. Invalid username/password');
		}
	}
?>