<!-- Basic datatable -->
<div class="panel panel-flat table-responsive">

    <!-- <div class="panel-body"> -->
        <form action="#" class="main-search" style="padding: 20px 20px 0px 20px;">
            <div class="input-group content-group">
                <div class="has-feedback has-feedback-left">
                    <input id="txt_search" type="text" class="form-control input-xlg" placeholder="Search..." value="" autocomplete="off">
                    <div class="form-control-feedback">
                        <i class="icon-search4 text-muted text-size-base"></i>
                    </div>
                </div>

                <div class="input-group-btn">
                    <button onclick="goSearch()" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>ค้นหา</button>
                </div>
            </div>
        </form>
    <!-- </div> -->

    <table class="table datatable-basic">

        <thead>
            <tr>
                <th width="10%">#</th>
                <th width="30%">ชื่อมังงะ</th>
                <th width="30%">IP</th>
                <th width="20%">วันที่ขอ</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; 
            if( !empty($requests) ){
                foreach($requests as $request){
        ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=urldecode($request['marequest_manga'])?></td>
                    <td><?=$request['marequest_ip']?></td>
                    <td><?=$request['marequest_datetime']?></td>
                </tr>
                <?php 
                    $i++;
                }
            } 
            else{
                echo '<tr><td colspan="4" class="text-center">No Data</td></tr>';
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

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
        event.preventDefault();
        return false;
        }
    });

    function goSearch(){
        window.location.href = "/manga/branch/<?=$branch?>/request/index/"+$("#txt_search").val();
    }

    function goDel15(branch, id){
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
                    window.location.href = "/manga/branch/"+branch+"/request/del/"+id;
                }
            }
        });
    }



</script> 
