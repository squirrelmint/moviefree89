<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" method="post" action="/movie/branch/<?php echo $branch;?>/category/saveadd">
            <fieldset class="content-group">
                <legend class="text-bold">Category Movie info</legend>
                <div class="form-group">
                    <label class="control-label col-lg-3">Category Name <span class="text-danger">*</span></label>
                    <div class="col-lg-9 cate-input">
                        <div class="input-group">
                            <span class="input-group-addon cate-no">1.</span>
                            <input type="text" name="macategory_name[]" autocomplete="off" class="form-control" required="required" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12 text-right">
                        <button id="AddCate" type="button" onclick="goAdd();" class="btn btn-success"><i class="icon-plus3"></i> Add</button>
                        <button id="DelCate" type="button" onclick="goRemove();" class="btn btn-danger"><i class="icon-minus3"></i> Remove</button>
                    </div>
                </div>
            </fieldset>

            <div class="text-right">
                <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </form>
    </div>

</div>

<script>
        
    $( document ).ready(function() {
        var form = $('form');
        var input = $('.input-group', form);
        if(Number(input.length) > 1){
            $("#DelCate").show();
        }else{
            $("#DelCate").hide();
        }
    });   

    function goAdd(){
        var form = $('form');
        var input = $('.input-group', form);

        var no = Number(input.length)+1;
        var cate = $('.input-group:first', form).clone().appendTo( ".cate-input" );
        $('.cate-no', cate).html(no+'.');
        $('input', cate).val('');

        if(no > 1){
            $("#DelCate").show();
        }
    }

    function goRemove(){
        var form = $('form');
        var input = $('.input-group', form);
    
        $('.input-group:last', form).remove();
        
        if(Number(input.length)==2){
            $("#DelCate").hide();
        }else{
            $("#DelCate").show();
        }
    }

</script>