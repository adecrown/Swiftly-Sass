var webSocketServer = new (require('ws')).Server
({
  port: (process.env.PORT || 8088)
}),
webSockets = {} // userID: webSocket

webSocketServer.on('connection', function (webSocket)
{
  var userID = parseInt(webSocket.upgradeReq.url.substr(1), 10)
  console.log(userID + " i am");
  webSockets[userID] = webSocket
  console.log('connected: ' + userID + ' in ' + Object.getOwnPropertyNames(webSockets))


  webSocket.on('message', function(message)
  {
    console.log('received from ' + userID + ': ' + message)
    var messageArray = JSON.parse(message);
    var sendingTo = messageArray.messageInbox[0].id;
    var toUserWebSocket = webSockets[sendingTo];
    if (toUserWebSocket)
    {
      console.log('sent to ' + sendingTo + ': ' + JSON.stringify(messageArray))
      messageArray[0] = userID
      toUserWebSocket.send(JSON.stringify(messageArray))
    }
  })


  webSocket.on('close', function () {
    delete webSockets[userID]
    console.log('deleted: ' + userID)
  })
})
