var color = 1;

function SelColor( id )
{   
    if ( '' != _v(id).className )
    {
        _v(id).className = '';
        SaveEvent( id );
    }
    else
    {
        _v(id).className = (1 == color) ? 'green' : 'red';
        SaveEvent( id, color );
    }
}/** SelColor */


function SaveEvent( id, color )
{
    var req = new JsHttpRequest();
    req.onreadystatechange = function() 
    {
        if (req.readyState == 4) 
        {
            //req.responseJS.q;
        }
    }
    req.open(null, siteAdr + 'ajax.php', true);
    var color = (null != color) ? color : '';
    req.send( { action: "add_event", id: id, color: color} );           
}


function SetColor( num )
{
    color = num;
}/** SetColor */