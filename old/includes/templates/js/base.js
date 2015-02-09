function Go(link)
{
    document.location=link;
	return true;
}

function CGo(link, mesg)
{
    if (confirm(mesg))
	{
		document.location=link;
		return true;
	}
}

function _v(id)
{
    return document.getElementById(id);
}

function selControl(obj)
{
    var i;
    var reg = /^check/;
    var result;
    for (i = 0; i < obj.form.elements.length; i++)
    {
        if (reg.test(obj.form.elements[i].name))
             obj.form.elements[i].checked = obj.checked;
    }
}

function confirmLink(theLink, confirmMsg)
{
    if (confirmMsg == '' || typeof(window.opera) != 'undefined') {
        return true;
    }

    var is_confirmed = confirm(confirmMsg);
    if (is_confirmed) {
        theLink.href += '&is_js_confirmed=1';
    }

    return is_confirmed;
}


var qstop = 0;
var sq    = 0;

function ShowDelay(str, strb, block, blt, wait_id) {
	sq = 1;
	setTimeout("Search('"+str+"', '"+strb+"', '"+block+"', '"+blt+"', '"+wait_id+"')", 500);
}

function Search(str, strb, block, blt, wait_id) {   
	if ( !qstop && _v(strb).value == str && sq ) {	
	    qstop = 1;
		sq    = 0;
		//_v(wait_id).style.display = 'block';
	    var req = new JsHttpRequest();
        req.onreadystatechange = function() {
            if (req.readyState == 4) { 
		        _v(block).innerHTML       =  req.responseJS.q;
			    _v(block).style.display   = 'block';
			    //_v(wait_id).style.display = 'none';
				qstop = 0;
            }
        }
        req.open(null, siteAdr+'ajax.php', true);
	    req.send( { action: 'search', str: str, blt: blt } );
	}	
}

function ShowLoad(t)
{
    if (_v('load'))
	{
	    _v('load').style.display = (t == 1) ? 'block' : 'none';
	}
}

