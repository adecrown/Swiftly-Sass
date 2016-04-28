
hideSearch();
function showResult(str) {

  var ele = document.getElementById("keyword");
  if (str.length==0 )
  {
    __("1","suggestion","");
    __("1","sub","");
    __("1","quest","");
    __("1","publicFiles","");
    __("2","searchResult","").style.display = 'none';

    return;
  }

  var url ="api/select/search.php?keywords="+str;


  xhrCallRequest(url,function (result) {
    var obj = JSON.parse(result);

    __("2","searchResult","").style.display = 'block';
    searchJsonArray(obj);
  });
};

// displays the json result in the right place for the user
function searchJsonArray(obj)
{
  //json users array
  __("1","suggestion","");

  if(obj.users != undefined)
  {
    obj.users.forEach(function(entry)
    {
      var methodCall = "followCallm";
      var image = "<img src='uploadedfile/image/"+entry.pics+"'>";
      var result = '<li><a href="index.php?profile=' +entry.id + '">'+image+entry.title + '</a><p id=f'+entry.id +' onclick="follow(&quot;'+entry.id +'&quot;,&quot;'+ entry.relation +'&quot;,&quot;'+methodCall+'&quot;)">'+ entry.relation +'</p> </li>  ';

      htmlAppend("2","suggestion","div",result);
      console.log(entry);

    });

  }
  else {
    __("1","suggestion","Empty");
  };


  //json subject array
  __("1","sub","");
  if(obj.subject != undefined)
  {
    obj.subject.forEach(function(entry)
    {
      var methodCall = "followCallsub";
    // var results = '<li><a href="subject.php?id=' +   entry.sid + '">' + entry.stitle + '</a><p id=fs'+entry.sid +' onclick="follow(&quot;'+entry.sid +'&quot;,&quot;'+ entry.relation +'&quot;,&quot;'+methodCall+'&quot;)">'+ entry.relation +'</p></li>'

      var results = '<li><a href="subject.php?id=' +   entry.sid + '">' + entry.stitle + '</a></li>'
      var rebtn = '<p id=fs'+entry.sid +' onclick="follow(&quot;'+entry.sid +'&quot;,&quot;'+ entry.relation +'&quot;,&quot;'+methodCall+'&quot;)">'+ entry.relation +'</p>';
      var together = results+rebtn;

      htmlAppend("2","sub","div",together);
      console.log(entry);

    });

  }
  else
  {
    __("1","sub","Empty");;
  };

  __("1","quest","");
  if(obj.quest != undefined)
  {
    obj.quest.forEach(function(entry)
    {
      var result = '<li><a href="viewtopic.php?question=' +entry.qid + '">' + entry.qtitle + '</a></li>'
      htmlAppend("2","quest","div",result);
    });
  }
  else
  {
    __("1","quest","Empy");
  };


  __("1","publicFiles","");

  if(obj.sfiles != undefined)
  {
    obj.sfiles.forEach(function(entry)
    {
      var result = '<li><a href="#filesp" onclick="previewFiles(&quot;filePreview1&quot;,&quot;'+entry.fileLink+'&quot;,&quot;'+entry.fileName+'&quot;,&quot;'+""+'&quot;)"> '+ entry.fileName + '</a></li>'
      htmlAppend("2","publicFiles","div",result);
    });
  }
  else
  {
    __("1","publicFiles","Empty");
  };
}

function addfilecall()
{
  var element = __("2","filesAdd","");
  if (element.innerHTML === 'Add to folder')
  {
    element.innerHTML = 'Now in folder';
  }
}

//allows a user to follow a subject or another user
function follow(id,relation,methodCall)
{
  myownID = __("2","user1","").value;
  var element
  if(methodCall == "followCallm")
  {
    element = __("2","f"+id,"");
  }
  else
  {
    element = __("2","fs"+id,"");
  }


  if (element.innerHTML == 'Follow')
  {
    __("2","user2","").value = id;
    callbackFollow(id,relation,methodCall,"");
    element.innerHTML = 'Unfollow';
  }
  else if (element.innerHTML == 'Unfollow' )
  {
    callbackFollow(id,relation,methodCall,"delete");
    element.innerHTML = 'Follow';
  }
  else
  {
    console.log("Something went wrong");
  }

  return false;
}


// if uses the "methodCall",to decided wether the user wants to follow a subject or another user
function callbackFollow(id,relation,methodCall,pd)
{
  var encodedParam ='api/data/data.php?functionName='+methodCall+'&myid='+myownID+'&otherid='+id+'&pd='+pd;
  followRelation(encodedParam);

  var subject = __("3","subjectF","");
  if(subject != undefined)
  {
    subject.innerHTML="";
    __("3","groupsName","").appendChild="";
    __("3","subjectT","").innerHTML="";
    __("3","fivecontribution","").appendChild="";
    __("3","liveproblems","").appendChild="";


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

}


function callSearchId(e)
{
  var val = e.target.value;
  showResult(val)
}

var elem = __("2","keyword","");
if(elem)
{
  elem.addEventListener("keyup",callSearchId, false);
}




/* this is for ajax uploading the file upload form
document.getElementById('fileSub').onclick = function()
{
  return sendForm(this.form,"","");
}*/
