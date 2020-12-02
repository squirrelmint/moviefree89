<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" method="post" enctype="multipart/form-data" action="/setting/branch/<?=$branch_id?>/saveedit">
            <input name="setting_id" value="<?=$setting['setting_id']?>" type="hidden">
            <fieldset class="content-group">
                <legend class="text-bold">ตั้งค่าเว็บ</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">Title</label>
                    <div class="col-lg-9">
                        <input type="text" required="required" autocomplete="off" name="setting_title" class="form-control" placeholder="Title" value="<?=$setting['setting_title']?>">  
                    </div> 
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Description คำอธิบายเว็บ</label>
                    <div class="col-lg-9">
                        <input type="text" autocomplete="off" name="setting_description" class="form-control" placeholder="Description" value="<?=$setting['setting_description']?>">  
                    </div> 
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Keyword</label>
                    <div class="col-lg-9">
                        <input type="text" required="required" autocomplete="off" name="setting_keyword" class="form-control" placeholder="Keyword" value="<?=$setting['setting_keyword']?>">  
                    </div> 
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Logo Image </label>
                    <div class="col-lg-9">
                        <input type="file" accept=".png, .jpg" name="setting_logo" id="setting_logo" class="file-styled" <?php if($setting['setting_logo']==""){echo "required";} ?> >  
                        <input type="hidden" name="oldlogo" id="oldlogo" value="<?=$setting['setting_logo']?>">  
                        <span class="help-block"><code>ขนาดไฟล์ไม่เกิน 100 MB</code></span>
                    </div> 
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Icon Image </label>
                    <div class="col-lg-9">
                        <input type="file" accept=".png, .jpg .ico .icon" name="setting_icon" id="setting_icon" class="file-styled" <?php if($setting['setting_icon']==""){echo "required";} ?>>  
                        <input type="hidden" name="oldicon" id="oldicon" value="<?=$setting['setting_icon']?>">  
                        <span class="help-block"><code>ขนาดไฟล์ไม่เกิน 100 MB</code></span>
                    </div> 
                </div>

            </fieldset>

            <fieldset class="content-group">
                <legend class="text-bold">ตั้งค่า Social</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">Facebook</label>
                    <div class="col-lg-9">
                        <input type="text" autocomplete="off" name="setting_facebook" class="form-control" placeholder="" value="<?=$setting['setting_fb']?>">  
                    </div> 
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Line</label>
                    <div class="col-lg-9">
                        <input type="text" autocomplete="off" name="setting_line" class="form-control" placeholder="" value="<?=$setting['setting_line']?>">  
                    </div> 
                </div>

            </fieldset>

            <fieldset class="content-group">
                <legend class="text-bold">ตั้งค่า Analytics</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">Header</label>
                    <div class="col-lg-9">
                        <textarea row="6" name="setting_header" class="form-control" ><?=$setting['setting_header']?></textarea>
                    </div> 
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Footer</label>
                    <div class="col-lg-9">
                    <textarea row="6" name="setting_footer" class="form-control" ><?=$setting['setting_footer']?></textarea>
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



    document.addEventListener('DOMContentLoaded', function() {

        <?php helper(['alert']);getAlert(); ?>

        $('.select').select2({
            minimumResultsForSearch: Infinity
        });

        var logo = $('#oldlogo').val();
        $("#uniform-setting_logo .filename").text(logo);

        var icon = $('#oldicon').val();
        $("#uniform-setting_icon .filename").text(icon);

        // Initialize
        var validator = $(".form-validate-jquery").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent().parent().parent() );
                    }
                    else {
                        error.appendTo( element.parent().parent().parent().parent().parent() );
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo( element.parent().parent().parent() );
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent() );
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                else {
                    error.insertAfter(element);
                }
            },
            validClass: "validation-valid-label",
            success: function(label) {
                label.addClass("validation-valid-label").text("Success.")
            },
            rules: {
                ads_url: {
                    url: true
                }
            },
            messages: {
                custom: {
                    required: 'This is a custom error message'
                },
                basic_checkbox: {
                    minlength: 'Please select at least {0} checkboxes'
                },
                styled_checkbox: {
                    minlength: 'Please select at least {0} checkboxes'
                },
                switchery_group: {
                    minlength: 'Please select at least {0} switches'
                },
                switch_group: {
                    minlength: 'Please select at least {0} switches'
                },
                agree: 'Please accept our policy'
            }
        });

        // Reset form
        $('#reset').on('click', function() {
            validator.resetForm();
        });

    });

</script>
