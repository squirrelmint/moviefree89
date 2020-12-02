

<div class="panel panel-flat">



    <div class="panel-heading">



    </div>



    <div class="panel-body">



        <form class="form-horizontal form-validate-jquery" method="POST" enctype="multipart/form-data" action="<?= base_url('/manga/branch/'.$branch.'/subject/editsave/id/'.$id) ?>">

            <fieldset class="content-group">

                <legend class="text-bold">ตั้งค่า Seo</legend>



                <?php if( !empty($setting) && !empty($seo) ){ ?>

                    <section style="padding: 20px;">

                        <div style="font-size:16px;background-color: white; border-radius: 10px; width: 600px; height: 100%; padding: 10px; box-shadow: rgb(160, 160, 160) 0px 0px 10px;">      

                            <input id="setting_title" name="setting_title" type="hidden" value="<?=$setting['setting_title']?>"> 

                            <input id="seo_title" name="seo_title" type="hidden" value="<?=$seo['seo_title']?>"> 

                            <p style="color: rgb(26, 13, 171); font-weight: 600; height: 2.5rem; overflow: hidden; text-overflow: ellipsis; width: 580px;">

                                <span id="seo_title_show"><?=$seo['seo_title']?></span>

                            </p>

                            <img src="<?= base_url('assets/img/icon-seo.png');?>" width="16px" height="16px" alt=""> 

                            <span style="color: rgb(0, 102, 33);"><?=$base_url?></span>

                            <span style="clip: rect(1px, 1px, 1px, 1px); position: absolute; height: 1px; width: 1px; overflow: hidden;"></span> 

                            <input id="seo_description" name="seo_description" type="hidden" value="<?=$seo['seo_description']?>"> 

                            <div id="seo_description_show" style="max-height: 4.5rem; overflow: hidden; text-overflow: ellipsis; width: 580px;"><?=$seo['seo_description']?></div>

                        </div>

                    </section>

                <?php }else{ ?>

                    <p>กรุณาตั้งค่าเว็บไซด์ก่อนใช้งาน SEO</p>

                <?php } ?> 



            </fieldset>

            

            <fieldset class="content-group">

                <legend class="text-bold">แก้ไข มังงะ</legend>



                <div id="Image" class="form-group" >

                    <label class="control-label col-lg-3">รูปภาพ <span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <?php

                            $img = base_url("assets/img/empty.png");

                            if( !empty($data['masubject_picture']) && filter_var(str_replace('-', '',str_replace(' ', '', $data['masubject_picture'])), FILTER_VALIDATE_URL)  ){

                                $img = $data['masubject_picture'];

                            }else{

                                $img = base_url($path_macover."/".$data['masubject_picture']);

                            }

                        ?>

                        <img src="<?=$img?>" alt=""  width="200">

                        <br><br>

                        <button onclick="goRemove();" type="button" class="btn btn-danger legitRipple" id="back"><i class="icon-cross position-left"></i> ลบ</button>

                    </div> 

                </div>



                <div id="checkUpload" class="form-group" style="display: none;">

                    <label class="control-label col-lg-3">รูปภาพ <span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <label class="radio-inline">

                            <input type="radio" name="radio-inline-left" class="styled"  onclick="showImg();">

                            อัพโหลดรูปภาพ

                        </label>



                        <label class="radio-inline">

                            <input type="radio" name="radio-inline-left" class="styled" onclick="showURL();">

                            อัพโหลด URL

                        </label>

                    </div>

                </div>



                <div class="form-group" style="display:none;">

                    <div id="Url" class="col-lg-9 col-lg-offset-3" style="display:none;">

                        <input type="text" name="masubject_url" id="masubject_url" autocomplete="off" class="form-control" placeholder="Ex. https://image.flaticon.com/teams/slug/google.jpg">

                    </div>

                    <div id="Img" class="col-lg-9 col-lg-offset-3" style="display:none;">

                        <input type="file" name="masubject_picture" id="masubject_picture" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif">

                    </div>

                </div>



                <input type="hidden" name="masubject_oldpic" id="masubject_oldpic" value="<?=$data['masubject_picture']?>">



                <!-- <div class="form-group">

                    <label class="control-label col-lg-3">Manga Cover <span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <input type="hidden" name="masubject_oldpic" id="masubject_oldpic" value="<?=$data['masubject_picture']?>">

                        <input type="file" name="masubject_picture" id="masubject_picture" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif" placeholder="">

                    </div>

                </div> -->



                <div class="form-group">

                    <label class="control-label col-lg-3">ชื่อมังงะ <span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <input type="text" name="masubject_name_eng" id="masubject_name_eng" value='<?=$data['masubject_name_eng']?>' autocomplete="off" class="form-control" required="required" placeholder="">

                    </div>

                </div>



                <div class="form-group">

                    <label class="control-label col-lg-3">ชื่อผู้แต่ง </label>

                    <div class="col-lg-9">

                        <input type="text" name="masubject_author" id="masubject_author" value='<?=$data['masubject_author']?>' autocomplete="off" class="form-control" placeholder="">

                    </div>

                </div>



                <div class="form-group">

                    <label class="control-label col-lg-3">สถานะ <span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <select name="masubject_status" id="masubject_status"  class="select">

                        <?php 

                        if($data['masubject_status'] == "1" )

                            {

                                echo '<option value="1" selected>แสดง</option>';

                                echo '<option value="0">ไม่แสดง</option>';

                            }

                        elseif($data['masubject_status'] == "0")

                            {

                                echo '<option value="0" selected>ไม่แสดง</option>';

                                echo '<option value="1">แสดง</option>';

                            } 

                        ?>

                        </select>

                    </div>

                </div>



                <div class="form-group">

                    <label class="control-label col-lg-3">หมวดหมู่ <span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <select multiple="multiple" name="macategory_id[]" id="macategory_id" class="select-border-color border-warning">

                        <?php 

                            foreach($categoryq as $key => $value){

                                $select = "";

                                if(in_array($value['macategory_id'],$group)){

                                    $select = 'selected';

                                }

                        ?>

                            <option value="<?php echo $value['macategory_id']?>" <?php echo $select ;?>><?php echo $value['macategory_name']?></option>

                            <?php }?>

						</select>

                    </div>

                </div>





                <div class="form-group">

                    <label class="control-label col-lg-3">เรื่องย่อ</label>

                    <div class="col-lg-9">

                        <!-- <input type="text" name="masubject_author" id="masubject_author" autocomplete="off" class="form-control" placeholder=""> -->

                        <textarea rows="5" cols="5" class="form-control" name="masubject_description"  id="masubject_description"><?=$data['masubject_description']?></textarea>

                    </div>

                </div>

                <input type="hidden"  name="masubject_create_datetime"  id="masubject_create_datetime" value="<?=date('Y-m-d H:i:s')?>"/>



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

        <?php helper(['alert']);getAlert(); ?>

        $('.datatable-basic').DataTable();



        $(".datatable-header").css("padding-top", "0px");



        $(".styled").uniform();

        $('.select').select2({

            minimumResultsForSearch: Infinity

        });

        $('.select-border-color').select2({

            dropdownCssClass: 'border-teal',

            containerCssClass: 'border-default text-teal-400'

        });



        <?php helper(['alert']);getAlert(); ?>



    });



    document.addEventListener('DOMContentLoaded', function() {



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

                masubject_url: {

                    url: true

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



    $(document).ready(function() {

        var title = $("#masubject_name_eng").val();

        var setting_title = $("#setting_title").val();

        var seo_title = $("#seo_title").val();

        var replace = seo_title.replace('{manga_title}', title);

        replace = replace.replace('{title_web}', setting_title); 

        $("#seo_title_show").html(replace);



        var description = $("#masubject_description").val();

        var seo_description = $("#seo_description").val();

        var replace_description = seo_description.replace('{manga_title}', title);

        replace_description = replace_description.replace('{manga_description}', description);

        console.log(replace_description);

        $("#seo_description_show").html(replace_description);



        $("#masubject_name_eng").keyup(function() {

            var title = $("#masubject_name_eng").val();

            var setting_title = $("#setting_title").val();

            var seo_title = $("#seo_title").val();

            var replace = seo_title.replace('{manga_title}', title);

            replace = replace.replace('{title_web}', setting_title); 

            $("#seo_title_show").html(replace);



            var description = $("#masubject_description").val();

            var seo_description = $("#seo_description").val();

            var replace_description = seo_description.replace('{manga_title}', title);

            replace_description = replace_description.replace('{manga_description}', description);

            console.log(replace_description);

            $("#seo_description_show").html(replace_description);

        });



        $("#masubject_description").keyup(function() {

            var title = $("#masubject_name_eng").val();

            var setting_title = $("#setting_title").val();

            var seo_title = $("#seo_title").val();

            var replace = seo_title.replace('{manga_title}', title);

            replace = replace.replace('{title_web}', setting_title); 

            $("#seo_title_show").html(replace);



            var description = $("#masubject_description").val();

            var seo_description = $("#seo_description").val();

            var replace_description = seo_description.replace('{manga_title}', title);

            replace_description = replace_description.replace('{manga_description}', description);

            console.log(replace_description);

            $("#seo_description_show").html(replace_description);

        });

    });



    function goRemove(){



        var up = $('#checkUpload');

        up.show();

        // $('input[name=masubject_picture', img).attr('required','required');



        var img = $('#Image');

        img.hide();



    }



    function showImg(){

        $('#Url').parent().show();

        $('#Url').hide();

        $('#Img').show();



        $('#Url input').removeAttr('required');

        $('#Img input').attr('required','required');

    }



    function showURL(){

        $('#Url').parent().show();

        $('#Url').show();

        $('#Img').hide();



        $('#Url input').attr('required','required');

        $('#Img input').removeAttr('required');

    }



</script> 

