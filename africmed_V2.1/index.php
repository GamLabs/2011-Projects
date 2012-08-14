<?php require_once("includes/session.php"); ?>
<?php require_once 'includes/connect.php';?>
<?php require_once("includes/receptionFunctions.php"); ?>
<?php

if (logged_in()) {
	redirect_to("main.php");
}



if (isset($_POST['submit'])) { // Form has been submitted.


	$username = trim(mysql_real_escape_string($_POST['username']));
	$password = trim(mysql_real_escape_string($_POST['password']));
	
	//$hashed_password = sha1($password);
	// Check database to see if username and the hashed password exist there.
	
	$query = "SELECT id,firstname,lastname, username,category ";
	$query .= "FROM users ";
	$query .= "WHERE username = '{$username}' ";
	$query .= "AND password = '{$password}' ";
	$query .= "AND active = 'YES' ";
	$query .= "LIMIT 1";
	$result_set = mysql_query($query)or die(mysql_error());
	//confirm_query($result_set);
	if (mysql_num_rows($result_set) == 1) {
		// username/password authenticated
		// and only 1 match
		$found_user = mysql_fetch_array($result_set);
		$_SESSION['user_id'] = $found_user['id'];
		$_SESSION['firstname'] = $found_user['firstname'];
		$_SESSION['lastname'] = $found_user['lastname'];
		$_SESSION['username'] = $found_user['username'];
		$_SESSION['group'] = $found_user['category'];

		redirect_to("main.php");
	} else {
		if(getUserStatus($username)=="NO"){
			$message = "<p style='color: red ;'>Username is not Active.<br />
					Please Contact Your Admin and  try again.</p>";
			
		}else{
			$message = "<p style='color: red ;'>Username/password Combination Incorrect.<br />
					Please make sure your CapsLock key is Off and try again.</p>";
			
		}
		// username/password combo was not found in the database
		
	}
		
}else { // Form has not been submitted.
	if (isset($_GET['logout']) && $_GET['logout'] == 1) {
		$message = "You are now logged out.";
	}
	$username = "";
	$password = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>AfricMed | Modern Record System Application</title>

<!--                       CSS                       -->

<!-- Reset Stylesheet -->
<link rel="stylesheet" href="resources/css/reset.css" type="text/css"
	media="screen" />

<!-- Main Stylesheet -->
<link rel="stylesheet" href="resources/css/style.css" type="text/css"
	media="screen" />

<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css"
	media="screen" />

<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		<link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
		
		<link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
	 
		-->

<!-- Internet Explorer Fixes Stylesheet -->

<!--[if lte IE 7]>
			<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
		<![endif]-->

<!--                       Javascripts                       -->

<!-- jQuery -->
<script type="text/javascript"
	src="resources/scripts/jquery-1.3.2.min.js"></script>

<!-- jQuery Configuration -->
<script type="text/javascript"
	src="resources/scripts/simpla.jquery.configuration.js"></script>

<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="resources/scripts/facebox.js"></script>

<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>

<!-- Internet Explorer .png-fix -->

<!--[if IE 6]>
			<script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->

</head>

<body id="login">

<div id="login-wrapper" class="png_bg">
<div id="login-top">

<h1>AfricMed | Modern Record System Application</h1>
<!-- Logo (221px width) --> <img id="logo" width="750"
	src="images/africmed_big.png" alt="logo" /></div>
<!-- End #logn-top -->

<div id="login-content">

<form action="index.php" method="post">

<div class="notification information png_bg">
<div><?php if(isset($message)){echo $message;}else{echo "Please Log In Here ";}?>
</div>
</div>

<p><label>Username</label> <input class="text-input" type="text"
	id="username" name="username" /></p>
<div class="clear"></div>
<p><label>Password</label> <input class="text-input" type="password"
	id="password" name="password" /></p>
<div class="clear"></div>

<div class="clear"></div>
<p><input class="button" type="submit" name="submit" id="submit"
	value="Sign In" /></p>

</form>


</div>
<!-- End #login-content --></div>
<!-- End #login-wrapper -->

</body>

</html>
