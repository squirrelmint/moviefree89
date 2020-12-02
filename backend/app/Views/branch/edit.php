<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form id="formeditbranch" class="form-horizontal form-validate-jquery" method="post" action="<?= base_url('/branch/saveedit') ?>/<?= $id ?>" enctype="multipart/form-data">
            <fieldset class="content-group">
                <legend class="text-bold">Branch info</legend>
                <div class="form-group">
                    <label class="control-label col-lg-3">Branch name <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="branch_name" id="branch_name" autocomplete="off" class="form-control" required="required" placeholder="" value="<?= $data['branch_name'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Type <span class="text-danger">*</span></label>
                    <div class="col-lg-3">
                        <select id="branch_system" name="branch_system" class="form-control">
                            <option value="movie">Movie</option>
                            <option value="manga">Manga</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3">Logo <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <?php if (empty($data['branch_logo'])) { ?>
                            <input type="file" name="logo" accept=".png, .jpg, .gif" required="required" class="file-styled">
                        <?php }else{  ?>
                            <input type="file" name="logo" accept=".png, .jpg, .gif" class="file-styled">
                        <?php }  ?>
                    </div>
                    <input type="hidden" name="oldlogo" value="<?= $data['branch_logo'] ?>">
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

        var branch_system = "<?= $data['branch_system'] ?>";
        $("#branch_system").val(branch_system);

        var branch_logo = "<?= $data['branch_logo'] ?>";
        $(".filename").text(branch_logo);

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
                password: {
                    minlength: 5
                },
                repeat_password: {
                    equalTo: "#password"
                },
                email: {
                    email: true
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