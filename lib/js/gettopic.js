
// gets question and comments based on the id given
function showResult2(str) {
  __("2","hidefilelink","").style.display = 'none';
  __("1","parentid","0");
  __("1","pcomment","");

  var url = "api/select/gettopic.php?question="+str;
  xhrCallRequest(url,function (result)
  {

    var obj = JSON.parse(result);

    obj.questioner.forEach(function(entry){
      __("1","vtitle",entry.title);
      __("1","vnote",entry.note);
      __("2","questionid","").value = entry.id;

      /*
      if the question poster id is the same as the logged in user id
      allow the user to close the question by calling the "closeQuestion" function
      if not show the question status
      */
      if(entry.owner == entry.user)
      {
        var result = '<p id="closew" onclick="closeQuestion()">'+entry.status+'</p>';
        __("1","closeq",result);
      }
      else {
        var result = '<p>'+entry.status+'</p>';
        __("1","closeq",result);
      }

      if(entry.status == "Closed")
      {
        document.getElementsByClassName("replyform")[0].innerHTML="";
      }
    });


    // checks if a comments has had a reply or not
    obj.comment.forEach(function(entrys){

      var getLength = function(obj) {
        var i = 0, key;
        for (key in obj) {
          if (obj.hasOwnProperty(key)){
            i++;
          }
        }
        return i;
      };

      var img = "<img src='uploadedfile/image/"+entrys.pic+"'>";
      var name = "<a>"+entrys.username+"</a>";
      var res = entrys.commentmade
      var po = '<p class="rep"><a href="#pcomment" class="but-go" onclick="commentid('+entrys.id+')" >Reply</a></p>';
      var joinC = img+name+"<section>"+res + po+"</section>";

      // if all of the comment posted is without a reply the fist condition execute
      if(getLength(obj) == 2)
      {
        htmlAppend("2","comment","dl",joinC);
        console.log(entrys);
      }
      else {

        //document.getElementById("comment").appendChild(newElements);
        htmlAppend("2","comment","dl",joinC);
        console.log(entrys);

        obj.reply.forEach(function(entrt)
        {
          if(entrys.id === entrt.child)
          {
            //reply post
            var img = "<img src='uploadedfile/image/"+entrt.pic+"'>";
            var name = "<a>"+entrt.username+"</a>";
            var rest = "<p>"+entrt.replymade+"</p>";
            htmlAppend("2","comment","div",img+name+rest);
            console.log(entrt);
            //reply ends
          }

        });
      }
    });


  });

};


//gets the question id from url
var questId = getParameterByName('question');

showResult2(questId);


function commentid(id) {
  __("2","parentid","").value = id;
};

function closeQuestion()
{
  var element = _("2","closew","");

  if (element.innerHTML === 'Open')
  {
    var encodedParam ='api/data/data.php?functionName=questionclose&questionid='+questId;
    followRelation(encodedParam);
    element.innerHTML="Closed";
    __("4","replyform","");
  }
}

// automatically upload comment with button click
__("2","qcomment","").onclick = function()
{
  var parameter = [questId];
  __("1","comment","");
  return sendForm(this.form,showResult2,parameter);
};
