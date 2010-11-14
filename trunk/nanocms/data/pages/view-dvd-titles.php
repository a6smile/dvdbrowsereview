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
	
	$file = "file/movies.txt";
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
					echo "details of " . $id;
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
	<table>
		<tr>
			<td><?php echo $title; ?></td>
			<td><?php echo $category; ?></td>
			<td rowspan="5"><?php echo '<img src="img/' . $image . '" alt="' . $image . '" />' ?></td>
		</tr>
		<tr>
			<td><?php echo $year; ?></td>
			<td><?php echo $director; ?></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo $actors; ?></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo $classification; ?></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo $short_desc; ?></td>
		</tr>
		<tr>
			<td colspan="3"><?php echo $long_desc; ?></td>
		</tr>
	</table>