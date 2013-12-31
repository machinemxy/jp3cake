<h3>第<?php echo $lesson;?>课,第<?php echo $part;?>部分</h3>
<h2><?php echo $description; ?></h2>
<form name="fm" method="post" action="/jp3cake/words/check">
	<input name="selection" id="fc"/>
	<input type="hidden" name="lesson" value="<?php echo $lesson; ?>"/>
	<input type="hidden" name="part" value="<?php echo $part; ?>"/>
	<input type="hidden" name="Id" value="<?php echo $Id; ?>"/>
	<input type="hidden" name="correct" value="<?php echo $correct; ?>"/>
	<input type="submit"/>
</form>
<br/>
<a href="/jp3cake/words?lesson=<?php echo $lesson; ?>&part=<?php echo $part; ?>" id="fc">返回</a>

<script language="javascript">
	window.onload=function(){
		document.getElementById("fc").focus();
	}
</script>