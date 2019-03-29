@extends('layouts.visorx')
@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mt-2" style="min-height: 150px; max-height: 150px;">
                        <div class="card-body">
                            <h6 class="card-subtitle text-center "><i
                                        style="color: #00C1FF;"class="fa fa-laptop">&nbsp;&nbsp;&nbsp;
                                </i>Registered PCs</h6>
                            @foreach($registered_computers as $count)
                                <p class="text-center status-number mt-4">{{$count->computer_count}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class=" col-md-3">
                    <div class="card mt-2" style="min-height: 150px; max-height: 150px;">
                        <div class="card-body">
                            <h6 class="card-subtitle text-center "><i style="color: #00C1FF;"class="fa fa-users">
                                    &nbsp;&nbsp;&nbsp;
                                </i>Active Users</h6>
                            <p class="text-center status-number mt-4">{{sizeof($active_users)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mt-2" style="min-height: 150px; max-height: 150px;">
                        <div class="card-body">
                            <h6 class="card-subtitle text-center "><i style="color: #00C1FF;" class="fa fa-long-arrow-up"></i>
                                <i style="color: #00C1FF;" class="fa fa-long-arrow-down"></i>
                                &nbsp;&nbsp;&nbsp;
                                Used Data
                            </h6>
                            <p class="text-center status-number mt-4">
                                @foreach($total_data as $data)
                                    <script type="text/javascript">document.write(bytesToData({{$data->total_sum}}));
                                    </script>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mt-2" style="min-height: 150px; max-height: 150px;">
                        <div class="card-body">
                            <h6 class="card-subtitle text-center "><i style="color: #00C1FF;" class="fa fa-users"></i>
                                &nbsp;&nbsp;&nbsp;
                                Inactive Users
                            </h6>
                            <p class="text-center status-number mt-4">{{$inactive_users}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="padding: 10px;" id="page1">
            <div class="card mt-2">
                <div class="card-body">
                    <h3 class="float-left sub-headers">Data Usage</h3>
                    <p  class="float-right">View More:&nbsp;<a  id="link_pages" href="#" style="margin-top: 0px;color: #00C1FF;">Table</a></p>
                    <canvas class="float-left my-4" id="bar-chart" width="900" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="padding:10px; display: none;" id="page2">
            <div class="card" >
                <div class="card-body" >
                    <h3 class="float-left sub-headers">Data Usage</h3>
                    <p  class="float-right">View More:&nbsp;<a  id="link_pages2" href="#" style="margin-top: 0px;color: #00C1FF;">Chart</a></p>
                    <br><br><br>
                    <div class="col-md-12 offset-md-3">
                        <div class="form-group form-inline">
                            <input id="search" type="text" class="form-control" placeholder="Looking for something?" style="width: 500px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!--<button  type="button" class="btn btn-info btn-rounded">Search </button>-->
                        </div>
                    </div>
                    <div class="table-responsive" style="overflow-x: hidden">
                        <!--Table-->
                        <table id="table" class="table table-striped">

                            <!--Table head-->
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Custordian</th>
                                <th>Data Used</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data_used as $data)
                            <tr>
                                <td scope="row" class="table-name">{{$data->logged_on_user.'   '.$data->computer_name}}</td>
                                <td scope="row" class="table-name">{{$data->custodian}}</td>
                                <td>
                                    <script type="text/javascript">
                                     document.write(bytesToData({{$data->used_data}}));
                                    </script>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="padding: 10px;"id="page3" >
            <div class="card">
                <div class="card-body">
                    <h3 class="float-left sub-headers">Most Visited Sites</h3>
                    <p  class="float-right">View More:&nbsp;
                        <a id="link_pages3" href="#" style="margin-top: 0px;color: #00C1FF;">Table</a></p>
                        <div style="margin-left: -80px;height:250px;width: 400px;" >
                            <canvas id="pie-chart"></canvas>
                        </div>
                        <div class="col-md-6 float-right">
                           <div id='chartjsLegend' class='chartjsLegend'></div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-6" style="padding:10px; display: none;overflow-x:hidden;" id="page4">
            <div class="card">
                <div class="card-body">
                    <h3 class="float-left sub-headers">Most Visited Sites</h3>
                   <p  class="float-right">View More:&nbsp;<a  id="link_pages4" href="#" style="margin-top: 0px;color: #00C1FF;">Chart</a></p>
                    <br><br><br>
                    <div class="col-md-12 offset-md-3">
                        <div class="form-group form-inline">
                            <input id="search2" type="text" class="form-control"
                                   placeholder="Looking for something?" style="width: 300px;">
                            <!--<button  type="button" class="btn btn-info btn-rounded">Search </button>-->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!--Table-->
                        <table id="table2" class="table table-striped">
                            <!--Table head-->
                            <thead>
                            <tr>
                                <th>URL</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($url_logs as $data)
                                <tr>
                                    <td scope="row" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">{{$data->url}}</td>
                                    <td scope="row">{{$data->url_count}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="padding: 10px;"id="page5" >
            <div class="card">
                <div class="card-body">
                    <h3 class="float-left sub-headers">Most Visited Domains</h3>
                    <p  class="float-right">View More:&nbsp;
                        <a id="link_pages5" href="#" style="margin-top: 0px;color: #00C1FF;">Table</a></p>
                    <div style="margin-left: -80px;height:250px;width: 400px;" >
                        <canvas id="pie-chart-2"></canvas>
                    </div>
                    <div class="col-md-6 float-right">
                        <div id='chartjsLegend2' class='chartjsLegend'></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="padding:10px; display: none;overflow-x:hidden;" id="page6">
            <div class="card">
                <div class="card-body">
                    <h3 class="float-left sub-headers">Most Visited Domains</h3>
                   <p  class="float-right">View More:&nbsp;<a  id="link_pages6" href="#" style="margin-top: 0px;color: #00C1FF;">Chart</a></p>
                    <br><br><br>
                    <div class="col-md-12 offset-md-3">
                        <div class="form-group form-inline">
                            <input id="search3" type="text" class="form-control"  placeholder="Looking for something?"
                             style="width: 300px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!--<button  type="button" class="btn btn-info btn-rounded">Search </button>-->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!--Table-->
                        <table id="table3" class="table table-striped">

                            <!--Table head-->
                            <thead>
                            <tr>
                                <th>DOMAIN</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($domain_logs as $data)
                                <tr>
                                    <td scope="row" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">{{$data->domain_name}}</td>
                                    <td scope="row">{{$data->domain_count}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: [
                    @if ($data_used->count() <= 10)
                    @foreach($data_used as $log) '{{$log->custodian}}'
                    {{','}}
                    @endforeach
                    @else
                    '{{$data_used[0]->custodian}}'
                    {{','}}
                    '{{$data_used[1]->custodian}}'
                    {{','}}
                    '{{$data_used[2]->custodian}}'
                    {{','}}
                    '{{$data_used[3]->custodian}}'
                    {{','}}
                    '{{$data_used[4]->custodian}}'
                    {{','}}
                    '{{$data_used[5]->custodian}}'
                    {{','}}
                    '{{$data_used[6]->custodian}}'
                    {{','}}
                    '{{$data_used[7]->custodian}}'
                    {{','}}
                    '{{$data_used[8]->custodian}}'
                    {{','}}
                    '{{$data_used[9]->custodian}}'
                    {{','}}
                    @endif

                    ],
                datasets: [
                    {
                        label: "data usage",
                        backgroundColor: ["#00C1FF","#00C1FF","#00C1FF","#00C1FF","#00C1FF","#00C1FF","#00C1FF","#00C1FF","#00C1FF","#00C1FF"],
                        data:[
                            @if ($data_used->count() <= 10)
                            @foreach($data_used as $log)
                            bytesToSize({{$log->used_data}},0)
                            {{','}}
                            @endforeach
                            @else
                            bytesToSize({{$data_used[0]->used_data}},0)
                            {{','}}
                            bytesToSize({{$data_used[1]->used_data}},0)
                            {{','}}
                            bytesToSize({{$data_used[2]->used_data}},0)
                            {{','}}
                            bytesToSize({{$data_used[3]->used_data}},0)
                            {{','}}
                            bytesToSize({{$data_used[4]->used_data}},0)
                            {{','}}
                            bytesToSize({{$data_used[5]->used_data}},0)
                            {{','}}
                            bytesToSize({{$data_used[6]->used_data}},0)
                            {{','}}
                            bytesToSize({{$data_used[7]->used_data}},0)
                            {{','}}
                            bytesToSize({{$data_used[8]->used_data}},0)
                            {{','}}
                            bytesToSize({{$data_used[9]->used_data}},0)
                            {{','}}
                            @endif
                        ]
                    }
                ]
            },
            options: {
                legend: { display: false },
                scales: {
                    xAxes: [{
                        barPercentage: 0.1,
                        responsive:true
                    }]
                },
            }

        });
        Chart.elements.Rectangle.prototype.draw = function () {

            var ctx = this._chart.ctx;
            var vm = this._view;
            var left, right, top, bottom, signX, signY, borderSkipped, radius;
            var borderWidth = vm.borderWidth;
            // Set Radius Here
            // If radius is large enough to cause drawing errors a max radius is imposed
            var cornerRadius = 20;

            if (!vm.horizontal) {
                // bar
                left = vm.x - vm.width / 2;
                right = vm.x + vm.width / 2;
                top = vm.y;
                bottom = vm.base;
                signX = 1;
                signY = bottom > top ? 1 : -1;
                borderSkipped = vm.borderSkipped || 'bottom';
            } else {
                // horizontal bar
                left = vm.base;
                right = vm.x;
                top = vm.y - vm.height / 2;
                bottom = vm.y + vm.height / 2;
                signX = right > left ? 1 : -1;
                signY = 1;
                borderSkipped = vm.borderSkipped || 'left';
            }

            // Canvas doesn't allow us to stroke inside the width so we can
            // adjust the sizes to fit if we're setting a stroke on the line
            if (borderWidth) {
                // borderWidth shold be less than bar width and bar height.
                var barSize = Math.min(Math.abs(left - right), Math.abs(top - bottom));
                borderWidth = borderWidth > barSize ? barSize : borderWidth;
                var halfStroke = borderWidth / 2;
                // Adjust borderWidth when bar top position is near vm.base(zero).
                var borderLeft = left + (borderSkipped !== 'left' ? halfStroke * signX : 0);
                var borderRight = right + (borderSkipped !== 'right' ? -halfStroke * signX : 0);
                var borderTop = top + (borderSkipped !== 'top' ? halfStroke * signY : 0);
                var borderBottom = bottom + (borderSkipped !== 'bottom' ? -halfStroke * signY : 0);
                // not become a vertical line?
                if (borderLeft !== borderRight) {
                    top = borderTop;
                    bottom = borderBottom;
                }
                // not become a horizontal line?
                if (borderTop !== borderBottom) {
                    left = borderLeft;
                    right = borderRight;
                }
            }

            ctx.beginPath();
            ctx.fillStyle = vm.backgroundColor;
            ctx.strokeStyle = vm.borderColor;
            ctx.lineWidth = borderWidth;

            // Corner points, from bottom-left to bottom-right clockwise
            // | 1 2 |
            // | 0 3 |
            var corners = [
                [left, bottom],
                [left, top],
                [right, top],
                [right, bottom]
            ];

            // Find first (starting) corner with fallback to 'bottom'
            var borders = ['bottom', 'left', 'top', 'right'];
            var startCorner = borders.indexOf(borderSkipped, 0);
            if (startCorner === -1) {
                startCorner = 0;
            }

            function cornerAt(index) {
                return corners[(startCorner + index) % 4];
            }

            // Draw rectangle from 'startCorner'
            var corner = cornerAt(0);
            var width, height, x, y, nextCorner, nextCornerId
            var x_tl, x_tr, y_tl, y_tr;
            var x_bl, x_br, y_bl, y_br;
            ctx.moveTo(corner[0], corner[1]);

            for (var i = 1; i < 4; i++) {
                corner = cornerAt(i);
                nextCornerId = i + 1;
                if (nextCornerId == 4) {
                    nextCornerId = 0
                }

                nextCorner = cornerAt(nextCornerId);

                width = corners[2][0] - corners[1][0];
                height = corners[0][1] - corners[1][1];
                x = corners[1][0];
                y = corners[1][1];

                radius = cornerRadius;

                // Fix radius being too large
                if (radius > Math.abs(height) / 2) {
                    radius = Math.floor(Math.abs(height) / 2);
                }
                if (radius > Math.abs(width) / 2) {
                    radius = Math.floor(Math.abs(width) / 2);
                }

                if (height < 0) {
                    // Negative values in a standard bar chart
                    x_tl = x; x_tr = x + width;
                    y_tl = y + height; y_tr = y + height;

                    x_bl = x; x_br = x + width;
                    y_bl = y; y_br = y;

                    // Draw
                    ctx.moveTo(x_bl + radius, y_bl);
                    ctx.lineTo(x_br - radius, y_br);
                    ctx.quadraticCurveTo(x_br, y_br, x_br, y_br - radius);
                    ctx.lineTo(x_tr, y_tr + radius);
                    ctx.quadraticCurveTo(x_tr, y_tr, x_tr - radius, y_tr);
                    ctx.lineTo(x_tl + radius, y_tl);
                    ctx.quadraticCurveTo(x_tl, y_tl, x_tl, y_tl + radius);
                    ctx.lineTo(x_bl, y_bl - radius);
                    ctx.quadraticCurveTo(x_bl, y_bl, x_bl + radius, y_bl);

                } else if (width < 0) {
                    // Negative values in a horizontal bar chart
                    x_tl = x + width; x_tr = x;
                    y_tl = y; y_tr = y;

                    x_bl = x + width; x_br = x;
                    y_bl = y + height; y_br = y + height;

                    // Draw
                    ctx.moveTo(x_bl + radius, y_bl);
                    ctx.lineTo(x_br - radius, y_br);
                    ctx.quadraticCurveTo(x_br, y_br, x_br, y_br - radius);
                    ctx.lineTo(x_tr, y_tr + radius);
                    ctx.quadraticCurveTo(x_tr, y_tr, x_tr - radius, y_tr);
                    ctx.lineTo(x_tl + radius, y_tl);
                    ctx.quadraticCurveTo(x_tl, y_tl, x_tl, y_tl + radius);
                    ctx.lineTo(x_bl, y_bl - radius);
                    ctx.quadraticCurveTo(x_bl, y_bl, x_bl + radius, y_bl);

                } else {
                    //Positive Value
                    ctx.moveTo(x + radius, y);
                    ctx.lineTo(x + width - radius, y);
                    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
                    ctx.lineTo(x + width, y + height - radius);
                    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
                    ctx.lineTo(x + radius, y + height);
                    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
                    ctx.lineTo(x, y + radius);
                    ctx.quadraticCurveTo(x, y, x + radius, y);
                }
            }

            ctx.fill();
            if (borderWidth) {
                ctx.stroke();
            }
        };


        var piechart = new Chart(document.getElementById("pie-chart"), {
            type: 'doughnut',
            data: {
                labels: [@foreach($url_logs as $log) '{{$log->url}}'{{','}}@endforeach],
                datasets: [{
                    label: "Count",
                    backgroundColor: ["#00C1FF", "#C2F0FF","#009DCF","#85D4EB","#327A92"],
                    data: [
                        @if ($url_logs->count() <= 5)
                        @foreach($url_logs as $log)
                        {{$log->url_count}}
                        {{','}}
                        @endforeach
                            @else
                        {{$url_logs[0]->url_count}}
                        {{','}}
                        {{$url_logs[1]->url_count}}
                        {{','}}
                        {{$url_logs[2]->url_count}}
                        {{','}}
                        {{$url_logs[3]->url_count}}
                        {{','}}
                        {{$url_logs[4]->url_count}}
                        {{','}}
                        @endif
                    ]
                }]
            },
            options: {
                responsive:true,
                maintainAspectRatio: true,
                legend: {
                    display: false  ,
                    usePointStyle: true,
                    position: 'right',
                    labels: {
                        fontColor: '#3B426C'

                    }
                },
                title: {
                }
            }
        });
        document.getElementById('chartjsLegend').innerHTML = piechart.generateLegend();


        var piechart_2 = new Chart(document.getElementById("pie-chart-2"), {
            type: 'doughnut',
            data: {
                labels: [@foreach($domain_logs as $log) '{{$log->domain_name}}'{{','}}@endforeach],
                datasets: [{
                    label: "Count",
                    backgroundColor: ["#00C1FF", "#C2F0FF","#009DCF","#85D4EB","#327A92"],
                    data: [
                        @if ($domain_logs->count() <= 5)
                        @foreach($domain_logs as $log)
                        {{$log->domain_count}}
                        {{','}}
                        @endforeach
                        @else
                        {{$domain_logs[0]->domain_count}}
                        {{','}}
                        {{$domain_logs[1]->domain_count}}
                        {{','}}
                        {{$domain_logs[2]->domain_count}}
                        {{','}}
                        {{$domain_logs[3]->domain_count}}
                        {{','}}
                        {{$domain_logs[4]->domain_count}}
                        {{','}}
                        @endif
                    ]
                }]
            },
            options: {
                responsive:true,
                maintainAspectRatio: true,
                legend: {
                    display: false  ,
                    usePointStyle: true,
                    position: 'right',
                    labels: {
                        fontColor: '#3B426C'

                    }
                },
                title: {
                }
            }
        });
        document.getElementById('chartjsLegend2').innerHTML = piechart_2.generateLegend();
    </script>
    <!-- Tables Javascript-->

@endsection
