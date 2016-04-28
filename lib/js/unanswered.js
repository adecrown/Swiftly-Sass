//displays all unanswered question 
function unanswered()
{
  __("2","hidefilelink","").style.display = 'none';
  var url = 'api/select/unanswered.php';

  xhrCallRequest(url,function (result)
  {
    var obj = JSON.parse(result);
    obj.unanswered.forEach(function(entry)
    {
      var results = '<a href="viewtopic.php?question='+entry.id+'"><p>'+entry.title+'</p></a>';
      htmlAppend("3","topicsection","div",results);
      console.log(entry);
    });
  });
};
unanswered();
