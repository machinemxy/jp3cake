<table>
	<tr>
		<td>假名</td><td><?php echo $word['Word']['kana']; ?></td>
	</tr>
	<tr>
		<td>汉字</td><td><?php echo $word['Word']['kanji']; ?></td>
	</tr>
	<tr>
		<td>释义</td><td><?php echo $word['Word']['meaning']; ?></td>
	</tr>
</table>

<a href="/jp3cake/words/test?lesson=<?php echo $lesson; ?>&part=<?php echo $part; ?>" id="fc">返回</a>

<script language="javascript">
	window.onload=function(){
		document.getElementById("fc").focus();
	}
</script>