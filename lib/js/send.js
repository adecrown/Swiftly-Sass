function sendForm(form,func,param)
{
  var formData = new FormData(form);

  formData.append('secret_token', '1234567890');

  var xhr = new XMLHttpRequest();
  //document.getElementById("progressBar").value = 0;
  xhr.open('POST', form.action, true);
  if(param[2] != undefined )
  {

    xhr.upload.onprogress = function(event)
    {
      var percent = (event.loaded / event.total) * 100;
      document.getElementById("progressBar").value = Math.round(percent);
    }

  }
  xhr.onload = function(e)
  {
    //  showResult3();
    if(param == "" && func !="")
    {
      func();
    }
    else if (param != "" && func != "")
    {
      if(param.length > 1)
      {
        func(param[0],param[1]);
      }
      else {
        func(param[0]);
      }

      console.log("i am: "+param);
    }
    else
    {
      console.log("function call not needed");
    }

  };




  xhr.send(formData);

  return false; // Prevent page from submitting.
};


function followRelation(url) {
  var xhr, success, failure,obj;
  xhr = new XMLHttpRequest();


  xhr.open("POST",url,true);

  xhr.onload = function(e)
  {

  };
  xhr.send();
};


function getValue2(a,b){ // Url, Callback, just a placeholder
  var c=new XMLHttpRequest;
  c.open('GET',a);
  c.onload=b;
  c.send()
}

function xhrCallRequest(url,callback) {
  var xhr, success, failure,obj;
  xhr = new XMLHttpRequest();

  success = function () {

    callback(xhr.responseText);
  };

  failure = function () {
    document.getElementById("quest").innerHTML = "<p>Something went wrong.</p>";
  };


  xhr.open("GET",url,true);
  xhr.onload = success;
  xhr.onerror = failure;
  xhr.send();

};


function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
  results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

// allws the user to preview a file that's not image using google drive
function drivepreview(elm,link)
{
  var imageExtension = ["jpeg", "png", "jpg"];
  var image = '<img src="uploadedfile/file/'+link+'" width="550" height="450">';
  //
  // The google drive url below should be pointing to my vm ip address but
  //  because of the firewalls google drive can't connect to it, so i have
  //  decided to point it to my domian for demonstration.
  //
  var drive = '<iframe src="http://docs.google.com/gview?url=http://redfischer.com/Web/uploadedfile/file/'+link+'&embedded=true" style="width:550px; height:450px;" frameborder="0"></iframe>';

  for(var i = 0;i < imageExtension.length;i++)
  {
    console.log(imageExtension[i]);
    if(link.indexOf(imageExtension[i]) >=0)
    {
      __("4",elm,image);
      break;
    }
    else
    {
      __("4",elm,drive);
    }
  }

}

// stop all forms from loading when the enter key is pressed
function stopEnter(event)
{
  if (event.keyCode == 13)
  {
    return false;
  }
}


function keyStop(id)
{
  var doc = document.getElementById(id);
  if(doc != null)
  {
    doc.onkeydown = function()
    {
      return stopEnter(event);
    }
  }
}

function callID()
{
  keyStop("topictitle");
  keyStop("topictags");
  keyStop("toWhom");
  keyStop("gname");
  keyStop("fname");
}
callID();

// breaks dow all data from json and display it as a message
function getMessage(obj,reply,container) {
  document.getElementById(reply).value ="";
  obj.messageInbox.forEach(function(entry){

    var image = '<img src="uploadedfile/image/'+entry.pict+'" width="32" height="32">';

    var flink = '<p>'+entry.from+'</p>'
    var mesg = entry.message;
    if(mesg.indexOf('https://www.youtube.com/watch?v') >=0)
    {
      var myarr = mesg.split("=");
      var myvar = myarr[1];
      mlink = entry.message+'<iframe width="470" height="300" src="http://www.youtube.com/embed/'+myvar+'" frameborder="0" allowfullscreen></iframe>';
    }
    else
    {
      mlink = '<section>'+entry.message+'</section>'
    }

    var messagelist = document.createElement('div');
    messagelist.innerHTML = image+flink+mlink;

    document.getElementsByClassName(container)[0].appendChild(messagelist);

    var sie = obj.messageInbox.length;
    var fr = obj.messageInbox[sie - 1].stamp;
    lastTimeStamp = fr;

  });
}


var ScrollRate = 0;

// automatically scroll down to the bottom of the message box.
function scrollDiv_init(section) {
  DivElmnt = document.getElementsByClassName(section)[0];
  ReachedMaxScroll = false;

  DivElmnt.scrollTop = 0;
  PreviousScrollTop  = 0;

  ScrollInterval = setInterval('scrollDiv()', ScrollRate);
}

function scrollDiv() {

  DivElmnt.scrollTop = PreviousScrollTop;
  PreviousScrollTop++;
  ReachedMaxScroll = DivElmnt.scrollTop >= (DivElmnt.scrollHeight - DivElmnt.offsetHeight);
}

function pauseDiv() {
  clearInterval(ScrollInterval);
}

function resumeDiv() {
  PreviousScrollTop = DivElmnt.scrollTop;
  ScrollInterval    = setInterval('scrollDiv()', ScrollRate);
}

function __(switchElement,id,val)
{
  var element;
  if(switchElement == "1")
  {
    element = document.getElementById(id).innerHTML = val;
  }
  else if (switchElement == "2")
  {
    element = document.getElementById(id);
  }
  else if (switchElement == "4")
  {
    element = document.getElementsByClassName(id)[0].innerHTML = val;
  }
  else {
    element = document.getElementsByClassName(id)[0];
  }
  return element;
}

// creates a new element
function htmlAppend(num,name,element,result)
{
  var docName = __(num,name,"");
  var newElements = document.createElement(element);
  newElements.innerHTML = result;

  for(var i = 0;i < newElements.innerHTML.length;i++)
  {
    docName.appendChild(newElements);
  }
}

// allows the user to preveiew all files by calling drivepreview()
function previewFiles(elm,link,name,id)
{
  myownID = __("2","user1","").value;
  drivepreview(elm,link);
  var encodedParam ='api/data/data.php?functionName=store&myid='+myownID+'&name='+name+'&link='+link;

  var addtomyFolder ='<a id="filesAdd" onclick="followRelation(&quot;'+encodedParam+'&quot;),addfilecall()">Add to folder</a>';

  var downloadbtn = '<a href="uploadedfile/file/'+link+'" download="'+name+'">Download</a>';

  if(elm ==="filePreview1")
  {
    __("1","bnt1",addtomyFolder + downloadbtn)

  }

  if(id === "0" && elm ==="filePreview")
  {
    __("1","bnt",downloadbtn);

  }
  else
  {
    __("1","bnt",addtomyFolder + downloadbtn);

  }
}























/*
if (window.FileReader) {
var drop;
addEventHandler(window, 'load', function () {
var status = document.getElementById('status');
drop = document.getElementById('fileName');
var list = document.getElementById('list');

function cancel(e) {
if (e.preventDefault) {
e.preventDefault();
}
return false;
}

// Tells the browser that we *can* drop on this target
addEventHandler(drop, 'dragover', cancel);
addEventHandler(drop, 'dragenter', cancel);

addEventHandler(drop, 'drop', function (e) {
e = e || window.event; // get window.event if e argument missing (in IE)
if (e.preventDefault)
{
e.preventDefault();
} // stops the browser from redirecting off to the image.

var dt = e.dataTransfer;
var files = dt.files;

var file = files[0];
var reader = new FileReader();
drop.innerHTML = file;
document.getElementById('i').click();;
reader.readAsDataURL(file);
});
});
}
else
{
document.getElementById('status').innerHTML = 'Your browser does not support the HTML5 FileReader.';
}


function addEventHandler(obj, evt, handler) {
if (obj.addEventListener) {
// W3C method
obj.addEventListener(evt, handler, false);
} else if (obj.attachEvent) {
// IE method.
obj.attachEvent('on' + evt, handler);
} else {
// Old school method.
obj['on' + evt] = handler;
}
}
*/
