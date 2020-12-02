<?php
    // echo "<pre>";
    // print_r($cate);
    // die;
?>
<!-- Basic datatable -->
<div class="panel panel-flat table-responsive">

    <table class="table datatable-basic">
        <thead>
            <tr>
                <th>#</th>
                <th width="60%">หนังที่ขอ</th>
                <th width="20%">วันที่</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; 
            if( !empty($requests) ){
                foreach($requests as $request){
        ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$request['mo_request']?></td>
                    <td><?=$request['requestdate']?></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a onclick="goDel('<?=$branch?>','<?=$request['mo_request_id']?>')"><i class="text-danger-600 icon-trash"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <?php 
                    $i++;
                }
            } 
            else{
                echo '<tr><td colspan="3" class="text-center">No Data</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<!-- /basic datatable -->
<script>

    document.addEventListener('DOMContentLoaded', function() {

        <?php helper(['alert']);getAlert(); ?>

        $('.datatable-basic').DataTable();
        $(".datatable-header").css("padding-top", "0px");

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

    function goDel( branch, id ){
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
                    window.location.href = "/movie/branch/"+branch+"/request/del/id/"+id;
                }
            }
        });
        
    }



</script>