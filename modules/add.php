<h3>New entry</h3>
<form role="form" method="post" action="index.php">
	<div class="col-md-12">
		<h4>Mood</h4>
		<div class="btn-group btn-group-justified" data-toggle="buttons">
			<label class="btn btn-danger"><input type="radio" name="mood" value="-10"/>-10</label>
			<label class="btn btn-danger"><input type="radio" name="mood" value="-9"/>-9</label>
			<label class="btn btn-danger"><input type="radio" name="mood" value="-8"/>-8</label>
			<label class="btn btn-danger"><input type="radio" name="mood" value="-7"/>-7</label>
			<label class="btn btn-danger"><input type="radio" name="mood" value="-6"/>-6</label>
			<label class="btn btn-danger"><input type="radio" name="mood" value="-5"/>-5</label>
			<label class="btn btn-warning"><input type="radio" name="mood" value="-4"/>-4</label>
			<label class="btn btn-warning"><input type="radio" name="mood" value="-3"/>-3</label>
			<label class="btn btn-warning"><input type="radio" name="mood" value="-2"/>-2</label>
			<label class="btn btn-warning"><input type="radio" name="mood" value="-1"/>-1</label>
			<label class="btn btn-default"><input type="radio" name="mood" value="0" checked/>0</label>
			<label class="btn btn-warning"><input type="radio" name="mood" value="1"/>+1</label>
			<label class="btn btn-warning"><input type="radio" name="mood" value="2"/>+2</label>
			<label class="btn btn-warning"><input type="radio" name="mood" value="3"/>+3</label>
			<label class="btn btn-warning"><input type="radio" name="mood" value="4"/>+4</label>
			<label class="btn btn-success"><input type="radio" name="mood" value="5"/>+5</label>
			<label class="btn btn-success"><input type="radio" name="mood" value="6"/>+6</label>
			<label class="btn btn-success"><input type="radio" name="mood" value="7"/>+7</label>
			<label class="btn btn-success"><input type="radio" name="mood" value="8"/>+8</label>
			<label class="btn btn-success"><input type="radio" name="mood" value="9"/>+9</label>
			<label class="btn btn-success"><input type="radio" name="mood" value="10"/>+10</label>
		</div>
		<br/>
	</div>
	
	<div class="col-md-6">
		<label for="textInput"><h4>Journal entry</h4></label><textarea name="textInput" type="textarea" class="form-control" id="textInput" style="width:100%;height:400px;"></textarea>
	</div>

	<div class="col-md-6">
		<h4>Date</h4>
		<div id="datepickr"></div>
		<input type="hidden" id="date" name="date"/>
	</div>
	
	<div class="col-md-12">
		<br/>
		<button type="submit" class="btn btn-primary">Save</button>
		<input type='hidden' value='1' name='submitted' />
		<input type='hidden' value='add' name='f' />
	</div>
</form>

<script>			
	$('#datepickr').datepicker({
	    todayBtn: "linked",
	    todayHighlight: true
	});
	$("#datepickr").on("changeDate", function(event) {
	    $("#date").val(
	        $("#datepickr").datepicker('getFormattedDate')
	     )
	});
	$(function() {
    $("#datepickr").datepicker({
        dateFormat: "yy-mm-dd"
    }).datepicker("setDate", "0");    // Here the current date is set
	});		
</script>
