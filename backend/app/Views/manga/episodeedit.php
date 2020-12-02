<style>
    .img-close {
        position: absolute;
        top: 10px;
        left: 155px;
        z-index: 99;
    }
</style>

<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" method="post" enctype="multipart/form-data"  action="/manga/<?=$manga_id?>/episode/edit/id/<?=$epdata['maepisode_id']?>/saveedit" onsubmit="return checkSubmit()">

            <input type="hidden" name="masubject_name_eng" value="<?=$manga['masubject_name_eng']?>">
            <input type="hidden" name="masubject_datetime" value="<?=$epdata['maepisode_public_datetime']?>">
            <fieldset class="content-group">
                <legend class="text-bold">แก้ไขตอนมังงะ</legend>

                <div class="form-group">
                    <label class="control-label col-lg-3">ชื่อตอนมังงะ <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="maepisode_name_eng" id="maepisode_name_eng" autocomplete="off" class="form-control" required="required" value="<?=$epdata['maepisode_name_eng']?>" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">สถานะ <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select name="maepisode_status" id="maepisode_status" class="select">
                            <option value="1" <?php if($epdata['maepisode_status']==true){echo 'selected'; } ?> >แสดง</option>
                            <option value="0" <?php if($epdata['maepisode_status']!=true){echo 'selected'; } ?> >ไม่แสดง</option>
                        </select>
                    </div>
                </div>

            </fieldset>

            <fieldset class="content-group ep-img">
                <legend class="text-bold">รูปภาพภายในตอนมังงะ</legend>

                <?php
                if( !empty($imgdata) ){
                    $i=1;
                    foreach($imgdata as $img){
                ?>

                <div class="form-group show-img" >
                    <label class="control-label col-lg-3">ลิ้งค์ภาพ <?=$i?> <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <?php
                            $epimg = base_url("assets/img/empty.png");
                            if( !empty($img['maepisodeimage_path']) && filter_var(str_replace('-','',str_replace(' ', '', $img['maepisodeimage_path'])), FILTER_VALIDATE_URL)  ){
                                $epimg = $img['maepisodeimage_path'];
                            }else{
                                $epimg = base_url($path_manga.'/'.$img['maepisodeimage_path']);
                            }
                        ?>
                        <img src="<?=$epimg?>" alt=""  width="200">
                        <button onclick="goRemoveImg(<?=$i-1?>);" type="button" class="btn btn-danger img-close" data-popup="tooltip" data-original-title="Remove Image" ><i class="icon-cross"></i></button>
                    </div> 
                </div>

                <div class="img-group" style="display:none">
                    <div class="form-group">
                        <label class="control-label col-lg-3">ลิ้งค์ภาพ <?=$i?> <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline">
                                <input type="radio" name="radio<?=$i?>" class="styled" onclick="showImg(<?=$i-1?>);">
                                อัพโหลดภาพ
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="radio<?=$i?>" class="styled" onclick="showURL(<?=$i-1?>);">
                                อัพโหลด URL
                            </label>
                        </div>
                    </div>

                    <div class="form-group link-img" style="display:none;">
                        <div class="col-lg-9 col-lg-offset-3 img-url" style="display:none;">
                            <input type="text" name="maepisodeimage_path[]" autocomplete="off" class="form-control" placeholder="Ex. https://image.flaticon.com/teams/slug/google.jpg">
                        </div>
                        <div class="col-lg-9 col-lg-offset-3 img-upload" style="display:none;">
                            <input type="file" name="maepisodeimage_picture[]" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif">
                        </div>
                    </div>
                </div>

                <?php  
                        $i++;
                    }
                }else{
                ?>
                <div class="img-group">
                    <div class="form-group">
                        <label class="control-label col-lg-3">ลิ้งค์ภาพ 1 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline">
                                <input type="radio" name="radio1" class="styled" required="required" onclick="showImg(0);">
                                อัพโหลดภาพ
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="radio1" class="styled" onclick="showURL(0);">
                                อัพโหลด URL
                            </label>
                        </div>
                    </div>

                    <div class="form-group link-img" style="display:none;">
                        <div class="col-lg-9 col-lg-offset-3 img-url" style="display:none;">
                            <input type="text" name="maepisodeimage_path[]" autocomplete="off" class="form-control" placeholder="Ex. https://image.flaticon.com/teams/slug/google.jpg">
                        </div>
                        <div class="col-lg-9 col-lg-offset-3 img-upload" style="display:none;">
                            <input type="file" name="maepisodeimage_picture[]" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif">
                        </div>
                    </div>
                </div>

                <div class="img-group">
                    <div class="form-group">
                        <label class="control-label col-lg-3">ลิ้งค์ภาพ 2 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline">
                                <input type="radio" name="radio2" class="styled" required="required" onclick="showImg(1);">
                                อัพโหลดภาพ
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="radio2" class="styled" onclick="showURL(1);">
                                อัพโหลด URL
                            </label>
                        </div>
                    </div>

                    <div class="form-group link-img" style="display:none;">
                        <div class="col-lg-9 col-lg-offset-3 img-url" style="display:none;">
                            <input type="text" name="maepisodeimage_path[]" autocomplete="off" class="form-control" placeholder="Ex. https://image.flaticon.com/teams/slug/google.jpg">
                        </div>
                        <div class="col-lg-9 col-lg-offset-3 img-upload" style="display:none;">
                            <input type="file" name="maepisodeimage_picture[]" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif">
                        </div>
                    </div>
                </div>
                
                <div class="img-group">
                    <div class="form-group">
                        <label class="control-label col-lg-3">ลิ้งค์ภาพ 3 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline">
                                <input type="radio" name="radio3" class="styled" required="required" onclick="showImg(2);">
                                อัพโหลดภาพ
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="radio3" class="styled" onclick="showURL(2);">
                                อัพโหลด URL
                            </label>
                        </div>
                    </div>

                    <div class="form-group link-img" style="display:none;">
                        <div class="col-lg-9 col-lg-offset-3 img-url" style="display:none;">
                            <input type="text" name="maepisodeimage_path[]" autocomplete="off" class="form-control" placeholder="Ex. https://image.flaticon.com/teams/slug/google.jpg">
                        </div>
                        <div class="col-lg-9 col-lg-offset-3 img-upload" style="display:none;">
                            <input type="file" name="maepisodeimage_picture[]" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif">
                        </div>
                    </div>
                </div>

                <div class="img-group">
                    <div class="form-group">
                        <label class="control-label col-lg-3">ลิ้งค์ภาพ 4 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline">
                                <input type="radio" name="radio4" class="styled" required="required" onclick="showImg(3);">
                                อัพโหลดภาพ
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="radio4" class="styled" onclick="showURL(3);">
                                อัพโหลด URL
                            </label>
                        </div>
                    </div>

                    <div class="form-group link-img" style="display:none;">
                        <div class="col-lg-9 col-lg-offset-3 img-url" style="display:none;">
                            <input type="text" name="maepisodeimage_path[]" autocomplete="off" class="form-control" placeholder="Ex. https://image.flaticon.com/teams/slug/google.jpg">
                        </div>
                        <div class="col-lg-9 col-lg-offset-3 img-upload" style="display:none;">
                            <input type="file" name="maepisodeimage_picture[]" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif">
                        </div>
                    </div>
                </div>

                <div class="img-group">
                    <div class="form-group">
                        <label class="control-label col-lg-3">ลิ้งค์ภาพ 5 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="radio-inline">
                                <input type="radio" name="radio5" class="styled" required="required" onclick="showImg(4);">
                                อัพโหลดภาพ
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="radio5" class="styled" onclick="showURL(4);">
                                อัพโหลด URL
                            </label>
                        </div>
                    </div>

                    <div class="form-group link-img" style="display:none;">
                        <div class="col-lg-9 col-lg-offset-3 img-url" style="display:none;">
                            <input type="text" name="maepisodeimage_path[]" autocomplete="off" class="form-control" placeholder="Ex. https://image.flaticon.com/teams/slug/google.jpg">
                        </div>
                        <div class="col-lg-9 col-lg-offset-3 img-upload" style="display:none;">
                            <input type="file" name="maepisodeimage_picture[]" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif">
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>

                <input type="hidden" id="cfile" name="cfile">
                <input type="hidden" id="curl" name="curl">
                <input type="hidden" id="count" name="count">
                
            </fieldset>

            <div class="form-group">
                <div class="col-lg-12 text-right">
                    <button type="button" onclick="goAdd();" id="addcate" class="btn btn-success"><i class="icon-plus3"></i> เพิ่มลิ้งค์</button>
                    <button type="button" onclick="goRemove();" id="removelink" class="btn btn-danger" ><i class="icon-minus3"></i> ลบลิ้งค์</button>
                </div>
            </div>

            <div class="text-right">
                <button type="reset" class="btn btn-default" id="reset">เคลียร์ <i class="icon-reload-alt position-right"></i></button>
                <button type="submit" name="btnsubmit" class="btn btn-primary">บันทึก <i class="icon-arrow-right14 position-right"></i></button>
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

        $('.styled').uniform();

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
                maepisodeimage_path: {
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

    function goAdd(){
        var form = $('form');
        var input = $('.img-group', form);
        var no = Number(input.length)+1;

        var html = '';

        html += '<div class="img-group">';
            html += '<div class="form-group">';
                html += '<label class="control-label col-lg-3">Link Image '+no+' <span class="text-danger">*</span></label>';
                html += '<div class="col-lg-9">';
                    html += '<label class="radio-inline">';
                        html += '<input type="radio" name="radio'+no+'" class="styled" required="required" onclick="showImg('+input.length+');">';
                        html += 'Upload by Image';
                    html += '</label>';

                    html += '<label class="radio-inline">';
                        html += '<input type="radio" name="radio'+no+'" class="styled" onclick="showURL('+input.length+');">';
                        html += 'Upload by URL';
                    html += '</label>';
                html += '</div>';
            html += '</div>';

            html += '<div class="form-group link-img" style="display:none;">';
                html += '<div class="col-lg-9 col-lg-offset-3 img-url" style="display:none;">';
                    html += '<input type="text" name="maepisodeimage_path[]" autocomplete="off" class="form-control" placeholder="Ex. https://image.flaticon.com/teams/slug/google.jpg">';
                html += '</div>';
                html += '<div class="col-lg-9 col-lg-offset-3 img-upload" style="display:none;">';
                    html += '<input type="file" name="maepisodeimage_picture[]" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif">';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        $(html).appendTo( ".ep-img" );
        $('.styled').uniform();
        $('.file-styled').uniform();


        if(no>1){
            $('#removelink').fadeIn();
        }
    }

    function goRemove(){
        var form = $('form');
        $('.img-group:last', form).remove();

        var len = $('.img-group', form).length;
        if(len<=1){
            $('#removelink').fadeOut();
        }
    }

    function goRemoveImg( inx ){

        var up = $('.img-group').eq(inx);
        up.show();
        // $('input[name=masubject_picture', img).attr('required','required');

        var img = $('.show-img').eq(inx);
        img.hide();

        var rdo = $('input[type=radio]', up).eq(0);
        rdo.attr('required','required');

    }

    function showImg(inx){
        var item = $( ".link-img" ).eq(inx);
        var imgUrl = $( ".img-url", item );
        var imgUpload = $( ".img-upload", item );

        item.show();
        imgUpload.show();
        imgUrl.hide();

        $( ".img-upload input", item ).attr('required','required');
        $( ".img-url input", item ).removeAttr('required');

    }

    function showURL(inx){
        var item = $( ".link-img" ).eq(inx);
        var imgUrl = $( ".img-url", item );
        var imgUpload = $( ".img-upload", item );

        item.show();
        imgUrl.show();
        imgUpload.hide();

        $( ".img-url input", item ).attr('required','required');
        $( ".img-upload input", item ).removeAttr('required');
        
    }

    function checkSubmit(){
        var form = $('form');
        var group = $('.img-group', form);
        var cfile = []; var curl = [];

        $.map( group, function( n, i ) {
            var g = $(n);
            if( $('input[name^=maepisodeimage_path]', g ).val() ){
                curl.push( i );
            }else if( $('input[name^=maepisodeimage_picture]', g ).val() ){
                cfile.push( i );
            }
        });

        $( "#cfile" ).val( cfile.join( "|" ) );
        $( "#curl" ).val( curl.join( "|" ) );
        $( "#count" ).val( group.length );
        
        return true;
        
    }

</script>