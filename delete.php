<? 
include('config.php'); 
$id = (int) $_GET['id']; 
if (isset($_REQUEST['id']) && $_REQUEST['confirmed'] == 1){
	mysqli_query($link, "DELETE FROM `lifelog` WHERE `id` = '$id' ") ; 
	// echo (mysqli_affected_rows($link)) ? "Entry deleted.<br /> " : "Nothing deleted.<br /> "; 
	header("Location: index.php");
	// die();
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
