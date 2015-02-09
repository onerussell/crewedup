function GetBlock( uid, res, action, block, params )
{
    var req = new JsHttpRequest();
    req.onreadystatechange = function() 
    {
        if (req.readyState == 4) 
        {
            _v(res).innerHTML = req.responseJS.q;
        }
    }
    req.open(null, siteAdr + 'ajax.php', true);
    req.send( { uid: uid, action: action, what : block, params: params } );           
}

function ShowWire( uid )
{
    if ( null != _v('wire_box'))
    {
        if ( 'none' == _v('wire_box').style.display )
        {
            _v('wire_box').style.display = 'block';
        }
        else
        {
            GetBlock( uid, 'wire_box', 'get_data_list', 'wire', {} );
        }
        _v('wire_up').style.display   = 'none'; 
        _v('wire_down').style.display = 'block';         
    }
}/** ShowWire */

function HideWire ( )
{
    _v('wire_up').style.display   = 'block'; 
    _v('wire_down').style.display = 'none';
    _v('wire_box').style.display  = 'none'; 
}/** HideWire */

function ShowResume( uid )
{
    if ( null != _v('resume_box'))
    {
        if ( 'none' == _v('resume_box').style.display )
        {
            _v('resume_box').style.display = 'block';
        }
        else
        {
            GetBlock( uid, 'resume_box', 'get_data_list', 'resume', {} );
        }
        _v('resume_up').style.display   = 'none'; 
        _v('resume_down').style.display = 'block';         
    }
}/** ShowResume */

function HideResume ( )
{
    _v('resume_up').style.display   = 'block'; 
    _v('resume_down').style.display = 'none';
    _v('resume_box').style.display  = 'none'; 
}/** HideResume */

function ShowAward( uid )
{
    if ( null != _v('award_box'))
    {
        if ( 'none' == _v('award_box').style.display )
        {
            _v('award_box').style.display = 'block';
        }
        else
        {
            GetBlock( uid, 'award_box', 'get_data_list', 'award', {} );
        }
        _v('award_up').style.display   = 'none'; 
        _v('award_down').style.display = 'block';         
    }
}/** ShowAward */

function HideAward ( )
{
    _v('award_up').style.display   = 'block'; 
    _v('award_down').style.display = 'none';
    _v('award_box').style.display  = 'none'; 
}/** HideAward */


function ShowComment( uid, wh )
{
    if ( null != _v('comment_box'))
    {
        GetBlock( uid, 'comment_box', 'get_data_list', 'comments', {wh: wh} );
        _v('b_com').style.display   =  ('r' == wh) ? 'block' : 'none';
        _v('b_rec').style.display   =  ('r' == wh) ? 'none' : 'block';
        
        _v('b_com_a').style.display =  ('r' == wh) ? 'none' : 'block';
        _v('b_rec_a').style.display =  ('r' == wh) ? 'block' : 'none';        
    }
}/** ShowAward */

function ShowRentals( uid )
{
    if ( null != _v('rentals_box'))
    {
        if ( 'none' == _v('rentals_box').style.display )
        {
            _v('rentals_box').style.display = 'block';
        }
        else
        {
            GetBlock( uid, 'rentals_box', 'get_data_list', 'rentals', {} );
        }
        _v('rentals_up').style.display   = 'none'; 
        _v('rentals_down').style.display = 'block';         
    }
}/** ShowRentals */

function HideRentals ( )
{
    _v('rentals_up').style.display   = 'block'; 
    _v('rentals_down').style.display = 'none';
    _v('rentals_box').style.display  = 'none'; 
}/** HideRentals */

function ShowRoster( uid )
{
    if ( null != _v('roster_box'))
    {
        if ( 'none' == _v('roster_box').style.display )
        {
            _v('roster_box').style.display = 'block';
        }
        else
        {
            GetBlock( uid, 'roster_box', 'get_data_list', 'roster', {} );
        }
        _v('roster_up').style.display   = 'none'; 
        _v('roster_down').style.display = 'block';         
    }
}/** ShowRoster */

function HideRoster ( )
{
    _v('roster_up').style.display   = 'block'; 
    _v('roster_down').style.display = 'none';
    _v('roster_box').style.display  = 'none'; 
}/** HideRoster */

function ShowCredits( uid )
{
    if ( null != _v('credits_box'))
    {
        if ( 'none' == _v('credits_box').style.display )
        {
            _v('credits_box').style.display = 'block';
        }
        else
        {
            GetBlock( uid, 'credits_box', 'get_data_list', 'credits', {} );
        }
        _v('credits_up').style.display   = 'none'; 
        _v('credits_down').style.display = 'block';         
    }
}/** ShowCredits */

function HideCredits ( )
{
    _v('credits_up').style.display   = 'block'; 
    _v('credits_down').style.display = 'none';
    _v('credits_box').style.display  = 'none'; 
}/** HideCredits */
