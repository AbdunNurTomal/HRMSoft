/**
 * @filename	note_util.js
 * @reference	add_note.php
 * @author		Mahfuzul Hoque Khan
 * @date		03 October 2020
 */

const excelTemplate =
[
	'<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:'
,	''			//index 1 - config.type
,	'" xmlns="http://www.w3.org/TR/REC-html40">'
,		'<head>'
,			'<!--[if gte mso 9]>'
,			'<xml>'
,				'<x:ExcelWorkbook>'
,					'<x:ExcelWorksheets>'
,						'<x:ExcelWorksheet>'
,							'<x:Name>'
,								'{worksheet}'
,							'</x:Name>'
,							'<x:WorksheetOptions>'
,								'<x:DisplayGridlines/>'
,							'</x:WorksheetOptions>'
,						'</x:ExcelWorksheet>'
,					'</x:ExcelWorksheets>'
,				'</x:ExcelWorkbook>'
,			'</xml>'
,			'<![endif]-->'
,		'</head>'
,		'<body>'
,			''	//index 22 - excel data goes here
,		'</body>'
,	'</html>'
];

function exportAsExcel( data, config )
{
//	$( '#export-as-excel' /*this must be a html table*/ ).tableExport( { type: 'excel', escape: 'false' } );
	
	config = config || { type: 'excel' };
	
	let excel = [];
	
	for( let r of data )
	{
		excel[excel.length] = '<td>' + r.join( '</td><td>' ) + '</td>';
		
//		console.info( Array.isArray( r ), r, '<td>' + r.join( '</td><td>' ) + '</td>' );
	}
	
	excelTemplate[ 1] = config.type;
	excelTemplate[22] = '<table><tr>' + excel.join( '</tr><tr>' ) + '</tr></table>';

	window.open	( 
					'data:application/vnd.ms-'
				+	config.type
				+	';filename=exportData.doc;base64,' 
				+	$.base64.encode( excelTemplate.join( '' ) )
				);
}

function printDiv()
{
	$.print( '#print_to_Div' );
}

function toUCWords( s )
{
	if( !s )
	{
		return '';
	}
	else
	{
		let arr = ( typeof s === 'string' ) ? s.trim().split( ' ' ) : Array.isArray( s ) ? s : false;
		
		if( arr === false )
		{
			return '';
		}
		
		let len = arr.length;
		
//		console.info( 'is arr?', s, len );
		
		if( len > 1 )
		{
			for( let i=0; i<len; i++ ) 
			{
				arr[i] = toUCWords( arr[i] );
			};
			
			return arr.join( ' ' );
		}
		else if( len == 1 )
		{
			s = arr[0];
		}
	}
	
	if( typeof s !== 'string' )
	{
		return '';
	}
	
	s = s.charAt( 0 ).toUpperCase() + s.slice( 1 ).toLowerCase();
	
//	console.info( 'finally toUCWords', s );
	
	return s;
}

function formatDate( date )
{
	if( !!date )
	{
			date = date.replace( /\//g, '-' ).replace( /, /g, '\t' );
		let idx  = date.lastIndexOf( ':' );
			date = date.substring( 0, idx ) + date.substring( idx+3 );
	}
	
	return date;
}

function formatUTCDate( date )
{
	let month	= zeroPrefix( date.getUTCMonth	()+1	);
	let dat		= zeroPrefix( date.getUTCDate	()		);
	let hours	= zeroPrefix( date.getUTCHours	()		);
	let minutes	= zeroPrefix( date.getUTCMinutes()		);
	let seconds	= zeroPrefix( date.getUTCSeconds()		);
	
	return `${date.getUTCFullYear()}-${month}-${dat} ${hours}:${minutes}:${seconds}`;
}

function formatToLocalDate( text )
{
	if( !!text )
	{
		let date = new Date( text );
		
		//	console.error( 'text:', text, 'date:', date, 'local:', formatDate( date.toLocaleString() ) );
		
		return formatDate( date.toLocaleString() );
	}
	
	return text;
}

function zeroPrefix( val )
{
	if( val < 10 )
	{
		return '0' + val;
	}
	else
	{
		return val;
	}
}

function setDate()
{
	let now	 = new Date( Date.now() );
	
	$( '#note_date' 		).val( formatDate	( now.toLocaleString()	) );//+ '\t\t' + formatUTCDate( now ) );
//	$( '#note_date_time'	).val( formatUTCDate( now					) );
}

/* hideAlertMsg function starts */
function hideEmployeeNoteAlertMsg()
{
	$( '#employee-note-alert'		).hide();
	$( '#employee-note-error-alert'	).hide();
}
/* hideAlertMsg function ends */
