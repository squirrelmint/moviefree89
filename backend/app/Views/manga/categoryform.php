<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

    <form class="form-horizontal form-validate-jquery" method="post" action="/manga/branch/<?php echo $branch;?>/category/saveadd">
            <fieldset class="content-group">
                <legend class="text-bold">หมวดหมู่ มังงะ</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">ชื่อหมวดหมู่ <span class="text-danger">*</span></label>
                    <div class="col-lg-9 cate-input">
                        <div class="input-group">
                            <span class="input-group-addon cate-no">1.</span>
                            <input type="text" name="macategory_name[]" autocomplete="off" class="form-control" required="required" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12 text-right">
                        <button type="button" onclick="goAdd();" id="addcate" class="btn btn-success"><i class="icon-plus3"></i> เพิ่มแถว</button>
                        <button type="button" onclick="goRemove();" id="removecate" class="btn btn-danger" style="display:none;" ><i class="icon-minus3"></i> ลบแถว</button>
                    </div>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="reset" class="btn btn-default" id="reset">เคลียร์ <i class="icon-reload-alt position-right"></i></button>
                <button type="submit" class="btn btn-primary">บันทึก <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </form>
    </div>

</div>

<script>

    function goAdd(){
        var form = $('form');
        var input = $('.input-group', form);
        var no = Number(input.length)+1;

        var cate = $('.input-group:first', form).clone().appendTo( ".cate-input" );
        $('.cate-no', cate).html(no+'.');
        $('input', cate).val('');

        if(no>1){
            $('#removecate').fadeIn();
        }
    }

    function goRemove(){
        var form = $('form');
        $('.input-group:last', form).remove();

        var len = $('.input-group', form).length;
        if(len<=1){
            $('#removecate').fadeOut();
        }
    }

</script>