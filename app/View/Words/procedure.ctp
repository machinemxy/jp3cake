<h3>进度一览</h3>
<a href="/jp3cake/words" id="fc">返回</a>
<br/>
<table>
	<tr>
		<th>课号</th>
		<th>部分</th>
		<th>状态</th>
		<th>完成时间</th>
	</tr>
	<?php
	$lastLesson=0;
	foreach($procedures as $procedure){
	?>
	<tr>
		<td>
			<?php
			if($lastLesson==0||$procedure['words']['lesson']!=$lastLesson){
				echo $procedure['words']['lesson'];
				$lastLesson=$procedure['words']['lesson'];
			}
			?>
		</td>
		<td><?php echo $procedure['words']['part'];?></td>
		<?php
		if($procedure['0']['mintimes']==3){
			echo "<td style='color:green;'>已完成</td>";
		}else{
			if($procedure['0']['maxtimes']==0){
				echo "<td style='color:red;'>未开始</td>";
			}else{
				echo "<td>背诵中</td>";
			}
		}
		?>
		<td><?php echo $procedure['0']['maxdate']; ?></td>
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