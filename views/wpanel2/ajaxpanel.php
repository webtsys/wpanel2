<?php

function AjaxPanelView($url, $callback_success, $callback_error)
{
	//Always get, the post is sended by url.
	
	PhangoVar::$arr_cache_jscript[]='jquery.min.js';
	PhangoVar::$arr_cache_css['wpanel2'][]='loading.css';
	
	?>
	<script language="javascript">
	$(document).ready( function () {
	
	//Show css loading
	$('#loading_ajax').show();
	
	$.ajax({
			url: "<?php echo $url; ?>",
			type: "GET",
			/*data: 'variable=value',*/
			dataType: "json",
			success: function(data){

				//Hide css loading
			
				//return [true, data];
				//Pass data to html template
				
				<?php echo $callback_success; ?>(data);
				//alert(JSON.stringify(data));
				
				$('#loading_ajax').hide();

			},
			error: function(data) {
				
				//Hide css loading
				
				//Pass data to html template
				
				<?php echo $callback_error; ?>(data);
				//alert('Error:'+JSON.stringify(data));
				
				$('#loading_ajax').hide();
			},

		});
	})
	</script>
	<?php

}

?>