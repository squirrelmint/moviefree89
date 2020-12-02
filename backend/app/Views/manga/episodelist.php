
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
                    <button onclick="goSearch('<?=$manga_id?>')" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>ค้นหา</button>
                    <button onclick="goClear('<?=$manga_id?>')" type="button" class="btn btn-danger btn-xlg legitRipple"><i class="icon-reset text-size-base position-left"></i>เคลียร์</button>
                    <button onclick="goAdd('<?=$manga_id?>')" type="button" class="btn btn-success btn-xlg legitRipple"><i class="icon-plus3 text-size-base position-left"></i>เพิ่ม</button>
                </div>
            </div>
        </form>
    <!-- </div> -->

    <table class="table datatable-basic">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th class="text-center">ชื่อตอนมังงะภาษาอังกฤษ (EN)</th>
                <th class="text-center">ชื่อตอนมังงะภาษาไทย (TH)</th>
                <th class="text-center">จำนวนผู้เข้าชม</th>
                <th class="text-center">วันที่ลง</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=$paginate['start_row']; 
            if( !empty($mangaep) ){
                foreach ($mangaep as $ep) {
        ?>
            <tr>
                <td><?=$i?></td>
                <td><?=$ep['maepisode_name_eng']?></td>
                <td><?=$ep['maepisode_name_thai']?></td>
                <td class="text-center"><?=$ep['maepisode_read']?></td>
                <td class="text-center"><?=$ep['public_date']?></td>
                <td class="text-center">
                <?php
                    $status = '<span class="label label-success">แสดง</span>';
                    if ($ep['maepisode_status']=="0") {
                        $status = '<span class="label label-danger">ไม่แสดง</span>';
                    }

                    echo $status;

                ?>
                </td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li><a href="<?= base_url('/manga/'.$manga_id.'/episode/edit/id/'.$ep['maepisode_id']) ?>"><i class="text-primary-600 icon-pencil7"></i></a></li>
                        
                        <?php  if ($ep['maepisode_status']=="1") { ?>
                            <li><a onclick="setDel(<?=$manga_id?>,<?=$ep['maepisode_id']?>, 1)"><i class="text-danger-600  icon-lock2"></i></a></li>
                        <?php }else{ ?>
                            <li><a onclick="setUnDel(<?=$manga_id?>,<?=$ep['maepisode_id']?>)"><i class="text-success-600  icon-unlocked"></i></a></li>
                        <?php } ?>

                        <?php  if ($ep['maepisode_status']=="0") { ?>
                            <li><a onclick="setDel(<?=$manga_id?>,<?=$ep['maepisode_id']?>, 0)"><i class="text-warning-600 icon-trash"></i></a></li>
                        <?php } ?>
                        
                    </ul>
                </td>
            </tr>
        <?php
                $i++;}
            }else{
                echo '<tr><td colspan="7" class="text-center">No Data</td></tr>';
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

    $('#txt_search').keypress(function (e) {
        if (e.which == 13) {
            goSearch('<?=$manga_id?>');
            return false;    //<---- Add this line
        }
    });

    document.addEventListener('DOMContentLoaded', function() {

        $('.datatable-basic').DataTable();
        $(".datatable-header").css("padding-top", "0px");

        <?php helper(['alert']);getAlert(); ?>

    });

    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],
        "searching": false,
        "bFilter" : false, 
        "lengthChange": false, 
        "bPaginate":false,             
        "bLengthChange": false,
        "bInfo": false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Search:</span> _INPUT_',
            searchPlaceholder: 'Search...',
            lengthMenu: '<span>Show:</span> _MENU_',
            // paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        },
        drawCallback: function () {
            // $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            // $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    function goSearch(maid){
        window.location.href = "/manga/"+maid+"/episode/index/"+$("#txt_search").val();
    }

    function goClear(maid){
        window.location.href = "/manga/"+maid+"/episode/index";
    }

    function goAdd(maid){
        window.location.href = "/manga/"+maid+"/episode/add";
    }

    function goEdit( maid, id ){
        window.location.href = "/manga/"+maid+"/episode/edit/id"+id;
    }

    function setDel( maid, id, action ){
        var msg = 'ยืนยันที่จะลบรายการนี้';
        if(action==true){
            msg = 'ยืนยันที่จะปิดการใช้งานรายการนี้';
        }

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
            callback: function (result) {
                if (result==true) {
                    window.location.href = "/manga/"+maid+"/episode/del/id/"+id+"/action/"+action;
                }
            }
        });
        
    }

    function setUnDel( maid, id ){
        bootbox.confirm({
            title: 'Confirm dialog',
            message: 'ยืนยันที่จะกู้รายการนี้',
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
            callback: function (result) {
                if (result==true) {
                    window.location.href = "/manga/"+maid+"/episode/undel/id/"+id;
                }
            }
        });
        
    }

</script>