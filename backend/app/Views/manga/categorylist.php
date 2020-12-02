
<!-- Basic datatable -->
<div class="panel panel-flat table-responsive">

    <form action="#" class="main-search" style="padding: 20px 20px 0px 20px;">
        <div class="input-group content-group">
            <div class="has-feedback has-feedback-left">
                <input id="txt_search" type="text" class="form-control input-xlg" placeholder="คำค้นหา..." value="<?=$search_string?>" autocomplete="off">
                <div class="form-control-feedback">
                    <i class="icon-search4 text-muted text-size-base"></i>
                </div>
            </div>

            <div class="input-group-btn">
            <button onclick="goSearch('<?php echo $branch?>')" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>ค้นหา</button>
                <button onclick="goClear('<?php echo $branch?>')" type="button" class="btn btn-danger btn-xlg legitRipple"><i class="icon-reset text-size-base position-left"></i>เคลียร์</button>
                <button onclick="goAdd('<?php echo $branch?>')" type="button" class="btn btn-success btn-xlg legitRipple"><i class="icon-plus3 text-size-base position-left"></i>เพิ่ม</button>
            </div>
        </div>
    </form>

    <table class="table datatable-basic">
        
        <thead>
            <tr>
                <th>#</th>
                <th width="70%">หมวดหมู่</th>
                <th class="text-center">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=$paginate['start_row']; 
            if( !empty($cate) ){
                foreach($cate as $ca){
        ?>
            <tr>
                <td><?=$i?></td>
                <td><?=$ca['macategory_name']?></td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li><a onclick="goEdit('<?=$branch?>', '<?=$ca['macategory_id']?>')"><i class="text-primary-600 icon-pencil7"></i></a></li>
                        <li><a onclick="goDel('<?=$branch?>', '<?=$ca['macategory_id']?>')"><i class="text-danger-600 icon-trash"></i></a></li>
                    </ul>
                </td>
            </tr>
        <?php 
                $i++; }
            }else{
                echo '<tr><td colspan="3" class="text-center">No Data</td></tr>';
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

    $('#txt_search').keypress(function (e) {
        if (e.which == 13) {
            goSearch('<?=$branch?>');
            return false;    //<---- Add this line
        }
    });

    function goSearch(branch){
        window.location.href = "/manga/branch/"+branch+"/category/index/"+$("#txt_search").val();
    }

    function goClear(branch){
        window.location.href = "/manga/branch/"+branch+"/category/index";
    }

    function goAdd(branch){
        window.location.href = "/manga/branch/"+branch+"/category/add";
    }

    function goEdit( branch,id ){
        window.location.href = "/manga/branch/"+branch+"/category/edit/id/"+id;
    }
    
    function goDel( branch,id ){
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
                    window.location.href = "/manga/branch/"+branch+"/category/del/id/"+id;
                }
            }
        });
        
    }

</script>