<?php
    // echo "<pre>";
    // print_r($cate);
    // die;
?>
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
                    <button onclick="goSearch()" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>Search</button>
                </div>
            </div>
        </form>
    <!-- </div> -->

    <table class="table datatable-basic">
        <thead>
            <tr>
                <th>#</th>
                <th width="30%">ชื่อหนัง</th>
                <th>เหตุผล</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; 
            if( !empty($reports) ){
                foreach($reports as $report){
        ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$report['movie_thname']?></td>
                    <td><?php if(!empty($report['reason'])){ echo $report['reason']; }else{ echo "-"; }?></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a onclick="goEdit('<?=$report['movie_id']?>')"><i class="text-primary-600 icon-pencil7"></i></a></li>
                            <!-- <li><a onclick="goDel('<?=$branch ?>','<?=$report['movie_id']?>')"><i class="text-danger-600 icon-trash"></i></a></li> -->
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

    $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

    function goSearch(){
        window.location.href = "/movie/branch/<?=$branch?>/report/index/"+$("#txt_search").val();
    }

    function goEdit( id ){
        window.location.href = "/video/branch/<?=$branch?>/video/edit/id/"+id;
    }



</script>