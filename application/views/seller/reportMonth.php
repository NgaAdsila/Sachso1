<div class="new_title">
    <div class="form-inline">
        <label class="control-label">BÁO CÁO THÁNG </label>
        <?php 
            $now = getdate();
            $cmonth = $now['mon'];
            $cyear = $now['year'];
        ?>
        <select name="month" id="month" class="form-control">
            <?php for ($i=1;$i<=12;$i++): ?>
            <option value="<?php echo $i ?>" <?php if ($i == $cmonth){echo 'selected = selected';} ?>><?php echo $i ?></option>
            <?php endfor;?>
        </select>
        <label class="control-label"> NĂM </label>
        <select name="year" id="year" class="form-control">
            <?php for ($i=2016;$i<2031;$i++): ?>
            <option value="<?php echo $i ?>" <?php if ($i == $cyear){echo 'selected = selected';} ?>><?php echo $i ?></option>
            <?php endfor;?>
        </select>
        <button id="monthPicker" class="btn btn-default"><span class="fa fa-chevron-down"></span></button>
    </div>
    <script type="text/javascript">
        $('#monthPicker').click(function (){
            $.ajax({
                url: "<?php echo site_url().'seller/Report/viewMonth'; ?>",
                type: "post",
                data:{
                    monthFocus: $('#month').val(),
                    yearFocus: $('#year').val()
                },
                datatype: "jsonp",
                success: function (result){
                    response = JSON.parse(result);
                    rp_month = response.rpMonth;
                    $('#viewMonth-content').html(rp_month);
                }
            });
        });
    </script>
</div>
<div id="viewMonth-content" style="margin-top: 10px">
    
</div>