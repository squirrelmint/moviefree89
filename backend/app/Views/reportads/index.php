<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">ค้นหาแบบระบุ<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <form  action="" class="main-search">
            <div class="input-group content-group">
                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                <input type="text" class="form-control daterange-basic" id="daterange" value="<?=$daterange?>"> 
                <div class="input-group-btn">
                    <button onclick="goSearch('<?=$branch_id?>')" type="button" class="btn btn-primary btn-xlg legitRipple">ค้นหา</button>
                    <button onclick="goClear('<?=$branch_id?>')" type="button" class="btn btn-default btn-xlg legitRipple">เคลียร์</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">รายงานโฆษณา<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
        <div class="heading-elements">
            <?php if( !empty($count) ){ ?><span class="label bg-success heading-text"><?=$count?>  รายการ</span><?php } ?>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-lg text-nowrap">
            <tbody>
                <tr>
                    <td class="col-md-5">
                        <div class="media-left">
                        <div id="campaigns-donut-plus"></div>
                        </div>

                        <div class="media-left" style="vertical-align: middle;">
                            <h5 class="text-semibold no-margin"><?=$count?> ครั้ง <small class="text-success text-size-base">
                            <?php
                                $percent = 0;
                                if( $lcount < $count ){
                                    $compare = $count - $lcount;
                                    if(empty($lcount)){ $lcount = 1;}
                                    $divide = $compare / $lcount;
                                    $percent = $divide * 100;
                                    $icon = "icon-arrow-up12";
                                }else{
                                    $compare = $lcount - $count;
                                    if(empty($count)){ $count = 1;}
                                    $divide = $compare / $count;
                                    $percent = $divide * 100;
                                    $icon = "icon-arrow-down12";
                                }
                            ?>
                                <i class="<?=$icon?>"></i> (+<?=$percent?>%)</small>
                            </h5>
                            <ul class="list-inline list-inline-condensed no-margin">
                                <li>
                                    <span class="status-mark border-success"></span>
                                </li>
                                <li>
                                    <span class="text-muted"><?=$daterange?></span>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td class="col-md-5">
                    <?php
                        if( !empty(json_decode($chart_lm)) ){
                    ?>
                        <div class="media-left">
                            <div id="campaigns-donut-negative"></div>
                        </div>

                        <div class="media-left" style="vertical-align: middle;">
                            <h5 class="text-semibold no-margin"><?=$lcount?> ครั้ง <small class="text-danger text-size-base">
                            <!-- <i class="icon-arrow-down12"></i> (- 4.9%)</small> -->
                            </h5>
                            <ul class="list-inline list-inline-condensed no-margin">
                                <li>
                                    <span class="status-mark border-danger"></span>
                                </li>
                                <li>
                                    <span class="text-muted"><?=$ldaterange?></span>
                                </li>
                            </ul>
                        </div>
                    <?php
                        }
                    ?>
                    </td>

                    <!-- <td class="text-right col-md-2">
                        <a href="#" class="btn bg-success legitRipple"><i class="icon-statistics position-left"></i> สถิติ</a>
                    </td> -->
                </tr>
            </tbody>
        </table>	
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap">
            <thead>
                <tr>
                    <th>โฆษณา</th>
                    <th class="col-md-2">วันที่ - เวลา</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if( !empty($report) ){

                    $cthisweek = 0;
                    $clastweek = 0;
                    $checkm = '';

                    $datesub = date_create(date('Y-m-d'));
                    date_sub($datesub,date_interval_create_from_date_string("1 days"));
                    $datesub =  date_format($datesub,"Y-m-d");

                    $firstday = date("Y-m-d", strtotime('sunday last week'));  
                    $lastday = date("Y-m-d", strtotime('sunday this week'));

                    foreach( $report as $krp => $rp ){

                        if( date('Y-m-d') == $krp ){
            ?>
                <tr class="active border-double">
                    <td>วันนี้</td>
                    <td class="text-right">
                        <span class="progress-meter" id="today-progress" data-progress="30"></span>
                    </td>
                </tr>
            <?php           foreach( $rp as $val ){ ?>
                <tr>
                    <td>
                        <div class="media-left media-middle">
                            <span class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom legitRipple">
                                <i class="icon-chess-king"></i>
                            </span>
                        </div>
                        <div class="media-left">
                            <div class="text-default text-semibold"><?=$val['ads_name']?></div>
                            <div class="text-muted text-size-small">
                                <span class="status-mark border-blue position-left"></span>
                                <?=$val['ads_url']?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <!-- <span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 2.43%</span> -->
                        <?php 
                            $reportdate = date_create($val['reportads_datetime']);
                            echo date_format($reportdate, 'd M Y H:i'); 
                        ?>
                    </td>
                    <!-- <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-file-stats"></i> ประวัติ</a></li>
                                </ul>
                            </li>
                        </ul>
                    </td> -->
                </tr>
            <?php 
                            }
                        }else
                        if( $datesub == $krp ){
            ?>
                <tr class="active border-double">
                    <td>เมื่อวาน</td>
                    <td class="text-right">
                        <span class="progress-meter" id="today-progress" data-progress="30"></span>
                    </td>
                </tr>
            
            <?php           foreach( $rp as $val ){ ?>
                <tr>
                    <td>
                        <div class="media-left media-middle">
                            <span class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom legitRipple">
                                <i class="icon-chess-king"></i>
                            </span>
                        </div>
                        <div class="media-left">
                            <div class="text-default text-semibold"><?=$val['ads_name']?></div>
                            <div class="text-muted text-size-small">
                                <span class="status-mark border-blue position-left"></span>
                                <?=$val['ads_url']?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php 
                            $reportdate = date_create($val['reportads_datetime']);
                            echo date_format($reportdate, 'd M Y H:i'); 
                        ?>
                    </td>
                </tr>
            <?php
                            }
                        }else
                        if( $krp > $firstday && $krp < $lastday ){

                            if( $cthisweek == 0  ){
            ?>
                <tr class="active border-double">
                    <td>สัปดาห์นี้</td>
                    <td class="text-right">
                        <span class="progress-meter" id="today-progress" data-progress="30"></span>
                    </td>
                </tr>
            <?php
                                $cthisweek++;
                            }

                            foreach( $rp as $val ){
            ?>
                <tr>
                    <td>
                        <div class="media-left media-middle">
                            <span class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom legitRipple">
                                <i class="icon-chess-king"></i>
                            </span>
                        </div>
                        <div class="media-left">
                            <div class="text-default text-semibold"><?=$val['ads_name']?></div>
                            <div class="text-muted text-size-small">
                                <span class="status-mark border-blue position-left"></span>
                                <?=$val['ads_url']?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php 
                            $reportdate = date_create($val['reportads_datetime']);
                            echo date_format($reportdate, 'd M Y H:i'); 
                        ?>
                    </td>
                </tr>
            <?php
                            }

                        }else if( date('m') == date_format(date_create($krp), 'm') ){
                            if( $clastweek == 0  ){
            ?>
                <tr class="active border-double">
                    <td>สัปดาห์ที่ผ่านมา</td>
                    <td class="text-right">
                        <span class="progress-meter" id="today-progress" data-progress="30"></span>
                    </td>
                </tr>
            <?php
                                $clastweek++;
                            }

                            foreach( $rp as $val ){
            ?>
                <tr>
                    <td>
                        <div class="media-left media-middle">
                            <span class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom legitRipple">
                                <i class="icon-chess-king"></i>
                            </span>
                        </div>
                        <div class="media-left">
                            <div class="text-default text-semibold"><?=$val['ads_name']?></div>
                            <div class="text-muted text-size-small">
                                <span class="status-mark border-blue position-left"></span>
                                <?=$val['ads_url']?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php 
                            $reportdate = date_create($val['reportads_datetime']);
                            echo date_format($reportdate, 'd M Y H:i'); 
                        ?>
                    </td>
                </tr>
            <?php
                            }



                        }else{

                            if($checkm != date_format(date_create($krp), 'm')){
            ?>
                <tr class="active border-double">
                    <td colspan="2">เดือน <?=$monththai[date_format(date_create($krp), 'n')]?></td>
                    <td class="text-right">
                        <span class="progress-meter" id="today-progress" data-progress="30"></span>
                    </td>
                </tr>
            <?php
                                $checkm = date_format(date_create($krp), 'm');
                            }

                            foreach( $rp as $val ){
            ?>
                <tr>
                    <td>
                        <div class="media-left media-middle">
                            <span class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom legitRipple">
                                <i class="icon-chess-king"></i>
                            </span>
                        </div>
                        <div class="media-left">
                            <div class="text-default text-semibold"><?=$val['ads_name']?></div>
                            <div class="text-muted text-size-small">
                                <span class="status-mark border-blue position-left"></span>
                                <?=$val['ads_url']?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php 
                            $reportdate = date_create($val['reportads_datetime']);
                            echo date_format($reportdate, 'd M Y H:i'); 
                        ?>
                    </td>
                </tr>

            <?php
                            }

                        }
                        
                    }
                }else{ 
            ?>
                <tr class="active border-double">
                    <td colspan="3" class="text-center">ไม่มีข้อมูล</td>
                </tr>
            <?php } ?>
                
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo base_url('/global_assets/js/plugins/visualization/d3/d3.min.js');?>"></script>
<script src="<?php echo base_url('/global_assets/js/plugins/visualization/d3/d3_tooltip.js');?>"></script>
<script src="<?php echo base_url('/global_assets/js/plugins/ui/moment/moment.min.js')?>"></script>
<script src="<?php echo base_url('/global_assets/js/plugins/pickers/daterangepicker.js')?>"></script>

<script>

document.addEventListener('DOMContentLoaded', function() { 

        $('.daterange-basic').daterangepicker({
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default',
            locale: {
                format: 'DD-MM-YYYY',
            }
        });

        campaignDonut("#campaigns-donut-plus", 100, 'cr');
        campaignDonut("#campaigns-donut-negative", 100, 'lm');  

        // Chart setup
        function campaignDonut(element, size, get) {

            // Basic setup
            // ------------------------------
            
            // Add data set
            var data = <?=$chart_cr?>;
            if( get == 'lm'){
                data = <?=$chart_lm?>;
            }
        

            // Main variables
            var d3Container = d3.select(element),
                distance = 2, // reserve 2px space for mouseover arc moving
                radius = (size/2) - distance,
                sum = d3.sum(data, function(d) { return d.value; })



            // Tooltip
            // ------------------------------

            var tip = d3.tip()
                .attr('class', 'd3-tip')
                .offset([-10, 0])
                .direction('e')
                .html(function (d) {
                    return "<ul class='list-unstyled mb-5'>" +
                        "<li>" + "<div class='text-size-base mb-5 mt-5'><i class='icon-sphere position-left'></i> " + d.data.ads + "</div>" + "</li>" +
                        "<li>" + "เยี่ยมชม: &nbsp;" + "<span class='text-semibold pull-right'>" + d.value + "</span>" + "</li>" +
                        "<li>" + "สถิติ: &nbsp;" + "<span class='text-semibold pull-right'>" + (100 / (sum / d.value)).toFixed(2) + "%" + "</span>" + "</li>" +
                    "</ul>";
                })



            // Create chart
            // ------------------------------

            // Add svg element
            var container = d3Container.append("svg").call(tip);

            // Add SVG group
            var svg = container
                .attr("width", size)
                .attr("height", size)
                .append("g")
                    .attr("transform", "translate(" + (size / 2) + "," + (size / 2) + ")");  



            // Construct chart layout
            // ------------------------------

            // Pie
            var pie = d3.layout.pie()
                .sort(null)
                .startAngle(Math.PI)
                .endAngle(3 * Math.PI)
                .value(function (d) { 
                    return d.value;
                }); 

            // Arc
            var arc = d3.svg.arc()
                .outerRadius(radius)
                .innerRadius(radius / 2);



            //
            // Append chart elements
            //

            // Group chart elements
            var arcGroup = svg.selectAll(".d3-arc")
                .data(pie(data))
                .enter()
                .append("g") 
                    .attr("class", "d3-arc")
                    .style('stroke', '#fff')
                    .style('cursor', 'pointer');

            // Append path
            var datacolor = [ "#66BB6A", "#9575CD", "#FF7043", "#03a9f4", "#f44336", "#888", "#ec407a", "#009688" ];
            var arcPath = arcGroup
                .append("path")
                .style("fill", function (d) { return datacolor[d.data.color]; });

            // Add tooltip
            arcPath
                .on('mouseover', function (d, i) {

                    // Transition on mouseover
                    d3.select(this)
                    .transition()
                        .duration(500)
                        .ease('elastic')
                        .attr('transform', function (d) {
                            d.midAngle = ((d.endAngle - d.startAngle) / 2) + d.startAngle;
                            var x = Math.sin(d.midAngle) * distance;
                            var y = -Math.cos(d.midAngle) * distance;
                            return 'translate(' + x + ',' + y + ')';
                        });
                })

                .on("mousemove", function (d) {
                    
                    // Show tooltip on mousemove
                    tip.show(d)
                        .style("top", (d3.event.pageY - 40) + "px")
                        .style("left", (d3.event.pageX + 30) + "px");
                })

                .on('mouseout', function (d, i) {

                    // Mouseout transition
                    d3.select(this)
                    .transition()
                        .duration(500)
                        .ease('bounce')
                        .attr('transform', 'translate(0,0)');

                    // Hide tooltip
                    tip.hide(d);
                });

            // Animate chart on load
            arcPath
                .transition()
                    .delay(function(d, i) { return i * 500; })
                    .duration(500)
                    .attrTween("d", function(d) {
                        var interpolate = d3.interpolate(d.startAngle,d.endAngle);
                        return function(t) {
                            d.endAngle = interpolate(t);
                            return arc(d);  
                        }; 
                    });
        }
    
});

function goSearch(branch){
    window.location.href = "/reportads/branch/"+branch+"/index/"+$('#daterange').val();
}

function goClear(branch){
    window.location.href = "/reportads/branch/"+branch+"/index";
}

</script>