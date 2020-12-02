<style>

    .home-box{

        height:200px;

        background-position-y:100%;

        background-repeat:no-repeat;

        background-size:cover;

        background-position:center;

        background-color:#000

    }

</style>



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

                    <button onclick="goSearch('<?php echo $branch?>')" type="button" class="btn btn-primary btn-xlg legitRipple"><i class="icon-search4 text-size-base position-left"></i>ค้นหา</button>

                    <button onclick="goClear('<?php echo $branch?>')" type="button" class="btn btn-danger btn-xlg legitRipple"><i class="icon-reset text-size-base position-left"></i>เคลียร์</button>

                    <button onclick="goAdd('<?php echo $branch?>')" type="button" class="btn btn-success btn-xlg legitRipple"><i class="icon-plus3 text-size-base position-left"></i>เพิ่ม</button>

                </div>

            </div>

        </form>

    <!-- </div> -->



    <table class="table datatable-basic">

        

        <thead>

            <tr>

                <th>#</th>

                <th width="10%" class="text-center">รูปภาพ</th>

                <th >ชื่อมังงะ</th>

                <th width="20%">วันที่ลง</th>

                <th width="5%">สถานะ</th>

                <th class="text-center" width="20%">การจัดการ</th>

            </tr>

        </thead>

        <tbody>

        <?php $i=$paginate['start_row']; 

            if( !empty($manga) ){

                foreach($manga as $ca){

        ?>

            <tr>

                <td><?=$i?></td>

                <td class="text-center">

                <?php

                    $img = base_url("assets/img/empty.png");

                    if( !empty($ca['masubject_picture']) && filter_var(str_replace('-', '',str_replace(' ', '', $ca['masubject_picture'])), FILTER_VALIDATE_URL)  ){

                        $img = $ca['masubject_picture'];

                    }else{

                        $img = base_url($path_macover."/".$ca['masubject_picture']);

                    }



                    // $img = base_url("/thumbnail/".$ca['masubject_picture']);

                ?>

                    <img src="<?= $img ?>" width="100%">

                </td>

                <td><?=$ca['masubject_name_eng']?></td>

                <td><?=$ca['masubject_create_datetime']?></td>

                <td>

                <?php

                    $status = '<span class="label label-success">แสดง</span>';

                    if ($ca['masubject_status']=="0") {

                        $status = '<span class="label label-danger">ไม่แสดง</span>';

                    }



                    echo $status;



                ?>

                </td>

                <td class="text-center">

                    <ul class="icons-list">

                        <li><a onclick="goView('<?=$branch?>', '<?=$ca['masubject_id']?>')"><i class="text-success-600 icon-eye"></i></a></li>

                        <li><a onclick="goEdit('<?=$branch?>', '<?=$ca['masubject_id']?>')"><i class="text-primary-600 icon-pencil7"></i></a></li>

                        <li><a onclick="goDel('<?=$branch?>', '<?=$ca['masubject_id']?>')"><i class="text-danger-600 icon-trash"></i></a></li>

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

        <?= pagination($paginate['page'], $paginate['total_page']); ?>

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
        
        window.location.href = "/manga/branch/"+branch+"/subject/index/"+$("#txt_search").val();

    }



    function goClear(branch){

        window.location.href = "/manga/branch/"+branch+"/subject/index";

    }



    function goAdd(branch){

        window.location.href = "/manga/branch/"+branch+"/subject/add";

    }



    function goView( branch,id ){

        window.location.href = "/manga/"+id+"/episode/index";

    }



    function goEdit( branch,id ){

        window.location.href = "/manga/branch/"+branch+"/subject/edit/id/"+id;

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

                    window.location.href = "/manga/branch/"+branch+"/subject/del/id/"+id;

                }

            }

        });

        

    }



</script>