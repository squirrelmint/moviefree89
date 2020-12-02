





<div class="panel panel-flat">



    <div class="panel-heading">



    </div>



    <div class="panel-body">



    <form class="form-horizontal form-validate-jquery" method="POST" enctype="multipart/form-data" action="<?= base_url('/manga/branch/'.$branch.'/subject/saveadd') ?>">

            <fieldset class="content-group">

                <legend class="text-bold">ตั้งค่า Seo</legend>



                <div class="form-group">

                    <div class="col-md-12">

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

                    </div>

                </div>



            </fieldset>



            <div id="mangaModal" class="modal fade" tabindex="-1">

                <div class="modal-dialog modal-full">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                            <h5 class="modal-title">ผลการค้นหา </h5>

                        </div>



                        <div class="modal-body">

                            <p>รายการมังงะ 100 รายการ</p>

                            <div class="table-responsive">

                                <table class="table">

                                    <thead>

                                        <tr class="bg-primary-400">

                                            <th class="text-center" width="5%">#</th>

                                            <th width="15%"></th>

                                            <th class="text-center" width="20%">ชื่อมังงะ</th>

                                            <th class="text-center" width="20%">รูปภาพ</th>

                                            <th class="text-center">เรื่องย่อ</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>

                            </div>

                        </div>



                        <!-- <div class="modal-footer">

                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

                        </div> -->

                    </div>

                </div>

            </div>



            <fieldset class="content-group">

                <legend class="text-bold">มังงะ</legend>



                <div class="form-group">

                    <label class="control-label col-lg-3">รูปภาพ<span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <label class="radio-inline">

                            <input type="radio" name="radio-inline-left" class="styled" required="required" onclick="showImg();">

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



                <div class="form-group">

                    <label class="control-label col-lg-3">ชื่อมังงะ <span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <div class="input-group">

                            <input type="text" name="masubject_name_eng" id="masubject_name_eng" autocomplete="off" class="form-control" required="required" placeholder="">

                            <span class="input-group-btn">

                                <button type="button" class="btn btn-default btn-sm" onclick="getSource()">ค้นหา <i class="icon-search4 position-right"></i></button>

                            </span>

                        </div>

                    </div>

                </div>


                <div class="form-group">

                    <label class="control-label col-lg-3">ชื่อผู้แต่ง </label>

                    <div class="col-lg-9">

                        <input type="text" name="masubject_author" id="masubject_author" autocomplete="off" class="form-control" placeholder="">

                    </div>

                </div>



                <div class="form-group">

                    <label class="control-label col-lg-3">สถานะ <span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <select name="masubject_status" id="masubject_status" class="select">

                            <option value="1">แสดง</option>

                            <option value="0" selected>ไม่แสดง</option>

                        </select>

                    </div>

                </div>



                <div class="form-group">

                    <label class="control-label col-lg-3">หมวดหมู่ <span class="text-danger">*</span></label>

                    <div class="col-lg-9">

                        <select multiple="multiple" name="macategory_id[]" id="macategory_id" class="select-border-color border-warning" required="required">

                        <?php foreach($categoryq as $key => $value ){?>

                            <option value="<?php echo $value['macategory_id']?>"><?php echo $value['macategory_name']?></option>

                        <?php }?>

						</select>

                    </div>

                </div>



                <div class="form-group">

                    <label class="control-label col-lg-3">เรื่องย่อ</label>

                    <div class="col-lg-9">

                        <textarea rows="5" cols="5" class="form-control" name="masubject_description"  id="masubject_description" autocomplete="off" placeholder=""></textarea>

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

        $(".styled").uniform();

        $('.select').select2({

            minimumResultsForSearch: Infinity

        });

        $('.select-border-color').select2({

            dropdownCssClass: 'border-teal',

            containerCssClass: 'border-default text-teal-400'

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


        $('#Img input').removeAttr('required');
        $('#Url input').attr('required','required');

    }


    function getSource(){

        // $("#modal_form_horizontal").modal('hide');

        var name = encodeURIComponent($("#masubject_name_eng").val());

        var link = '<?php echo $url_service;?>manga/subject/'+name;



        if( name ){

            $.ajax({

                url: link,

                type: 'GET',

                async : false,

                success: function(result)          

                {   

                    console.log(result.data);

                    var data = result.data;



                    var modal = $('#mangaModal');

                    $('.modal-title', modal).html('ผลลัพธ์การค้นหา <u>'+$("#masubject_name_eng").val()+'</u>');

                    

                    var tb =  $('table tbody', modal);

                    var store = [];

                    var i = 1;



                    if( data ){

                        tb.html('');

                        data.forEach(ele => {

                            var html = '';



                            if( jQuery.inArray( ele.mangaName, store ) == -1 ){

                                // เก็บชื่อมังงะ เพื่อไปเช็คตัวที่ซ้ำ

                                store.push(ele.mangaName);



                                html += '<tr>';

                                    html += '<td>'+i+'</td>';



                                    var inx = i - 1;

                                    html += '<td><button type="button" class="btn bg-primary-400 btn-labeled btn-rounded legitRipple" onclick="chooseSource('+inx+')"><b><i class="icon-select2"></i></b> เลือก</button></td>';

                                   

                                    html += '<td>'+ele.mangaName+'</td>';



                                    var img = '<?=base_url("assets/img/empty.png");?>';

                                    if(ele.mangaThumbnail){

                                        img = ele.mangaThumbnail;

                                    }



                                    html += '<td class="text-center"><img src="'+img+'" width="130px"></td>';



                                    var des = '';

                                    if( ele.mangaDes ){

                                        des = ele.mangaDes;

                                    }



                                    html += '<td>'+des+'</td>';

                                html += '</tr>';

                                

                                $( html ).appendTo( tb );

                                i++;

                            }

                        });



                        i--;

                        $('p', modal).html('รายการมังงะ '+i+' รายการ');

                    }else{



                        tb.html( '<tr><td class="text-center" colspan="5">ไม่มีผลลัพธ์</td></tr>' );

                        $('p', modal).html('รายการมังงะ 0 รายการ');



                    }

                }

            });



            $('#mangaModal').modal('show'); 

        }

       

    }



    function chooseSource( inx ){

        var modal = $('#mangaModal');

        var tr = $('table tbody tr', modal).eq(inx);

        var td = $('td', tr);



        var mangaName = td.eq(2).html();

        var mangaCover = td.eq(3);

        var img = $('img', mangaCover).attr('src');

        var mangaDes = td.eq(4).html();



        $('#masubject_name_eng').val(mangaName);

        $('.radio-inline').eq(1).html( '<input type="radio" name="radio-inline-left" class="styled" onclick="showURL();" checked> อัพโหลด URL' );
        // $('input[type=radio]').eq(1).attr('checked','checked');


        $(".styled").uniform();

        $('#Url').show(); $('#Url').parent().show();

        $('#masubject_url').val(img);

        $('#masubject_description').html(mangaDes);





        modal.modal('hide'); 

    }



</script>