// display all messages belonging to te logged in user.
function messageinbox(str,timeNow)
{
  var url = 'api/select/inbox.php?hash='+str+'&timeNow='+timeNow;

  xhrCallRequest(url,function (result)
  {
    var obj = JSON.parse(result);

    if(obj.messageInbox != undefined)
    {
      getMessage(obj,"rmessage","messagesDetails");
      console.log(obj);
    }
  });
};
