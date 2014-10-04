<?php 
	register_shutdown_function('shutdownFunction'); 
    function shutDownFunction() { 
        $error = error_get_last(); 
        if ($error['type'] == 1) { 
            echo "Critical PHP error! Unfortunately we can't continue, sorry.<br>Please refresh the page and try again, or return to the previous page.";    
        } 
    }	
?>