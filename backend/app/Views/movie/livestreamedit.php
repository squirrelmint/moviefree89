<?php //print_r($data);die; ?>

<div class="panel panel-flat">
    <div class="panel-heading">
    </div>

    <style type="text/css">

        div{
            font-size: 15px;
        }

        .modal-fullscreen{
            width: 100%;
            height: 100%;
            margin: 0;
            top: 0;
            left: 0;
        }

    </style>

    <div class="panel-body">
        <form class="form-horizontal form-validate-jquery"  method="post" action="/video/branch/<?=$branch?>/livestream/update/id/<?php echo $id?>" enctype="multipart/form-data">
            

            <fieldset class="content-group">
                <legend class="text-bold"><h2>แก้ไข ไลฟ์สตรีม</h2></legend>

                <div class="form-group">
                    <div class="col-lg-3 ">ชื่อไลฟ์สตรีม<span class="text-danger">*
                        <input type="text" value="<?=$data['livestream_name']?>" id="name_livestream_seo" name="livestreamname_th" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>
                    
                    <div class="checkbox checkbox-switchery col-lg-1">
						<label>
							<input type="checkbox" id="ls_Status" value="1" <?php if($data['livestream_status']==1){echo "checked";}?>   name="status" class="switchery" >
							สถานะ
						</label>
					</div>
                </div>    
                <div class="form-group">
                    <label class="control-label col-lg-2">URL Live Stream<span class="text-danger">*</span></label>
                    <div class="col-lg-4 cate-input">
                        <div class="form-group">
                            <input type="text" id="triler_video" value="<?=$data['livestream_url']?>" name="livestreamname_url" placeholder="URL Live Stream" autocomplete="off" class="form-control" required="required" placeholder=""> 
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <?php 
                        $check_link = substr($data['livestream_img'], 0, 4);
                        $logo = $data['livestream_img'];
                        if ($check_link!="http") {
                            $logo = base_url($filepath.$data['livestream_img']) ;
                        }
                    ?>
                    <img id="TMPimg" src='<?= $logo ?>' alt="" height="130px;">     
                </div>
                <div class="form-group col-lg-12">
                    <label class="control-label col-lg-2">หน้าปกไลฟ์สตรีม <span class="text-danger">*</span></label>
                    <div class="col-lg-6 cate-input">
                        <div class="input-group">
                    <label class="display-block text-semibold">เลือกไฟล์ หน้าปกหนัง </label>
                        <label class="radio-inline">
                            <input type="radio" id="video_check_file" checked name="video_check" onclick="show_img()" name="radio-inline-left" class="styled">
                           ใช้รูปโดย อัพโหลดจากคอมพิวเตอร์
                        </label>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="show_addimg" >
                    <label class="control-label col-lg-2"><span class="text-danger"></span></label>
                    <div class="col-lg-6 cate-input">
                            <div class="col-lg-6">
                            <input type="file" onchange="FileChangeSRC(this)" name="img_video" id="img_video" accept=".png, .jpg"  class="file-styled-primary">
                        </div>
                    </div>
                </div>
                <input type="text" style="display:none"  value="<?=$data['livestream_img']?>" name="livestream_old_img"  autocomplete="off" >         
            </fieldset>

            <div class="text-right" style="margin-right: 40px;">
                    <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt"></i></button>
                    <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14"></i></button>
                </div>

        </form><br>
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

    function FileChangeSRC(t){
        document.getElementById('TMPimg').src = window.URL.createObjectURL(t.files[0]);
    }   
    
    document.addEventListener('DOMContentLoaded', function() {

        $('.select-size-xs').select2({
            containerCssClass: 'select-xs'
        });

        $(".styled").uniform();
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
                videoname_url:{
                    url:true
                },
                video_url:{
                    url:true
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

    function changeStatusVal(){
        if(document.getElementById('ls_status').checked)
        {
            $("#ls_status").val(1);
        }else{
            $("#ls_status").val(0);
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
            html += '<td><button type="button" onclick="selectMovie(\'' + id + '\',\'' + thumbnail + '\', \'' + name + '\', \'' + preview + '\', \'' + quality + '\', \'' + score + '\', \'' + year + '\', \'' + url + '\')" class="btn btn-info btn-labeled btn-xs legitRipple"><b><i class="icon-select2"></i></b> เลือก</button></td>';
            html += '<td>'+img+'</td>';
            html += '<td>'+name+'</td>';
            html += '<td>'+iframe+'</td>';
            html += '<td>'+quality+'</td>';
            html += '<td>'+score+'</td>';
            html += '<td>'+year+'</td>';
        html += '</tr>';

        return html;

    }   

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

</script>

<script>
function show_url(){
    $('#show_addurl').show();
    $('#show_addimg').hide();
}
function show_img(){
    $('#show_addurl').hide();
    $('#show_addimg').show();
}
// function choose_movies(id){
//         $("#modal_form_horizontal").modal('hide');
//    // console.log(id);
// }

$(document).ready(function() {

    var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });

});
</script>