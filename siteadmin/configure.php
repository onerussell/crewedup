<?php
/**
 * Dictionary Module
 *
 * @package    CrewedUp
 * @version    0.1
 * @since      11.01.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

require 'top.php';
load_gz_compress($gSmarty);


if (isset($_REQUEST['action'])) 
{
   $action = $_REQUEST['action'];
   $gSmarty -> assign('action', $action);
}
else
   $action = '';

if (isset($_REQUEST['ocid'])) 
{
   $ocid = intval($_REQUEST['ocid']);
   $gSmarty -> assign('ocid' ,  $ocid);
}
else
   $ocid = 0;

if (isset($_REQUEST['group'])) 
{ 
   $group = intval($_REQUEST['group']);
   $gSmarty -> assign('group',  $group);
}
else
   $group = 0;
   
// ------------------------------------------------------------------------

// < Рабочая часть контроллера >

if (isset($_REQUEST['do']) && 1 == $_REQUEST['do'])
{
    $hw = '?group='.$group;

    if ('edit' == $action)
    {
        if (!isset($_REQUEST['name']))
            $_REQUEST['name'] = 'Not defined';

        if (!isset($_REQUEST['var']))
            $_REQUEST['var'] = 'Not defined';
            
        if (!isset($_REQUEST['sortid']))
           $sortid = 0;
        else
           $sortid = intval($_REQUEST['sortid']);
           
        if (!isset($_REQUEST['groupf']))
           $groupf = 0;
        else
           $groupf = intval($_REQUEST['groupf']);
                
           
        if (0 == $ocid)//add
        {
            $gDb->query('INSERT INTO '.TB.'config
                         (name,var,val,sortid,groupf) 
                         VALUES (?,?,?,?,?)', 
                         array($_REQUEST['name'],$_REQUEST['var'],$_REQUEST['val'],$sortid,$groupf)
                        );
        }
        else//edit 
        {
            $gDb->query("update ".TB."config set name='".addslashes($_REQUEST['name'])."', var='".addslashes($_REQUEST['var'])."', val='".addslashes($_REQUEST['val'])."', sortid='".$sortid."', groupf='".$groupf."' where ocid=".$ocid);
        }
        SaveConfig();
    }
    elseif ('del' == $action)
    {
        if (0 < $ocid)
        {
            $gDb->query("delete from ".TB."config where ocid=".$ocid);
            SaveConfig();
        }
 
    }
    elseif ( ($action=="editgroup") && (isset($_REQUEST['name'])) && (isset($_REQUEST['fname'])) )
    {       

        if ($_REQUEST['name']=='')
           $_REQUEST['name']='Not defined';
        if ($_REQUEST['fname']=='')
           $_REQUEST['fname']='def';

        if (0 < $group) 
            $gDb->query('update '.TB.'config_g set name="'.$_REQUEST['name'].'", fname="'.$_REQUEST['fname'].'" where id='.$group);  
        else 
            $gDb->query('insert into '.TB.'config_g (name, fname) values ("'.$_REQUEST['name'].'", "'.$fname.'")'); 

        SaveConfig();

     }
     elseif ('delgroup' == $action && 0 < $group)
     {
         $gDb->query('delete from '.TB.'config where groupf='.$group); 
         $gDb->query('delete from '.TB.'config_g where id='.$group); 
         $hw='';
         SaveConfig();
     }
     
     $url = 'configure.php'.$hw; 
     header("Location: $url");
}

if (('edit' == $action || 'del' == $action) && 0 < $ocid)
{
    $sql = "select name,val, var, sortid, groupf from ".TB."config where ocid=".$ocid;
    $db  = $gDb -> query($sql); 
    $val = array();
    if (0 < $db -> numRows())
    {
        $row         = $db -> fetchRow();
        $row['name'] = stripslashes($row["name"]);
        $row['val']  = stripslashes($row["val"]);      
        $gSmarty->assign('info', $row);

    }
   
}
elseif ('editgroup' == $action && 0 < $group)
{
    $db = $gDb->query("select name, fname from ".TB."config_g where id=".$group);
    if (0 < $db -> numRows())
    {
        $row = $db -> fetchRow();
        $gSmarty -> assign('name',$row['name']);
        $gSmarty -> assign('fname',$row['fname']);
    }   
}

// </ Рабочая часть контроллера >

// ------------------------------------------------------------------------

// < Компиляция темплейтов >

$gv = 'where groupf="-1"';
$gar = array();
if (0 < $group)
{
    $gv = 'where groupf = '.$group;
    $db = $gDb->query('select name, fname from '.TB.'config_g where id='.$group);
    if (0 < $db -> numRows())
    {
        $row = $db -> fetchRow();
        $gSmarty->assign('name_',$row['name']);
        $gSmarty->assign('fname',$row['fname']);
    }
}
//----------------
    $db = $gDb->query("select id, name, fname from ".TB."config_g ORDER BY name ASC");

    if (0 < $db -> numRows())
        while ($row=$db -> fetchRow())
        {
            $ar=array("id"=>$row["id"],"name"=>$row["name"],"fname"=>$row["fname"]);
            array_push($gar,$ar);
        }

    $gSmarty->assign('gar',$gar);

    $db=$gDb->query("select ocid, name, var, val, sortid from ".TB."config ".$gv." order by sortid");
    $show_ar=array();
    if (0 < $db -> numRows())
    {
        while ($row=$db -> fetchRow())
            $show_ar[]=array("ocid"=>$row["ocid"],"name"=>$row["name"],"var"=>$row["var"],"val"=>stripslashes($row["val"]), "sortid"=>$row["sortid"]);
        $gSmarty->assign("show_ar",$show_ar);
    }

$main_content = $gSmarty -> fetch('mods/Tools/Configure.html');
$gSmarty -> assign_by_ref('main_content',$main_content);
$gSmarty -> display('main_template.html');

// </ Компиляция темплейтов >

// ------------------------------------------------------------------------

require 'bottom.php';

// ------------------------------------------------------------------------

// < Специфичные для контроллера функции / макросы >

function SaveConfig()
    {
     global $gDb;
     if ($fh = fopen(BPATH . 'files/config/generated.php', 'w'))
        {
         $txt = '<?php'."\n";
         $dbout = $gDb->query("select c.var, c.val, c.name from ".TB."config c, ".TB."config_g cg where c.groupf=cg.id");
         if (0 < $dbout -> numRows())
            {
             while ($row = $dbout -> fetchRow())
                   {
                    $va = explode('|', $row['val']);
                    $va = StripSlashes($va[0]);
                    $va = str_replace("'","\\'",$va);
                    if (is_numeric($va) && strlen($va) < 9)
                       $txt .= 'define(\''.AddSlashes($row['var']).'\', '.$va.');'."   #".$row['name']."\n";
                     else
                       $txt .= 'define(\''.AddSlashes($row['var']).'\', \''.$va.'\');'."   #".$row['name']."\n";
                   }
             $txt .= '?>';
             fwrite($fh, $txt);
             fclose($fh);
            }
        }
     else 
       die('Access denied for config file \'generated.php\'');
    }

// </ Специфичные для контроллера функции / макросы >

?>