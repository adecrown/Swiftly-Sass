//var connection = new WebSocket('ws://127.0.0.1:8088/1');
function wsConnect(id,toId,fromWho,toWho,picture,hashID)
{
  /*
  var connection = new WebSocket('ws://hostname:port/id');

  The id is used to determine which user is connecting to the websocket.
  It is also used to send and receive messages
  */
  var connection = new WebSocket("ws://"+window.location.hostname+":8088/"+id);
  var content = document.getElementById('messagesDetails');
  var input = document.getElementById('rmessage');
  var status = document.getElementById('status');
  document.getElementById('socketws').innerHTML="WebSocket connection to 'ws://"+window.location.hostname+":8088/"+id+"' failed";

  connection.onopen = function ()
  {

  };


  connection.onerror = function (error) {
    window.location = "#errorws";
  };

  connection.onmessage = function (message)
  {
    var obj = JSON.parse(message.data)
    console.log(obj);
    var whoIsTalking = document.getElementById('hash').value;
    var whoSentMessage = obj.messageInbox[0].hash;

    /*
    if who am talking to is the one that sent a message, then show me the message and also store it to the database. If not, only store the message to the database.
    */
    if(whoIsTalking == whoSentMessage)
    {
      getMessage(obj,"rmessage","messagesDetails");
    }
  }


  function sendMessage(obj)
  {
    var whoSentMessage = obj.messageInbox[0].hash;
    var messageSent = obj.messageInbox[0].message;
    var messageOwner = obj.messageInbox[0].to;
    var messageFrom = obj.messageInbox[0].from;

    var encodedParam ='api/select/inbox.php?hash='+whoSentMessage+'&rmessage='+messageSent+'&rec='+messageOwner+'&from='+messageFrom;
    followRelation(encodedParam);

    getMessage(obj,"rmessage","messagesDetails");
  }

  document.getElementById('sendreply').onclick = function()
  {
    var ourMessage = {"messageInbox":[{"id":toId,"from":fromWho,"to":toWho,"message":input.value,"pict":picture,"hash":hashID}]}

    var makeString = JSON.stringify(ourMessage);
    var objSent = JSON.parse(makeString);
    sendMessage(objSent);
    connection.send(makeString);
  };

}
