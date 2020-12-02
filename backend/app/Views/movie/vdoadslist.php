<!-- Basic datatable -->
<div class="panel panel-flat table-responsive">

    <!-- <div class="panel-body"> -->
        <form action="#" class="main-search" style="padding: 20px 20px 0px 20px;">
            <div class="input-group content-group">
                <div class="has-feedback has-feedback-left">
                    <input id="txt_search" type="text" class="form-control input-xlg" placeholder="Search..." value="<?=$search_string?>" autocomplete="off">
                    <div class="form-control-feedback">
                        <i class="icon-search4 text-muted text-size-base"></i>
                    </div>
                </div>

                <div class="input-group-btn">
                    <button onclick="goSearch('<?php echo $branch?>')" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>Search</button>
                    <button onclick="goClear('<?php echo $branch?>')" type="button" class="btn btn-danger btn-xlg legitRipple"><i class="icon-reset text-size-base position-left"></i>Clear</button>
                    <button onclick="goAdd('<?php echo $branch?>')" type="button" class="btn btn-success btn-xlg legitRipple"><i class="icon-plus3 text-size-base position-left"></i>Add</button>
                </div>
            </div>
        </form>
    <!-- </div> -->

    <table class="table datatable-basic">
        
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>  Video</th>
                <th>URL</th>
                <th>Skip Time</th>
                <th>Status</th>
                <th class="text-center" width="10%">Actions</th>
            </tr>
        </thead>
        
        <tbody>
        <?php $i=$adsvdo['start_row']; 
            if( !empty($adsvdo['list']) ){
                foreach($adsvdo['list'] as $list){
        ?>
            <tr>
                <td><?=$i?></td>
                <td><?=$list['adsvideo_name']?></td>

                <td>    
                    <video id="video1" width="220" controls>
                    <source src="<?= base_url($filepath.$list['adsvideo_video'])?>" type="video/mp4">
                    </video>
                </td>

                <td><?=$list['adsvideo_url']?></td>
                <td><?=$list['adsvideo_skip']?></td>
                <td>
                <?php
                    $status = '<span class="label label-success">Active</span>';
                    if ($list['adsvideo_status']=="0") {
                        $status = '<span class="label label-danger">Inactive</span>';
                    }

                    echo $status;

                ?>
                </td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li><a onclick="goEdit('<?=$branch?>','<?=$list['adsvideo_id']?>')"><i class="text-primary-600 icon-pencil7"></i></a></li>
                        <li><a onclick="goDel('<?=$branch?>','<?=$list['adsvideo_id']?>')"><i class="text-danger-600 icon-trash"></i></a></li>
                    </ul>
                </td>
            </tr>
        <?php
               $i++; }
            }else{
                echo '<tr><td colspan="7" class="text-center">No Data</td></tr>';
            }
        ?>
        </tbody>
    </table>

    <div class="text-right pb-10 pt-10">
        <?= pagination($adsvdo['page'], $adsvdo['total_page']); ?>
    </div>
</div>
<!-- /basic datatable -->

<script>

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

    $('#txt_search').keypress(function (e) {
        if (e.which == 13) {
            goSearch('<?=$branch?>');
            return false;    //<---- Add this line
        }
    });

    function goSearch(branch){
        window.location.href = "/vdoads/branch/"+branch+"/index/"+$("#txt_search").val();
    }

    function goClear(branch){
        window.location.href = "/vdoads/branch/"+branch+"/index";
    }

    function goAdd(branch){
        window.location.href = "/vdoads/branch/"+branch+"/add";
    }

    function goEdit( branch, id){
        window.location.href = "/vdoads/branch/"+branch+"/edit/id/"+id;
    }

    function goDel( branch, id ){
        window.location.href = "/vdoads/branch/"+branch+"/del/id/"+id;
    }

</script>