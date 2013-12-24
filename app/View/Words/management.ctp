<h2>第<?php echo $lesson;?>课,第<?php echo $part;?>部分</h2>
<table>
	<tr>
		<th>假名</th>
		<th>汉字</th>
		<th>释义</th>
		<th>熟练度</th>
		<th>操作</th>
	</tr>
	<?php
	foreach($words as $word){
	?>
	<tr>
		<td><?php echo $word['Word']['kana'];?></td>
		<td><?php echo $word['Word']['kanji'];?></td>
		<td><?php echo $word['Word']['meaning'];?></td>
		<td>
			<?php
			$times=$word['Word']['times'];
			if($times==0){
				echo '---';
			}else if($times==1){
				echo '+--';
			}else if($times==2){
				echo '++-';
			}else{
				echo '+++';
			}
			?>
		</td>
		<td>a</td>
	</tr>
	<?php
	}
	?>
</table>
<a href="/jp3cake/words/insert?lesson=<?php echo $lesson; ?>&part=<?php echo $part; ?>" id="fc">新增</a>
<a href="/jp3cake/words?lesson=<?php echo $lesson; ?>&part=<?php echo $part; ?>">返回</a>

<script language="javascript">
	window.onload=function(){
		document.getElementById("fc").focus();
	}
</script>