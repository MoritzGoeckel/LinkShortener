<?php
error_reporting(-1);
ini_set('error_reporting', E_ALL);

include("inc/dblogin.php"); 
include("inc/encrypt_function.php");

if(isset($_GET['auth']))
{
	$auth = $_GET['auth'];

	$result = mysqli_query($db,"SELECT email FROM user WHERE auth = '" . $auth . "'");
	if($row = mysqli_fetch_array($result))
	{
		$email = $row['email'];
		
		if($_GET['action'] == "new")
		{
			mysqli_query($db,"INSERT INTO link (dest, user) VALUES ('".urldecode($_GET['url'])."', '".$email."')");
			echo encrypt(mysqli_insert_id($db));
		}
		else if($_GET['action'] == "stats")
		{
			$result2 = mysqli_query($db,"SELECT clicks FROM link WHERE user = '" . $email . "' and id = " . decrypt($_GET['id']));
			if($row2 = mysqli_fetch_array($result2))
			{
				echo $row2['clicks'];
			}
			else
			{
				echo "id not found";
			}		
		}
		else if($_GET['action'] == "update")
		{
			mysqli_query($db,"UPDATE link SET dest = '".urldecode($_GET['url'])."' WHERE user = '" . $email . "' and id = " . decrypt($_GET['id']));
			if(mysqli_affected_rows($db) == 0)
			{
				echo "false";
			}
			else
			{
				echo "true";
			}
		}
		else if($_GET['action'] == "del")
		{
			mysqli_query($db,"DELETE link WHERE user = '" . $email . "' and id = " . decrypt($_GET['id']));	
			if(mysqli_affected_rows($db) == 0)
			{
				echo "false";
			}
			else
			{
				echo "true";
			}		
		}
		else if($_GET['action'] == "list")
		{
			$result2 = mysqli_query($db, "SELECT * FROM link WHERE user = '" . $email . "'");

			if (!$result2 || mysqli_affected_rows($db) == 0) {
    				echo "no result";
				exit;
			}
			
			echo "ID|URL|DESTINATION|CLICKS<br>";
			while ($row2 = mysqli_fetch_array($result2)) {
				echo $row2['id'] . "|" . "http://minutus.de/" . encrypt($row2['id']) . "|" . $row2['dest'] . "|" . $row2['clicks'] . "<br>";
			}		
		}
	}
	else
	{
		echo "auth not valid";
	}
}
else
{
	echo "enter auth";
}
?>