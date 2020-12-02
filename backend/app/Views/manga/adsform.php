<script src="<?= base_url('/global_assets/js/demo_pages/form_select2.js'); ?>"></script>

<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" method="post" enctype="multipart/form-data" action="/mangaads/branch/<?=$branch_id?>/saveadd">
            <fieldset class="content-group">
                <legend class="text-bold">โฆษณา</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">รูปภาพโฆษณา <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="file" name="ads_picture" class="file-styled" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">ชื่อโฆษณา <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" autocomplete="off" name="ads_name" class="form-control" placeholder="Name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">ลิ้งค์โฆษณา <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" autocomplete="off" name="ads_url" class="form-control" placeholder="ex. https://www.google.com/" value="" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">ตำแหน่งโฆษณา<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select id="ads_position" name="ads_position" class="select" data-placeholder="Select Position" required>
                            <option value=""></option>
                            <?php 
                                if (!empty($posads['pos'])) {
                                    foreach ($posads['pos'] as $ps) {
                                        echo '<option value="' . $ps['value'] . '">' . $ps['name'] . '</option>';
                                    }
                                }                            
                            ?>

                            <!-- <option value="1">ด้านบนซ้ายทุกหน้า - ขนาดแนะนำ 300 * 300</option>
                            <option value="2">ด้านบนกลางทุกหน้า - ขนาดแนะนำ 600 * 140</option>
                            <option value="3">ด้านบนขวาทุกหน้า - ขนาดแนะนำ 300 * 300</option>
                            <option value="4">ด้านบนล่างทุกหน้า - ขนาดแนะนำ 728 * 94</option> -->
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-3"> </div>
                    <div class="col-lg-9">
                        <img id="img_ads_position" src="" width="100%">
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
    document.addEventListener('DOMContentLoaded', function() {

        <?php helper(['alert']);
        getAlert(); ?>

        $('.select').select2({
            minimumResultsForSearch: Infinity
        });

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

        $('#ads_position').on('change', function() {
            var ads_position = $("#ads_position").val();
            // alert(ads_position);
            <?php 
                if (!empty($posads['img'])) { 
                    $i = 1;

                    foreach ($posads['img'] as $img) {
            ?>

            if (ads_position == '<?php echo $i ?>') {                
                var img = '<?php echo base_url($img) ?>';            
            }

            <?php 
                        $i++;
                    } 
                }
            ?>

            $('#img_ads_position').attr('src', img)
        });

    });

    
</script>