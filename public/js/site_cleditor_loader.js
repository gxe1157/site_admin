
/* manage users table control  */

$(document).ready(function() {
	/* ---------- Text editor ---------- */
  	$('#input').cleditor({
  		width: 'auto',
  		height: 175,
		controls: // controls to add to the toolbar
                "bold italic underline strikethrough subscript superscript | bullets | outdent " +
                "indent | alignleft center alignright justify | undo redo | ",
  	});
} );
