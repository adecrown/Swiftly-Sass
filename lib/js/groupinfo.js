var lastTimeStamp;
function groupDetails(str,timeNow) {

  var url = "api/select/groupinfo.php?id="+str+'&timeNow='+timeNow;

  // ouput the json file for the user in the right place.
  xhrCallRequest(url,function (result)
  {
    var obj = JSON.parse(result);
    if(timeNow == "")
    {
      console.log(obj);
      obj.groupInfo.forEach(function(entry)
      {
        var adminimage = image(entry.avatar,entry.groupAdmin)
        __("1","groupName",entry.groupName);
        __("4","groupMem","");__("4","groupMessages","");
        __("3","groupMem","").appendChild(adminimage);
      });

      //output the group members
      obj.groupMembers.forEach(function(entry)
      {
        var membersimage = image(entry.avatar,entry.username);
        __("3","groupMem","").appendChild(membersimage);
      });

      // this function displays files belonging to the logged in user
      if(obj.file != undefined)
      {
        obj.file.forEach(function(entry)
        {
          var link = '<p onclick="filetogroup(&quot;filePreview&quot;,&quot;'+entry.link+'&quot;,&quot;'+entry.name+'&quot;)"> '+entry.name+'</p>';
          htmlAppend("3","filecontentload","div",link);
        });
      }
      else
      {
        __("3","filecontentload","").appendChild="Empty";
      }
    }

    //displays the group files
    __("4","groupfilename","");
    if(obj.groupfile != undefined)
    {
      obj.groupfile.forEach(function(entry)
      {
        var file = '<li><a href="#filesp" onclick="previewFiles(&quot;filePreview1&quot;,&quot;'+entry.Link+'&quot;,&quot;'+entry.Name+'&quot;,&quot;'+""+'&quot;)"> '+ entry.Name + '</a></li>'

        htmlAppend("3","groupfilename","div",file);
      });
    }
    else
    {
      __("3","groupfilename","").innerHTML="<li>No Files for the group</li>";;
    }


    if(obj.messageInbox != undefined)
    {
      __("2","fname","").value="";
      __("2","i","").value="";
      getMessage(obj,"gmessage","groupMessages")
    }
  });

};


function image(avatar,name)
{
  var image = '<img src="uploadedfile/image/'+avatar+'" alt='+name+'>';
  var groupMember = document.createElement('div');
  groupMember.innerHTML = image;
  return groupMember;
}

var questId = getParameterByName('id');
document.getElementById('groupid').value = questId;
document.getElementById('groupidl').value = questId;
document.getElementById('groupown').value = questId;
groupDetails(questId,"");



//lets the logged in user share their file among with the group.
function filetogroup(elm,link,name)
{
  myownID = document.getElementById('user1').value;
  drivepreview(elm,link);
  var encodedParam ='api/data/data.php?functionName=togroup&myid='+myownID+'&name='+name+'&link='+link+'&gid='+questId;

  var addtomyFolder ='<a id="filesAdd" onclick="followRelation(&quot;'+encodedParam+'&quot;),changebtndisplay()">Add file to group</a>';

  var downloadbtn = '<a href="uploadedfile/file/'+link+'" download="'+name+'">Download</a>';
  document.getElementById("bnt").innerHTML = addtomyFolder + downloadbtn;
}


function changebtndisplay()
{
  var element = document.getElementById('filesAdd');
  if (element.innerHTML === 'Add file to group')
  {
    element.innerHTML = 'Now in group';
  }
}



document.getElementById('sendreply').onclick = function()
{
  var param = [questId,lastTimeStamp];
  return sendForm(this.form,groupDetails,param);
};

document.getElementById('groupfileup').onclick = function()
{
  var param = [questId,lastTimeStamp,"progress"];
  return sendForm(this.form,groupDetails,param);
};


document.getElementById('newUser').onclick = function()
{
  getError();
};

/*
"getError" checks if the new user is allowed to be added to the group
 */
function getError()
{
  var newUsername = document.getElementById('newUsername').value;
  var url = "api/inserts/groupMessage.php?groupidl="+questId+'&newUsername='+newUsername;
  xhrCallRequest(url,function (result)
  {
    var error = JSON.parse(result);
    document.getElementById('errorSub').innerHTML = error;
    groupDetails(questId,"");
  });
}

window.setInterval(function()
{
  groupDetails(questId,lastTimeStamp);
}, 5000);
