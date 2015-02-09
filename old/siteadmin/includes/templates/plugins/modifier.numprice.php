<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty price modifier plugin
 *
 * Type:     modifier<br>
 * Name:     numprice<br>
 * Purpose:  convert price  1000000.000 to format 1,000,000.00
 * @author   engine37.com
 * @param string
 * @return string
 */
function smarty_modifier_numprice($string)
{
    return number_format($string, 2);
}

?>
