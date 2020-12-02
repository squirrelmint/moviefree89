<!-- Basic datatable -->
<div class="panel panel-flat table-responsive">

    <!-- <div class="panel-body"> -->
        <form action="#" class="main-search" style="padding: 20px 20px 0px 20px;">
            <div class="input-group content-group">
                <div class="has-feedback has-feedback-left">
                    <input id="txt_search" type="text" class="form-control input-xlg" placeholder="คำค้นหา..." value="<?=$search_string?>" autocomplete="off">
                    <div class="form-control-feedback">
                        <i class="icon-search4 text-muted text-size-base"></i>
                    </div>
                </div>

                <div class="input-group-btn">
                    <button onclick="goSearch('<?=$branch_id?>')" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>ค้นหา</button>
                    <button onclick="goClear('<?=$branch_id?>')" type="button" class="btn btn-danger btn-xlg legitRipple"><i class="icon-reset text-size-base position-left"></i>เคลียร์</button>
                    <button onclick="goAdd('<?=$branch_id?>')" type="button" class="btn btn-success btn-xlg legitRipple"><i class="icon-plus3 text-size-base position-left"></i>เพิ่ม</button>
                </div>
            </div>

        </form>
    <!-- </div> -->

    <table class="table datatable-basic">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="20%" class="text-center">รูปโฆษณา</th>
                <th class="text-center">ชื่อโฆษณา</th>
                <th class="text-center">ลิ้งค์โฆษณา</th>
                <th class="text-center">ตำแหน่งโฆษณา</th>
                <th width="10%" class="text-center">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $paginate['start_row'];
            if (!empty($adslist)) {
                foreach ($adslist as $ads) {
            ?>
                    <tr>
                        <td class="text-center"><?= $i ?></td>
                        <td>
                            <?php
                            $img = base_url("assets/img/empty.png");
                            if (!empty($ads['ads_picture']) && filter_var(str_replace('-','',str_replace(' ', '', $ads['ads_picture'])), FILTER_VALIDATE_URL)) {
                                $img = $ads['ads_picture'];
                            } else {
                                $img = base_url($path_ads . $ads['ads_picture']);
                            }

                            // $img = base_url("/thumbnail/".$ca['masubject_picture']);
                            ?>

                            <img src="<?= $img ?>" width="200px">

                        </td>
                        <td class="text-center"><?= $ads['ads_name'] ?></td>
                        <td class="text-center"><?= $ads['ads_url'] ?></td>
                        <td class="text-center">                            
                            <?php
                                if( !empty($posads['pos']) ){
                                    foreach($posads['pos'] as $ps){                                     
                                        if ($ads['ads_position'] == $ps['value']) {
                                            echo $ps['name'].'</br>';
                                            $posimg = 'img'.$ps['value'];
                                            echo '<img id="img_ads_position" src="'.base_url($posads['img'][$posimg]).'" width="200px">';                                    
                                        }
                                    }
                                }
                            ?>
                        </td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li><a href="<?= base_url('/mangaads/branch/' . $branch_id . '/edit/id/' . $ads['ads_id']) ?>"><i class="text-primary-600 icon-pencil7"></i></a></li>
                                <li><a onclick="setDel(<?= $branch_id ?>,<?= $ads['ads_id'] ?>)"><i class="text-warning-600 icon-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
            <?php
                    $i++;
                }
            } else {
                echo '<tr><td colspan="6" class="text-center">No Data</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="text-right pb-10 pt-10">
        <?= pagination($paginate['page'], $paginate['total_page']); ?>
    </div>
</div>
<!-- /basic datatable -->

<script>
    $('#txt_search').keypress(function(e) {
        if (e.which == 13) {
            goSearch('<?= $branch_id ?>');
            return false; //<---- Add this line
        }
    });

    document.addEventListener('DOMContentLoaded', function() {

        $('.datatable-basic').DataTable();
        $(".datatable-header").css("padding-top", "0px");

        <?php helper(['alert']);
        getAlert(); ?>

    });

    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: false,
            width: '100px',
            targets: [5]
        }],
        "searching": false,
        "bFilter": false,
        "lengthChange": false,
        "bPaginate": false,
        "bLengthChange": false,
        "bInfo": false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Search:</span> _INPUT_',
            searchPlaceholder: 'Search...',
            lengthMenu: '<span>Show:</span> _MENU_',
            // paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        },
        drawCallback: function() {
            // $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            // $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    function goSearch(brid) {
        window.location.href = "/mangaads/branch/" + brid + "/index/" + $("#txt_search").val();
    }

    function goClear(brid) {
        window.location.href = "/mangaads/branch/" + brid + "/index";
    }

    function goAdd(brid) {
        window.location.href = "/mangaads/branch/" + brid + "/add";
    }

    function goEdit(brid) {
        window.location.href = "/mangaads/branch/" + brid + "/edit/id" + id;
    }

    function setDel(brid, id) {
        var msg = 'ยืนยันที่จะลบรายการนี้';

        bootbox.confirm({
            title: 'Confirm dialog',
            message: msg,
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-primary'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-link'
                }
            },
            callback: function(result) {
                if (result == true) {
                    window.location.href = "/mangaads/branch/" + brid + "/del/id/" + id;
                }
            }
        });

    }
</script>
