// displays the relationship between the user and others
function disp(str)
{
  __("2","hidefilelink","").style.display = 'none';
  var url = 'api/select/display.php?relation='+str;

  xhrCallRequest(url,function (result)
  {
    var obj = JSON.parse(result);
    obj.followingDisplay.forEach(function(entry)
    {
      var methodCall = "followCallm";
      var openLI = "<li>";
      var closeLI = "</li>";
      var result = '<img src="uploadedfile/image/'+entry.image+'" width="150" height="150">';
      var result2 = '<a href="index.php?profile='+entry.id +'">'+entry.username+'</a>';
      var result3='<p id=f'+entry.id +' onclick="follow(&quot;'+entry.id +'&quot;,&quot;'+ entry.relation +'&quot;,&quot;'+methodCall+'&quot;)">'+ entry.relation +'</p>';

      htmlAppend("2","relationpo","div",openLI+result + result2+result3+closeLI);
      console.log(entry);
    });

  });
};

var relate = getParameterByName('relation');

disp(relate);
