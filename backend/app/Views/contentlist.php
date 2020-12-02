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
                <th width="15%">ชื่อเนื้อหา</th>
                <th class="text-center" width="20%">ภาพประกอบ</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $paginate['start_row'];
            if (!empty($data)) {
                foreach ($data as $ca) {


                    $check_link = substr($ca['content_thumbnail'], 0, 4);
            ?>
                    <tr>
                        <td class="text-center"><?= $i ?></td>
                        <td><?= $ca['content_head'] ?></td>
                        <td>
                            <?php
                            $logo = $ca['content_thumbnail'];
                            if ($check_link != "http") {
                                $logo = base_url($filepath . $ca['content_thumbnail']);
                            }
                            ?>

                            <img src='<?= $logo ?>' alt="" height="130px;">
                        </td>
                        
                        <td class="text-center">
                            <ul class="icons-list">
                                <li><a onclick="goEdit('<?= $ca['branch_id'] ?>','<?= $ca['content_id'] ?>')"><i class="text-primary-600 icon-pencil7"></i></a></li>
                                <li><a onclick="goDel('<?= $branch ?>','<?= $ca['content_id'] ?>')"><i class="text-danger-600 icon-trash"></i></a></li>
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
    function goSearch(branch) {
        window.location.href = "/content/branch/" + <?= $branch ?>+"/content/index/"+ $("#txt_search").val();
    }

    function goClear() {
        window.location.href = "/content/branch/" + <?= $branch ?>+"/content/index";
    }

    function goAdd() {
        window.location.href = "/content/branch/" + <?= $branch ?> + "/content/add";
    }

    function goEdit(branch, id) {
        window.location.href = "/content/branch/" + <?= $branch ?> + "/content/edit/id/" + id;

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
                    window.location.href = "/content/branch/" + branch + "/content/delete/id/" + id;
                }
            }
        });

    }
</script>