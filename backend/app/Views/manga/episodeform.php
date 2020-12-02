<div class="panel panel-flat">

    <div class="panel-heading">

    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" enctype="multipart/form-data" method="post" action="/manga/<?= $manga_id ?>/episode/saveadd" onsubmit="return checkSubmit()">

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
                                            <th class="text-center">ชื่อตอนมังงะ</th>
                                            <th class="text-center" width="20%">จำนวนรูปภาพ</th>
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

            <input type="hidden" name="masubject_name_eng" id="masubject_name_eng" value="<?= $masubject_name_eng ?>">
            <fieldset class="content-group">
                <legend class="text-bold">เพิ่มตอนมังงะ</legend>


                <div class="form-group">

                    <div class="col-lg-9 col-lg-offset-3">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-sm" onclick="getSource()">เลือกตอน<i class="icon-search4 position-right"></i></button>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">ชื่อตอนมังงะ <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="maepisode_name_eng" id="maepisode_name_eng" autocomplete="off" class="form-control" required="required" placeholder="">

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3">สถานะ <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select name="maepisode_status" id="maepisode_status" class="select">
                            <option value="1">แสดง</option>
                            <option value="0" selected>ไม่แสดง</option>
                        </select>
                    </div>
                </div>

            </fieldset>

            <fieldset class="content-group ep-img">
                <legend class="text-bold">รูปภาพภายในตอนมังงะ</legend>

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
                <input type="hidden" id="cfile" name="cfile">
                <input type="hidden" id="curl" name="curl">
                <input type="hidden" id="count" name="count">
            </fieldset>

            <div class="form-group">
                <div class="col-lg-12 text-right">
                    <button type="button" onclick="goAdd();" id="addcate" class="btn btn-success"><i class="icon-plus3"></i> เพิ่มลิ้งค์</button>
                    <button type="button" onclick="goRemove();" id="removelink" class="btn btn-danger"><i class="icon-minus3"></i> ลบลิ้งค์</button>
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
        const dataManga = [];

        <?php helper(['alert']);
        getAlert(); ?>

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

    function goAdd() {
        var form = $('form');
        var input = $('.img-group', form);
        var no = Number(input.length) + 1;

        var html = '';

        html += '<div class="img-group">';
        html += '<div class="form-group">';
        html += '<label class="control-label col-lg-3">Link Image ' + no + ' <span class="text-danger">*</span></label>';
        html += '<div class="col-lg-9">';
        html += '<label class="radio-inline">';
        html += '<input type="radio" name="radio' + no + '" class="styled" required="required" onclick="showImg(' + input.length + ');">';
        html += 'Upload by Image';
        html += '</label>';

        html += '<label class="radio-inline">';
        html += '<input type="radio" name="radio' + no + '" class="styled" onclick="showURL(' + input.length + ');">';
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

        $(html).appendTo(".ep-img");
        $('.styled').uniform();
        $('.file-styled').uniform();


        if (no > 1) {
            $('#removelink').fadeIn();
        }
    }

    function goRemove() {
        var form = $('form');
        $('.img-group:last', form).remove();

        var len = $('.img-group', form).length;
        if (len <= 1) {
            $('#removelink').fadeOut();
        }
    }

    function showImg(inx) {
        var item = $(".link-img").eq(inx);
        var imgUrl = $(".img-url", item);
        var imgUpload = $(".img-upload", item);

        item.show();
        imgUpload.show();
        imgUrl.hide();

        $(".img-upload input", item).attr('required', 'required');
        $(".img-url input", item).removeAttr('required');

    }

    function showURL(inx) {
        var item = $(".link-img").eq(inx);
        var imgUrl = $(".img-url", item);
        var imgUpload = $(".img-upload", item);

        item.show();
        imgUrl.show();
        imgUpload.hide();

        $(".img-url input", item).attr('required', 'required');
        $(".img-upload input", item).removeAttr('required');

    }

    function checkSubmit() {
        var form = $('form');
        var group = $('.img-group', form);
        var cfile = [];
        var curl = [];

        $.map(group, function(n, i) {
            var g = $(n);
            if ($('input[name^=maepisodeimage_path]', g).val()) {
                curl.push(i);
            } else if ($('input[name^=maepisodeimage_picture]', g).val()) {
                cfile.push(i);
            }
        });

        $("#cfile").val(cfile.join("|"));
        $("#curl").val(curl.join("|"));
        $("#count").val(group.length);

        return true;

    }

    function getSource() {
        // $("#modal_form_horizontal").modal('hide');
        var name = encodeURIComponent($("#masubject_name_eng").val());
        var link = '<?php echo $url_service; ?>/manga/ep/' + name;

        if (name) {
            $.ajax({
                url: link,
                type: 'GET',
                async: false,
                success: function(result) {
                    console.log(result.data);
                    // return false;
                    dataManga = result.data;
                    var data = result.data;

                    var modal = $('#mangaModal');
                    $('.modal-title', modal).html('ผลลัพธ์การค้นหา <u>' + $("#masubject_name_eng").val() + '</u>');

                    var tb = $('table tbody', modal);
                    var store = [];
                    var i = 1;

                    if (data) {
                        tb.html('');

                        for (var [key, value] of Object.entries(data)) {

                            var epName = value[0].EPName;
                            var cImg = value.length;

                            var html = '';

                            html += '<tr>';
                            html += '<td>' + i + '</td>';

                            html += '<td><button type="button" class="btn bg-primary-400 btn-labeled btn-rounded legitRipple" onclick="chooseSource(' + key + ')"><b><i class="icon-select2"></i></b> เลือก</button></td>';

                            html += '<td>' + epName + '</td>';

                            html += '<td class="text-center">' + cImg + '</td>';

                            html += '</tr>';

                            $(html).appendTo(tb);
                            i++;
                        }

                        i--;
                        $('p', modal).html('รายการตอนมังงะ ' + i + ' รายการ');
                    } else {

                        tb.html('<tr><td class="text-center" colspan="5">ไม่มีผลลัพธ์</td></tr>');
                        $('p', modal).html('รายการตอนมังงะ 0 รายการ');

                    }
                }
            });

            $('#mangaModal').modal('show');
        }

    }

    function chooseSource(inx) {
        var modal = $('#mangaModal');
        var data = dataManga[inx];
        var input = '';
        var no = '';

        $('#maepisode_name_eng').val(data[0].EPName);
        $('.ep-img .img-group').remove();

        for (var [key, value] of Object.entries(data)) {
            // console.log(key, value);

            input = $('.img-group');
            no = Number(input.length) + 1;

            var html = '';

            html += '<div class="img-group">';
            html += '<div class="form-group">';
            html += '<label class="control-label col-lg-3">Link Image ' + no + ' <span class="text-danger">*</span></label>';
            html += '<div class="col-lg-9">';
            html += '<label class="radio-inline">';
            html += '<input type="radio" name="radio' + no + '" class="styled" required="required" onclick="showImg(' + input.length + ');">';
            html += 'Upload by Image';
            html += '</label>';

            html += '<label class="radio-inline">';
            html += '<input type="radio" name="radio' + no + '" class="styled" onclick="showURL(' + input.length + ');" checked="checked">';
            html += 'Upload by URL';
            html += '</label>';
            html += '</div>';
            html += '</div>';

            html += '<div class="form-group link-img">';
            html += '<div class="col-lg-9 col-lg-offset-3 img-url">';
            html += '<input type="text" name="maepisodeimage_path[]" autocomplete="off" class="form-control" placeholder="Ex. https://image.flaticon.com/teams/slug/google.jpg" value="' + value.mangaEPIMG + '">';
            html += '</div>';
            html += '<div class="col-lg-9 col-lg-offset-3 img-upload" style="display:none;">';
            html += '<input type="file" name="maepisodeimage_picture[]" autocomplete="off" class="file-styled" accept=".png, .jpg, .gif">';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            $(html).appendTo(".ep-img");
            $('.styled').uniform();
            $('.file-styled').uniform();

        }

        modal.modal('hide');
    }
</script>