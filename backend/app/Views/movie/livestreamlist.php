<?php
// echo "<pre>";
// print_r($cate);die;
// print_r($url_service);
?>
<!-- Basic datatable -->
<div class="panel panel-flat table-responsive">

    <!-- <div class="panel-body"> -->
    <form action="#" class="main-search" style="padding: 20px 20px 0px 20px;">
        <div class="input-group content-group">
            <div class="has-feedback has-feedback-left">
                <input id="txt_search" type="text" class="form-control input-xlg" placeholder="Search..." value="<?= $search_string ?>" autocomplete="off">
                <div class="form-control-feedback">
                    <i class="icon-search4 text-muted text-size-base"></i>
                </div>
            </div>

            <div class="input-group-btn">
                <button onclick="goSearch(<?= $branch ?>)" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>Search</button>
                <button onclick="goClear()" type="button" class="btn btn-danger btn-xlg legitRipple"><i class="icon-reset text-size-base position-left"></i>Clear</button>
                <button onclick="goAdd()" type="button" class="btn btn-success btn-xlg legitRipple"><i class="icon-plus3 text-size-base position-left"></i>Add</button>
            </div>
        </div>
    </form>
    <!-- </div> -->

    <table class="table datatable-basic">

        <thead>
            <tr>
                <th class="text-center" width="8%">#</th>
                <th width="15%">รูปภาพ</th>
                <th class="text-center" width="20%">ชื่อไลฟ์สตรีม(Titel)</th>
                <th width="10%">URL</th>
                <th width="10%">สถานะ</th>
                <th width="10%">สาขา</th>
                <th class="text-center">Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = $paginate['start_row'];
            if (!empty($cate)) {
                foreach ($cate as $ca) {


                    $check_link = substr($ca['livestream_img'], 0, 4);
            ?>
                    <tr>
                        <td class="text-center"><?= $i ?></td>
                        <td>
                            <?php
                            $logo = $ca['livestream_img'];
                            if ($check_link != "http") {
                                $logo = base_url($filepath . $ca['livestream_img']);
                            }
                            ?>

                            <img src='<?= $logo ?>' alt="" height="130px;">
                        </td>
                        <td><?= $ca['livestream_name'] ?></td>
                        <td><?= $ca['livestream_url'] ?></td>
                        <td><?php if ($ca['livestream_status'] == 1) {
                                echo "เปิดการใช้งาน";
                            } else if ($ca['livestream_status'] == 0) {
                                echo "ปิดการใช้งาน";
                            } ?></td>
                        <td><?= $ca['branch_id'] ?></td>

                        <td class="text-center">
                            <ul class="icons-list">
                                <li><a onclick="goEdit('<?= $ca['branch_id'] ?>','<?= $ca['livestream_id'] ?>')"><i class="text-primary-600 icon-pencil7"></i></a></li>
                                <li><a onclick="goDel('<?= $branch ?>','<?= $ca['livestream_id'] ?>')"><i class="text-danger-600 icon-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
            <?php
                    $i++;
                }
            } else {
                echo '<tr><td colspan="10" class="text-center">No Data</td></tr>';
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
    document.addEventListener('DOMContentLoaded', function() {
        <?php helper(['alert']);getAlert(); ?>
    });

    $('#txt_search').keypress(function(e) {
        if (e.which == 13) {
            goSearch(<?php echo $branch; ?>);
            return false; //<---- Add this line
        }
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

    function goSearch(branch) {
        window.location.href = "/video/branch/" + <?= $branch ?> + "/livestream/index/" + $("#txt_search").val();
    }

    function goClear() {
        window.location.href = "/video/branch/" + <?= $branch ?> + "/livestream/index";
    }

    function goAdd() {
        window.location.href = "/video/branch/" + <?= $branch ?> + "/livestream/add";
    }

    function goEdit(branch, id) {
        window.location.href = "/video/branch/" + <?= $branch ?> + "/livestream/edit/id/" + id;

    }

    function goDel(branch, id) {
        //console.log(id);
        bootbox.confirm({
            title: 'Confirm dialog',
            message: 'ยืนยันที่จะลบรายการนี้',
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
                    window.location.href = "/video/branch/" + branch + "/livestream/del_livestream/id/" + id;
                }
            }
        });

    }
</script>