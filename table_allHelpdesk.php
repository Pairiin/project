<div class="col-md-12">
  <div class="card">
    <h3 class="card-title">รายการแจ้งซ่อมทั้งหมด</h3>
    <p style="text-align:center;color:red">**สถานะการซ่อม :
      <i class="fa fa-inbox" aria-hidden="true"></i> (รอการรับงาน) ->
      รอประเมินอาการ ->
      รอการยืนยัน ->
      กำลังดำเนินการซ่อม ->
      สำเร็จ**</p></li>


    <div class="table-responsive">
      <table class="table" id="AllHelpDest">
        <thead>
          <tr>
            <th style="text-align:center; width:10%;"  id="widthTh1">#</th>
            <th style="text-align:center; width:15%;">ชื่อผู้แจ้ง</th>
            <th style="text-align:center;">ปัญหา</th>
            <th style="text-align:center; width:15%;">วันที่แจ้งซ่อม</th>
            <th style="text-align:center; width:15%;">สถานะ</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $i=1;

          $sqlAll = "SELECT *
                    FROM repair r
                    LEFT JOIN detail_repair dt ON r.id_repair=dt.id_repair
                    LEFT JOIN status s ON dt.id_status=s.id_status
                    WHERE dt.id_status != 4 AND dt.id_status != 5 AND dt.id_status != 6 AND dt.id_status != 8";

            $objQueryAll = mysql_query($sqlAll);
            while($objResultAll = mysql_fetch_array($objQueryAll)){

           ?>
             <tr>
               <td align="center"><?=$i;?></td>
               <td style="text-align:left	;"><?=$objResultAll["user_display"];?></td>
               <td style="text-align:left;"><?=$objResultAll["problem"];?></td>
               <td style="text-align:center;"><?=dateToBE($objResultAll[date_s]); ?></td>
               <td style="text-align:center;"><?=$objResultAll["status_name"];?></td>
             </tr>
           <?$i++; } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
