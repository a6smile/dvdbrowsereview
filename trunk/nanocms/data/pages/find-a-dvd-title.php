<?php
/**********************************************
*	DVD Search page
*	Developer: Paul Ryan
*	Completion date: 13/11/2010
***********************************************
*/
	session_start();
//	$uname = $_SESSION['uname'];
	$match_array = $_SESSION['match_array'];
	$file = "file/movies.txt";
	
	//Set the category based on the one selected from the combo box
	$title = $_POST['title'];
	$year = $_POST['year'];
	$category = $_POST['category'];
	$classification = $_POST['classification'];
	$director = $_POST['director'];
	$actors = $_POST['actors'];

	$sort = $_GET['sort'];
	if(!isset($sort))
	{
		$sort = "title";
	}

	if (isset($_POST['submit']))
	{
		$_SESSION['title'] = $title;
		$_SESSION['year'] = $year;
		$_SESSION['category'] = $category;
		$_SESSION['classification'] = $classification;
		$_SESSION['director'] = $director;
		$_SESSION['actors'] = $actors;

		//Open the movie file and read all the records for the current search into an array
		$match_array = array();
		$fileh = fopen($file, 'r');
		
		if ($fileh)
		{
			$filecontents = file_get_contents($file);
			$contentsarray = explode("\n", $filecontents);
			fclose($fileh);
			
			foreach($contentsarray as $content)
			{
				$titlematch = true;
				$yearmatch = true;
				$catmatch = true;
				$classmatch = true;
				$dirmatch = true;
				$actormatch = true;
				
				$explode = explode("~",$content);
				if ($title != "")
				{
					$found = stristr($explode[1], $title);
					if (!$found)
					{
						$titlematch = false;
					}
				}

				if ($year != "")
				{
					$found = stristr($explode[2], $year);
					if (!$found)
					{
						$yearmatch = false;
					}
				}

				if ($category != "All")
				{
					if ($explode[3] != $category)
					{
						$catmatch = false;
					}
				}

				if ($classification != "All")
				{
					//echo "explode=" . $explode[4] . " $class=" . $classification . "<br />";
					if ($explode[4] != $classification)
					{
						$classmatch = false;
					}
				}

				if ($director != "")
				{
					$found = stristr($explode[5], $director);
					if (!$found)
					{
						$dirmatch = false;
					}
				}

				if ($actors != "")
				{
					$found = stristr($explode[6], $actors);
					if (!$found)
					{
						$actormatch = false;
					}
				}

				if (($titlematch && $yearmatch && $catmatch && $classmatch && $dirmatch && $actormatch) && $explode[0] != "")
				{
					$match_array['id'][] = $explode[0];
					$match_array['title'][] = $explode[1];
					$match_array['year'][] =  $explode[2];
					$match_array['category'][] = $explode[3];
					$match_array['classification'][] = $explode[4];
					$match_array['director'][] = $explode[5];
					$match_array['actors'][] = $explode[6];
					$match_array['desc'][] = $explode[7];
				}
			}
			$_SESSION['match_array'] = $match_array;
		}
	}
	
	//Sort the array by the selected field
	if (count($match_array) > 0)
		asort($match_array[$sort]);

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
				<option>All</option>
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
				<option>All</option>
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
				<td colspan="2"><input type="submit" name="submit" id="submit" value="Search" /></td>
			</tr>
		</table>
	</form>
	
	<table>
		<tr>
			<th>Title</th>
			<th>Year</th>
			<th>Category</th>
			<th>Classification</th>
			<th>Director</th>
			<th>Actors</th>
			<th>Description</th>
		</tr>
	
		<?php
			if (count($match_array) == 0)
				echo "<td colspan='7'>No DVDs found.</td>";
			else
			{
				//Display the rows of the table
				foreach($match_array[$sort] as $key=>$value)
				{
					echo "<tr>";
					echo '<td><a href=data/pages/view-dvd-titles.php?id=' . $match_array['id'][$key] . '>' . $match_array['title'][$key] . '</a></td>';
					echo "<td>" . $match_array['year'][$key] . "</td>";
					echo "<td>" . $match_array['category'][$key] . "</td>";
					echo "<td>" . $match_array['classification'][$key] . "</td>";
					echo "<td>" . $match_array['director'][$key] . "</td>";
					echo "<td>" . $match_array['actors'][$key] . "</td>";
					echo "<td>" . $match_array['desc'][$key] . "</td>";
					echo "</tr>";
				}
					echo "<tr><td colspan='7'>" . count($match_array['id']) . " DVDs found.</td></tr>";
			}
		?>
	</table>