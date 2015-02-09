<?
$pn = $_SERVER['REQUEST_URI'];
switch ($pn)
{
    case '/contact':
	    header("location:/contact/");
	break;
    case '/cat':
	    header("location:/cat/");
	break;
	default:
}
?>
<html>
<head>
<style>
body {
    font-size: 11px; font-family: verdana, arial, helvetica
}

h2 {
    font-size: 16px; color: black
}
</style>
</head>
<body>
<h2>404 Page not found</h2>
</body>
</html>