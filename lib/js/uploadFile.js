function getFile(id1)
{
  document.getElementById(id1).click();
}


document.getElementById('fileName').onclick = function() {
  getFile("i","fileName")
  document.getElementById("i").onchange = function()
  {
    var filename = document.getElementById("i").value.toString().split(/(\\|\/)/g);

    if(filename != "")
    {
      document.getElementById("fileName").innerHTML = filename[filename.length - 1];
    }
    else
    {
      document.getElementById("fileName").innerHTML = "Click to upload your files";
    }
  };
};


function switchselector()
{
  var val = "#";
  var sel = document.getElementById('soptions');
  var opts = sel.options;
  for(var opt, j = 0; opt = opts[j]; j++) {
    if(opt.value == val) {
      sel.selectedIndex = j;
      break;
    }
  }

}

function getCookie(name)
{
  var re = new RegExp(name + "=([^;]+)");
  var value = re.exec(document.cookie);
  return (value != null) ? unescape(value[1]) : null;
}

function sentMessage()
{
  var MessageAlert = getCookie("MessageAlert");
  MessageAlert = MessageAlert.replace(/\+/g, '%20');
  var decodeVal = decodeURI(MessageAlert);
  if(decodeVal == "Message Sent")
  {
    document.getElementById("toWhom").value ="";
    document.getElementById("toWhomMessage").value ="";
  }
  document.getElementById("MessageAlert").innerHTML = decodeVal;
}


document.getElementById('sendmessage').onclick = function()
{
  return sendForm(this.form,sentMessage,"");
};


// used to hide the search result when the search form losses focus
function hideSearch()
{
  var hasFocus = false;
  var resultFocus = false;

  __("2","keyword","").onblur = function()
  {
    getFocus(hasFocus);
  }
  __("2","searchResult","").onmouseover = function()
  {
    resultFocus = true;
    __("2","keyword","").focus();
  }

  __("3","sugest","").onmouseover = function()
  {
    resultFocus = true;
    __("2","keyword","").focus();
  }

  __("3","sugest","").onmouseout = function()
  {
    resultFocus = false;
  }

  __("2","searchResult","").onmouseout = function()
  {
    resultFocus = false;
  }


  function getFocus(hasFocus)
  {
    if(hasFocus == false && resultFocus == false)
    {
      __("2","searchResult","").style.display = 'none';
    }

  }
}
