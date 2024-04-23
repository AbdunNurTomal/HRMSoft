/**
 * @filename	word_count.js
 * @author		Mahfuzul Hoque Khan
 * @date		04 October 2020
 */

let maxLength		= note_size || 300;
let eleText			= undefined;
let eleWordCount	= undefined;

function resetWordMaxLengthCount()
{
	updateWordMaxLengthCount();

	hideWordCount();
}

function updateWordMaxLengthCount()
{
	let textlen = maxLength - eleText.val().length;
	$( '#rchars' ).text( textlen );
}

function showWordCount()
{
	eleWordCount.show();
}

function hideWordCount()
{
	eleWordCount.hide();
}

function setInput( ele )
{
	eleText = ele;
	eleText . attr( 'maxlength', maxLength );
	
	return eleText;
}

$(document).ready(function()
{
	eleWordCount = $( '#word-count-div' );
});
