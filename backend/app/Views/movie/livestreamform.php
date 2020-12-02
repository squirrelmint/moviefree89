<div class="panel panel-flat">
    <div class="panel-heading">
    </div>

    <style type="text/css">
        div {
            font-size: 15px;
        }

        .modal-fullscreen {
            width: 100%;
            height: 100%;
            margin: 0;
            top: 0;
            left: 0;
        }
    </style>

    <div class="panel-body">
        <form class="form-horizontal form-validate-jquery" method="post" action="/video/branch/<?php echo $branch; ?>/livestream/saveadd" enctype="multipart/form-data">


            <fieldset class="content-group">
                <legend class="text-bold">
                    <h2>เพิ่ม ไลฟ์สตรีม</h2>
                </legend>

                <div class="form-group">
                    <div class="col-lg-3 ">ชื่อไลฟ์สตรีม<span class="text-danger">*
                            <input type="text" id="name_livestream_seo" name="livestreamname_th" autocomplete="off" class="form-control" required="required" placeholder="">
                    </div>

                    <div class="checkbox checkbox-switchery col-lg-1">
                        <label>
                            <input type="checkbox" id="ls_status" onclick="changeStatusVal()" value=1 name="status" class="switchery" checked="checked">
                            สถานะ
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2">URL Live Stream<span class="text-danger">*</span></label>
                    <div class="col-lg-4 cate-input">
                        <div class="form-group">
                            <input type="text" id="triler_video" name="livestreamname_url" placeholder="URL Live Stream" autocomplete="off" class="form-control" required="required" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="form-group col-lg-4">
                    <img id="TMPimg"  src='' alt="" height="130px;">
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
                <div class="form-group" id="show_addimg">
                    <label class="control-label col-lg-2"><span class="text-danger"></span></label>
                    <div class="col-lg-6 cate-input">
                        <div class="col-lg-6">
                            <input type="file" onchange="FileChangeSRC(this)" required name="img_video" id="img_video" accept=".png, .jpg" class="file-styled-primary">
                        </div>
                    </div>
                </div>

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
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div> <!-- **************************   Model    *******************************  -->
<script>
    <?php helper(['alert']);
    getAlert(); ?>

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
                livestreamname_url: {
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
            location.reload();
        });

    });

    function changeStatusVal() {
        if (document.getElementById("myCheck").checked) {
            $("#ls_status").val() = 1;
        } else {
            $("#ls_status").val() = 0;
        }

    }

    function get_namemovie() {

        $('#modal_form_horizontal').modal('toggle');

        if ($("#name_movie_seo").val() == "") {
            return false;
        }

        $("#panelmovie").html("");

        var name = encodeURIComponent($("#name_movie_seo").val());
        var movieList = $.ajax({
            url: "<?php echo $url_service; ?>movies/" + name,
            type: 'GET',
            async: false,
            success: function(data) {
                return data;
            }
        }).responseJSON;

        if (movieList['data'].length > 0) {

            var html = '';

            for (let index = 0; index < movieList['data'].length; index++) {

                var element = movieList['data'][index];
                html += setHTMLPanelMovie(index + 1, element['movieThumbnail'], element['movieName'], element['moviePreview'], element['movieQuality'], element['movieScore'], element['movieYear'], element['movieUrl']);

            }

            // console.log(html)
            $("#titleMovie").text("รายการหนัง " + movieList['data'].length + " รายการ")
            $("#panelmovie").append(html);

        }

    }

    function selectMovie(id, thumbnail, name, preview, quality, score, year, url) {

        var input = ['name_movie_seo', 'videoname_year', 'videoname_imdb', 'videoname_des', 'url_movie_manin', 'url_movie720p', 'triler_video', 'video_check', 'videoname_url']

        $("#name_movie_seo").val(name);
        $("#videoname_year").val(year);
        $("#videoname_imdb").val(score);
        $("#url_movieth_manin").val(url);
        $("#triler_video").val(preview);

        $('#video_check_url').prop('checked', true);
        $.uniform.update();

        show_url();
        $("#videoname_url").val(thumbnail);

        $("#modal_form_horizontal").modal('hide');

    }

    function setHTMLPanelMovie(id, thumbnail, name, preview, quality, score, year, url) {

        var html = '';

        var img = "";
        var iframe = "";

        if (thumbnail != "") {
            img = '<img src="' + thumbnail + '" width="80px" alt="">';
        }

        if (preview != "") {
            iframe = '<iframe height="150" src="' + preview + '"></iframe>';
        }

        html += '<tr>';
        html += '<td><button type="button" onclick="selectMovie(\'' + id + '\',\'' + thumbnail + '\', \'' + name + '\', \'' + preview + '\', \'' + quality + '\', \'' + score + '\', \'' + year + '\', \'' + url + '\')" class="btn btn-info btn-labeled btn-xs legitRipple"><b><i class="icon-select2"></i></b> เลือก</button></td>';
        html += '<td>' + img + '</td>';
        html += '<td>' + name + '</td>';
        html += '<td>' + iframe + '</td>';
        html += '<td>' + quality + '</td>';
        html += '<td>' + score + '</td>';
        html += '<td>' + year + '</td>';
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
    function show_url() {
        $('#show_addurl').show();
        $('#show_addimg').hide();
    }

    function show_img() {
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

        $("#name_movie_seo").focus();

        $("#name_movie_seo").keypress(function(e) {

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
            // console.log(replace_description);
            $("#seo_description_show").html(replace_description);

            if (e.which == "13") {
                get_namemovie();
                event.preventDefault();
            }

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
            // console.log(replace_description);
            $("#seo_description_show").html(replace_description);
        });

    });
</script>