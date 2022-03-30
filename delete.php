<? 
include('config.php'); 
$id = (int) $_GET['id']; 
if (isset($_REQUEST['id']) && $_REQUEST['confirmed'] == 1){
	mysql_query("DELETE FROM `lifelog` WHERE `id` = '$id' ") ; 
	// echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
	header("Location: ".$baseURL);
	die();
}
else{
	include_once('modules/header.php');
	?>
	
	<script>
	var r = confirm("Are you sure you want to delete entry <?=$id?>?");
	if (r == true) {
	    window.location.href = "<?=$baseURL?>delete.php?id=<?=$id?>&confirmed=1";
	} else {
	    window.location.href = "<?=$baseURL?>";
	}
	</script>

<? } ?>