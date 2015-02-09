<?php
    include 'top.php';

    $fl  = fopen('shows.txt', 'r');
    $k   = 1;
    $cid = 25; 
    while (!feof($fl))
    {
    	$s = fgets($fl, 4096);
    	if (!empty($s))
    	{
    		$sql = 'INSERT INTO cu_dict (cid, name, sortid) VALUES (?, ?, ?)';
    		$gDb -> query($sql, array( $cid, $s, $k));
    		$k++;
    	}
    }
    echo 'ok';
?>

