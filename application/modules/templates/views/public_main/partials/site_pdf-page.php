<!-- This page is for PDF files and not html.  -->
<style>
#page_no{
	font-size: 1.5em;
	width: 100%;
}	
</style>

<div class="col-md-12" id="page_no">
    <img class="img-responsive" id="page_img" src="#" />
	<?php
	    if(count($bm_pages)>1)
	    	echo create_links($bm_pages, 0);
	?>
</div>

<script language="javascript">
	var imgNames = <?php echo json_encode($bm_pages) ?>;

	function nextPage( opt ){
		var target=document.getElementById('page_img');
		target.src = imgNames[ opt -1 ];

		var fileNameIndex = imgNames[ opt -1 ].lastIndexOf("/") + 1;
		var filename = imgNames[ opt -1 ].substr(fileNameIndex);
		if(filename=='404-error-page.jpg'){
			target.style.width= '100%';
			target.style.height= '100%';
		}	

		for( var i=1; i<imgNames.length+1; i++ ){
			document.getElementById('img'+i).style.fontSize = opt == i ? '125%':'100%';
			document.getElementById('img'+i).style.color = opt == i ? 'red':'#000';
		}
	}

	nextPage(1);
</script>
