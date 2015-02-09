<?php
/**
 * Dictionary
 *
 * @package   CrewedUp
 * @version   1.0
 * @since     14.05.2009
 * @copyright 2007-2009 Engine37
 * @link      http://engine37.com
 */

require '_top.php';
$gSmarty -> assign('mod', 'dict');
      
try
{         
    require_once CLASS_PATH.'Model/Main/Model_Main_Dict.php';
  
    /*
    if (empty($uid))
        uni_redirect(PATH_ROOT.'?mod=login');

    if ($is_user && UID == $uid)
        $ui =& $uinfo;  
    else
    {
        $ui =& $gUser -> Get($uid);
        if (empty($ui))
            uni_redirect(PATH_ROOT . '?mod=login');
    }

    $gSmarty -> assign_by_ref('ui', $ui);
    */
    
    $oDict =& new Model_Main_Dict($gDb);

    switch ($action)
    {
        case 'get_movie_logo':
        case 'get_company_logo':
            $acts = array('get_movie_logo'    => array(DICT_FILMS, DICT_SHOWS), 
                          'get_company_logo'  => DICT_NETS);


            $q = base_chk3(_vg('q'), ' \'+=');

            if (2 < strlen($q))
                echo array2json($oDict -> GetAdditionalField($acts[$action], base_chk3(_vg('q'), ' \'+=')));
            else
                echo '';
            n_exit();
            break;
        
        case 'get_companies':
        case 'get_jobs':
        case 'get_movies':
            $acts = array('get_companies' => DICT_NETS,
                          'get_jobs'      => DICT_JOBS,
                          'get_movies'    => array(DICT_FILMS, DICT_SHOWS));
            
            $q = base_chk3(_vg('q'), ' \'+=');
            if (2 < strlen($q))
            {
                $res = $oDict -> SearchDict($q, $acts[$action]);

                while (list($key, $val) = each($res))
                {
                    echo $key.'|'.$val."\n";
                }
            }

            n_exit();
            break;
    }	
}
catch (Exception $exc)
{
    sc_error($exc);
}


require '_bottom.php';

?>