<h3>第<?php echo $lesson;?>课,第<?php echo $part;?>部分</h3>
<h2><?php echo $kana; ?></h2>
<form name="fm" method="post" action="/jp3cake/words/check">
	<?php 
	for($i=0;$i<=3;$i++){ 
		echo $i+1;
	?>
	.
	<input name="selection" type="submit" id="sub_<?php echo $i; ?>" value="<?php echo $selections[$i]; ?>">
	<br/>
	<?php } ?>
	<input type="hidden" name="lesson" value="<?php echo $lesson; ?>"/>
	<input type="hidden" name="part" value="<?php echo $part; ?>"/>
	<input type="hidden" name="Id" value="<?php echo $Id; ?>"/>
	<input type="hidden" name="correct" value="<?php echo $correct ?>"/>
</form>
<br/>
<a href="/jp3cake/words?lesson=<?php echo $lesson; ?>&part=<?php echo $part; ?>" id="fc">返回</a>

<script language="javascript">
	window.onload=function(){
		document.getElementById("fc").focus();
	}

	document.onkeydown=function(){
		key=window.event.keyCode;
		if (key>=49 && key<=52)
		{
			document.getElementById('sub_'+(key-49)).click();
		}
	}
</script>