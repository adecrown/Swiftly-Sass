
<section class="uploads">

<a href="#upload">
<button  class="but-go" type="button"> UPLOAD FILE </button>
</a>

<select onchange="location = this.options[this.selectedIndex].value; switchselector();" id="soptions" class="selector">
<option value="#">Click for more Options</option>
<option value="#creategroup">Create New Group</option>
<option value="#newmessage">Send A New Conversation</option>
<option value="#files" id="hidefilelink">See Files</option>
<option value="inc/logout.inc.php">Log Out</option>
</select>

<div id="follOwner" class="suggestion">
</div>



<div id="filesp" class="darkCover">
<div class="uploadPopup">
<h2>Files</h2>
<a class="close" href="#">×</a>
<div class="content">


<section class="filePreview1">

</section>

<section class="downloadbtn" id="bnt1">

</section>
</div>
</div>
</div>





<!--  see your files pop-up starts here-->

<div id="files" class="darkCover">
<div class="filecontentloadFull uploadPopup">
<h2>Uploaded Files</h2>
<a class="close" href="#">×</a>
<div class="content">

<section class="filecontentload" id="hidefileload">

</section>
<section class="filePreview">

</section>

<section class="downloadbtn" id="bnt">

</section>
</div>
</div>
</div>

<!--  see your files pop-up ends here-->





<!--  create new Message pop-up starts here-->

<div id="newmessage" class="darkCover">
<div class="uploadPopup">
<h2>Start a new Conversation</h2>
<a class="close" href="#">×</a>
<div class="content" id="delivered">
<form method="post" action="api/inserts/message.php">
<input type="text" name="toWhom" id="toWhom" autocomplete="off" placeholder="Send To" required>
<textarea name="message" class="kol" id="toWhomMessage" placeholder="Message" required></textarea>
<input type="submit" value="SEND MESSAGE" class="but-go formButton" id="sendmessage">
</form>
<div id="MessageAlert"></div>
</div>
</div>
</div>

<!--  create new Message pop-up ends here-->











<!--  create new group pop-up starts here-->

<div id="creategroup" class="darkCover">
<div class="uploadPopup">
<h2>Give your group a name</h2>
<a class="close" href="#">×</a>
<div class="content">
<form method="post" action="api/inserts/group.php">
<input type="text" name="gname" id="gname" autocomplete="off" placeholder="Group Name" required>
<input type="submit" value="Create" class="but-go formButton">
</form>

</div>
</div>
</div>

<!--  create new group pop-up ends here-->


<!--  upload form pop-up starts here-->
<div id="upload" class="darkCover">
<div class="uploadPopup">
<h2>File Upload</h2>
<a class="close" href="#">×</a>
<div class="content">

<form method="post" id="fileForm" action="api/select/fileuploadcall.php" enctype="multipart/form-data">
<div class="uploadButton">
<div  id="fileName" class="uploadbt">
<span>Click to upload your files</span>
</div>
<div class="hidebutton">
<input type="file"  size="40" id="i" name="file" multiple required>

</div>
</div>

<div class="uploadRestriction">
<br>
<input type="text" name="fname"  id="fname" placeholder="Rename" required>
<br>
<br>
<input type="checkbox" name="fPrivate" value="1"> Private
<br>
<br>
<textarea name="ftags" class="kol" placeholder="Give this file some tags."></textarea>

</div>
<input type="submit" value="submit" id="fileSub" class="but-go formButton">
</form>
  <progress id="progressBar" value="0" max="100" style="width:300px; "></progress>
</div>
</div>
</div>

<!--  upload form ends starts here-->

</section>
