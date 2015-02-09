<?php
/**
 * Calendar class
 *
 * @package    Engine 37 catalog 3.1
 * @version    0.1b
 * @since      25.12.2005
 * @copyright  2004-2005 Engine 37.com
 * @link       http://Engine37.com
 */

class Calendar
{

    public function __construct()
    {
        
    }

    /**
     * Get Month with dates
     *
     * @param string $pdate - current date
     * @return array with days
     */
    function &Show($pdate = array())
    {
   
        $day        = $pdate["mday"];
        $month      = $pdate["mon"];
        $year       = $pdate["year"];

        $this_month           = getDate(mktime(0, 0, 0, $month, 1, $year));
        $this_month['mmonth'] = date("M", mktime(0, 0, 0, $month, 1, $year));
        
        $next_month           = getDate(mktime(0, 0, 0, $month + 1, 1, $year));
        $next_month['mmonth'] = date("M", mktime(0, 0, 0, $month + 1, 1, $year));
        
        $prev_month           = getDate(mktime(0, 0, 0, $month, 0, $year));
        $prev_month['mmonth'] = date("M", mktime(0, 0, 0, $month, 0, $year));

        #Find out when this month starts and ends.
        $first_week_day     = $this_month["wday"] ;
        $days_in_this_month = round(($next_month[0] - $this_month[0]) / (60 * 60 * 24));

        $res           = array();
        $res['month']  = $month;
        $res['mmonth'] = $this_month["month"];
        $res['year']   = $year;
        $res['days']   = array();
        $line          = 0;

         //Fill the first week of the month with the appropriate number of blanks.

         if (-1 == $first_week_day)
         {
         	$first_week_day = 6;
         }
         for($week_day = 0; $week_day < $first_week_day; $week_day++)
         {
            $res['days'][$line][] = array($prev_month['mday'] - $first_week_day + 1 + $week_day, 
                                          $prev_month['mday'] - $first_week_day + 1 + $week_day.'_'.
                                          $prev_month['mon'].'_'.
                                          $prev_month['year'],
                                          $prev_month['mmonth'],
                                          getDate(mktime(0, 0, 0, $prev_month['mon'], $prev_month['mday'] - $first_week_day + 1 + $week_day, $prev_month['year']))
                                         );
         }


         $week_day = $first_week_day;
         for($day_counter = 1; $day_counter <= $days_in_this_month; $day_counter++)
         {
                
             $week_day %= 7;
             if($week_day == 0 && isset($res['days'][0]))
             {
                 $line ++;
             }
             $dd = array($day_counter, $day_counter.'_'.$month.'_'.$year, $this_month['mmonth'],
                         getDate(mktime(0, 0, 0, $month, $day_counter, $year))
                         );
             $res['days'][$line][] = $dd;
             $week_day++;
         }
         
         
         if (count($res['days'][count($res['days'])-1]) < 7)
         {
             #print_r($res['days'][count($res['days'])-1]); 
             $k = 0;
             for ($i = 0; $i < 7; $i++)
             {
                 if (!isset($res['days'][count($res['days'])-1][$i]))
                 {
                     $res['days'][count($res['days'])-1][$i] = array(
                                                                    $next_month['mday'] +$k,
                                                                    $next_month['mday'] + $k.'_'.
                                                                    $next_month['mon'].'_'.
                                                                    $next_month['year'], 
                                                                    $next_month['mmonth'],
                                                                    getDate(mktime(0, 0, 0, $next_month['mon'], $next_month['mday'] + $k, $next_month['year']))                                                                    
                                                                    );
                     $k++;                                               
                 }
             }
         }


         return $res; 
    }#Show
    
    
    /**
     * Get current week
     *
     * @param string $pd
     * @return array
     */
    function &GetWeek($pd = array())
    {   

        //deb($pd);
        $res = array();
        /*
        $res['month']  = $pd['mon'];
        $res['mmonth'] = $pd["month"];
        $res['year']   = $pd['year'];
        */
        $res['days']   = array();
        #$d = (0 == $pd['wday']) ? 7 : $pd['wday'];
        $d  = $pd['wday'] +1;       
        for ($i = 0; $i < 7; $i++)
        {
            $dt = mktime(0, 0, 0, $pd['mon'], $pd['mday']-$d+$i+1, $pd['year']);
            $res['days'][$i] = array(
                                      date("j", $dt),
                                      date("j_n_Y", $dt), 
                                      date("M", $dt),
                                      getDate($dt)
                                    );                      
        }
        return $res;    
    }#GetWeek
    
    
    
    
    public function PrepDate($pdate = '')
    {
        if($pdate == '')
        {
            $pdate = getDate();
        }    
        else
        {
            $pdate = explode('_', $pdate);

            if (isset($pdate[0]) && is_numeric($pdate[0]) &&
                isset($pdate[1]) && is_numeric($pdate[1]) &&
                isset($pdate[2]) && is_numeric($pdate[2]))
            {
                /*
                $pdate['mday']  = $pdate[0];
                $pdate['mon']   = $pdate[1];
                $pdate['year']  = $pdate[2];
                */
                $pdate = getDate(mktime(0, 0, 0, $pdate[1], $pdate[0], $pdate[2]));
            }
            else
            {
                $pdate = getDate();
            }    
        }
        return $pdate;
    }#PrepDate
    
    
    /**
     * Get day in prev or next month
     *
     * @param array $pdate
     * @param int $pn - counter (+-1 etc)
     */
    public function GetDay($pdate = array(), $pn = 1)
    {
        $pndate     = getDate(mktime(0, 0, 0, $pdate["mon"] + $pn, 1, $pdate["year"])); 
        return $pndate;  
    }
    
}
?>