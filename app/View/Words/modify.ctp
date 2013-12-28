<h3>第<?php echo $word['Word']['lesson'];?>课,第<?php echo $word['Word']['part'];?>部分</h3>
<form name="fm" method="post" action="/jp3cake/words/doModify">
	<table>
		<tr>
			<td>假名</td><td>
			<input name="data[Word][kana]" id="fc" value="<?php echo $word['Word']['kana']; ?>"/></td>
		</tr>
		<tr>
			<td>汉字</td><td><input name="data[Word][kanji]" value="<?php echo $word['Word']['kanji']; ?>"/></td>
		</tr>
		<tr>
			<td>释义</td><td><input name="data[Word][meaning]" value="<?php echo $word['Word']['meaning']; ?>"/></td>
		</tr>
	</table>
	<input type="hidden" name="data[Word][Id]" value="<?php echo $word['Word']['Id']; ?>"/>
	<input type="hidden" name="data[Word][lesson]" value="<?php echo $word['Word']['lesson'];?>"/>
	<input type="hidden" name="data[Word][part]" value="<?php echo $word['Word']['part'];?>"/>
	<input type="submit" value="提交"/>
</form>
<a href="/jp3cake/words/management?lesson=<?php echo $word['Word']['lesson']; ?>&part=<?php echo $word['Word']['part']; ?>">返回</a>

<script language="javascript">
	window.onload=function(){
		document.getElementById("fc").focus();
		document.getElementById("fc").select();
	}
</script>