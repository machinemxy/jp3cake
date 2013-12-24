<h2>日语背词神器(CAKEPHP版v0.2）</h2>
<h3>请选择</h3>
<form name="fm" id="fm" method="get">
<div>
	第
	<select name="lesson">
		<?php
		for($i=1;$i<=$lessonCount;$i++){
		   if($i==$lesson){
				echo '<option value="'.$i.'" selected>'.$i.'</option>';
		   }else{
				echo '<option value="'.$i.'">'.$i.'</option>';
		   }
		}
		?>
	</select>
	课，第
	<select name="part">
		<?php
		for($i=1;$i<=$partCount;$i++){
		   if($i==$part){
				echo '<option value="'.$i.'" selected>'.$i.'</option>';
		   }else{
				echo '<option value="'.$i.'">'.$i.'</option>';
		   }
		}
		?>
	</select>
	部分
</div>
<input value="开始背诵" type="submit"/>
<input value="词库管理" type="submit" onclick="sub(2)"/>
<br/>
<input value="检视错词" type="submit" onclick="sub(3)"/>
<input value="检视进度" type="submit" onclick="sub(4)"/>
</form>

<script type="text/javascript">
	function sub(value){
		if (value==1)
		{
			
		}else if (value==2)
		{
			document.getElementById('fm').action="/jp3cake/words/management";
		}else if (value==3)
		{

		}else if (value==4)
		{

		}
		document.getElementById('fm').submit;
	}
</script>