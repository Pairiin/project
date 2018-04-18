<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Help Desk KMUTNB</title>
	  <?php include"inc_css.php";?>
</head>

<style>
	th {
		background-color: #d9edf7;
	}
</style>

<body style="background-color:#E0EEEE">
	<?php
	include"connect.php";
	include"header.php";
	include"function.php";
	?>

    <div class="container" style="padding-top:10px;">

       <div class="row">
				 <div class="col-md-12">
					   <div class="card">
					     <h3 class="card-title">ปัญหาที่เกิดขึ้นบ่อยและแนวทางการแก้ปัญหา (FAQ : Frequency Asked Questions)</h3>

							 <li style="font-size: 18px;">ปัญหาที่เกิดขึ้นบ่อย 5 อันดับแรก</li><br>
					     <?php
							 $i=1;
							 $strSQL = "SELECT dr.id_problem,p.problem_name,p.solution_problem,COUNT(*) as count_problem
													FROM detail_repair dr
													INNER JOIN problem p ON dr.id_problem=p.id_problem
													GROUP BY dr.id_problem
													ORDER BY count_problem DESC LIMIT 0,5";

							 $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
							 echo '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
							 while ($objResult = mysql_fetch_array($objQuery)) {
									?>

									  <div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="heading<?=$i?>">
									      <h4 class="panel-title">
									        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i?>" aria-expanded="false" aria-controls="collapse<?=$i?>">
									          <?=$i.".) ".$objResult['problem_name']?>
									        </a>
									      </h4>
									    </div>
									    <div id="collapse<?=$i?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$i?>">
									      <div class="panel-body">
													<?=$objResult['solution_problem']?>
									      </div>
									    </div>
									  </div>

								<?
									$i++;
								}
								echo '</div>';
							 ?>


							 <li style="font-size: 18px;">ปัญหาที่เกิดขึ้นบ่อย 3 อันดับแรก ของประเภทปัญหา ด้านซอฟต์แวร์</li><br>
               <?php
							 $i=1;
							 $strSQL_sw = "SELECT p.problem_name,pt.problem_type_name,p.solution_problem,COUNT(*) as count_problem_type
													FROM detail_repair dr
													INNER JOIN problem p ON dr.id_problem=p.id_problem
													INNER JOIN problem_type pt ON p.id_problem_type=pt.id_problem_type
													WHERE pt.id_problem_type = 2
													GROUP BY p.id_problem_type,p.id_problem
													ORDER BY count_problem_type DESC LIMIT 0,3";

							 $objQuery_sw = mysql_query($strSQL_sw) or die ("Error Query [".$strSQL_sw."]");
							 echo '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
							 while ($objResult_sw = mysql_fetch_array($objQuery_sw)) {
									?>

									  <div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="heading_sw<?=$i?>">
									      <h4 class="panel-title">
									        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_sw<?=$i?>" aria-expanded="false" aria-controls="collapse_sw<?=$i?>">
									          <?=$i.".) ".$objResult_sw['problem_name']?>
									        </a>
									      </h4>
									    </div>
									    <div id="collapse_sw<?=$i?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_sw<?=$i?>">
									      <div class="panel-body">
													<?=$objResult_sw['solution_problem']?>
									      </div>
									    </div>
									  </div>

								<?
									$i++;
								}
								echo '</div>';
							 ?>


							 <li style="font-size: 18px;">ปัญหาที่เกิดขึ้นบ่อย 3 อันดับแรก ของประเภทปัญหา ด้านฮาร์ดแวร์</li><br>
					     <?php
							 $i=1;
							 $strSQL_hw = "SELECT p.problem_name,pt.problem_type_name,p.solution_problem,COUNT(*) as count_problem_type
													FROM detail_repair dr
													LEFT JOIN problem p ON dr.id_problem=p.id_problem
													LEFT JOIN problem_type pt ON p.id_problem_type=pt.id_problem_type
													WHERE pt.id_problem_type = 1
													GROUP BY p.id_problem_type,p.id_problem
													ORDER BY count_problem_type DESC LIMIT 0,3";

							 $objQuery_hw = mysql_query($strSQL_hw) or die ("Error Query [".$strSQL_hw."]");
							 echo '<div class="panel-group" id="accordion_hw" role="tablist" aria-multiselectable="true">';
							 while ($objResult_hw = mysql_fetch_array($objQuery_hw)) {
									?>

									  <div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="heading_hw<?=$i?>">
									      <h4 class="panel-title">
									        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_hw" href="#collapse_hw<?=$i?>" aria-expanded="false" aria-controls="collapse_hw<?=$i?>">
									          <?=$i.".) ".$objResult_hw['problem_name']?>
									        </a>
									      </h4>
									    </div>
									    <div id="collapse_hw<?=$i?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_hw<?=$i?>">
									      <div class="panel-body">
													<?=$objResult_hw['solution_problem']?>
									      </div>
									    </div>
									  </div>

								<?
									$i++;
								}
								echo '</div>';
							 ?>
					   </div>
					 </div>

				 </div>
       </div>
			</div>

			<?php include"inc_js.php";?>
</body>
</html>
