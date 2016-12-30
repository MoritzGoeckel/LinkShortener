<?php 

include("inc/dblogin.php"); 
include("inc/fb_begin.php"); 


//Neuen Link eintragen
if(isset($_GET['url']) && isset($_GET['site']) && $_GET['site'] == "newlink")
	{
		$url = $_GET['url'];
		//In DB eintragen
		
		$userToInsert = "null";
		if ($user != 0 && $user != "0" && $user != null)
		{
			$userToInsert = $user_profile['email'];
		}
		
		mysqli_query($db,"INSERT INTO link (dest, user) VALUES ('" . urldecode($url) . "', '".$userToInsert."')");
		
		$redict = "http://minutus.de?site=showlink&id=" . mysqli_insert_id($db);
		header("Location: " . $redict);
	}
?>

<html>
<head>
<title><?php 

$title = "Minutus.de | ";

if (isset($_GET['site']) && $_GET['site'] == "help")
{
	$title .= "Help";
}
else if (isset($_GET['site']) && $_GET['site'] == "manage")
{
	$title .= "Link Manager";
}
else if (isset($_GET['site']) && $_GET['site'] == "api")
{
	$title .= "API";
}
else if (isset($_GET['site']) && $_GET['site'] == "impressum")
{
	$title .= "Impressum";
}else if (isset($_GET['site']) && $_GET['site'] == "edit")
{
	$title .= "Edit";
}
else
{
	$title = "Minutus.de | Link Shortener";
}

echo $title;

?></title>
</head>

<link rel="stylesheet" type="text/css" href="css/styles.css">

<div id="center">
	<table border="0" align="center" width="100%">
		<tr>
			<td>
				<table border="0" align="center" width="100%">
					<tr>
						<td width="66%" height="180px" align="center">	
							<span class="headerText">Minutus.de</span>
						</td>
						<td width="33%" height="180px">	
							<a href="?site=help"><div id="box">Help</div></a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" align="center" width="100%">
					<tr>
						<td width="33%" height="180px">
							<div id="box_not_move">Shorten link
														
							<form action="index.php" type="GET">
								<input name="url" type="text" class="textinput" placeholder="insert url here...">
								<input type="hidden" name="site" value="newlink" />
								<input type="submit" class="button" value="Shorten!">
								
							</form>
							
							</div>
						</td>
						<td width="33%" height="180px">
							<a href="?site=manage"><div id="box">Manage links</div></a>
						</td>
						<td width="33%" height="180px">
							<a href="?site=api"><div id="box">API</div></a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<?php if (isset($_GET['site']) && file_exists("sites/" . $_GET['site'] . ".php")): ?>
		<tr>
			<td>
				<div id="border_box_big">
					<?php include("sites/" . $_GET['site'] . ".php"); ?>			
				</div>
			</td>
		</tr>
		<?php endif; ?>
		
		<tr>
			<td>
				<table border="0" align="center" width="100%">
					<tr>
						<td width="33%" height="180px">
							<a href="?site=impressum"><div id="box">Impressum</div></a>
						</td>
						
						<?php if ($user != 0 && $user != "0" && $user != null): ?>
						
						<?php
							//Check ob eingetragen
							$result = mysqli_query($db,"SELECT * FROM user WHERE email = '" . $user_profile['email'] . "'");
							if(mysqli_affected_rows($db) == 0)
							{
								//Reinschreiben
								mysqli_query($db,"INSERT INTO user (name, email) VALUES ('" . $user_profile['name'] . "', '" . $user_profile['email'] . "')");
							}					
						?>
						
						<td width="33%" height="180px">
							<div id="border_box">
									You are logged in:<br>
									<table border="0">
									  <tr>
										<th><img style="border: 3px solid black" src="https://graph.facebook.com/<?php echo $user; ?>/picture"></th>
										<th><?php echo $user_profile['name'] . "<br>" . $user_profile['email']; ?></th>
									  </tr>
									</table>
							</div>
						</td>
						
						<td width="33%" height="180px">
							
						</td>
						
						<?php else: ?>
						
						<td width="33%" height="180px">
							<div id="no_box" style="background-image: url(pics/arrow.png);"><span class="standard_font">Log in with Facebook in order to manage your links and to see the statistics.</span></div>
						</td>
						<td width="33%" height="180px">
							<a href="<?php echo $loginUrl; ?>"><div id="box_blue" style="background-image: url(pics/login.png);"></div></a>
						</td>
						
						<?php endif; ?>
						
					</tr>
				</table>
			</td>
		</tr>
	</table>

</div>

</body>
</html>