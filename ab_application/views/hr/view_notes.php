<?php
/**
 * @filename	view_notes.php
 * @author		Mahfuzul Hoque Khan
 * @date		02 October 2020
 */

?>

<style type="text/css">
    .btn-info{background:#72c02c !important}
    .scroll-wrap{overflow-x:scroll !important}
    .no-wrap{ min-width:300px; white-space:normal !important; }
    .breadcrumb .active:empty{ display: none; }
/*	if use link
    #dataTables-notes tbody td{ padding: 0; }
    #dataTables-notes tbody td a{ padding: 8px 10px; }*/
    #dataTables-notes tbody td span[role="id"]{ display: none; }
    #dataTables-notes tbody tr[onclick]{ cursor:pointer; }
    #dataTables-notes tbody td:empty::before{ content : "N/A";  }

    .view_notes_container{margin-top:0px; width: 96%;}
    .company_select_alert{ margin: 0;padding: 10pt;background: #d6d668;color: #403b32;text-align: center;}
<?php
if( $has_company_selected )
{
?>
	.view_notes_container{padding-bottom: 15px;}
<?php
}
?>
</style>

<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active" id="bcpghd"><?php echo $page_header; ?></li>
                <li class="active" id="bcpgid"><?php echo $page_id_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3 view_notes_container">
	        <?php
			if( $has_company_selected )
			{
			?>
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <?php 
                if( $this->user_type != 1 ) 
                {
                ?>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employee_Note/add_note/$search_id"	; ?>"><span class="glyphicon glyphicon-plus-sign"	></span> Add Note</a>
                    <span style="margin:0 5pt;"> </span>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employee_Note/search_note/"."1"		; ?>"><i class="fa fa-search" aria-hidden="true"	></i> Issued	</a>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employee_Note/search_note/"."2"		; ?>"><i class="fa fa-search" aria-hidden="true"	></i> Closed	</a>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employee_Note/search_note/"."3"		; ?>"><i class="fa fa-search" aria-hidden="true"	></i> Discarded	</a>
                    <span style="margin:0 5pt;"> </span>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employee_Note/search_note/"."4"		; ?>"><i class="fa fa-search" aria-hidden="true"	></i> High		</a>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employee_Note/search_note/"."5"		; ?>"><i class="fa fa-search" aria-hidden="true"	></i> Critical	</a>
                    <span style="margin:0 5pt;"> </span>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employee_Note/search_note/"."0"		; ?>"><i class="fa fa-search" aria-hidden="true"	></i> All Notes	</a>
                    </br></br>
              	<?php
				}
				?>
				<!--
				<table id="dataTables-notes" class="table table-striped table-bordered table-hover">
                -->
                <table id="dataTables-notes" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl responsive-table table-wrap" >
                    <colgroup>
                        <col width="30%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup> 
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Issued By</th>
                            <th>Issued on</th>
                            <th>Priority</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php/*
                        
                        $WHERE	= ( $show_result === TRUE ) ? " WHERE main_notes.status=$search_by_status" : "";
                        
                        $sql	= "SELECT main_notes.id as note_id, main_notes.ref_note_id, main_notes.employee_id, main_notes.department_id, main_notes.issueby, main_notes.issued_datetime, main_notes.updateby,main_notes.updated_datetime,main_notes.priority,main_notes.status,main_notes.title,main_notes.note"
									.", main_department.department_name"
									.", main_employees.first_name, main_employees.middle_name, main_employees.last_name"
									.", main_users.name as issueby_name"
									." FROM main_notes"
									." LEFT JOIN main_employees ON main_employees.employee_id = main_notes.employee_id"
									." LEFT JOIN main_users ON main_users.id = main_notes.issueby"
									." LEFT JOIN main_department ON main_department.id = main_notes.department_id"
        							.  $WHERE
								//	." Group BY main_notes.employee_id"
									." ORDER BY main_notes.issued_datetime DESC"
									." LIMIT 10"
									;

                        // echo "<pre>".print_r($this->session->userdata('hr_logged_in'),1)."</pre>";exit;

                        $query = $this->db->query( $sql );

                        //echo $this->db->last_query();

                        //echo '<tr><td 1>debug</td><td 2 style="white-space:break-spaces;">'.$sql.'</td><td 3></td><td 4></td><td 5></td><td 6></td><td 7></td></tr>';//' . json_encode( $query ) .'
                        
                        if( $query )
                        {
                        	$rows = $query->result();
                        	
                        	foreach( $rows as $row )
                        	{
                            ?>
                                <tr>
                                    <td onclick="edit_row('<?php echo $row->note_id; ?>');" style="cursor: pointer !important;">
                                        <div class="testimonial-info">
                                            <?php echo $row->title; ?>
                                        </div>
                                    </td>
                                    <td onclick="edit_row('<?php echo $row->note_id; ?>');" style="cursor: pointer !important;" >
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                        	<?php echo $row->first_name . ' ' . $row->last_name; ?>
                                        </div>
                                    </td>
                                    <td onclick="edit_row('<?php echo $row->note_id; ?>');" style="cursor: pointer !important;">
                                        <div class="testimonial-info">
                                            <?php echo $row->department_name; ?>
                                        </div>
                                    </td>
                                    <td onclick="edit_row('<?php echo $row->note_id; ?>');" style="cursor: pointer !important;" >
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                        	<?php echo $row->issueby_name; ?>
                                        </div>
                                    </td>
                                    <td onclick="edit_row('<?php echo $row->note_id; ?>');" style="cursor: pointer !important;" >
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                        	<?php echo $row->issued_datetime; ?>
                                        </div>
                                    </td>
                                    <td onclick="edit_row('<?php echo $row->note_id; ?>');" style="cursor: pointer !important;" >
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                        	<?php echo $row->priority; ?>
                                        </div>
                                    </td>
                                    <td onclick="edit_row('<?php echo $row->note_id; ?>');" style="cursor: pointer !important;" >
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                        	<?php echo $row->status; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    */?></tbody>
                </table>
            </div>
            <!-- end data table -->
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
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script src="/assets/js/notes/note_util.js"></script>
<script>

//console.warn( 'local_datetime:', '<?php echo $local_datetime	; ?>' );

var base_url			= "<?php echo base_url(); ?>";
var search_id			= "<?php echo $search_id; ?>";
var search_by_emplyee	= "<?php echo $search_by_emplyee; ?>";
var hasCompanySelected	= "<?php echo $has_company_selected; ?>";

function edit_row( emp_id )
{
	window.location = base_url + 'Con_Employee_Note/edit_entry/' + emp_id + '/' + search_id;

	return false;
}

function innerHTML( html )
{
// 	console.error(html);
	
	let
	inner = html	.replace	( '</div>'		, ''		);
	inner = inner	.substring	( inner.indexOf	( '>' ) + 1	);
	inner = inner	.trim		();

	return inner;
}

/* document ready starts */
$(document).ready(function()
{
	var timezone_offset_minutes = new Date();//.getTimezoneOffset();
// 		timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
	var sto = ''+timezone_offset_minutes;
	var idx = sto.indexOf( 'GMT' ) + 3;
		sto = sto.substring( idx, sto.indexOf( ' ', idx ) );
	
	$.post
	(
		base_url + 'Con_Employee_Note/setClientTimezoneOffset/'
	,	{
			timezoneOffset		: sto
		}
	,	( result, status ) =>
		{
			console.warn( result, status, sto === result );
		}
	);
	  
	if( !hasCompanySelected )
	{
// 		alert( 'Please select a company' );
		
		return;
	}
	
	let name		//nId
	,	sbe		=	false
	,	arrLink =	[
						'<a onclick="edit_row('
					,	''
					,	')" href="javascript:void(0);" style="text-decoration: none; color: inherit; width: 100%; display: inline-block;">'
					,	'' 
					,	'</a>'
					]
	;

	function getLink( val1, val2 )
	{
		arrLink[1] = val1;
		arrLink[3] = val2;

		return arrLink.join( '' );
	}
	
	if( sbe = ( search_by_emplyee.length > 0 ) )
	{
		search_by_emplyee = '/' + search_by_emplyee;
	}

	let	bkLink	=	[
						'<a href="' + base_url + 'Con_Employee_Note/index/249/' + search_id + search_by_emplyee + '">' 
					,	'' 
					,	'</a>'
					];
	
// 	console.info( 'sbe', sbe );
	
	/* datatable for contact employee by employee starts */
	let notesTable = $( '#dataTables-notes' ).DataTable
	({
		'pageLength'		: 10
	,	'paginationType'	: 'input'
//	,	'serverSide'		: true
	,	'order':
		[
			[4, 'desc']
		,	[6, 'asc' ]
		,	[5, 'asc' ]
		,	[1, 'asc' ]
		,	[2, 'asc' ]
		]
	,	'ajax': 
		{
			url		: base_url + 'Con_Employee_Note/showNotes/' + search_id + search_by_emplyee
		,	type	: 'GET'
		}
	,	'columnDefs': 
		[
			//Title
			{
				'targets': 0
			,	'render': function( data, type, full, meta )
				{
// 					console.log('render', '\n\t data:', data, '\n\t type:', type, '\n\t full:', full, '\n\t meta:', meta);
	
// 					console.warn( notesTable.cell().node() );

// 					$( notesTable.row().node() ).click( edit_row.bind( null, data[0] ) );
// 					$( notesTable.cell().node() ).attr( 'onclick', 'edit_row(' + data[0] + ')' );
					
					return '<span role="id">'+data[0]+'</span>'+data[1];//getLink( nId = data[0], data[1] );
				}
			}
			//Employee
		,	{
				'targets': 1
			,	'render': function( data, type, full, meta )
				{
// 					console.log('render', '\n\t data:', data, '\n\t type:', type, '\n\t full:', full, '\n\t meta:', meta);
				
				/*	data
					[
						full	name
					,	first	name
					,	last	name
					]
				*/
				
					let nam = data[0];//data[1] + ' ' + data[2];

					if( sbe )
					{
						name = nam;
					}
	
					return nam;//getLink( nId, data[0] + ' ' + data[1] );
				}
			}
			//Department
		,	{
				'targets': 2
			,	'render': function( data, type, full, meta )
				{
// 					console.log('render', '\n\t data:', '->'+data+'<-', typeof data );//, '\n\t type:', type, '\n\t full:', full, '\n\t meta:', meta);
	
					return data;//getLink( nId, data );
				}
			}
			//Issued By
		,	{
				'targets': 3
			,	'render': function( data, type, full, meta )
				{
// 					console.log('render', '\n\t data:', '->'+data+'<-', typeof data );//, '\n\t type:', type, '\n\t full:', full, '\n\t meta:', meta);
	
					return data;//getLink( nId, data );
				}
			}
			//Issued on
		,	{
				'targets': 4
			//,	'searchable': false
			//,	'orderable': false
			,	'className': 'dt-body-center text-center'
			//,	"width": "4%"
			,	'render': function( data, type, full, meta )
				{
// 					console.log('render', '\n\t data:', data );//, '\n\t type:', type, '\n\t full:', full, '\n\t meta:', meta);
	
					let	dat = innerHTML			( data	);
					let	frm = formatToLocalDate	( dat	);
	
				//	console.log('render', '\n\t', dat, frm );
	
					data = data.replace( 'style="', 'style="margin-right: 20px;' );
					data = data.replace( dat, `<span style="white-space:pre;">${frm}</span>` );
					
					return data;//getLink( nId, data );
				}
			}
			//Priority
		,	{
				'targets': 5
			,	'render': function( data, type, full, meta )
				{
// 					console.log('render', '\n\t data:', '->'+data+'<-', typeof data );//, '\n\t type:', type, '\n\t full:', full, '\n\t meta:', meta);
	
					data = toUCWords( data );

// 					console.warn('render', '\n\t data:', data );

					return data;//getLink( nId, data );
				}
			}
			//Status
		,	{
				'targets': 6
			,	'render': function( data, type, full, meta )
				{
// 					console.log('render', '\n\t data:', '->'+data+'<-', typeof data );//, '\n\t type:', type, '\n\t full:', full, '\n\t meta:', meta);
	
					data = toUCWords( data );

// 					console.warn('render', '\n\t data:', data );

					return data;//getLink( nId, data );
				}
			}
		]
	});
// 	$("#dataTables-notes").wrap('<div class="overflow-x"> </div>');
	/* datatable for contact employee by employee ends */
	
	notesTable.on( 'draw', function()
	{
// 		console.group( 'dataTables-notes drawn' );

		let len = notesTable.rows()[0].length;

// 		console.info( 'len', len );

		for( let i=0; i<len; i++ )
		{
			let row = notesTable.row(i).node();
			let spn = row.firstChild.firstChild;
			let nid = spn.innerText;

			$( row ).attr( 'onclick', 'edit_row(' + nid + ')' );

// 			spn.remove();
			
// 			console.warn( 'id', nid );
		}
		
		if( sbe )
		{
			bkLink[1]	 = $( '#bcpghd' ).text();
			
			$( '#bcpghd' ).removeClass	( 'active'			);
			$( '#bcpghd' ).html			( bkLink.join( '' )	);
			$( '#bcpgid' ).text			( name				);
		}

// 		console.groupEnd();
	});

// 	let new_url = base_url + 'Con_Employee_Note/search_note/0';
// 	notesTable.ajax.url(new_url).load()

});
/* document ready ends */
</script>
<!--=== End Content ===-->
