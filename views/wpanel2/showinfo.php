<?php

function ShowInfoView()
{

ob_start();
					
?>

<script language="javascript">
	
		function load_info(data)
		{
		
			//alert(JSON.stringify(data));
			
			if(data.login==0)
			{
				
				$('#error_login').html(data.txt_error);
			
			}
			else
			{
			
				
			
			}
		
		}
		
		function load_error_info(data)
		{
			
			$('#error_login').html(data.txt_error);
		
		}
	
</script>

<?php

PhangoVar::$arr_cache_header[]=ob_get_contents();

ob_end_clean();

ob_start();

?>
<span class="error" id="error_login"></span>
<div id="info_server" style="display:none;">
</div>
<?php

$cont_index=ob_get_contents();

ob_end_clean();

echo load_view(array('Información del servidor', $cont_index), 'content');

}

?>