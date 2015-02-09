function ChgView(id) {
  var o = document.getElementById(id);
  if ( 'none' == o.style.display )
  {
    o.style.display = 'block';
  }
  else
  {
    o.style.display = 'none';
  }
}

function setCookie (name, value, expires, path, domain, secure) {
    document.cookie = name + "=" + escape(value) +
    ((expires) ? "; expires=" + expires : "") +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") +
    ((secure) ? "; secure" : "");
}

function SavePrefs(id) {
    var item = id;
    var val = document.getElementById(item).value;
    setCookie(item,val);
}

function SaveCookie() {
    //fromage = document.getElementById("fromage");
    //radius = document.getElementById("radius");
    //limit = document.getElementById("limit");
    //target= document.getElementById("target");
    //alert(fromage.value);
    SavePrefs("fromage");
    //alert(radius.value);
    SavePrefs("radius");
    //alert(limit.value)
    SavePrefs("limit");
    //alert(target.value)
    SavePrefs("target");
    history.go(0);
}

function ChPg(donum) {
    var _num = new Number(document.getElementById('num').value);
    var __num = new Number(donum);
    var pg = _num + __num;
    //alert(num);
    //alert(_num);
    //alert(pg);
    var _sortby = document.getElementById("sortby").value;
    var _sort = document.getElementById("sort").value;
    JobFilter(_sortby, _sort, pg);}

function CenterDiv(id) {

    var elem = document.getElementById(id);
    elem.style.display = 'block';
    var wid = elem.style.width;
    var hei = elem.style.height;

    elem.style.marginTop = '-' + hei/2;
    elem.style.marginLeft = '-' + wid/2;
    
    
}
function JobFilter(__sortby, __sort, _page) {
    // Create new JsHttpRequest object.
        var req = new JsHttpRequest();
	var _sortby = __sortby ? __sortby : "";
	var page = _page ? _page : 1;
	var _sort = __sort ? __sort : "";
		
	//alert(page);
	// Code automatically called on load finishing.
	req.onreadystatechange = function() {
		switch (req.readyState)
		{
		    
		    
		    case 1:
		    case 2:
		    {
			
			// Draw spinning "Loading" image.
			    			img = '<img src="images/loading.gif" />';
						document.getElementById(4).innerHTML = img;
						break;
		    }
		    case 3:
		    {
			
			// Print text "interactive"
			    		img = 'interactive';
					document.getElementById(4).innerHTML = img;
					break;
		    }
		    case 4:
		    {
			// Write result to page element (_RESULT become responseJS).
					    document.getElementById(4).innerHTML = req.responseJS['jobs'];
					    document.getElementById("pagenum").innerHTML = req.responseJS['pagenum']
					    // Write debug information too (output become responseText).
					    document.getElementById('debug').innerHTML = req.responseText;
					    break;
		    }
		    
		    default:
		    {
			img = 'uninitialized';
			document.getElementById(4).innerHTML = img;
			break;
		    }
		    
		    
		}
	}
	    // Prepare request object (automatically choose GET or POST).
	        req.open(null, 'getjob.php', true);

		req.send( {
		    act: 3,
		    what: document.getElementById("what_form").value,
		    where: document.getElementById("where_form").value,
		    sortby: _sortby,
		    sort: _sort,
		    page: page
		    
		});
}

function JobSearch(act) {
    // Create new JsHttpRequest object.
    var req = new JsHttpRequest();
    var action = act;
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
    	if (act == 1|| act == 2 || act == 3) 
    	switch (req.readyState)
        {
    	
    	
    	case 1:
    	case 2:
    		{	
    			
    			// Draw spinning "Loading" image.
    			img = '<img src="images/loading.gif" />';
    			document.getElementById(4).innerHTML = img;
    			document.getElementById(1).innerHTML = img;
    			document.getElementById(2).innerHTML = img;
    			document.getElementById(3).innerHTML = img;
    			break;
    		}
    	case 3:
    		{
    		
    		// Print text "interactive"
    		img = 'interactive';
    		document.getElementById(4).innerHTML = img;
			document.getElementById(1).innerHTML = img;
			document.getElementById(2).innerHTML = img;
			document.getElementById(3).innerHTML = img;
			break;
    		}
    		case 4:
    		{
		    // Write result to page element (_RESULT become responseJS).
		    document.getElementById(4).innerHTML = req.responseJS['jobs'];
		    document.getElementById(1).innerHTML = req.responseJS['company'];
		    document.getElementById(2).innerHTML = req.responseJS['title'];
		    document.getElementById(3).innerHTML = req.responseJS['location'];
		    document.getElementById("pagenum").innerHTML = req.responseJS['pagenum'],
		    // Write debug information too (output become responseText).
		    document.getElementById('debug').innerHTML = req.responseText;
		    break;
		}
    	
    	default:
    		{
    			img = 'uninitialized';
    			document.getElementById(4).innerHTML = img;
    			document.getElementById(1).innerHTML = img;
    			document.getElementById(2).innerHTML = img;
    			document.getElementById(3).innerHTML = img;
    			break;
    		}
    		
    		
        }
    }
    // Prepare request object (automatically choose GET or POST).
    req.open(null, 'getjob.php', false);
    // Send data to backend.
    switch (action) {
    case 1: { //search
				
				req.send( {	act: action,
							what: document.getElementById("what_form").value,
							where: document.getElementById("where_form").value 
						} );
    			break;
			}
    case 2: { //adv search
				req.send( {
    			act: action,
    			as_and: document.getElementById("as_and").value,
    			as_phr: document.getElementById("as_phr").value,
    			as_any: document.getElementById("as_any").value,
    			as_not: document.getElementById("as_not").value,
    			as_ttl: document.getElementById("as_ttl").value,
    			as_cmp: document.getElementById("as_cmp").value,
    			as_jt: document.getElementById("as_jt").value,
    			as_st: document.getElementById("as_st").value,
    			as_salary: document.getElementById("as_salary").value,
    			as_radius: document.getElementById("as_radius").value,
    			as_where: document.getElementById("as_where").value,
    			as_fromage: document.getElementById("as_fromage").value,
    			as_limit: document.getElementById("as_limit").value,
    			as_sort: document.getElementById("as_sort").value
    		} );
    		//ChgView('adpage');
    		//ChgView('bground');
    		break;
    		}
    case 3:
    		{ // page
			req.send( {
    			act: action,
    			page: page
    		}); 
    		break;
    		}
    case 4:  // prefs
    		{
				req.send({
    			act: action,
    			fromage: document.getElementById("fromage").value,
    			radius: document.getElementById("radius").value,
    			limit: document.getElementById("limit").value,
    			target: document.getElementById("target").value
    		});
    		break;
    		}
    }
}
