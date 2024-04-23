/**
 * @filename	add_note.js
 * @reference	add_note.php
 * @author		Mahfuzul Hoque Khan
 * @date		02 October 2020
 */

function onSelectEmployee( ele )
{
	let ds = ele.dataset;
	let dp = ds.employeeDepartment.split( ',' );
	
//	console.warn( ds.employeeDepartment, dp );
//	console.log( ds.employeeFname, ds.employeeLname, ds.employeeDepartment );

	$( '#note_employee'			).val( ds.employeeFname + ' ' + ds.employeeLname );
	$( '#note_employee_id'		).val( ele.value );
	
	$( '#note_department'		).val( dp[1] || ds.employeeDepartment );
	$( '#note_department_id'	).val( dp[0] || $( '#department_id' ).val() );

	activateAddNoteButton();
}

function activateAddNoteButton()
{
	$( '#btnAddNote' ).prop( 'disabled', true );
	
	if( $( '#employee-note-message'	).val().length > 0 
	&&	$( '#note_employee'			).val().length > 0
//	&&	$( '#note_department'		).val().length > 0
	&&	$( '#note_title'			).val().length > 0
	)
	{
		$( '#btnAddNote' ).prop( 'disabled', false);
	}
}

$( '#note_priority' ).select2
({
	placeholder	: 'Select priority'
,	allowClear	: !true
});

$(document).on( 'change keyup paste', '#note_title', function()
{
	activateAddNoteButton();
});

/* document ready starts */
$(document).ready(function()
{
	showWordCount();
	
	setInput( $( '#employee-note-message' ) ).on( 'change keyup paste', function()
	{
		updateWordMaxLengthCount();
		activateAddNoteButton	();
	});

	/* Add Note button click starts */
	$( '#btnAddNote' ).on( 'click', function(e)
	{
		let name		= $( '#hr_representative'		).val();
		let user		= $( '#hr_representative_id'	).val();
		let employee	= $( '#note_employee_id'		).val();
//		let datetime	= $( '#note_date_time'			).val();
		let department	= $( '#note_department_id'		).val();
		let title		= $( '#note_title'				).val();
		let note		= $( '#employee-note-message'	).val();
		let priority	= $( '#note_priority'			).val();
		let url			= $( '#employee-note-form'		).attr('action');
		let action		= '';

		 //console.log(employees);return;
		$( '#note' ).load( location.href + ' #note' );
		
		hideEmployeeNoteAlertMsg();
		
		$.ajax
		({
			url		: url
		,	data	:
			{
				employee	: employee
			,	user		: user
			,	name		: name
//			,	datetime	: datetime
			,	department	: department
			,	title		: title
			,	note		: note
			,	priority	: priority
			}
		,	method		: 'POST'
		,	dataType	: 'JSON'
		,	success		: function( response )
			{
 				console.error( 'response', response );
 				
				if( response.status )
				{
//					$( '#note_employee'			).val('');
//					$( '#note_department'		).val('');
//					$( '#note_employee_id'		).val('');
//					$( '#note_department_id'	).val('');
					$( '#employee-note-message'	).val('');
					$( '#note_title'			).val('');
					$( '#note_priority'			).val('NORMAL').trigger('change');
					
					if( hasBtnEmployeeNoteClose )
					{
						$( '#note_employee'			).val('');
						$( '#note_department'		).val('');
						$( '#note_employee_id'		).val('');
						$( '#note_department_id'	).val('');
					}
					
					if( response.successMsg )
					{
						$( '#employee-note-alert' ).html( response.successMsg ).show();
					}
					
					if( response.errorMsg )
					{
						$( '#employee-note-error-alert' ).html( response.errorMsg ).show();
					}
				}
				else
				{
					if( response.errorMsg )
					{
						$( '#employee-note-error-alert' ).html( response.errorMsg ).show();
					}
				}

//				$( '#btnAddNote'			).prop			( 'disabled', false	);
				if( hasBtnEmployeeNoteClose )
				$( '#btnEmployeeNoteClose'	).removeClass	( 'disabled'		);
				
				resetWordMaxLengthCount();
				setDate();
			}
		,	error	: function(err)
			{
				$( '#btnAddNote'			).prop			( 'disabled', false	);
				if( hasBtnEmployeeNoteClose )
				$( '#btnEmployeeNoteClose'	).removeClass	( 'disabled'		);
				
				setDate();
			}
		});
		
		$( '#btnAddNote'			).prop		( 'disabled', true	);
		if( hasBtnEmployeeNoteClose )
		$( '#btnEmployeeNoteClose'	).addClass	( 'disabled'		);
	});
	/* Add Note button click ends */

	setDate();
});
/* document ready ends */
