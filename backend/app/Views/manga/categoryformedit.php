<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">


        <form class="form-horizontal form-validate-jquery" method="post" action="/manga/branch/<?php echo $branch;?>/category/editsave/id/<?php echo $id;?>">
            <fieldset class="content-group">
                <legend class="text-bold">หมวดหมู่ มังงะ</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">ชื่อหมวดหมู่ <span class="text-danger">*</span></label>
                    <div class="col-lg-9 cate-input">
                        <input type="text" name="macategory_name" autocomplete="off" value='<?=$data['macategory_name']?>' class="form-control" required="required" placeholder="">
                        <input type="hidden" name="macategory_id" value='<?=$data['macategory_id']?>'>
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
