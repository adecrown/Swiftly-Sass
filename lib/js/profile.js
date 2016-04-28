/*
*this file contains three main function
*1. usersprofile() -  displays the logged in user info by  calling profileJsonArray(obj,id)
*2. changeFileProtect() - chnages the level of protection of the user's file
*3. recallUser() - calls the usersprofile() function by passing the right parameter
*/

function usersprofile(id) {

  // calls the php file for user info
  var url = 'api/select/profileinfo.php?profile='+id;
  // Requests a new xhr callback
  xhrCallRequest(url,function (result)
  {
    var obj = JSON.parse(result,id);
    console.log(obj);
    profileJsonArray(obj,id);
  });

};


function profileJsonArray(obj,id)
{
  var methodCall = "followCallsub";
  // this functin gets all userinfo (name,school,followers/following count )
  obj.profile.forEach(function(entry)
  {
    var folResult = '<p id=f'+entry.id +' onclick="follow(&quot;'+entry.id +'&quot;,&quot;'+ entry.rel +'&quot;)">'+ entry.rel +'</p>';
    if(entry.rel != null)
    {
      __("1","follOwner",folResult);
    }
    else
    {
      __("3","uploads",folResult).style.height="110px";
    }

    __("4","cname",entry.course);
    __("4","uniname",entry.school);
    __("1","pt",entry.folCount);
    __("1","pt1",entry.foll);
    __("1","groupC",entry.group);
    __("1","point","Points: "+entry.point);


    function userAvatar(pic,name)
    {
      var img = "<img src='uploadedfile/image/"+pic+"'>";
      __("3","pic","").innerHTML = img+ '<p>'+name+'</p>';
      __("3","profileimage","").style.backgroundImage = "url('uploadedfile/image/"+pic+"')";
    }

    if(entry.profilepic != "" && entry.profilepic != null)
    {

      userAvatar(entry.profilepic,entry.userne);
    }
    else
    {
      userAvatar("blank-profile.jpg",entry.userne);
    }
  });


  if(obj.subjecter != undefined)
  {
    // this function displays the subject the user follows
    obj.subjecter.forEach(function(entry)
    {
      var results = entry.subjectName;
      var ast = '<a id="follsub" class="suggestion">';
      var aend = '</a>';
      var folsublink =ast+'<p id=fs'+entry.id +' onclick="follow(&quot;'+entry.id +'&quot;,&quot;'+ entry.subrel +'&quot;,&quot;'+methodCall+'&quot;)">'+ entry.subrel+'</p></li>'+aend;

      htmlAppend("3","subjectF","div",results + folsublink);
    });
  }
  else
  {
    var result = 'You can follow a subject';
    htmlAppend("3","subjectF","div",result);
  }


  // this function suggest  the subject the user should follows
  if(obj.subjectFl != undefined)
  {
    obj.subjectFl.forEach(function(entry){

      var results = entry.subjectName;

      var ast = '<a id="follsub" class="suggestion">';
      var aend = '</a>';
      var folsub =ast+'<p id=fs'+entry.id +' onclick="follow(&quot;'+entry.id +'&quot;,&quot;'+ entry.subrel +'&quot;,&quot;'+methodCall+'&quot;)">'+ entry.subrel+'</p></li>'+aend;

      htmlAppend("3","subjectT","div",results + folsub);

    });
  }
  // counts how many unread message the user have
  if(obj.newmessage != undefined)
  {
    __("1","newmesage",obj.newmessage[0].newM);
  }
  else
  {
    __("1","newmesage","0");
  }


  if(obj.usersgroup != undefined)
  {
    // this function displays the subject the user follows
    obj.usersgroup.forEach(function(entry)
    {
      var results = '<a href="group.php?id='+entry.id+'"><p>'+entry.name+'</p></a>';
      htmlAppend("3","groupsName","div",results);
    });
  }
  else
  {
    var result = 'You currently do not belong to a group';
    htmlAppend("3","groupsName","p",result);
  }

  if(obj.contributions != undefined)
  {
    // this function displays the subject the user follows
    obj.contributions.forEach(function(entry)
    {
      var results = '<a href="viewtopic.php?question='+entry.id+'"><p>'+entry.title+'</p></a>';
      htmlAppend("3","fivecontribution","div",results);
    });
  }
  else
  {
    var result = 'You have no contributions';
    htmlAppend("3","fivecontribution","p",result);
  }


  if(obj.sugcontributions != undefined)
  {
    // this function displays the subject the user follows
    obj.sugcontributions.forEach(function(entry){

      var results = '<a href="viewtopic.php?question='+entry.id+'"><p>'+entry.title+'</p></a>';
      htmlAppend("3","liveproblems","div",results);
    });
  }
  else
  {
    var result = 'You have contributed to all topics';
    htmlAppend("3","liveproblems","p",results);
  }


  // this function displays files belonging to the user
  if(obj.file != undefined)
  {
    obj.file.forEach(function(entry)
    {

      var protect;
      var protectVal;
      if(entry.protect == 0)
      {
        protect = "Make Private";
        protectVal = 1;
      }
      else {
        protect = "Make Public";
        protectVal = 0;
      }

      var protectChange = '<a id=f'+entry.id+' onclick="changeFileProtect(&quot;'+entry.id+'&quot;,'+protectVal+')"> '+protect+'</a>';

      var link = '<p onclick="previewFiles(&quot;filePreview&quot;,&quot;'+entry.link+'&quot;,&quot;'+entry.name+'&quot;,&quot;'+id+'&quot;)"> '+entry.name+'</p>';

      var newElements = document.createElement('div');

      if(id == "0")
      {
        newElements.innerHTML = link + protectChange;
      }
      else
      {
        newElements.innerHTML = link;
      }

      document.getElementsByClassName("filecontentload")[0].appendChild(newElements);

    });
  }
}

// changes the protection level of a file
function changeFileProtect(myownID,val)
{

  var element = document.getElementById('f'+myownID);

  if (element.innerHTML === 'Make Public')
  {
    element.innerHTML = 'Make Private';
    var encodedParam ='api/data/data.php?functionName=files&myid='+myownID+"&val=0";
    followRelation(encodedParam);
  }
  else
  {
    element.innerHTML = 'Make Public';
    var encodedParam ='api/data/data.php?functionName=files&myid='+myownID+"&val=1";
    followRelation(encodedParam);

  }
}

//
// This checks which user profile should be displays and the user is called
//
function recallUser()
{
  var viewingID = getParameterByName('profile');
  if(viewingID == "")
  {
    usersprofile("0");
  }
  else
  {
    usersprofile(viewingID);
  }
}
recallUser();


//
// This handles the profile picture upload
//
__("2","pictureName","").onclick = function() {
  __("2","up","").click();
  __("2","up","").onchange = function()
  {
    if (!document.getElementById("up").value)
    {
      event.preventDefault();
    }
    else
    {
      __("3","subjectF","").appendChild = "";
      __("3","subjectT","").appendChild = "";
      __("3","fivecontribution","").appendChild = "";
      __("3","liveproblems","").appendChild = "";
      __("3","groupsName","").appendChild="";
      return sendForm(this.form,usersprofile,"");
    }
  };

};


//
// This handles the profile picture upload form button
//
function change_sidebar(view)
{
  __("2","pictureName","").style.visibility = view;
}

__("3","pic","").onmouseover = function()
{
  change_sidebar("visible");
};

__("3","pic","").onmouseout = function()
{
  change_sidebar("hidden");
};


__("2","pictureName","").onmouseover = function() {

  change_sidebar("visible");
};

__("2","pictureName","").onmouseout = function() {

  change_sidebar("hidden");
};
