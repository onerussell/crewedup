function make_hidden(idnum)
        {
     if (document.getElementById(idnum).style.display == 'none')
            {
             document.getElementById(idnum).style.display = 'block';
            }
          else
            {
             document.getElementById(idnum).style.display = 'none';
            }
        }
function mhidden(idnum1,idnum2)
        {
         document.getElementById(idnum1).style.display = 'none';
         document.getElementById(idnum2).style.display = 'block';
        }

function spisokChange(klausel,spisok,nospisok)
{
if (klausel.checked)
   {
    nospisok.disabled='';
    spisok.disabled='1';
   }
 else
   {
    nospisok.disabled='1';
    spisok.disabled='';
   }
}

function isDigit(charCode){ return (charCode >= 48 && charCode <= 57)}
function isLat(charCode){ return ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122))}
function isRus(charCode){ return (charCode >= 1040 && charCode <= 1103)}
function filter(evt,set,exc,x) 
       { //set= 1 - digit 2 - lat 4 - rus; x=кроме set
    evt = (evt) ? evt : ((event) ? event : null);
    if (evt) {
        var charCode = (evt.charCode || evt.charCode == 0) ? evt.charCode :
            ((evt.keyCode) ? evt.keyCode : evt.which);
//alert(charCode);
        if (charCode > 13 && !x^(!(set&1 && isDigit(charCode)) && !(set&2 && isLat(charCode)) && !(set&4 && isRus(charCode)) && exc.indexOf(String.fromCharCode(charCode))==-1)) {
        if (evt.preventDefault) { evt.preventDefault(); } else { evt.returnValue = false; return false; }
        }
    }
}

function isNumeric(str)
{
  if (str.length == 0) return false;
  for (var i=0; i < str.length; i++)
     {
      var ch = str.substring(i, i+1);
      if ( ch < "0" || ch>"9" || str.length == null)  return false;
    }
  return true;
}

/**
 * Displays an confirmation box beforme to submit a "EXIT/DELETE" operations.
 * This function is called while clicking links
 *
 * @param   object   the link
 * @param   string   confirm message
 *
 * @return  boolean  whether to run the query or not
 */
function confirmLink(theLink, confirmMsg)
{
    // Confirmation is not required in the configuration file
    // or browser is Opera (crappy js implementation)
    if (confirmMsg == '' || typeof(window.opera) != 'undefined') {
        return true;
    }

    var is_confirmed = confirm(confirmMsg);
    if (is_confirmed) {
        theLink.href += '&is_js_confirmed=1';
    }

    return is_confirmed;
} // end of the 'confirmLink()' function
