<script src="<?= base_url('/global_assets/js/plugins/pickers/pickadate/picker.js')?>"></script>
<script src="<?= base_url('/global_assets/js/plugins/pickers/pickadate/picker.date.js')?>"></script>


<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

    <form class="form-horizontal form-validate-jquery" method="POST" enctype="multipart/form-data" action="<?= base_url('/vdoads/branch/'.$branch.'/saveadd') ?>">
            <fieldset class="content-group">
                <legend class="text-bold">Video Ads info</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">Video Ads Name <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="adsvideo_name" id="adsvideo_name" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Video <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="file" name="adsvideo_video" id="adsvideo_video" autocomplete="off" class="file-styled" required="required" accept=".mp4,.mov,.3gp,.ogg">
                        <span class="help-block"><code>ขนาดไฟล์ไม่เกิน 100 MB</code></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">URL  <span class="text-danger">*</span></label>
                    <div class="col-lg-3 ">
                        <input type="text" name="adsvideo_url" id="adsvideo_url" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Skip Time<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="adsvideo_skip" id="adsvideo_skip" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Status <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select name="adsvideo_status" id="adsvideo_status" class="select">
                            <option value="1">Active</option>
                            <option value="0" selected>Inactive</option>
                        </select>
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

        $('.select').select2({
            minimumResultsForSearch: Infinity
        });
        $('.pickadate').pickadate({
            formatSubmit: 'yyyy-mm-dd',
        });

        <?php helper(['alert']);getAlert(); ?>

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
                adsvideo_url: {
                    url: true
                },
                adsvideo_skip:{
                    number:true
                },
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

    function showImg(){
        $('#Url').parent().show();
        $('#Url').hide();
        $('#Img').show();

        $('#Img input').attr('required','required');
    }

    function showURL(){
        $('#Url').parent().show();
        $('#Url').show();
        $('#Img').hide();

        $('#Url input').attr('required','required');
    }

</script>