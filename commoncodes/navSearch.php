<?php
$user1 = $_SESSION['user_id'];
$nav = '
<header>
<div class="logo">
logo
</div>

<nav>
<a href="index.php">HOME</a>
<a href="unanswered.php">UNANSWERED TOPIC</a>
<a href="createtopic.php">CREATE TOPIC</a>
</nav>
</header>
<section class="search">
<input type="text"  name="search" placeholder="SEARCH" id="keyword" autocomplete="off" >

<!--<h4 id="results-text">Showing results for: <b id="search-string">Array</b></h4>
onkeyup="showResult(this.value)"
-->

</section>
<section id="searchResult">
<section class="sugest">
<p>Members</p>
<ul id="suggestion" class="suggestion"></ul>
</section>
<section class="sugest">
<p>Subjects</p>
<ul id="sub" class="suggestion">

</ul>
</section>
<section class="sugest">
<p>Questions</p>
<ul id="quest" class="suggestion"></ul>
</section>

<section class="sugest">
<p>Files</p>
<ul id="publicFiles" class="suggestion"></ul>
</section>
</section>

<form  method="post" action="api/data/data.php?functionName=followCallm" id="mun" >
<input type="text" id="user1" name="user1"  value= "'.$user1.'" readonly hidden>
<input type="text" id="user2" name="user2"  readonly hidden>
</form>
';
?>
