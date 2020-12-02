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
                    <input id="txt_search" type="text" class="form-control input-xlg" placeholder="Search..." value="<?= $search_string ?>" autocomplete="off">
                    <div class="form-control-feedback">
                        <i class="icon-search4 text-muted text-size-base"></i>
                    </div>
                </div>

                <div class="input-group-btn">
                    <button onclick="goSearch()" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>Search</button>
                    <button onclick="goClear()" type="button" class="btn btn-danger btn-xlg legitRipple"><i class="icon-reset text-size-base position-left"></i>Clear</button>
                </div>
            </div>
        </form>
    <!-- </div> -->

    <table class="table datatable-basic">
        
        <thead>
            <tr>
                <th>#</th>
                <th class="text-center">ชื่อ</th>
                <th class="text-center">E-mail</th>
                <th class="text-center">Line</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=$requestads['start_row']; 
            if( !empty($requestads['list']) ){
                foreach($requestads['list'] as $ca){
        ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$ca['mo_adscontact_namesurname']?></td>
                    <td><?=$ca['mo_adscontact_email']?></td>
                    <td><?=$ca['mo_adscontact_lineid']?></td>
                    <td><?=$ca['mo_adscontact_phone']?></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a onclick="goDel('<?=$branch ?>','<?=$ca['mo_adscontact_id']?>')"><i class="text-danger-600 icon-trash"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <?php 
                    $i++;
                }
            } 
            else{
                echo '<tr><td colspan="6" class="text-center">No Data</td></tr>';
            }
            ?>
        </tbody>
    </table>
    <div class="text-right pb-10 pt-10">
        <?= pagination($requestads['page'], $requestads['total_page']); ?>
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

        <?php helper(['alert']);getAlert(); ?>

        // $('.datatable-basic').DataTable();
        $(".datatable-header").css("padding-top", "0px");

    });

    

    function goSearch(){
        window.location.href = "/movie/requestads/branch/"+<?= $branch ?>+"/search/"+$("#txt_search").val();
    }

    function goClear(){
        window.location.href = "/movie/requestads/branch/"+<?= $branch ?>;
    }

   

    function goDel(branch,id){
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
        callback: function (result) {
            if (result==true) {
                window.location.href = "/movie/requestads/branch/"+branch+"/del_requestads/"+id;
            }
        }
    });

}

</script>