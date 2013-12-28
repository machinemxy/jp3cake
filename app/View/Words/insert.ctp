<h3>第<?php echo $lesson;?>课,第<?php echo $part;?>部分</h3>
<form name="fm" method="post" action="/jp3cake/words/doInsert">
	<table>
		<tr>
			<td>假名</td><td>
			<input name="data[Word][kana]" id="fc"/></td>
		</tr>
		<tr>
			<td>汉字</td><td><input name="data[Word][kanji]"/></td>
		</tr>
		<tr>
			<td>释义</td><td><input name="data[Word][meaning]"/></td>
		</tr>
	</table>
	<input type="hidden" name="data[Word][lesson]" value="<?php echo $lesson; ?>"/>
	<input type="hidden" name="data[Word][part]" value="<?php echo $part; ?>"/>
	<input type="submit" value="提交"/>
</form>
<a href="/jp3cake/words/management?lesson=<?php echo $lesson; ?>&part=<?php echo $part; ?>">返回</a>

<script language="javascript">
	window.onload=function(){
		document.getElementById("fc").focus();
	}
</script>