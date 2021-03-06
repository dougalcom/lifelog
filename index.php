<?
include ('config.php');
session_start();

// LOG OUT
if ($_GET['f'] == 'logout')
{
    $_SESSION['auth'] = 1;
    session_destroy();
    header('Location: index.php');
    die;
}

// LOG IN
if ($_GET['f'] == 'login')
{ // ?f=login
    if (hash('md5', $_POST['password'], false) == $passhash)
    { // check password
        session_start();
        $_SESSION['auth'] = 1;
        $_SESSION['chart'] = $_REQUEST['displayChart'];
        // echo "password matched hash!";
        header('Location: index.php');
    }
    else
    {
        echo "<strong>Incorrect password!</strong>";
    }
}

if ($_SESSION['auth'] == 1)
{ // security check -- this bracket carries all the way to the bottom of the file. Not bothering to indent all that.
    // RECORD NEW EVENT
    if ($_POST['f'] == 'add' && isset($_POST['submitted']) == true)
    {
        if ($_POST['textInput'] == '')
        {
            echo "Did not record. Input blank.";
        } // catch blank entry
        else
        {
            $textToWrite = mysqli_real_escape_string($link, $_POST['textInput']);
            $sql = "INSERT INTO `lifelog` ( `text` ,  `mood` ,    `dateSet` , `dateRecorded`  ) VALUES(  '" . $textToWrite . "' ,  '" . $_POST['mood'] . "' ,     STR_TO_DATE('" . $_POST[date] . "', '%m/%d/%Y'), '" . date('Y-m-d H:i:s') . "'  ) ";
            if (mysqli_query($link, $sql))
            {
                header('Location: index.php');
            }
            else
            {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    // GENERATE LIST OF EVENTS
    if ($result = mysqli_query($link, "SELECT * FROM lifelog"))
    {
        $i = 1;
        $eventsOutput = '';
        while ($row = mysqli_fetch_array($result))
        {
            // format: {id: 1, content: 'item 1', start: '2014-04-20'}
            $textToDisplay = '<a data-toggle="modal" data-target="#detail' . $row['id'] . '">' . str_replace(array(
                "\r",
                "\n",
                "\"",
                "'"
            ) , "", substr($row['text'], 0, 80)) . '</a>';
            $eventsOutput .= "{id: " . $i . ", content: '" . $textToDisplay . "', start:'" . $row['dateSet'] . "', type: 'point'},";
            $i++;
        }
    }

    include ('modules/header.php');

    if ($_REQUEST['f'] == 'add' && isset($_POST['submitted']) == false)
    { // NEW RECORD FORM
        include ('modules/add.php');
    }
    elseif ($_REQUEST['f'] == 'edit' && isset($_POST['submitted']) == false)
    { // EDIT RECORD FORM
        include ('modules/edit.php');
    }
    else
    {
?>
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
        $result = mysqli_query($link, "SELECT * FROM `lifelog` WHERE dateSet > '" . $curYear . "-01-01' ORDER BY dateSet DESC") or trigger_error(mysqli_error());
        while ($row = mysqli_fetch_array($result))
        {
            foreach ($row AS $key => $value)
            {
                $row[$key] = stripslashes($value);
            }
            echo "[ new Date('";
            echo $row['dateSet'];
            echo "'), ";
            echo $row[mood];
            echo ", '";
            echo addslashes(substr($row[text], 0, 101)) . "...";
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

	<? include ('modules/table.php'); /*bring in the table*/ ?>

<?
    }

    include ('modules/footer.php');

    mysqli_close($link);
} // end security
else
{ // security check fails, display login field.
    include ('modules/loginForm.php');
}

