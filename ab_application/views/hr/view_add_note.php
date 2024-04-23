<?php
/**
 * @filename	view_add_note.php
 * @reference	View_Contact_Employee.php
 * @author		Mahfuzul Hoque Khan
 * @date		30 August 2020
 */

// echo "<pre>". print_r($this->session->userdata('hr_logged_in'), 1) ."</pre>";exit;

// print_r($this->company_id);exit;
$this->db->order_by("first_name", "asc");

if( $this->session->userdata('hr_logged_in')["user_group"] == 1 && $this->session->userdata('hr_logged_in')["company_view"] == 0)
{
	$employee_query = $this->db->get_where('main_employees', array('contact_via_text' => 1,'isactive' => 1));
}
else
{
	$employee_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'contact_via_text' => 1,'isactive' => 1));
}

$backPG = base_url() . "Con_Employee_Note/index/249/" . $search_id;

// if( is_null( $note_size ) )
// {
// 	$note_size = 300;
// }

?>

<style>
#employee-note-root-container .control-label{ text-align: right; }
span[role="department-id"]{display: inline-block;width: 0;visibility: hidden;}
</style>
<script>
	let hasBtnEmployeeNoteClose = true;
//	var note_size				= <?php echo $note_size; ?>;
</script>

<div id="employee-note-root-container" class="col-md-10 main-content-div">
	<div class="main-content">
		<div class="container conbre">
			<ol class="breadcrumb">
				<li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
				<li><a href="<?php echo $backPG; ?>"><?php echo $page_header; ?></a></li>
				<li class="active">Add Note</li>
			</ol>
		</div>
		
		<div class="container tag-box-v3-employee-note">
			<!-- container well div -->
			<div class="table-responsive col-md-12 col-centered">
				<form class="form-horizontal" action="<?php echo base_url() . 'Con_dashbord/search_company/'; ?>" method="post">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">Select an option</label>
							<div class="col-sm-4">
								<select id="employee-note-option" class="col-sm-12 col-xs-12 myselect2 input-sm" name="employee-note-option">
									<option value="department" selected>Department</option>
									<option value="group">User Group</option>
									<option value="employee">Employee</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div id="employee-note-by-department" class="container tag-box-v3-employee-note" style="margin-top: 0px; padding: 20px 0 15px; display: block;">
			<div class="table-responsive col-md-12 col-centered">
			
				<div class="tag-box-v3-employee-note">
					<form class="form-horizontal" action="<?php echo base_url() . 'Con_Employee_Note/search_Department/'; ?>" method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-4 control-label"> Department </label>
									<div class="col-sm-4">
										<select name="department_id" id="department_id" class="col-xs-12 myselect2 input-sm">
											<option></option>
											<?php
											foreach ($department_query->result() as $key) {
												$slct = ($search_criteria['department_id'] == $key->id) ? 'selected' : '';
												echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->department_name . '</option>';
											}
											?>
										</select>
									</div>
									<div class="col-sm-4">
										<!-- <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button>  -->
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>

				<!-- <input type="hidden" name="employee_id" id="employee_id"> -->
				<br>

				<table id="employee-note-datatable" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">
<!-- 								<input type="radio" name="select_all" value="1" id="department-table-select-all"> -->
							</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Department</th>
							<th>Mobile</th>
							<!-- <th>Actions</th>  -->
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>

			</div>
		</div>

		<div id="employee-note-by-group" class="container tag-box-v3-employee-note" style="margin-top: 0px; padding: 20px 0 15px; display: none;">
			<div class="table-responsive col-md-12 col-centered">
			
				<div class="tag-box-v3-employee-note">
					<form class="form-horizontal" action="<?php echo base_url() . 'Con_Employee_Note/search_Usergroup/'; ?>" method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-4 control-label"> User Group </label>
									<div class="col-sm-4">
										<select name="usergroup_id" id="usergroup_id" class="col-xs-12 myselect2 input-sm">
											<option></option>
											<?php
											foreach ($usergroup_query->result() as $key) {
												$slct1 = ($search_criteria['usergroup_id'] == $key->id) ? 'selected' : '';
												echo '<option value="' . $key->id . '" ' . $slct1 . '>' . $key->group_name . '</option>';
											}
											?>
										</select>
									</div>
									<div class="col-sm-4">
										<!-- <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button>  -->
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>

				<!-- <input type="hidden" name="employee_id" id="employee_id">  -->
				<br>

				<table id="employee-note-group-datatable" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">
<!-- 							<input type="radio" name="select_all" value="1" id="usergroup-table-select-all"> -->
							</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Department</th>
							<th>Mobile</th>
							<!-- <th>Actions</th>  -->
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>

			</div>
		</div>

		<div id="employee-note-by-employee" class="container tag-box-v3-employee-note" style="margin-top: 0px; padding: 20px 0 15px; display: none;">
			<div class="table-responsive col-md-12 col-centered">
				<table id="employee-note-by-employee-datatable" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">
<!-- 							<input type="radio" name="select_all" value="1" id="employee-table-select-all"> -->
							</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Department</th>
							<th>Mobile</th>
							<!-- <th>Actions</th>  -->
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
		
		<div class="container tag-box" style="margin-bottom: 20px">
			<h2></h2>
		</div>
		
		<?php include_once( 'tab/add_note.php' ); ?>
	</div>
</div>
<!--=== End Content ===-->

<script>
	let hasCompanySelected	= "<?php echo $has_company_selected; ?>";

	$("#employee-note-option").select2
	({
		placeholder: "Select Employee",
		allowClear: true
	});

	$("#employee-note-select").select2
	({
		placeholder: "Select Employee",
		allowClear: true,
	});

	$("#department_id").select2
	({
		placeholder: "Select department",
		allowClear: true
	});

	$("#usergroup_id").select2
	({
		placeholder: "Select User Group",
		allowClear: true
	});

	$(document).on("change", "#employee-note-option", function()
	{
		let selectedOption = $(this).val();

		$( "#word-count-div"				).hide();
		$( "#employee-note-message"			).val ( "" );
		$( "#department-table-select-all"	).prop( "checked", false );
		$( "#usergroup-table-select-all"	).prop( "checked", false );
		$( "#employee-table-select-all"		).prop( "checked", false );

		hideEmployeeNoteAlertMsg();

		$("#employee-note-by-department").hide();
		$("#employee-note-by-group").hide();
		$("#employee-note-by-employee").hide();
		$("#btnAddNote").prop("disabled", false);
		
		if(selectedOption === "employee")
		{
			$("#employee-note-by-employee").show();
		}
		else if(selectedOption === "group")
		{
			$("#btnAddNote").prop("disabled", true);
			$("#employee-note-by-group").show();
		}
		else if(selectedOption === "department")
		{
			$("#btnAddNote").prop("disabled", true);
			$("#employee-note-by-department").show();
		}

		$("#department_id").val("").trigger("change");
		$("#usergroup_id").val("").trigger("change");
	});

	/* document ready starts */
	$(document).ready(function()
	{
		if( !hasCompanySelected )
		{
//	 		alert( 'Please select a company' );
			
			return;
		}
		
		/* department dropdown change starts */
		$(document).on('change', '#department_id', function()
		{
			hideEmployeeNoteAlertMsg();
			$("#department-table-select-all").prop("checked", false);

			let myTable = $('#employee-note-datatable').DataTable(); // get the table ID

			// If you want totally refresh the datatable use this 
			// myTable.ajax.reload();
			let deptId = $(this).val();
			let new_url = base_url + "Con_Employee_Note/showEmployeesByDepartment?department_id=" + deptId;
			myTable.ajax.url(new_url).load()

			// If you want to refresh but keep the paging you can you this
			// myTable.ajax.reload( null, false );
		});
		/* department dropdown change ends */

		let base_url = "<?php echo base_url(); ?>";

		/* datatable for contact employee by employee starts */
		let employeeNoteTable = $('#employee-note-datatable').DataTable
		({
			"pageLength"		: 10
		,	"paginationType"	: "input"
// 		,	"serverSide"		: true
		,	"ajax"				:
			{
				url		: base_url + 'Con_Employee_Note/showEmployeesByDepartment?department_id=' + $("#department_id").val()
			,	type	: 'GET'
			}
		,	'columnDefs'		:
			[
				{
					'targets'		: 0
				,	'searchable'	: false
				,	'orderable'		: false
				,	'className'		: 'dt-body-center text-center'
				,	"width"			: "4%"
				,	'render'		: function(data, type, full, meta)
					{
						//console.log('1 meta', data, type, full, meta);
						
						return '<input type="radio" onchange="onSelectEmployee(this)" data-id="department" data-employee-fname="'+full[1]+'" data-employee-lname="'+full[2]+'" data-employee-department="'+full[3]+'" name="id" value="' + $('<div/>').text(data).html() + '">';
					}
				}
				//Department
			,	{
					'targets'	: 3
				,	'render'	: function( data, type, full, meta )
					{
						return data[1];
// 						let
// 						id = data[0];
// 						id = !!id ? '<span role="department-id">'+id+'</span>' : '';
						
// 						return id + data[1];
					}
				}
			]
		,	'order':	
			[
				[0, "asc"]
			,	[1, 'asc']
			]
		});
		$("#employee-note-datatable").wrap('<div class="overflow-x"> </div>');
		/* datatable for contact employee by employee ends */

		/* usergroup dropdown change starts */
		$(document).on('change', '#usergroup_id', function()
		{
			hideEmployeeNoteAlertMsg();
			$("#usergroup-table-select-all").prop("checked", false);

			let myTable = $('#employee-note-group-datatable').DataTable(); // get the table ID

			// If you want totally refresh the datatable use this 
			// myTable.ajax.reload();
			let groupId = $(this).val();
			let new_url = base_url + "Con_Employee_Note/showEmployeesByGroup?usergroup_id=" + groupId;
			myTable.ajax.url(new_url).load()

			// If you want to refresh but keep the paging you can you this
			// myTable.ajax.reload( null, false );
		});
		/* usergroup dropdown change ends */

		/* datatable for contact employee by group starts */
		let groupEmployeeNoteTable = $('#employee-note-group-datatable').DataTable
		({
			"pageLength"		: 10
		,	"paginationType"	: "input"
		//,	"serverSide"		: true
		,	"ajax"				:
			{
				url		: base_url + 'Con_Employee_Note/showEmployeesByGroup?usergroup_id=' + $("#usergroup_id").val()
			,	type	: 'GET'
			}
		,	'columnDefs': 
			[
				{
					'targets'		: 0
				,	'searchable'	: false
				,	'orderable'		: false
				,	'className'		: 'dt-body-center text-center'
				,	"width"			: "4%"
				,	'render'		: function(data, type, full, meta)
					{
						//console.log('2 meta', data, type, full, meta);
						
						return '<input type="radio" onchange="onSelectEmployee(this)" data-id="group" data-employee-fname="'+full[1]+'" data-employee-lname="'+full[2]+'" data-employee-department="'+full[3]+'" name="id" value="' + $('<div/>').text(data).html() + '">';
					}
				}
				//Department
			,	{
					'targets'	: 3
				,	'render'	: function( data, type, full, meta )
					{
						return data[1];
// 						let
// 						id = data[0];
// 						id = !!id ? '<span role="department-id">'+id+'</span>' : '';
						
// 						return id + data[1];
					}
				}
			]
		,	'order': 
			[
				[0, "asc"]
			,	[1, 'asc']
			]
		});
		$("#employee-note-group-datatable").wrap('<div class="overflow-x"> </div>');
		/* datatable for contact employee by group ends */

		/* datatable for contact employee by employee starts */
		let employeeNoteByEmployeeTable = $('#employee-note-by-employee-datatable').DataTable
		({
			"pageLength"		: 10
		,	"paginationType"	: "input"
		//,	"serverSide"		: true
		,	"ajax"				:
			{
				url		: base_url + 'Con_Employee_Note/showEmployees'
			,	type	: 'GET'
			}
		,	'columnDefs': 
			[
				{
					'targets'		: 0
				,	'searchable'	: false
				,	'orderable'		: false
				,	'className'		: 'dt-body-center text-center'
				,	"width"			: "4%"
				,	'render'		: function( data, type, full, meta )
					{
						//console.log('3 meta', data, type, full, meta);
						
						return '<input type="radio" onchange="onSelectEmployee(this)" data-id="employee" data-employee-fname="'+full[1]+'" data-employee-lname="'+full[2]+'" data-employee-department="'+full[3]+'" name="id" value="' + $('<div/>').text(data).html() + '">';
					}
				}
				//Department
			,	{
					'targets': 3
				,	'render': function( data, type, full, meta )
					{
						return data[1];
// 						let
// 						id = data[0];
// 						id = !!id ? '<span role="department-id">'+id+'</span>' : '';
						
// 						return id + data[1];
					}
				}
			]
		,	'order': 
			[
				[0, "asc"]
			,	[1, 'asc']
			]
		});
		$("#employee-note-by-employee-datatable").wrap('<div class="overflow-x"> </div>');
		/* datatable for contact employee by employee ends */
	});
	/* document ready ends */
</script>