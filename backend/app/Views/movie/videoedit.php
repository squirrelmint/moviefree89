<style>
    .modal-fullscreen{
        width: 100%;
        height: 100%;
        margin: 0;
        top: 0;
        left: 0;
    }

</style>

<?php 
    //  echo "<pre>";
    //  print_r($category_onmovie);die;
    //echo substr($data['movie_picture'], 0, 4);
    // print_r($link_video1);
    // print_r($link_video2);
    // print_r($link_video3);
    // die;
    //print_r($path_img);die;
    //print_r($file_old);die;
    //print_r($category_list);die;
    // echo "<pre>";
    // print_r($data);die;
//  echo "<pre>";
// print_r($setting);die;
?>
<div class="panel panel-flat">
    <div class="panel-heading">

    </div>

    <div class="panel-body">
        
        <form class="form-horizontal form-validate-jquery" method="post" enctype="multipart/form-data" action="/video/branch/<?=$data['branch_id']?>/video/update/id/<?php echo $data['movie_id'];?>">

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
                                    <span id="seo_title_show"><?=$seo['seo_title']?> </span>
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

            <fieldset class="content-group">
                <input type="hidden" name="movie_id" value="<?=$data['movie_id']?>"> 
                <legend class="text-bold">Category Movie info</legend>
                <div class="form-group">
                    <div class="col-lg-3  cate-input">ชื่อหนัง
                        <input type="text" id="name_movie_seo" value="<?=$data['movie_thname']?>" name="videoname_th" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                    <div class="col-lg-1">
                        <button type="button" onclick="get_namemovie()" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-search"></i></button> 
                    </div>
                   <div class="col-lg-1"></div>
                    <div class="row col-lg-1 cate-input"> ปี
                        <input type="text" value="<?=$data['movie_year']?>" id="videoname_year" name="videoname_year" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                    <div class="row col-lg-1 cate-input" style="margin-left: 10px;"> Rate Score
                        <input type="text" value="<?=$data['movie_ratescore']?>" value="videoname_ratescore" name="videoname_ratescore" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                    <div class="row col-lg-2 cate-input" style="margin-left: 20px;"> ความละเอียดภาพ
                    <div class="form-group">
                                <select name="quality" id="quality" class="form-control">
                                    <option value="hd" <?php if($data['movie_quality']=='hd'){echo "selected";}?>>HD</option>
                                    <option value="sd" <?php if($data['movie_quality']=='sd'){echo "selected";}?>>SD</option>
                                    <option value="zoom" <?php if($data['movie_quality']=='zoom'){echo "selected";}?>>Zoom</option>
                                </select>
                            </div>
                    </div>
                    <div class="row col-lg-1 cate-input" style="margin-left: 20px;"> ประเภทหนัง
                        <div class="form-group">
                            <select name="video_type" id="video_type" class="form-control">
                                <option value="hd">หนัง</option>
                                <option value="sd">ซีรีย์</option>
                            </select>
                        </div>
                    </div>
                    <div class="row col-lg-1 cate-input" style="margin-left: 20px;"> เสียงหนัง
                        <div class="form-group">
                            <select name="sound" id="sound" class="form-control">
                                <option value="thai" <?php if($data['movie_sound']=='thai'){echo "selected";}?>>Thai</option>
                                <option value="eng" <?php if($data['movie_sound']=='eng'){echo "selected";}?>>English</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                   
                   <div class="col-lg-9 cate-input">เนื้อเรื่องย่อ
                       <textarea id="des_name_seo" name="videoname_des"  autocomplete="off" class="form-control" placeholder=""><?=$data['movie_des']?></textarea>
                   </div>
               </div>
                <div class="form-group">
                    <label class="control-label col-lg-2">ไฟล์หนัง พากษ์ไทย</label>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text"  value="<?=$data['movie_thmain']?>" name="url_movieth_manin" id="url_movieth_manin" autocomplete="off" class="form-control" placeholder="" class="form-control">
                                <span class="label label-block label-primary" style="font-size: 14px;">หลัก</span>
                            </div>

                            <div class="col-md-4">
                                <input type="text" value="<?=$data['movie_thsub1']?>"  name="url_movieth_sub1" id="url_movieth_sub1" autocomplete="off" class="form-control" placeholder="" class="form-control">
                                <span class="label label-block label-danger" style="font-size: 14px;">สำรอง 1</span>
                            </div>

                            <div class="col-md-4">
                            <input type="text" value="<?=$data['movie_thsub2']?>" name="url_movieth_sub2" id="url_movieth_sub2" autocomplete="off" class="form-control" placeholder="" class="form-control">
                                <span class="label label-block label-info" style="font-size: 14px;">สำรอง 2</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">ไฟล์หนัง ซาวด์แทร็ค</label>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" value="<?=$data['movie_enmain']?>" name="url_movieen_manin" id="url_movieen_manin" autocomplete="off" class="form-control" placeholder="" class="form-control">
                                <span class="label label-block label-primary" style="font-size: 14px;">หลัก</span>
                            </div>

                            <div class="col-md-4">
                                <input type="text" value="<?=$data['movie_ensub1']?>" name="url_movieen_sub1" id="url_movieen_sub1" autocomplete="off" class="form-control" placeholder="" class="form-control">
                                <span class="label label-block label-danger" style="font-size: 14px;">สำรอง 1</span>
                            </div>

                            <div class="col-md-4">
                            <input type="text" value="<?=$data['movie_ensub2']?>" name="url_movieen_sub2" id="url_movieen_sub2" autocomplete="off" class="form-control" placeholder="" class="form-control">
                                <span class="label label-block label-info" style="font-size: 14px;">สำรอง 2</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">เลือก หมวดหมู่ที่ต้องการเพิ่ม  <span class="text-danger">*</span></label>
                    <div class="col-lg-4 cate-input">
                        <div class="form-group">
                            <select multiple="multiple" name="category_choose[]" class="select-border-color border-warning" required>
                                <option value=""></option>
                                <?php  foreach($category_list as $cate_list){ ?>
                                    <option
                                    <?php foreach($category_onmovie as $co){?>
                                             <?php if($co['category_id']==$cate_list['category_id']){echo "selected";} ?> 
                                           
                                    <?php }?>
                                    value="<?php echo $cate_list['category_id'];?>"><?php echo $cate_list['category_name'];?></option>    
                                <?php }?>
                                        
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                        <label class="control-label col-lg-2">ตัวอย่างหนัง <span class="text-danger">*</span></label>
                        <div class="col-lg-4 cate-input">
                            <div class="form-group">
                               <input type="text" value="<?=$data['movie_preview']?>" id="triler_video" name="triler_video" placeholder="youtube ตัวอย่างหนัง" autocomplete="off" class="form-control" placeholder=""> 
                            </div>
                        </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-lg-2">ภาพหน้าปกปัจจุบัน<span class="text-danger"></span></label>
                    <div class="col-lg-6 cate-input">
                        <?php
                            $check_link = substr($data['movie_picture'], 0, 4);
                            $logo = $data['movie_picture'];
                            if ($check_link != "http") {
                                $logo = base_url($path_img.$data['movie_picture']);
                            }
                        ?>
                        <img id="TMPimg" src='<?= $logo ?>' alt="" height="130px;">
                    </div>                            
                </div>
                <div class="form-group col-lg-12">
                    <label class="control-label col-lg-2">หน้าปกหนัง <span class="text-danger">*</span></label>
                    <div class="col-lg-6 cate-input">
                        <div class="input-group">
                    <label class="display-block text-semibold">เลือกไฟล์ หน้าปกหนัง </label>
                        <label class="radio-inline">
                            <input type="radio" <?php if(substr($data['movie_picture'],0,4)=='http'){echo "checked";}?> id="video_check_url" name="video_check" onclick="show_url()" name="radio-inline-left"  class="styled">
                            ใช้รูปโดย URL 
                        </label>

                        <label class="radio-inline">
                            <input type="radio" id="video_check_file" <?php if(substr($data['movie_picture'],0,4)!='http'){echo "checked";}?> name="video_check" onclick="show_img()" name="radio-inline-left" class="styled">
                           ใช้รูปโดย อัพโหลดจากคอมพิวเตอร์
                        </label>
                        </div>
                    </div>
                </div>
               
                <div class="form-group" <?php if(substr($data['movie_picture'],0,4)=='http'){echo "style='display:none';";}?>  id="show_addimg">
                    <label class="control-label col-lg-2"><span class="text-danger"></span></label>
                    <div class="col-lg-12 cate-input">
                            <div class="col-lg-6">
                            <input type="file" onchange="FileChangeSRC(this)" name="img_video" id="img_video" accept=".png, .jpg"  class="file-styled-primary">
                            <span class="help-block"><code>ขนาดไฟล์ไม่เกิน 100 MB</code></span>
                        </div>
                    </div>
                </div>

                <div class="form-group" <?php if(substr($data['movie_picture'],0,4)!='http'){echo "style='display:none';";}?>   id="show_addurl">
                    <label class="control-label col-lg-2"><span class="text-danger"></span></label>
                    <div class="col-lg-8 cate-input">
                        <div class="col-lg-6">
                            <input onchange="UrlChangeSRC()" type="text" <?php if(substr($data['movie_picture'],0,4)=='http'){ echo "value = "."'".$data['movie_picture']."'";} ?>  id="videoname_url" name="videoname_url"  placeholder="Ex.https//www.images.com" autocomplete="off" class="form-control" placeholder="">
                        </div>   
                    </div>

                </div>
                <!-- <div class="form-group">
                    <label class="control-label col-lg-3">Year <span class="text-danger">*</span></label>
                    <div class="col-lg-6 cate-input">
                        <div class="input-group">
                            <span class="input-group-addon cate-no"></span>
                            <input type="text" name="videoname_year" value="<?//=$data['movie_year']?>" autocomplete="off" class="form-control" required="required" placeholder="">
                        </div>
                    </div>
                </div>

               <div class="form-group">
                    <label class="control-label col-lg-3">Video Ratescore <span class="text-danger">*</span></label>
                    <div class="col-lg-6 cate-input">
                        <div class="input-group">
                            <span class="input-group-addon cate-no"></span>
                            <input type="text" name="videoname_ratescore" value="<?//=$data['movie_ratescore']?>" autocomplete="off" class="form-control" required="required" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Imdb <span class="text-danger">*</span></label>
                    <div class="col-lg-6 cate-input">
                        <div class="input-group">
                            <span class="input-group-addon cate-no"></span>
                            <input type="text" name="videoname_imdb" value="<?//=$data['movie_imdb']?>" autocomplete="off" class="form-control" required="required" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">Tomato <span class="text-danger">*</span></label>
                    <div class="col-lg-6 cate-input">
                        <div class="input-group">
                            <span class="input-group-addon cate-no"></span>
                            <input type="text" name="videoname_tomato" value="<?//=$data['movie_tomato']?>" autocomplete="off" class="form-control" required="required" placeholder="">
                        </div>
                    </div>
                </div> -->


                <!-- <div class="row form-group">
                    <label class="control-label col-lg-3">Quality <span class="text-danger">*</span></label>
                    <div class="col-lg-2 cate-input">
                        <div class="input-group">
                            <span class="input-group-addon cate-no"></span>
                            <div class="form-group">
                                <select name="quality" class="form-control">

                                    <option value="hd" <?php if($data['movie_quality']=='hd'){ echo "selected";} ?>>HD</option>
                                    <option value="sd" <?php if($data['movie_quality']=='sd'){ echo "selected";} ?>>SD</option>
                                    <option value="zoom" <?php if($data['movie_quality']=='zoom'){ echo "selected";} ?>>Zoom</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <label class="control-label col-lg-1">Video Sound<span class="text-danger">*</span></label> -->
                    <!-- <div class="col-lg-2 cate-input">
                        <div class="input-group">
                            <span class="input-group-addon cate-no"></span>
                            <div class="form-group">
                            <label class="radio-inline col-lg-5">
                                <input type="radio" name="sound" value="thai" class="styled"  <?php if($data['movie_sound']=='thai'){echo "checked";}?>>
                                    Thai
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="sound" value="eng" class="styled" <?php if($data['movie_sound']=='eng'){echo "checked";}?>>
                                    English
                                </label>
                            </div>
                        </div>
                    </div> -->

                    
                <!-- <div class="form-group">
                    <div class="col-lg-12 text-right">
                        <button type="button" onclick="goAdd();" class="btn btn-success"><i class="icon-plus3"></i> Add</button>
                        <button type="button" onclick="goRemove();" class="btn btn-danger"><i class="icon-minus3"></i> Remove</button>
                    </div>
                </div> -->
            </fieldset>
            <div class="text-right">
                <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </form>
    </div>

</div>
<!-- **************************   Model    *******************************  -->
<div id="modal_form_horizontal" class="modal fade">
						<div class="modal-dialog modal-fullscreen">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 id="titleMovie" class="modal-title">เลือกหนัง</h5>
								</div>
								<form action="#" class="form-horizontal">
									<div class="modal-body" style="overflow-x: scroll; overflow-y: scroll">
                                       <div class="panel panel-flat">

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="bg-blue">
                                                            <th>Action</th>
                                                            <th>Thumbnail</th>
                                                            <th width="200px">Name</th>
                                                            <th>Preview</th>
                                                            <th>Quality</th>
                                                            <th>Score</th>
                                                            <th>Year</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="panelmovie"></tbody>
                                                </table>
                                            </div>
                                        </div>
									<div class="modal-footer">
										<button type="button"  class="btn btn-link" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
                    </div>
                    
             </div>
        </div>            <!-- **************************   Model    *******************************  -->
<script>

 <?php helper(['alert']);getAlert(); ?>
    document.addEventListener('DOMContentLoaded', function() {
        $('.select-size-xs').select2({
                containerCssClass: 'select-xs'
            });
        $(".styled").uniform();
        $("#username").focus();

        $('.multiselect').multiselect();

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
                videoname_url: {
                    url: true
                },
                video_url: {
                    url: true
                },
                url_movieth_manin:{
                    // url: true
                },
                url_movieth_sub1:{
                    // url: true
                },
                url_movieth_sub2:{
                    // url: true
                },
                url_movieen_manin:{
                    // url: true
                },
                url_movieen_sub1:{
                    // url: true
                },
                url_movieen_sub2:{
                    // url: true
                },
                // triler_video:{
                //     url: true
                // },
                videoname_year: {
                    number: true,
                    maxlength:4
                },
                videoname_ratescore:{
                    //number: true,
                    // min:0,
                    // max:10
                    maxlength:3
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
<script>

function selectMovie(id, thumbnail, name, preview, quality, score, year, url) {
        
    var input = ['name_movie_seo', 'videoname_year', 'videoname_imdb', 'videoname_des', 'url_movie_manin', 'url_movie720p', 'triler_video', 'video_check', 'videoname_url']

    $("#name_movie_seo").val(name);
    $("#videoname_year").val(year);
    $("#videoname_imdb").val(score);
    $("#url_movieth_manin").val(url);
    $("#triler_video").val(preview);

    $('#video_check_url').prop('checked',true);
    $.uniform.update();

    show_url();
    $("#videoname_url").val(thumbnail);

    $("#modal_form_horizontal").modal('hide');
    UrlChangeSRC();
}

function get_namemovie(){

    $('#modal_form_horizontal').modal('toggle');

    if ( $("#name_movie_seo").val()=="" ) {
        return false;
    }

    $("#panelmovie").html("");

    var name = encodeURIComponent($("#name_movie_seo").val());
    var movieList = $.ajax({
            url: "<?php echo $url_service;?>movies/"+name,
            type: 'GET',
            async : false,
            success: function(data)          
            {   
                return data;
            }
        }).responseJSON;

    if ( movieList['data'].length > 0 ) {

        var html = '';
        
        for (let index = 0; index < movieList['data'].length; index++) {
            
            var element = movieList['data'][index];
            html += setHTMLPanelMovie(index+1, element['movieThumbnail'], element['movieName'], element['moviePreview'], element['movieQuality'], element['movieScore'], element['movieYear'], element['movieUrl']);
            
        }

        // console.log(html)
        $("#titleMovie").text("รายการหนัง "+movieList['data'].length+" รายการ")
        $("#panelmovie").append(html);

    }

}

function setHTMLPanelMovie(id, thumbnail, name, preview, quality, score, year, url){

    var html = '';

    var img = "";
    var iframe = "";

    if ( thumbnail!="" ) {
        img = '<img src="'+thumbnail+'" width="80px" alt="">';
    }

    if ( preview!="" ) {
        iframe = '<iframe height="150" src="'+preview+'"></iframe>';
    }

    html += '<tr>';
        html += '<td><button type="button" onclick="selectMovie(\'' + id + '\',\'' + thumbnail + '\', \'' + name + '\', \'' + preview + '\', \'' + quality + '\', \'' + score + '\', \'' + year + '\', \'' + url + '\')" class="btn bg-primary-400 btn-labeled btn-rounded legitRipple"><b><i class="icon-select2"></i></b> เลือก</button></td>';
        html += '<td>'+img+'</td>';
        html += '<td>'+name+'</td>';
        html += '<td>'+iframe+'</td>';
        html += '<td>'+quality+'</td>';
        html += '<td>'+score+'</td>';
        html += '<td>'+year+'</td>';
    html += '</tr>';

    return html;

}   

function goRemove(){

    var up = $('#checkUpload');
    up.show();
    //$('input[name=masubject_picture', img).attr('required','required');

    var img = $('#Image');
    img.hide();

}

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

function choose_movies(id){
    $("#modal_form_horizontal").modal('hide');
    // console.log(id);
}

$(document).ready(function() {

    var title = $("#name_movie_seo").val();
            var setting_title = $("#setting_title").val();
            var seo_title = $("#seo_title").val();
            var replace = seo_title.replace('{movie_title}', title);
            replace = replace.replace('{title_web}', setting_title); 
            $("#seo_title_show").html(replace);

            var description = $("#des_name_seo").val();
            var seo_description = $("#seo_description").val();
            var replace_description = seo_description.replace('{movie_title}', title);
            replace_description = replace_description.replace('{movie_description}', description);
            console.log(replace_description);
            $("#seo_description_show").html(replace_description);


        $("#name_movie_seo").keyup(function() {
            var title = $("#name_movie_seo").val();
            var setting_title = $("#setting_title").val();
            var seo_title = $("#seo_title").val();
            var replace = seo_title.replace('{movie_title}', title);
            replace = replace.replace('{title_web}', setting_title); 
            $("#seo_title_show").html(replace);

            var description = $("#des_name_seo").val();
            var seo_description = $("#seo_description").val();
            var replace_description = seo_description.replace('{movie_title}', title);
            replace_description = replace_description.replace('{movie_description}', description);
            console.log(replace_description);
            $("#seo_description_show").html(replace_description);
        });

        $("#des_name_seo").keyup(function() {
            var title = $("#name_movie_seo").val();
            var setting_title = $("#setting_title").val();
            var seo_title = $("#seo_title").val();
            var replace = seo_title.replace('{movie_title}', title);
            replace = replace.replace('{title_web}', setting_title); 
            $("#seo_title_show").html(replace);

            var description = $("#des_name_seo").val();
            var seo_description = $("#seo_description").val();
            var replace_description = seo_description.replace('{movie_title}', title);
            replace_description = replace_description.replace('{movie_description}', description);
            console.log(replace_description);
            $("#seo_description_show").html(replace_description);
        });

 
    });
    function show_url(){
        $('#show_addurl').show();
        $('#show_addimg').hide();
    }
    function show_img(){
        $('#show_addurl').hide();
        $('#show_addimg').show();
    }
    function UrlChangeSRC(){
        var url = $('#videoname_url').val();
        if(url!=''){
            document.getElementById("TMPimg").src = url;
        }
    }
    function FileChangeSRC(t){
        document.getElementById('TMPimg').src = window.URL.createObjectURL(t.files[0]);
    }
</script>