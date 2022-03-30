<?

/*
Life log project began May 17, 2015
May 21 - set up security, list of items below the timeline, CRUD framework
May 22 - set up log.oridou.com, cleaned up code and broke up into modules/
May 24 - integrated CRUD stuff into the main program
May 25 - implemented new login form screen, added logout button, simplified menu & style, built 2-col input form, colored mood buttons, implemented modal detail windows, built in edit function
may 26 - made tweaks to the timeline, recorded a lot of events from my work calendar and memory.
may 27 - fixed line breaks, removed modal fade, added edit and delete buttons from modal, integrated edit function into the main index.php.
july 3 - fixed cache_miss error by adding redirect headers
sept 23 - worked on mood calendar chart
oct 1 - removed the calendar chart because it kills mobile
feb 10, 2016 - installed option for displaying chart on login screen

to do:


done:
display mood on timeline with color/other
make items deletable from timeline
make items viewable from clicking timeline
display only first characters on timeline
solve issue with timeline not displaying after first-time login
password protect
break up into modules
*/

include('config.php');
session_start();

// LOG OUT
if($_GET[f] == logout){$_SESSION['auth'] = 1;session_destroy(); header('Location: index.php'); die;}

// LOG IN
if($_GET[f] == login){ // ?f=login
	if(hash('md5',$_POST['password'],FALSE) == $passhash){ // check password
		session_start();
		$_SESSION['auth'] = 1;
		$_SESSION['chart'] = $_REQUEST['displayChart'];
		// echo "password matched hash!";
		header('Location: index.php');
	}
	else{echo "<strong>Incorrect password!</strong>";}
}

if($_SESSION['auth'] == 1){ // security check -- this bracket carries all the way to the bottom of the file. Not bothering to indent all that.

// RECORD NEW EVENT
if ($_POST['f'] == 'add' && isset($_POST['submitted']) == true) {
	if($_POST['textInput'] == ''){ echo "Did not record. Input blank."; } // catch blank entry
	else{
		foreach($_POST AS $key => $value) {
			$_POST[$key] = mysql_real_escape_string($value);
			}
		$textToWrite = $_POST[textInput];
		$sql = "INSERT INTO `lifelog` ( `text` ,  `mood` ,    `dateSet`  ) VALUES(  '{$textToWrite}' ,  '{$_POST['mood']}' ,     STR_TO_DATE('".$_POST[date]."', '%m/%d/%Y')  ) ";
		mysql_query($sql) or die(mysql_error());
		header('Location: index.php');
	}
}

// GENERATE LIST OF EVENTS
$result = mysql_query("SELECT * FROM lifelog");
$i=1;
while($row = mysql_fetch_array($result)){
	// format: {id: 1, content: 'item 1', start: '2014-04-20'}
	$textToDisplay = '<a data-toggle="modal" data-target="#detail'.$row['id'].'">'.str_replace(array("\r", "\n", "\"", "'"), "", substr($row[text], 0, 80)).'</a>';
	$eventsOutput .= "{id: ".$i.", content: '".$textToDisplay."', start:'".$row[dateSet]."', type: 'point'},";
  $i++;
}

include('modules/header.php');

if($_REQUEST['f'] == 'add' && isset($_POST['submitted']) == false){ // NEW RECORD FORM
	include('modules/add.php');
}
elseif($_REQUEST['f'] == 'edit' && isset($_POST['submitted']) == false){  // EDIT RECORD FORM
	include('modules/edit.php');
}
else{
	if($_SESSION['chart'] == 1){	?>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		 <script type="text/javascript">
		   google.load("visualization", "1.1", {packages:["calendar"]});
		   google.setOnLoadCallback(drawChart);

		function drawChart() {
			var dataTable = new google.visualization.DataTable();
			dataTable.addColumn({ type: 'date', id: 'Date' });
			dataTable.addColumn({ type: 'number', id: 'mood' });
			dataTable.addColumn({ type: 'string', role: 'tooltip' });
			dataTable.addRows([

				<?
				$curYear = date("Y");
				$result = mysql_query("SELECT * FROM `lifelog` WHERE dateSet > '".$curYear."-01-01' ORDER BY dateSet DESC") or trigger_error(mysql_error());
				while($row = mysql_fetch_array($result)){
					foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
					echo "[ new Date('";
					//echo substr($row[dateSet],0,10);
					echo $row['dateSet'];
					echo "'), ";
					echo $row[mood];
					echo ", '";
					echo addslashes(substr($row[text],0,101))."...";
					echo "'],";
				}
			 ?>
			 ]);

			var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

			var options = {
			  title: "mood",
			  height: 185,
			};

			chart.draw(dataTable, options);
		}
		 </script>
		<div id="calendar_basic" class="col-md-12 column visible-lg-* hidden-sm hidden-xs" style="width: 1000px; height: 185px;"></div>
	<? } ?>
	<? include('modules/table.php'); /*bring in the table*/?>

<?
}

include('modules/footer.php');

mysql_close($link);
} // end security

else{ // security check fails, display login field.
	include('modules/loginForm.php');
}