<? 
include('config.php'); 
include('modules/header.php'); 
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
	$timeStamp = date('Y/m/d H:i:s',time());
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `lifelog` SET  `text` =  '{$_POST['text']}' ,  `mood` =  '{$_POST['mood']}' , `dateRecorded` =  '{$timeStamp}' ,  `dateSet` =  '{$_POST['dateSet']}'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `lifelog` WHERE `id` = '$id' ")); 
?>
<h2>entry <?=$_GET['id']?></h2>
<form action='' method='POST'> 
<p><b>Text:</b><br /><textarea name='text' style="width:100%;height:400px;"><?= stripslashes($row['text']) ?></textarea> 
<p><b>Mood:</b><br /><input type='text' name='mood' value='<?= stripslashes($row['mood']) ?>' /> 
<p><b>DateSet:</b><br /><input type='text' name='dateSet' value='<?= stripslashes($row['dateSet']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<br/><br/><a href=delete.php?id=<?=$_GET['id']?>>Delete entry <?=$_GET['id']?></a></td> 
</body></html>
<? } ?>