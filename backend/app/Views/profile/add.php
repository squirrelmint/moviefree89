<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" action="<?= base_url('/profile/saveadd') ?>" method="POST">
            <fieldset class="content-group">
                <legend class="text-bold">User info</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">Username <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="username" id="username" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Password <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="password" name="password" id="password" autocomplete="off" class="form-control" required="required" placeholder="Minimum 5 characters allowed">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Confirm Password <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="password" id="repeat_password" name="repeat_password" autocomplete="off" class="form-control" required="required" placeholder="Try different password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Name <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="name" id="name" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Tel <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="tel" name="tel" id="tel" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Email</label>
                    <div class="col-lg-9">
                        <input type="text" name="email" id="email" autocomplete="off" class="form-control" placeholder="">
                    </div>
                </div>

            </fieldset>

            <fieldset>

                <legend class="text-bold">My Branch</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">System <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <select name="system[]" id="system" class="multiselect" multiple="multiple">
                                <?php 

                                    $getbranch = "";

                                    foreach ($branch as $key => $value) {
                                        
                                        if ($getbranch=="") {
                                            
                                            $getbranch = $value['branch_system'];
                                            echo '<optgroup label="'.$getbranch.'">';
                                                echo '<option value="'.$value['branch_id'].'">'.$value['branch_name'].'</option>';
                                            
                                        }else if ( $getbranch!=$value['branch_system']) {
                                            
                                            $getbranch = $value['branch_system'];
                                            echo '<optgroup label="'.$getbranch.'">';
                                                echo '<option value="'.$value['branch_id'].'">'.$value['branch_name'].'</option>';
                                            
                                        }else {

                                                echo '<option value="'.$value['branch_id'].'">'.$value['branch_name'].'</option>';
                                            echo '</optgroup>';

                                        }
                                        
                                    }

                                ?>
                            </select>
                        </div>
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
        

        $("#username").focus();

        $('.multiselect').multiselect();

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