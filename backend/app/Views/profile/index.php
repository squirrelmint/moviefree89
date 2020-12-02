
<!-- Basic datatable -->
<div class="panel panel-flat table-responsive">

    <!-- <div class="panel-body"> -->
        <form class="main-search" style="padding: 20px 20px 0px 20px;">
            <div class="input-group content-group">
                <div class="has-feedback has-feedback-left">
                    <input id="txt_search" type="text" class="form-control input-xlg" placeholder="Search..." value="<?= $search_string ?>" autocomplete="off">
                    <div class="form-control-feedback">
                        <i class="icon-search4 text-muted text-size-base"></i>
                    </div>
                </div>

                <div class="input-group-btn">
                    <button onclick="goSearch()" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>Search</button>
                    <button onclick="goClear()" type="button" class="btn btn-danger btn-xlg legitRipple"><i class="icon-reset text-size-base position-left"></i>Clear</button>
                    <button onclick="goAdd()" type="button" class="btn btn-success btn-xlg legitRipple"><i class="icon-plus3 text-size-base position-left"></i>Add</button>
                </div>
            </div>
        </form>
    <!-- </div> -->

    <table class="table datatable-basic">
        
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=$paginate['start_row']; 
            foreach ($userdata as $key => $value) { 
                $status = '<span class="label label-success">Active</span>';

                if ($value['user_status']=="0") {
                    $status = '<span class="label label-danger">In-Active</span>';
                }
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $value['user_name'] ?></td>
                <td><?= $value['user_label'] ?></td>
                <td><?= $value['user_email'] ?></td>
                <td><?= $value['user_tel'] ?></td>
                <td><?= $status ?></td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li><a href="<?= base_url('profile/edit/') ?>/<?= $value['user_id'] ?>"><i class="text-primary-600 icon-pencil7"></i></a></li>
                        <?php  if ($value['user_status']=="0") { ?>
                            <li><a onclick="setUnDel(<?= $value['user_id'] ?>)"><i class="text-success-600 icon-user-check"></i></a></li>
                        <?php }else{ ?>
                            <li><a onclick="setDel(<?= $value['user_id'] ?>)"><i class="text-danger-600 icon-user-lock"></i></a></li>
                        <?php } ?>
                    </ul>
                </td>
            </tr>
        <?php $i++; } ?>
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
            goSearch();
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

    function goSearch(){

        console.log("/profile/index/"+$("#txt_search").val());
        
        window.location.href = "/profile/index/"+$("#txt_search").val();

    }

    function goClear(){
        
        window.location.href = "/profile/index";

    }

    function goAdd(){
        
        window.location.href = "/profile/add";

    }

    function setDel(id){

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
            callback: function (result) {
                if (result==true) {
                    window.location.href = "/profile/savedelete/"+id;
                }
            }
        });

    }

    function setUnDel(id){

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
                    window.location.href = "/profile/saveundelete/"+id;
                }
            }
        });

    }

</script>