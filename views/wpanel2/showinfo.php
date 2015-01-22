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
			
				
			
			}
		
		}
		
		function load_error_info(data)
		{
		
			
		
		}
	
</script>

<?php

PhangoVar::$arr_cache_header[]=ob_get_contents();

ob_end_clean();

ob_start();

?>

<?php

$cont_index=ob_get_contents();

ob_end_clean();

echo load_view(array('Información del servidor', ''), 'content');

}

?>