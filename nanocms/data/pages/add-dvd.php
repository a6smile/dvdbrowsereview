<?php
/**********************************************
*	Add New DVD page
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
		
	if (isset($_POST['submit']))
	{
		$title = htmlentities(addslashes($_POST['title']));
		$year = htmlentities(addslashes($_POST['year']));
		$category = htmlentities(addslashes($_POST['category']));
		$classification = htmlentities(addslashes($_POST['classification']));
		$director = htmlentities(addslashes($_POST['director']));
		$actors = htmlentities(addslashes($_POST['actors']));
		$short = htmlentities(addslashes($_POST['short_desc']));
		$long = htmlentities(addslashes($_POST['long_desc']));
		$image = htmlentities(addslashes($_POST['image']));

		$_SESSION['title'] = $title;
		$_SESSION['year'] = $year;
		$_SESSION['category'] = $category;
		$_SESSION['classification'] = $classification;
		$_SESSION['director'] = $director;
		$_SESSION['actors'] = $actors;
		$_SESSION['short'] = $short;
		$_SESSION['long'] = $long;
		$_SESSION['image'] = $image;

		//$uname = $_SESSION['uname'];

		//Error checking
		//All values must be entered and not contain a semi colon
		if ($title == '')
			echo "Title must be entered";
		elseif ($year == '')
			echo "Year of Release must be entered";
		elseif ($category == '')
			echo "Category must be selected";
		elseif ($classification == '')
			echo "Classification must be selected";
		elseif ($director == '')
			echo "Director must be entered";
		elseif ($actors == '')
			echo "Actors must be entered";
		elseif ($short == '')
			echo "Short Description must be entered";
		elseif ($long == '')
			echo "Long description must be entered";
		elseif ($image == '')
			echo "Image file must be entered";
		elseif ((strpos($title, "~") != 0) || (strpos($year, "~") != 0) || (strpos($director, "~") != 0) || (strpos($actors, "~") != 0) || (strpos($short, "~") != 0) || (strpos($long, "~") != 0) || (strpos($image, "~") != 0))
			echo "~ may not be used in text fields";
		elseif(!file_exists("images/" . $image))
			echo $image . " does not exist in the img folder";
		else
		{
			$id_file = "file/id.txt";
			$id_fileh = fopen($id_file,'r');
			$id_num = file_get_contents($id_file);
			$id_num++;
			//echo $id_num;
			
			$id_fileh = fopen($id_file,'w');
			fwrite($id_fileh, $id_num);
			fclose($id_fileh);

			$file = "file/movies.txt";
			$fileh = fopen($file, 'a+');
			$result = fwrite($fileh, $id_num . "~" . $title . "~" . $year . "~" . $category . "~" . $classification . "~" . $director . "~" . $actors . "~" . $short . "~" . $long . "~" . $image . "\n");
			fclose($fileh);
			unset($_SESSION['title']);
			unset($_SESSION['year']);
			unset($_SESSION['category']);
			unset($_SESSION['classification']);
			unset($_SESSION['director']);
			unset($_SESSION['actors']);
			unset($_SESSION['short']);
			unset($_SESSION['long']);
			unset($_SESSION['image']);
		}
	}
?>

	<form id="form1" name="form1" method="post" action="<?php show_content_slug();?>">
		<table>
			<tr>
				<td><label for="title">Title</label></td>
				<td>
				<?php
					if (isset($_SESSION['title']))
						echo '<input type="text"  name="title" id="title" size="60" value="'  . $_SESSION['title']. '">';
					else
						echo '<input type="text" name="title" id="title" size="60" value=""/></td>';
				?>
				</td>
			</tr>
			<tr>
				<td><label for="year">Year of Release</label></td>
				<td>
				<?php
					if (isset($_SESSION['year']))
						echo '<input type="text"  name="year" id="year" size="8" value="'  . $_SESSION['year']. '">';
					else
						echo '<input type="text" name="year" id="year" size="8" value=""/></td>';
				?>
				</td>
			</tr>
			<tr>
				<td><label for="category">Category</label></td>
				<td><select name="category" id="category" size="1">
				<?php
					//Populate the combo with values from the category file
					$file = "file/category.txt";
					$fileh = fopen($file, 'r');
			
					if ($fileh)
					{
						$filecontents = file_get_contents($file);
						$contentsarray = explode("\n", $filecontents);
						fclose($fileh);
				
						foreach($contentsarray as $key => $value)
						{
							if ($value != "") //check for the blank line at the end of the file
							{
								if (trim($value) == $_SESSION['category'])
									echo "<option selected>" . $value . "</option>";
								else
									echo "<option>" . $value . "</option>";
							}	
						}
					}
				?>
				</select></td>
			</tr>
			<tr>
				<td><label for="classification">Classification</label></td>
				<td><select name="classification" id="Classification" size="1">
				<?php
					//Populate the combo with values from the category file
					$file = "file/classification.txt";
					$fileh = fopen($file, 'r');
			
					if ($fileh)
					{
						$filecontents = file_get_contents($file);
						$contentsarray = explode("\n", $filecontents);
						fclose($fileh);
				
						foreach($contentsarray as $key => $value)
						{
							$fileline = explode(";", $value);
							if ($fileline[0] != "") //check for the blank line at the end of the file
							{
								if (trim($value) == $_SESSION['classification'])
									echo "<option selected>" . $value . "</option>";
								else
									echo "<option>" . $value . "</option>";
							}
						}
					}
				?>
				</select></td>
			</tr>
			<tr>
				<td><label for="director">Director</label></td>
				<td>
				<?php
					if (isset($_SESSION['director']))
						echo '<input type="text"  name="director" id="director" size="60" value="' . $_SESSION['director'] . '">';
					else
						echo '<input type="text" name="director" id="director" size="60" value=""/></td>';
				?>
				</td>
			</tr>
			<tr>
				<td><label for="actors">Actors</label></td>
				<td>
				<?php
					if (isset($_SESSION['actors']))
						echo '<input type="text"  name="actors" id="actors" size="60" value="' . $_SESSION['actors'] . '">';
					else
						echo '<input type="text" name="actors" id="actors" size="60" value=""/></td>';
				?>
				</td>
			</tr>
			<tr>
				<td><label for="short_desc">Short Description</label></td>
				<td>
				<?php
					if (isset($_SESSION['short']))
						echo '<input type="text"  name="short_desc" id="short_desc" size="80" value="' . $_SESSION['short'] . '">';
					else
						echo '<input type="text" name="short_desc" id="short_desc" size="80" value=""/></td>';
				?>
				</td>
			</tr>
			<tr>
				<td><label for="long_desc">Long Description</label></td>
				<td>
				<?php
					if (isset($_SESSION['long']))
						echo '<textarea name="long_desc" id="long_desc" rows="4" cols="60">' . $_SESSION['long'] . '</textarea>';
					else
						echo '<textarea name="long_desc" id="long_desc" rows="4" cols="60"></textarea>';
				?>
				</td>
			</tr>
			<tr>
				<td><label for="image">Image File</label></td>
				<td>
				<?php
					if (isset($_SESSION['image']))
						echo '<input type="text"  name="image" id="image" size="80" value="' . $_SESSION['image'] . '">';
					else
						echo '<input type="text" name="image" id="image" size="80" value=""/></td>';
				?>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="submit" id="submit" value="Submit" />
				<input type="reset" name="reset" id="reset" value="Reset" /></td>
			</tr>
		</table>
	</form>