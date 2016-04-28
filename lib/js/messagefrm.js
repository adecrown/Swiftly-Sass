//displays a list users the logged in user have messaged
function messageFm() {
  __("2","hidefilelink","").style.display = 'none';
  var url = 'api/select/list.php';
  xhrCallRequest(url,function (result)
  {

    var obj = JSON.parse(result);
    if(obj.messageLink != undefined)
    {
      var firstMessage = obj.messageLink[0].TagHash;
      var firstSender = obj.messageLink[0].sender;
      messageinbox(firstMessage,"");
      document.getElementById('hash').value = firstMessage;
      document.getElementById('rec').value = firstSender ;

      var mId = obj.messageLink[0].myId;
      var toWId = obj.messageLink[0].toId;
      var iSent = obj.messageLink[0].myName;
      var myPict = obj.messageLink[0].myPicture;
    
      connectWs(mId,toWId,iSent,obj.messageLink[0].sender,myPict,obj.messageLink[0].TagHash);

      obj.messageLink.forEach(function(entry)
      {
        var link = '<p onclick="formsndreply(&quot;'+entry.sender+'&quot;,'+entry.TagHash+',&quot;'+entry.myId+'&quot;,'+entry.toId+',&quot;'+iSent+'&quot;,&quot;'+myPict+'&quot;)"> '+entry.sender+'</p>';

        htmlAppend("3","messagesFrom","div",link);
      });
    }
    else
    {
      htmlAppend("3","messagesFrom","div","<p>No existing conversation</p>");
    }
  });

};

messageFm();

// calls and sart the websocket
function connectWs(myId,toId,fromWho,toWho,picture,hashID)
{
  wsConnect(myId,toId,fromWho,toWho,picture,hashID);
}


function formsndreply(towhom,id,myId,toId,fromWho,picture)
{
  connectWs(myId,toId,fromWho,towhom,picture,id);
  document.getElementById('hash').value = id;
  document.getElementById('rec').value = towhom+'' ;
  document.getElementsByClassName("messagesDetails")[0].innerHTML ="";
  messageinbox(id,"");
};
