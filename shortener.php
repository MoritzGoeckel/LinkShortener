<?php 

include("inc/dblogin.php");
include("inc/encrypt_function.php");

$id = $_GET['id'];

//Zu ID
$id = decrypt($id);

//Click zaehlen
//Wenn nicht Facebook
if (in_array($_SERVER['HTTP_USER_AGENT'], array(
  'facebookexternalhit/1.1 (+https://www.facebook.com/externalhit_uatext.php)',
  'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)'))) 
{
	//it's probably Facebook's bot
	//nicht zeahlen
}
else {
	mysqli_query($db, "UPDATE link SET clicks = clicks + 1 WHERE id = " . $id);
}



//Nachschauen
$result = mysqli_query($db,"SELECT dest FROM link WHERE id = " . $id);
if(mysqli_num_rows($result) != 0)
{
	if($row = mysqli_fetch_array($result))
	{
		//Weiterleiten
		header("Location:" . $row['dest']);
		exit();
	}
}
else
{
	echo "Not found...";
}
?>