<div class="new_title">
    <div class="form-inline">
        <label class="control-label">BÁO CÁO NGÀY </label>
        <div class="input-group date" id="datePicker">
            <input id="dateFocus" name="date-Focus" type="text" class="form-control" 
                   value="<?php echo set_value('date-Focus'); ?>"/>
            <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
            <div id="main-ajax-loader" style="display: none"><img src="<?php echo base_url(); ?>template/icon/loading.gif" style="width: 50px; display: block"/></div>
        </div>
    </div>
    <script type="text/javascript">
        $('#datePicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: '<?php echo time(); ?>'
        });
        
        $('#datePicker').change(function (){
            resultLoad();
            $.ajax({
                url: "<?php echo site_url().'seller/Report/viewDate'; ?>",
                type: "post",
                data:{
                    dateFocus: $('#dateFocus').val()
                },
                datatype: "jsonp",
                success: function (result){
                    response = JSON.parse(result);
                    rp_date = response.rpdate;
                    $('#viewDate-content').html(rp_date);
                    resultShow();
                }
            });
            function resultLoad() {
                $('#main-ajax-loader').show();
                $('#viewDate-content').css({
                    'opacity': '0.3',
                    'filter': 'alpha(opacity=30)',
                });
            }
            function resultShow() {
                $('#main-ajax-loader').hide();
                $('#viewDate-content').css({
                    'opacity': '1',
                    'filter': 'alpha(opacity=100)',
                });
            }
        });
    </script>
</div>
<div id="viewDate-content" style="margin-top: 10px">
    
</div>