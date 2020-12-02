<script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>

<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" action="/content/branch/<?= $branch ?>/content/update/id/<?= $id ?>" method="POST" enctype="multipart/form-data">

            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-3">Title Content <span class="text-danger">*</span></label>
                    <div class="input-group col-lg-8">
                        <div class="form-group">
                            <input type="text" value="<?= $data['content_head'] ?>" name="txthead" autocomplete="off" class="form-control" required="required" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3">ภาพย่อ<span class="text-danger">*</span></label>
                    <div class="input-group col-lg-9">
                        <img id="TMPimg" src="<?= base_url($filepath . $data['content_thumbnail']); ?>" height="130px;">
                        <input type="hidden" value="<?= $data['content_thumbnail'] ?>" name="oldfile">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3">Img Content<span class="text-danger">*</span></label>
                    <div class="input-group col-lg-9">
                        <!-- <span class="input-group-addon cate-no">1.</span> -->
                        <input onchange="FileChangeSRC(this)" type="file" name="thumbnail" class="file-styled" accept="image/x-png,image/gif,image/jpeg">
                        <span class="help-block"><code>ขนาดไฟล์ไม่เกิน 100 MB</code></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-3">Detail Content<span class="text-danger">*</span></label>
                    <div class="input-group col-lg-9">
                        <textarea rows="5" id="editor" name="ckeditor"><?= html_entity_decode(htmlspecialchars_decode($data['content_body'])) ?></textarea>
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
    CKEDITOR.replace('ckeditor');

    function FileChangeSRC(t) {
        document.getElementById('TMPimg').src = window.URL.createObjectURL(t.files[0]);
    }

    document.addEventListener('DOMContentLoaded', function() {

        <?php helper(['alert']);
        getAlert(); ?>


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
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                    if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo(element.parent().parent().parent().parent());
                    } else {
                        error.appendTo(element.parent().parent().parent().parent().parent());
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo(element.parent().parent().parent());
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent());
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                } else {
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