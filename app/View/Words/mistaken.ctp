<h3>错词一览</h3>
<a href="/jp3cake/words" id="fc">返回</a>
<br/>
<table>
	<tr>
		<th>课号</th>
		<th>部分</th>
		<th>假名</th>
		<th>汉字</th>
		<th>释义</th>
		<th>操作</th>
	</tr>
	<?php
	foreach($words as $word){
	?>
	<tr>
		<td><?php echo $word['Word']['lesson'];?></td>
		<td><?php echo $word['Word']['part'];?></td>
		<td><?php echo $word['Word']['kana'];?></td>
		<td><?php echo $word['Word']['kanji'];?></td>
		<td><?php echo $word['Word']['meaning'];?></td>
		<td><a href="/jp3cake/words/remember?Id=<?php echo $word['Word']['Id']; ?>">记住了</a></td>
	</tr>
	<?php
	}
	?>
</table>
<a href="/jp3cake/words">返回</a>

<script language="javascript">
	window.onload=function(){
		document.getElementById("fc").focus();
	}
</script>