
<!--
// CODE FOR POPUP WINDOWS
function launch(newURL, newName, newFeatures, orgName)
{
  var remote = open(newURL, newName, newFeatures);
  if (remote.opener == null)
    remote.opener = window;
  remote.opener.name = orgName;
  return remote;
}

function popup(url, name, width, height)
{
mywinpos = findscreencenter(width,height);
settings=
"toolbar=no,location=no,directories=no,"+
"status=no,menubar=no,scrollbars=auto,"+
"resizable=yes,width="+width+",height="+height+",top="+mywinpos[0]+",left="+mywinpos[1];
orgname="mymain";

MyNewWindow=launch(url,name,settings,orgname);
}

function findscreencenter( pwinwidth, pwinheight )
{
    winpos = new Array(2);
    scrheight = screen.height;
    scrwidth = screen.width;
    wintop = (scrheight - pwinheight-100) / 2;
    winleft = (scrwidth - pwinwidth) / 2;
    winpos[0] = wintop;
    winpos[1] = winleft;
    return winpos;
}

//CODE FOR RECURRENCE STUFF
function rbox_handler()
{
    var const_html = "Recurrence:<SELECT name=recur onChange=rbox_handler()><OPTION value=none>none</OPTION><OPTION value=daily>daily</OPTION><OPTION value=weekly>weekly</OPTION><OPTION value = monthly>monthly</OPTION><OPTION value=yearly>yearly</OPTION></SELECT>";
    var index = document.AddEvnt.recur.selectedIndex;
    var period = document.AddEvnt.recur.options[index].value;
    inputbox = "&nbsp;&nbsp;one time only";
    caption = "";
    if(period != "none")
    {
      inputbox = "&nbsp;&nbsp;for&nbsp;&nbsp;<INPUT TYPE=text size=2 maxlength=3 name=numrecur>";
      caption = "&nbsp;&nbsp;";
      if(period == "daily")
      {
        caption += "days";
        const_html = "Recurrence:&nbsp;<SELECT name=recur onChange=rbox_handler()><OPTION value=none>none</OPTION><OPTION value=daily selected>daily</OPTION><OPTION value=weekly>weekly</OPTION><OPTION value = monthly>monthly</OPTION><OPTION value=yearly>yearly</OPTION></SELECT>";
      }
      else if(period == "monthly")
      {
        caption += "months";
        const_html = "Recurrence:&nbsp;<SELECT name=recur onChange=rbox_handler()><OPTION value=none>none</OPTION><OPTION value=daily>daily</OPTION><OPTION value=weekly>weekly</OPTION><OPTION value = monthly selected>monthly</OPTION><OPTION value=yearly>yearly</OPTION></SELECT>";
      }
      else if(period == "weekly")
      {
        caption += "weeks";
        const_html = "Recurrence:&nbsp;<SELECT name=recur onChange=rbox_handler()><OPTION value=none>none</OPTION><OPTION value=daily>daily</OPTION><OPTION value=weekly selected>weekly</OPTION><OPTION value = monthly>monthly</OPTION><OPTION value=yearly>yearly</OPTION></SELECT>";
      }
      else if(period == "yearly")
      {
        caption += "years";
        const_html = "Recurrence:&nbsp;<SELECT name=recur onChange=rbox_handler()><OPTION value=none>none</OPTION><OPTION value=daily>daily</OPTION><OPTION value=weekly selected>weekly</OPTION><OPTION value = monthly>monthly</OPTION><OPTION value=yearly selected>yearly</OPTION></SELECT>";
      }
    }
    document.getElementById("recurdiv").innerHTML = const_html+inputbox+caption;
}
//-->
