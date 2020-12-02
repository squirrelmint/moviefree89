
<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" method="post" action="/movie/category/branch/<?php echo $branch;?>/update/id/<?php echo $data['category_id'];?>">
            <fieldset class="content-group">
                <legend class="text-bold">Category Movie info</legend>
                <div class="form-group">
                    <label class="control-label col-lg-3">Category Name <span class="text-danger">*</span></label>
                    <!-- <input type="hidden" vaue="<?php echo $data['category_id'];?>" name="category_id"> -->
                    <div class="col-lg-9 cate-input">
                        <div class="input-group">
                            <span class="input-group-addon cate-no"></span>
                            <input type="text" value="<?php echo $data['category_name'];?>"  required="required" name="macategory_name" autocomplete="off" class="form-control" required="required" placeholder="">
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="text-right">
                <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                <button type="submit" class="btn btn-primary">Save <i class="glyphicon glyphicon-ok position-right"></i></button>
            </div>
        </form>
    </div>

</div>

<script>

    // function goAdd(){
    //     var form = $('form');
    //     var input = $('.input-group', form);

    //     var no = Number(input.length)+1;

    //     var cate = $('.input-group:first', form).clone().appendTo( ".cate-input" );
    //     $('.cate-no', cate).html(no+'.');
    //     $('input', cate).val('');
    // }

    // function goRemove(){
    //     var form = $('form');
    //     $('.input-group:last', form).remove();
    // }

</script>
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
            location.reload();
        });

    });

</script>