@extends('admin.layouts.default')
@section('content')
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Static Tables</h1>

        <!--Searchbox-->
        <div class="searchbox">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search..">
                <span class="input-group-btn">
                    <button class="text-muted" type="button"><i class="demo-pli-magnifi-glass"></i></button>
                </span>
            </div>
        </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Static Tables</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->


    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Sample Toolbar</h3>
            </div>

            <!--Data Table-->
            <!--===================================================-->
            <div class="panel-body">
                <div class="pad-btm form-inline">
                    <div class="row">
                        <div class="col-sm-6 table-toolbar-left">
                            <button id="demo-btn-addrow" class="btn btn-primary"><i class="demo-pli-add"></i> Add</button>
                            <button class="btn btn-default"><i class="demo-pli-printer"></i></button>
                            <div class="btn-group">
                                <button class="btn btn-default"><i class="demo-pli-exclamation-circle"></i></button>
                                <button class="btn btn-default"><i class="demo-pli-recycling"></i></button>
                            </div>
                        </div>
                        <div class="col-sm-6 table-toolbar-right">
                            <div class="form-group">
                                <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-default"><i class="demo-pli-download-from-cloud"></i></button>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                        <i class="demo-pli-gear"></i>
                                        <span class="caret"></span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Invoice</th>
                            <th>User</th>
                            <th>Order date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Tracking Number</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a class="btn-link" href="#"> Order #53431</a></td>
                            <td>Steve N. Horton</td>
                            <td><span class="text-muted"><i class="demo-pli-clock"></i> Oct 22, 2014</span></td>
                            <td>$45.00</td>
                            <td>
                                <div class="label label-table label-success">Paid</div>
                            </td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td><a class="btn-link" href="#"> Order #53432</a></td>
                            <td>Charles S Boyle</td>
                            <td><span class="text-muted"><i class="demo-pli-clock"></i> Oct 24, 2014</span></td>
                            <td>$245.30</td>
                            <td>
                                <div class="label label-table label-info">Shipped</div>
                            </td>
                            <td><i class="demo-pli-mine"></i> CGX0089734531</td>
                        </tr>
                        <tr>
                            <td><a class="btn-link" href="#"> Order #53433</a></td>
                            <td>Lucy Doe</td>
                            <td><span class="text-muted"><i class="demo-pli-clock"></i> Oct 24, 2014</span></td>
                            <td>$38.00</td>
                            <td>
                                <div class="label label-table label-info">Shipped</div>
                            </td>
                            <td><i class="demo-pli-mine"></i> CGX0089934571</td>
                        </tr>
                        <tr>
                            <td><a class="btn-link" href="#"> Order #53434</a></td>
                            <td>Teresa L. Doe</td>
                            <td><span class="text-muted"><i class="demo-pli-clock"></i> Oct 15, 2014</span></td>
                            <td>$77.99</td>
                            <td>
                                <div class="label label-table label-info">Shipped</div>
                            </td>
                            <td><i class="demo-pli-mine"></i> CGX0089734574</td>
                        </tr>
                        <tr>
                            <td><a class="btn-link" href="#"> Order #53435</a></td>
                            <td>Teresa L. Doe</td>
                            <td><span class="text-muted"><i class="demo-pli-clock"></i> Oct 12, 2014</span></td>
                            <td>$18.00</td>
                            <td>
                                <div class="label label-table label-success">Paid</div>
                            </td>
                            <td>-</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--===================================================-->
            <!--End Data Table-->

        </div>
    </div>
    <!--===================================================-->
    <!--End page content-->
@endsection