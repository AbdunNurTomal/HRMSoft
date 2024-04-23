<?php
/**
 * @filename	add_note.php
 * @author		Mahfuzul Hoque Khan
 * @date		02 October 2020
 */

// date_default_timezone_set( 'UTC' );
// date_default_timezone_set('America/Chicago');
//https://hrcsoft.com/Con_Employee_Note/index/249

if( is_null( $note_size ) )
{
	$note_size = 300;
}
?>

<style>
#add_note #btnEmployeeNoteClose{ display : none; }
#s2id_note_priority{ margin-bottom: 3px; }
#employee-note-message{max-width: 100%;max-height: 500pt;}

    .view_add_note_container{margin-top: 0px;}
    .company_select_alert{ margin: 0;padding: 10pt;background: #d6d668;color: #403b32;text-align: center;}
<?php
if( $has_company_selected )
{
?>
	.view_add_note_container{padding-bottom: 15px;}
<?php
}
?>
</style>

<script>
	var note_size	= <?php echo $note_size	; ?>;

	console.warn( 'note_size:', note_size );
	console.warn( 'date:', '<?php echo $date	; ?>' );
	console.warn( 'time:', '<?php echo $time	; ?>' );
	console.warn( 'datetime:', '<?php echo $datetime	; ?>' );
	console.warn( 'date_default_timezone_get:', '<?php echo date_default_timezone_get ( )	; ?>' );
//	console.warn( 'local_datetime:', '<?php echo $local_datetime	; ?>' );
</script>
<div id="employee_add_note_div">   

		<div class="container tag-box-v3-employee-note view_add_note_container">
			
		<?php
		if( $has_company_selected )
		{
		?>
			<form id="employee-note-form" class="form-horizontal" method="POST" action="<?php echo site_url('Con_Employee_Note/addNote'); ?>" role="form">
				<div class="col-sm-12">
					<div class="form-group">
					</div>
				</div>
			
				<!-- container well div -->
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-4 control-label">HR Representative</label>
						<div class="col-sm-4">
							<input type="text" name="hr_representative" id="hr_representative" value="<?= $user_name; ?>" readonly="readonly" class="form-control input-sm" placeholder="HR Representative" data-toggle="tooltip" data-placement="bottom" title="HR Representative">
							<input type="hidden" name="hr_representative_id" id="hr_representative_id" value="<?= $user_id; ?>" readonly="readonly" class="form-control input-sm">
						</div>
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-4 control-label">Date & Time</label>
						<div class="col-sm-4">
							<input type="text" name="note_date" id="note_date" class="form-control dt-pick input-sm" value="" readonly="readonly" placeholder="Note issue Date & Time" data-toggle="tooltip" data-placement="bottom" title="Note Create Date & Time" autocomplete="off" />
							<!--
							<input type="hidden" name="note_date_time" id="note_date_time" class="form-control input-sm" value="< ?php echo $date; ? >" readonly="readonly" />
							-->
						</div>
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="form-group">
					</div>
				</div>
			
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-4 control-label">Employee</label>
						<div class="col-sm-4">
							<input type="text" name="note_employee" id="note_employee" value="<?php echo $return_name; ?>" readonly="readonly" class="form-control input-sm" placeholder="Note on Employee" data-toggle="tooltip" data-placement="bottom" title="Note on Employee">
							<input type="hidden" name="note_employee_id" id="note_employee_id" value="<?php echo $employee_id; ?>" readonly="readonly" class="form-control input-sm">
						</div>
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-4 control-label">Department</label>
						<div class="col-sm-4">
							<input type="text" name="note_department" id="note_department" value="<?php echo $department; ?>" readonly="readonly" class="form-control input-sm" placeholder="Department" data-toggle="tooltip" data-placement="bottom" title="Department">
							<input type="hidden" name="note_department_id" id="note_department_id" value="<?php echo $departmentId; ?>" readonly="readonly" class="form-control input-sm">
						</div>
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-4 control-label">Priority</label>
						<div class="col-sm-4">
							<select name="note_priority" id="note_priority" class="col-xs-12 myselect2 input-sm" title="Note Priority">
								<option value="NORMAL">Normal</option>
								<option value="LOW">Low</option>
								<option value="MEDIUM">Medium</option>
								<option value="HIGH">High</option>
								<option value="CRITICAL">Critical</option>
							</select>
						</div>
					</div>
				</div>
			
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-4 control-label">Title</label>
						<div class="col-sm-4">
							<input type="text" name="note_title" id="note_title" class="form-control input-sm" placeholder="Note Title" data-toggle="tooltip" data-placement="bottom" title="Note Title" autocomplete="off" maxlength="50" />
						</div>
					</div>
				</div>
			
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-4 control-label">Note</label>
						<div class="col-sm-4">
							<textarea id="employee-note-message" type="text" name="employee-note-message" class="form-control input-sm" rows="4" placeholder="Note" data-toggle="tooltip" data-placement="bottom" title="Note" maxlength="<?php echo $note_size; ?>"></textarea>
							<span id="word-count-div" style="display: none;"><span id="rchars"><?php echo $note_size; ?></span> Character(s) Remaining</span>
						</div>
					</div>
				</div>

				<div class="col-sm-12 text-center" style="margin-top: 10px;" id="note">
					<div id="employee-note-alert" class="alert alert-success" role="alert" style="display: none;">Note added</div>
					<div id="employee-note-error-alert" class="alert alert-danger" role="alert" style="display: none;"></div>
				</div>

				<div class="col-sm-12" style="margin-top: 10px;">
					<div class="modal-footer">
						<button id="btnAddNote" type="button" class="btn btn-u" disabled>Add Note</button>
						<a id="btnEmployeeNoteClose" class="btn btn-danger" href="<?php echo $backPG; ?>">Exit</a>
					</div>
				</div>
			</form>
		<?php
		}
		else
		{
		?>
			<h3 class="company_select_alert">Please select a company from dashboard</h3>
		<?php
		}
		?>
		</div>
		<!-- </div> -->
</div>
<!--=== End Content ===-->

<script src="/assets/js/notes/note_util.js"	></script>
<script src="/assets/js/notes/word_count.js"></script>
<script src="/assets/js/notes/add_note.js"	></script>
