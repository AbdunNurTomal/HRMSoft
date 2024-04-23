<?php
/**
 * @filename	view_note.php
 * @author		Mahfuzul Hoque Khan
 * @date		02 October 2020
 */

// date_default_timezone_set( 'UTC' );

$time				= time();
$date				= date( 'Y-m-d H:i:s', $time );
$datetime			= $this->Common_model->show_date_formate( date( 'Y-m-d', $time ) ) ." ".  date( 'h:i a', $time );//

$title				= $row->title;
$status				= $row->status;
$noteEdit			= $row->note;
$note_id			= $row->note_id;
$note_size			= $note_size -	(	strlen( $noteEdit ) + $note_item_tmpl_size );
$isIssued			= 'ISSUED'		== $status;
$isFollowup			= 'FOLLOWUP'	== $status;
$backPG				= base_url()	. "Con_Employee_Note/index/249/" . $search_id;
$stslbl				= Con_Employee_Note::toUCWords( $status );

$this->session->set_userdata( 'note_json_str', $noteEdit );

if( !$isIssued )//if( 'ISSUED' != $status )
{
	$row->updateby_name	= null;
	
	$sql = "SELECT name"
			." FROM main_users"
			." WHERE id = $row->updateby"
			;
			
	$query = $this->db->query( $sql );
	
	// 		echo $sql . '<br>' . json_encode( $param['query'] );
	
	if( $query )
	{
		$r					= $query->result()[0];
		$row->updateby_name	= $r->name;
	}
}

function toExel( $item, $s, $i )
{
	return $item['n'] . "\n" . ucfirst( $s ) . ' on ' . $item['d'] . "\n" . $item['m'] . "\n\n";
}

function toTmpl( $item, $s, $i )
{
	return '<li><input id="note-item-'.$i.'" type="checkbox"><label for="note-item-'.$i.'" data-status="'.$s.'" data-date="'.$item['d'].'">'.$item['n'].'</label><div>'.$item['m'].'</div></li>';
}

// echo $noteEdit. ' ' . gettype( $noteEdit ). '<br>';

$eaeNote	= '';
$noteEdit	= json_decode	( $noteEdit, true	);
$count		= count			( $noteEdit			);

// echo json_encode( $noteEdit ) . ' ' . $count . '<br>';

if( $count == 0 )
{
	$noteEdit	= '';
}
else	//if( $count > 0 )
{
	$i			= 0;
	$note		= '<ul>';
	$issued		= $noteEdit['i'];
	$followed	= $noteEdit['f'];
	$discarded	= $noteEdit['d'];
	$closed		= $noteEdit['c'];
	
	if( empty( $followed ) && empty( $discarded ) && empty( $closed ) )
	{
		$eaeNote	=
		$noteEdit	= $noteEdit['i']['m'];
	}
	else
	{
		$eaeNote   .= toExel( $issued, 'issued', $i );
		$note	   .= toTmpl( $issued, 'issued', $i );
		$i		   += 1;
		
		if( !empty( $followed ) )
		{
			$s		= 'followed up';
			
			foreach( $followed as $item )
			{
				$eaeNote	.= toExel( $item, $s, $i );
				$note		.= toTmpl( $item, $s, $i );
				
				$i			+= 1;
			}
		}
		
		if( !empty( $discarded ) )
		{
			$eaeNote	.= toExel( $discarded, 'discarded', $i );
			$note		.= toTmpl( $discarded, 'discarded', $i );
			$i			+= 1;
		}
		
		if( !empty( $closed ) )
		{
			$eaeNote	.= toExel( $closed, 'closed', $i );
			$note		.= toTmpl( $closed, 'closed', $i );
			$i			+= 1;
		}
		
		$note		.= '</ul>';
		
		$noteEdit	 = $note;
		
		$eaeNote	 = trim( $eaeNote );
	}
}

?>

<style>
textarea#employee-note-message{resize: none;}
div#employee-note-message{white-space: pre;height: auto;max-height: 500pt;overflow: auto;}
#print_to_Div h2{display: none;}
#employee-note-message ul{padding: 0;list-style: none;}
#employee-note-message div{margin-bottom: 5pt;}
#employee-note-message label{width: 100%;margin-bottom: 2pt;padding: 0 2pt;background: #eee;cursor: pointer;}
#employee-note-message label::before{margin-right: 5pt;}
#employee-note-message label::after{content: attr(data-status) " on    " attr(data-date);float: right;text-transform: capitalize;}
/*input[id="note-all"],*/
#employee-note-message input{position: absolute;width: 0;height: 0;opacity: 0;}
</style>
<style media="screen">
/*input[id="note-all"]:not(:checked) ~ label::before,input[id="note-all"]:not(:checked) ~ div #employee-note-message label::before,*/
#employee-note-message input:not(:checked) ~ label::before{content: "▷";}
input[id="note-all"]:not(:checked) ~ div #employee-note-message div,#employee-note-message input:not(:checked) ~ div{display: none;}
/*input[id="note-all"]:checked ~ label::before,input[id="note-all"]:checked ~ div #employee-note-message label::before,*/
#employee-note-message input:checked ~ label::before{content: "▽";}
/*input[id="note-all"]:checked ~ div #employee-note-message div,*/
#employee-note-message input:checked ~ div{display: block;}

#note-wrap ~ #employee-note-message div{white-space: pre/*break-spaces*/;}
#note-wrap, #note-justify{position: absolute;bottom: -11pt;}
#note-wrap + label, #note-justify + label{position: absolute;bottom: -19pt;}
#note-wrap + label{margin-left: 12pt;}
#note-wrap:checked ~ #employee-note-message div{white-space: pre-wrap/*break-spaces*/;}

#note-justify{margin-left: 50pt;}
#note-justify + label{margin-left: 61pt;}
#note-justify:checked ~ #employee-note-message div{text-align: justify;}
</style>
<style media="print">
#print_to_Div	{display: flex;flex-direction: column;width: 100%;/*border: 1px solid red;*/}
#print_to_Div h2{display: block;align-self: center;margin-bottom: 20pt;}
.form-group		{display: flex;flex-direction: row;width: 100%;}
.control-label	{width: 20%;padding-top: 7px;text-align: right;/*border: 1px solid blue;*/}
div.col-sm-4	{width: 80%;flex: 1;/*border: 1px solid green;*/}
.form-control	{/*border: none;*/}
div#employee-note-message{max-height: none;overflow: hidden;}
div#employee-note-message ul{max-width: 90%;}
#employee-note-remark{display:none;/*max-width: 100%;max-height: 500pt;*/}
#employee-note-message label::before{content: "";}
#employee-note-message div{display: block;white-space: break-spaces;}
#note-wrap, #note-justify,#note-wrap + label, #note-justify + label{display:none;}
</style>
<script>
	const	autoRedirect			= !true;

	var		note_size				=  <?php echo $note_size				 ; ?> ;
	var		note_closing_min_size	=  <?php echo $note_closing_min_size	 ; ?> 
									+  <?php echo $note_item_tmpl_size		 ; ?> ;
	let		isIssued				=  <?php echo json_encode( $isIssued	); ?> ;
	let		isFollowup				=  <?php echo json_encode( $isFollowup	); ?> ;
	let		status					= '<?php echo $status					 ; ?>';
	let		eaeData					= 
	[
		[
			'Issued By'
		,	'Issued On'

	<?php
	if( !$isIssued )//if( 'ISSUED' != $status )
	{
		echo
		",	'$stslbl By'
		,	'$stslbl On'"
		;
	}
	?>
		,	'Employee'
		,	'Department'
		,	'Priority'
		,	'Status'
		,	'Title'
		,	'Note'
		]
	,	[
			'<?php echo $row->issueby_name; ?>'
		,	''									//eae-issued-date
	<?php
	if( !$isIssued )//if( 'ISSUED' != $status )
	{
		echo
		",	'$row->updateby_name'
		,	''"									//eae-updated-date
		;
	}
	?>
		,	'<?php echo $row->first_name . ' '	. $row->last_name	; ?>'
		,	'<?php echo $row->department_name						; ?>'
		,	'<?php echo $row->priority								; ?>'
		,	'<?php echo $row->status								; ?>'
		,	'<?php echo $title										; ?>'
		,	'<?php echo str_replace( "\n", '\n'	, $eaeNote		)	; ?>'
	//	,	'<?php echo str_replace( "\n", '\n'	, $row->note	)	; ?>'
		]
	];

	console.warn( 'note_size:', note_size, ', note_closing_min_size:', note_closing_min_size );
//	console.warn( 'local_datetime:', '<?php echo $local_datetime	; ?>' );
</script>
<div id="employee-note-view-root-container" class="col-md-10 main-content-div">
	<div class="main-content">
		<div class="container conbre">
			<ol class="breadcrumb">
				<li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
				<li><a href="<?php echo $backPG; ?>"><?php echo $page_header; ?></a></li>
				<li class="active">View Note :: <?php echo $title; ?></li>
			</ol>
		</div>
		
		<div class="container tag-box-v3-employee-note" style="margin-top: 0px; padding-bottom: top; padding-bottom: 15px;">	
			<form id="employee-note-form" class="form-horizontal" method="POST" action="<?php echo site_url('Con_Employee_Note/updateNote'); ?>" role="form">
			
					<div class="col-sm-12">
						<div class="form-group">
						</div>
					</div>
					
					<?php
					
					if( $isIssued || $isFollowup )//if( 'ISSUED' == $status )
					{
						echo
							'<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-4 control-label">HR Representative</label>
									<div class="col-sm-4">
										<input type="text" name="hr_representative" id="hr_representative" value="'. $user_name .'" readonly="readonly" class="form-control input-sm" placeholder="HR Representative" data-toggle="tooltip" data-placement="bottom" title="HR Representative">
										<input type="hidden" name="hr_representative_id" id="hr_representative_id" value="'. $user_id .'" readonly="readonly" class="form-control input-sm">
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-4 control-label">Date & Time</label>
									<div class="col-sm-4">
										<input type="text" name="note_date" id="note_date" class="form-control dt-pick input-sm" value="" readonly="readonly" placeholder="Note issued Date & Time" data-toggle="tooltip" data-placement="bottom" title="Note Create Date & Time" autocomplete="off" />
										<!--
										<input type="hidden" name="note_date_time" id="note_date_time" class="form-control input-sm" value="'. $date .'" readonly="readonly" />
										-->
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
								</div>
							</div>'
						;
					}
					
					?>
					<!--			
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
								<input type="text" name="note_date" id="note_date" class="form-control dt-pick input-sm" value="" readonly="readonly" placeholder="Note issued Date & Time" data-toggle="tooltip" data-placement="bottom" title="Note Create Date & Time" autocomplete="off" />
								<input type="hidden" name="note_date_time" id="note_date_time" class="form-control input-sm" value="< ?php echo $date; ? >" readonly="readonly" />
							</div>
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="form-group">
						</div>
					</div>
					-->
				
				<div id="print_to_Div">
					<h2><?php echo $title; ?></h2>
							
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">Issued By</label>
							<div class="col-sm-4">
								<input type="text" name="note_issued_by" id="note_issued_by" value="<?php echo $row->issueby_name; ?>" readonly="readonly" class="form-control input-sm" placeholder="Note Issued By" data-toggle="tooltip" data-placement="bottom" title="Note Issued By">
								<input type="hidden" name="note_issued_by_id" id="note_issued_by_id" value="<?php echo $row->issueby; ?>" readonly="readonly" class="form-control input-sm">
							</div>
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">Issued On</label>
							<div class="col-sm-4">
								<input type="text" name="note_issued_datetime" id="note_issued_datetime" value="<?php echo $local_issued_datetime/*$row->issued_datetime*/; ?>" readonly="readonly" class="form-control input-sm" placeholder="Note Issued On" data-toggle="tooltip" data-placement="bottom" title="Note Issued On">
							</div>
						</div>
					</div>
				
					<?php
					
					if( !$isIssued )//if( 'ISSUED' != $status )
					{
						echo
							'<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-4 control-label">'.$stslbl.' By</label>
									<div class="col-sm-4">
										<input type="text" name="note_updated_by" id="note_updated_by" value="'. $row->updateby_name .'" readonly="readonly" class="form-control input-sm" placeholder="Note Updated By" data-toggle="tooltip" data-placement="bottom" title="Note Updated By">
										<input type="hidden" name="note_updated_by_id" id="note_updated_by_id" value="'. $row->updateby .'" readonly="readonly" class="form-control input-sm">
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-4 control-label">'.$stslbl.' On</label>
									<div class="col-sm-4">
										<input type="text" name="note_updated_datetime" id="note_updated_datetime" value="'. $local_updated_datetime/*$row->updated_datetime*/ .'" readonly="readonly" class="form-control input-sm" placeholder="Note Updated On" data-toggle="tooltip" data-placement="bottom" title="Note Updated On">
									</div>
								</div>
							</div>'
						;
					}
					
					?>
					<div class="col-sm-12">
						<div class="form-group">
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">Employee</label>
							<div class="col-sm-4">
								<input type="text" name="note_employee" id="note_employee" value="<?php echo $row->first_name . ' ' . $row->last_name; ?>" readonly="readonly" class="form-control input-sm" placeholder="Note on Employee" data-toggle="tooltip" data-placement="bottom" title="Note on Employee">
								<input type="hidden" name="note_employee_id" id="note_employee_id" value="" readonly="readonly" class="form-control input-sm">
							</div>
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">Department</label>
							<div class="col-sm-4">
								<input type="text" name="note_department" id="note_department" value="<?php echo $row->department_name; ?>" readonly="readonly" class="form-control input-sm" placeholder="Department" data-toggle="tooltip" data-placement="bottom" title="Department">
								<input type="hidden" name="note_department_id" id="note_department_id" value=<?php echo $row->department_id; ?>"" readonly="readonly" class="form-control input-sm">
							</div>
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">Priority</label>
							<div class="col-sm-4">
								<input type="text" name="note_priority" id="note_priority" value="<?php echo Con_Employee_Note::toUCWords( $row->priority ); ?>" readonly="readonly" class="form-control input-sm" placeholder="Note Priority" data-toggle="tooltip" data-placement="bottom" title="Note Priority">
							</div>
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">Status</label>
							<div class="col-sm-4">
								<input type="text" name="note_status" id="note_status" value="<?php echo $stslbl; ?>" readonly="readonly" class="form-control input-sm" placeholder="Note Status" data-toggle="tooltip" data-placement="bottom" title="Note Status">
							</div>
						</div>
					</div>
				
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">Title</label>
							<div class="col-sm-4">
								<input type="text" name="note_title" id="note_title" value="<?php echo $title; ?>" class="form-control input-sm" readonly="readonly" placeholder="Note Title" data-toggle="tooltip" data-placement="bottom" title="Note Title" autocomplete="off" maxlength="50" />
								<input type="hidden" name="note_id" id="note_id" value=<?php echo $note_id; ?>"" readonly="readonly" class="form-control input-sm">
							</div>
						</div>
					</div>
				
					<div class="col-sm-12" style="margin-bottom: 10pt;">
						<div class="form-group">
							<!--  
							<input id="note-all" type="checkbox">
							-->
							<label for="note-all" class="col-sm-4 control-label">Note</label>
							<div class="col-sm-4">
								<!--  
								<textarea id="employee-note-message" type="text" name="employee-note-message" class="form-control input-sm" readonly="readonly" rows="4" placeholder="Note" data-toggle="tooltip" data-placement="bottom" title="Note" maxlength="<?php echo $note_size; ?>"><?php echo $row->note; ?></textarea>
								-->
								<input id="note-wrap"		type="checkbox" checked=""	>
								<label for="note-wrap"									>Wrap			</label>
								<input id="note-justify"	type="checkbox"	checked=""	>
								<label for="note-justify"								>Text Justify	</label>
								<div id="employee-note-message" name="employee-note-message" class="form-control input-sm" data-toggle="tooltip" data-placement="bottom" title="Note" maxlength="<?php echo $note_size; ?>"><?php echo $noteEdit; ?></div>
							</div>
						</div>
					</div>
				</div>
			
				<?php
				
				if( $isIssued || $isFollowup )//if( 'ISSUED' == $status )
				{
					echo
						'<div id="remark-container">
							<div class="col-sm-12">
								<div class="form-group">
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-4 control-label">Remark</label>
									<div class="col-sm-4">
										<textarea id="employee-note-remark" name="employee-note-remark" type="text" class="form-control input-sm" rows="4" placeholder="Remark" data-toggle="tooltip" data-placement="bottom" title="Remark" maxlength="<?php echo $note_size; ?>"></textarea>
										<span id="word-count-div" style="display: none;"><span id="rchars">' . $note_size . '</span> Character(s) Remaining</span>
									</div>
								</div>
							</div>
						</div>';
				}
				
				?>
				
				<div class="col-sm-12 text-center" style="margin-top: 10px;" id="note">
					<div id="employee-note-alert" class="alert alert-success" role="alert" style="display: none;">Note updated</div>
					<div id="employee-note-error-alert" class="alert alert-danger" role="alert" style="display: none;"></div>
				</div>
		
				<div class="col-sm-12" style="margin-top: 10px;">
					<div class="modal-footer">
						<?php
						
						if( $isIssued || $isFollowup )//if( 'ISSUED' == $status )
						{
							echo
								'<button id="btnFollowUp"	type="button" class="btn btn-u"		>Follow Up		</button>
								<span						style="margin:0 20pt;"> </span>
								<button id="btnClose"		type="button" class="btn btn-u"		>Close Note		</button>
								<button id="btnDiscard"		type="button" class="btn btn-danger">Discard Note	</button>
								<span						style="margin:0 20pt;"> </span>';
						}
						
						?>
						<button class="btn-u center-align" type="button" id="btnPrint"	onclick="printDiv();"				> <i class="fa fa-print"		aria-hidden="true"></i> PDF </button>
						<button class="btn-u center-align" type="button" id="btnExport"	onclick="exportAsExcel(eaeData);"	> <i class="fa fa-file-excel-o" aria-hidden="true"></i> XLS </button>
						<span style="margin:0 20pt;"> </span>
						<a id="btnEmployeeNoteClose" class="btn btn-danger" href="<?php echo $backPG; ?>">Exit</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="/assets/js/notes/note_util.js"	></script>
<script src="/assets/js/notes/word_count.js"></script>
<script>
function format( id )
{
	let d = $( id );
	let v = formatToLocalDate( d.val() );

	d.val( v );

	return v;
}

function formatLabelDate( lbl )
{
	let v = formatToLocalDate( lbl.dataset.date );

	lbl.dataset.date = v.replace( /\t/g, ' ' );

	return v;
}

function hideActionButtons()
{
// 	return;
	
	$( '#btnClose'			).hide();
	$( '#btnDiscard'		).hide();
	$( '#btnFollowUp'		).hide();
	$( '#remark-container'	).hide();
}

function activateActionButtons()
{
// 	return;
	
	$( '#btnClose'		).prop( 'disabled', true );
	$( '#btnDiscard'	).prop( 'disabled', true );
	$( '#btnFollowUp'	).prop( 'disabled', true );
	
	if( $( '#employee-note-remark'	).val().length > 0 
	&&	$( '#note_employee'			).val().length > 0
	&&	$( '#note_department'		).val().length > 0
	)
	{
		$( '#btnClose'		).prop( 'disabled', false );
		$( '#btnDiscard'	).prop( 'disabled', false );

		if( note_size > note_closing_min_size )
		{
			$( '#btnFollowUp'	).prop( 'disabled', false );
		}
	}
}

function enableAllButtons( enable )
{
	$( '#btnClose'		).prop( 'disabled', enable	);
	$( '#btnDiscard'	).prop( 'disabled', enable	);
	$( '#btnFollowUp'	).prop( 'disabled', enable	);
	$( '#btnPrint'		).prop( 'disabled', enable	);
	$( '#btnExport'		).prop( 'disabled', enable	);

	if( enable )
	{
		$( '#btnEmployeeNoteClose'	).removeClass	( 'disabled' );
	}
	else
	{
		$( '#btnEmployeeNoteClose'	).addClass		( 'disabled' );
	}
}

function update( type )
{
	let id			= $( '#note_id'					).val();
	let name		= $( '#hr_representative'		).val();
	let user		= $( '#hr_representative_id'	).val();
	let employee	= $( '#note_employee_id'		).val();
//	let datetime	= $( '#note_date_time'			).val();
	let department	= $( '#note_department_id'		).val();
	let title		= $( '#note_title'				).val();
// 	let note		= $( '#employee-note-message'	).text();//.val();
	let remark		= $( '#employee-note-remark'	).val();
	let priority	= $( '#note_priority'			).val();
	let url			= $( '#employee-note-form'		).attr( 'action' );
	let action		= '';

/*	let remarkText	= 
					[
						'\n--' 
					,	toUCWords( type ).replace( 'ed', 'ing' ) 
					,	'Remark by' 
					,	$( '#hr_representative'	).val() 
					,	'on' 
					,	datetime 
					,	'GMT'
					,	'--\n'
					];
	console.info( remarkText.join( ' ' ) );return;
*/
// 	console.info( 'note', note );return;

	 //console.log(employees);return;
	$( '#note' ).load( location.href + ' #note' );

	hideEmployeeNoteAlertMsg();
	
	$.ajax
	({
		url: url
	,	data:
		{
		/*	employee	: employee
		,	datetime	: datetime
		,	department	: department
		,	title		: title
		,	priority	: priority
		,*/	id			: id
		,	user		: user
		,	name		: name
// 		,	datetime	: datetime
	//	,	note		: '<?php echo $row->note; ?>'//encodeURIComponent(  )
		,	remark		: remark
		,	status		: type
		}
	,	method		: 'POST'
	,	dataType	: 'JSON'
	,	success		: function( response )
		{
			//console.error(response);
			if( response.status )
			{
				$( '#employee-note-remark'	).val('');
// 				$( '#note_employee'			).val('');
// 				$( '#note_department'		).val('');
// 				$( '#note_employee_id'		).val('');
// 				$( '#note_department_id'	).val('');
// 				$( '#note_title'			).val('');
// 				$( '#note_priority'			).val( 'NORMAL' ).trigger( 'change' );

				if( response.successMsg )
				{
					$( "#employee-note-alert" ).html( response.successMsg ).show();
				}
				
				if( response.errorMsg )
				{
					$( "#employee-note-error-alert" ).html( response.errorMsg ).show();
				}

				hideActionButtons();
				
				if( autoRedirect )
				{
					setTimeout( function() 
					{
					//	console.error( 'click' );
						
						document.querySelector( '#btnEmployeeNoteClose'	).click();
						
					},	5000 );
				}
			}
			else
			{
				if( response.errorMsg )
				{
					$( "#employee-note-error-alert" ).html( response.errorMsg ).show();
				}
			}

			$( '#btnPrint'				).prop			( 'disabled', false	);
			$( '#btnExport'				).prop			( 'disabled', false	);
			$( '#btnEmployeeNoteClose'	).removeClass	( 'disabled'		);

			resetWordMaxLengthCount();
			setDate();
		}
	,	error: function( err )
		{
			enableAllButtons( false );
			setDate();
		}
	});

	enableAllButtons( true );
}

$(document).ready(function()
{
	if( note_size <= note_closing_min_size )
	{
		$( '#btnFollowUp'		).hide();
	}
	
	let fd = format( '#note_issued_datetime' );

	eaeData[1][1] = fd;
	
	if( isIssued || isFollowup )//if( 'ISSUED' == status )
	{
		setDate();
		showWordCount();
		activateActionButtons();

		setInput( $( '#employee-note-remark'	) ).on( 'change keyup paste', function()
		{
			updateWordMaxLengthCount( $( this ) );
			activateActionButtons();
		});
		
		$( '#btnClose' ).on( 'click', function( e )
		{
			update( 'CLOSED' );
		});
		
		$( '#btnDiscard' ).on( 'click', function( e )
		{
			update( 'DISCARDED' );
		});
		
		$( '#btnFollowUp' ).on( 'click', function( e )
		{
			update( 'FOLLOWUP' );
		});
	}
	//else
	if( !isIssued )
	{
		fd = format( '#note_updated_datetime' );

		<?php
		if( !$isIssued )//if( 'ISSUED' != $status )
		{
			echo 'eaeData[1][3] = fd;';
		}
		?>

		let list = document.querySelectorAll( '[for^="note-item-"]' );

// 		console.warn( list );

		list.forEach( function( lbl )
		{
			formatLabelDate( lbl );
		});
	}
});

</script>