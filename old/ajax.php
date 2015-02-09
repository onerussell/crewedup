<?php
    include '_top.php';
    
    require_once CLASS_PATH . "Ctrl/Ajax/JsHttpRequest.php";
    $JsHttpRequest =& new JsHttpRequest("utf-8");
     
    /*   
    $fl = fopen('tt.txt', 'w');
	fputs($fl, serialize($_REQUEST));
	fputs($fl, print_r($_REQUEST, 1));
	fclose($fl);	
	*/
    //$_REQUEST = unserialize('a:4:{s:6:"cat3id";s:32:"773759db1cfea45542601e24eb1f1727";s:6:"action";s:9:"add_event";s:2:"id";s:8:"1_3_2008";s:5:"color";s:1:"1";}');
    
    $action =  (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
    $st     =  '';
    $st2    =  '';
    
    switch ($action)
    {
    	case 'add_event':
            if (!empty($gSystemLogin) && $is_user)
            {
    		    $id    = (isset( $_REQUEST['id'] )) ? $_REQUEST['id'] : '';
                $color = (isset( $_REQUEST['color'] ) && is_numeric($_REQUEST['color'])) ? $_REQUEST['color'] : 0;
                if ($id)
                {    
                    $pdate = MakeDate($id, '_');
    		        include_once CLASS_PATH . 'Model/Main/Model_Main_Calendar_Events.php';
    		        $gCEvent =& new Model_Main_Calendar_Events($gDb, array('events' => TB . 'calendar_events'));
    		        $gCEvent -> DelEventByDate( $uid, $pdate );
                    
    		        if ($color)
    		        {
    		        	$gCEvent -> AddEvent($uid, $pdate, $color, '');
    		        }
    		        $st = 1;
                }
            }    
    	break;
    		
    	case 'get_data_list':
            $what = (!empty($_REQUEST['what'])) ? $_REQUEST['what'] : '';
    	    $uid  = (!empty($_REQUEST['uid']) && is_numeric($_REQUEST['uid'])) ? $_REQUEST['uid'] : 0;
    	    if ($uid)
    	    {
    	        $ui =& $gUser -> Get( $uid );
                if (empty($ui))
                {
                    $uid = 0;
                }
    	    }
    	    if (!$uid && !empty($gSystemLogin))
    	    {
    	        $ui =& $uinfo;
    	    }
    	    
            switch($what)
            {
                case 'resume':
                    if (!empty($ui))
                    {
                        include_once CLASS_PATH . 'Model/Main/Model_Main_Resume.php';
                        $gResume =& new Model_Main_Resume($gDb, array('resume' => TB . 'resume', 'users' => TB . 'users'));
                        $gSmarty -> assign('ma', array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')); 
                        $gSmarty -> assign('rl', $gResume -> GetList( $ui['uid'] ) );
                        
                        $st = $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_box.html');
                    }                    
                break;
                
                case 'award':
                    if (!empty($ui))
                    {
                        include_once CLASS_PATH . 'Model/Main/Model_Main_Award.php';
                        $gAward  =& new Model_Main_Award($gDb, array('award' => TB . 'awards'));
                        $gSmarty -> assign_by_ref('al', $gAward -> GetList( $ui['uid'] ));
                        $st = $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_award_box.html');          
                    }
                break;
                
                case 'wire':
                    
                    if (!empty($ui))
                    {
                        include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                        $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users')); 
                        $gSmarty -> assign_by_ref('wl', $gWire -> GetList( $uid, 0, 6 ) ); 
                    
                        $st = $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/wire/_box.html');
                    }
                break; 

                case 'comments':
                    if (!empty($ui))
                    {
                        $gSmarty -> assign('euid', $_REQUEST['uid']);
						include_once CLASS_PATH . 'Model/Main/Model_Main_Comments.php';
                        $wh   = (!empty($_REQUEST['params']['wh']) && 'r' == $_REQUEST['params']['wh']) ? 'r' : '';
                        $gSmarty -> assign('wh', $wh);                  
                    
                        $gCom =& new Model_Main_Comments($gDb, array('comments' => TB . 'comments', 'users' => TB . 'users'));
                        $gSmarty -> assign_by_ref('coml', $gCom -> GetList( $ui['uid'], (!$wh ? 0 : 1), 0, 5) );
                        $st = $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/comments/_box.html');
                    }
                break;   
                
                case 'rentals':
                    
                    if (!empty($ui))
                    {
                        include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 
                        $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
                        $gSmarty -> assign_by_ref('pl', $gGear -> GetList($ui['uid'])); 
                        $gSmarty -> assign_by_ref('catl', $gGear -> GetCatListAssoc());
                        $st = $gSmarty -> Fetch('mods/employer/gear/_box.html');
                    }
                break;

                case 'roster':
                    
                    if (!empty($ui))
                    {
                        include_once CLASS_PATH . 'Model/Main/Model_Main_Roster.php';
                        $gRoster =& new Model_Main_Roster($gDb, array('roster' => TB.'roster', 'users' => TB.'users'));
                    
                        $gSmarty -> assign_by_ref('rol', $gRoster -> GetList($ui['uid'], 0, 0));
                        $st = $gSmarty -> Fetch('mods/employer/roster/_box.html');
                    }
                break;

                case 'credits':
                    
                    if (!empty($ui))
                    {
                        include_once CLASS_PATH . 'Model/Main/Model_Main_Resume.php';
                        $gResume =& new Model_Main_Resume($gDb, array('resume' => TB . 'resume', 'users' => TB . 'users'));
                        $gSmarty -> assign('ma', array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')); 
                        $gSmarty -> assign('rl', $gResume -> GetList( $ui['uid'] ) );
                        
                        $st = $gSmarty -> Fetch('mods/employer/resume/_box.html');
                    }
                break;                
            }
    	    
    	break;    
    	
        case 'search':
            $blt = (!empty($_REQUEST['blt']) && 1 == $_REQUEST['blt']) ? 1 : 0; 
            $gSmarty -> assign('blt', $blt);
             
            $sstr = (!empty($_REQUEST['str'])) ? strip_tags( trim($_REQUEST['str']) ) : '';
            $gSmarty -> assign('sstr', $sstr);
            if ($sstr)
            {
                /** search members */
                $mc = $gUser -> SearchUserCount($sstr, 1);
                $gSmarty -> assign('mc', $mc);   
                $gSmarty -> assign('mcl', $gUser -> SearchUser($sstr, 1, 0, 3));    
               
                /** search employers */
                $ec = $gUser -> SearchUserCount($sstr, 2);
                $gSmarty -> assign('ec', $ec); 
                $gSmarty -> assign('ecl', $gUser -> SearchUser($sstr, 2, 0, 3));
                
                /** search jobs */
                include_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
                $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
                $jc = $gJobs -> GetCount(0, 0, '', '', $sstr);
                $gSmarty -> assign('jc', $jc); 
                $gSmarty -> assign('jcl', $gJobs -> GetList(0, 0, 0, 3, '', '', $sstr));
              
                include_once CLASS_PATH.'Model/Geografy/Main.class.php';
                $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDivAssoc('US'));
                
                /** search gear */
                include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php';
                $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
                $gc = $gGear -> GetCount(0, 0, '', '', '', $sstr);
                $gSmarty -> assign('gc', $gc);
                $gSmarty -> assign('gcl', $gGear -> GetList(0, 0, 0, 3, '', '', '', '', $sstr)); 
                              
                $gSmarty -> assign('search_c', $mc + $ec + $jc + $gc);                        
            }
             
             $st = $gSmarty -> Fetch('_search_block.html');   
        break;    
    	
        default:
    				
    }
    
	$_RESULT = array(
      "q"     => $st,
	  "eq"    => $st2
    );     
?>