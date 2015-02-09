function isDigit(charCode) { return (charCode >= 48 && charCode <= 57) }
function isLat(charCode)   { return ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122)) }
function isRus(charCode)   { return (charCode >= 1040 && charCode <= 1103) }
function filter(evt,set,exc,x) 
{ //set= 1 - digit 2 - lat 4 - rus; x=кроме set
    evt = (evt) ? evt : ((event) ? event : null);
    if (evt) 
    {
        var charCode = (evt.charCode || evt.charCode == 0) ? evt.charCode :
            ((evt.keyCode) ? evt.keyCode : evt.which);

        if (charCode > 13 && !x^(!(set&1 && isDigit(charCode)) && !(set&2 && isLat(charCode)) && !(set&4 && isRus(charCode)) && exc.indexOf(String.fromCharCode(charCode))==-1)) 
        {
            if (evt.preventDefault) { evt.preventDefault(); } else { evt.returnValue = false; return false; }
        }
    }
}

function isNumeric(str)
{
   if (str.length == 0) return false;
   for (var i = 0; i < str.length; i++)
   {
      var ch = str.substring(i, i+1);
      if ( ch < '0' || ch>'9' || str.length == null)  return false;
   }
   return true;
}

function clearSelect(obj)
{
    var cnt = obj.options.length;

    for (var i = cnt - 1; i >= 0; i--)
    {
        obj.options[i] = null;
    }
}

function clearSelect2(obj, gr1)
{
    var cnt = obj.options.length;

    for (var i = cnt - 1; i >= gr1; i--)
    {
        obj.options[i] = null;
    }
}

function add_years(srcYearObj, val)
{
    var sel_val = (0 < srcYearObj.value) ? srcYearObj.value : 0;

    clearSelect2(srcYearObj, 1);

    var year_lim = val*1 + 15;
    for (var year = val; year <= year_lim; year++)
    {
        oOption = document.createElement('OPTION');
        oOption.text  = year;
        oOption.value = year;

        if (year == sel_val) oOption.selected = true;

        srcYearObj.options.add(oOption);
    }
}

function deb(d, l) 
{
    if (l == null) l = 1;

    if (l > 1) return;

    var s = '';

    if (typeof(d) == 'object') 
    {
        s += typeof(d) + " {\n";
        for (var k in d) 
        {
            for (var i=0; i<l; i++) 
                s += "  ";

            s += k+": " + deb(d[k],l+1);
        }
        for (var i=0; i<l-1; i++) 
            s += "  ";

        s += "}\n"
    } 
    else 
        s += '' + d + "\n";

    return s;
}

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

