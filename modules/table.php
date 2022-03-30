<br/>
<table class="table">
	<tr>
	<td><b><center>date</center></b></td>
	<td></td>
	<td><b><center>mood</center></b></td>
	<td><b><center>updated</center></b></td>
	</tr>

	<?
	$result = mysql_query("SELECT * FROM `lifelog` ORDER BY dateSet DESC") or trigger_error(mysql_error());
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
	echo "<tr>";
	echo "<td style='vertical-align: middle;' class='text-nowrap'><center><a data-toggle='modal' data-target='#detail".$row['id']."'>" . date("D M j Y", strtotime($row['dateSet'])) . "</a></center></td>";  
	echo "<td valign='top'>" . nl2br( truncText($row[text], 80)) . $tbc . "</td>";
	if ($row['mood'] > -1 && $row['mood'] < 5 ){ $certStyle = "color:orange;"; }
	elseif ($row['mood'] > 4){ $certStyle = "color:green;"; }
	elseif ($row['mood'] < 0){ $certStyle = "color:red;"; }
	else{ $certStyle = "color:black;"; }
	echo "<td style='vertical-align: middle;' class='text-nowrap'><center><span class='glyphicon glyphicon-certificate' style='".$certStyle."'></span> <small>" . nl2br( $row['mood']) . "</small></center></td>";  
	echo "<td style='vertical-align: middle;' class='text-nowrap'><center>" . relativeTime($row['dateRecorded']) . "</center></td>"; 
	echo "</tr>"; 
	?>
	<!-- Modal -->
	<div id="detail<?=$row['id']?>" class="modal" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><? echo date("l M j, Y", strtotime($row['dateSet'])); ?></h4>
	      </div>
	      <div class="modal-body">
	        <p><? echo nl2br($row["text"]); ?></p>
	        <p><small>Last updated: <?=date("l M j, Y", strtotime($row['dateRecorded']))?></small></p>
	      </div>
	      <div class="modal-footer">
	      <span style="float:left;"><a href="delete.php?id=<?=$row['id']?>"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a></span>
	        <a href="edit.php?id=<?=$row['id']?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button></a>  <button type="button" class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
	      </div>
	    </div>
	  </div>
	</div><?
	}  // ends foreach db records
	echo "</table>";