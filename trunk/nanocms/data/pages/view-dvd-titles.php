<?php
/**********************************************
*	View details of DVD page
*	Developer: Paul Ryan
*	Completion date: 12/11/2010
***********************************************
*/
	session_start();
/*
	$uname = $_SESSION['uname'];
	
	if ($_SESSION['uname'])
	{
		//Welcome info
		echo "<div class='welcome'>Welcome " . $uname . "<br />";
		echo "<a href='logout.php'>Logout</a></div>";
	}
	else 
		echo "<div class='welcome'><a href='index.php'>Login</a></div>";
*/
		
	$id = $_GET['id'];
		
	$file = "../../file/movies.txt";
	$fileh = fopen($file, 'r');

	if ($fileh)
	{
		$filecontents = file_get_contents($file);
		$contentsarray = explode("\n", $filecontents);
		fclose($fileh);

		foreach($contentsarray as $content)
		{
			$explode = explode("~", $content);
			if ($explode[0] != "") //check for the blank line at the end of the file
			{
				if ($explode[0] == $id)
				{
					//echo "details of " . $id;
					$title = $explode[1];
					$year = $explode[2];
					$category = $explode[3];
					$classification = $explode[4];
					$director = $explode[5];
					$actors =  $explode[6];
					$short_desc = $explode[7];
					$long_desc = $explode[8];
					$image = $explode[9];
				}
			}	
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Browse DVD details</title>
	<link rel="stylesheet" type="text/css" media="screen" href="../../style.css" />
</head>

<body>
<div class="dvd_table">
	<table>
		<tr>
			<td>Title:<br /><?php echo $title; ?></td>
			<td>Category:<br /><?php echo $category; ?></td>
			<td rowspan="5"><?php echo '<img src="../../images/' . $image . '" alt="' . $image . '" class="DVDimg"/>' ?></td>
		</tr>
		<tr>
			<td>Released:<br /><?php echo $year; ?></td>
			<td>Director:<br /><?php echo $director; ?></td>
		</tr>
		<tr>
			<td colspan="2">Actors:<br /><?php echo $actors; ?></td>
		</tr>
		<tr>
			<td colspan="2">Classified:<br /><?php echo $classification; ?></td>
		</tr>
		<tr>
			<td colspan="2">Short Comment:<br /><?php echo $short_desc; ?></td>
		</tr>
		<tr>
			<td colspan="3">Long Comment:<br /><?php echo $long_desc; ?></td>
		</tr>
	</table>
</div>
</body>
</html>