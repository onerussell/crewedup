<?php
    require '_top.php';
    
#*************************************************************
# Main part
#*************************************************************
    $err = ( !empty($_REQUEST['err']) ) ? $_REQUEST['err'] : '';
                
try
{         
    switch ($mod)
    {
    	case 'blog':
    	    
    		switch ($err)
    		{
    			
    			default:
    				$gSmarty -> assign('title', 'No access');
    				$gSmarty -> assign('mesg', '');
    		}
    		
    	break;

    	default:
    	    $gSmarty -> assign('title', 'No access');
    		$gSmarty -> assign('mesg', '');
    }
    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/msg/_msg.html'));
    
}
catch (Exception $exc)
{
    sc_error($exc);
}
    
    #Display template
    $gSmarty -> display('main.html');

#*************************************************************
# End part
#*************************************************************
    require '_bottom.php';
?>