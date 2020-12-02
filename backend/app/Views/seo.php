<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" method="post" enctype="multipart/form-data" action="/seo/branch/<?=$branch_id?>/saveedit">
            <input name="seo_id" value="<?=$seo['seo_id']?>" type="hidden">
            <fieldset class="content-group">

                <legend class="text-bold">ตั้งค่า SEO title สำหรับหน้าแสดง<?=$lg['th']?></legend>

                <p class="content-group-lg">
                    ตัวอย่าง defalut {<?=$lg['en']?>_title} - {title_web} <code>{<?=$lg['en']?>_title} ชื่อเรื่อง</code> <code>{title_web} Site Title</code>
                </p>

                <div class="form-group">
                    <div class="col-lg-12">
                        <input required type="text" autocomplete="off" name="seo_title" class="form-control" placeholder="defalut {<?=$lg['en']?>_title} - {title_web}" value="<?=$seo['seo_title']?>">  
                    </div> 
                </div>
            
            </fieldset>

            <fieldset class="content-group">

                <legend class="text-bold">ตั้งค่า SEO Description สำหรับหน้าแสดง<?=$lg['th']?></legend>

                <p class="content-group-lg">
                    ตัวอย่าง defalut {<?=$lg['en']?>_description} <code>{<?=$lg['en']?>_description} เรื่องย่อของ<?=$lg['th']?></code>
                </p>

                <div class="form-group">
                    <div class="col-lg-12">
                        <input required type="text" autocomplete="off" name="seo_description" class="form-control" placeholder="defalut {<?=$lg['en']?>_description}" value="<?=$seo['seo_description']?>">  
                    </div> 
                </div>
            
            </fieldset>

            <fieldset class="content-group">

                <legend class="text-bold">ตั้งค่า Sitemap</legend>

                <div class="form-group">
                    <div class="col-lg-12">
                        <input type="text" autocomplete="off" name="seo_sitemap" class="form-control" placeholder="sitemap"  value="<?=$seo['seo_sitemap']?>">  
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
