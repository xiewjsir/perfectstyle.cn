<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Profile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap">
                            <div class="pad-btm">
                                <span class="label label-success pull-right">New</span>
                                <img class="img-circle img-sm img-border" src="{{Storage::url($userInfo['avatar'])}}" alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <span class="pull-right dropdown-toggle">
                                    <i class="dropdown-caret"></i>
                                </span>
                                <p class="mnp-name">{{$userInfo['name']}}</p>
                                <span class="mnp-desc">{{$userInfo['email']}}</span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-gear icon-lg icon-fw"></i> 设置
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-information icon-lg icon-fw"></i> 帮助
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-unlock icon-lg icon-fw"></i> 退出
                            </a>
                        </div>
                    </div>


                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut">
                        <ul class="list-unstyled">
                            <li class="col-xs-3" data-content="个人资料">
                                <a class="shortcut-grid" href="#">
                                    <i class="demo-psi-male"></i>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="信息">
                                <a class="shortcut-grid" href="#">
                                    <i class="demo-psi-speech-bubble-3"></i>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="激活">
                                <a class="shortcut-grid" href="#">
                                    <i class="demo-psi-thunder"></i>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="锁屏">
                                <a class="shortcut-grid" href="#">
                                    <i class="demo-psi-lock-2"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->


                    <ul id="mainnav-menu" class="list-group">
                        @foreach($leftMenus['0'] as $oneLevelMenu)
                            <li class="list-header">{{$oneLevelMenu['name']}}</li>
                            @foreach($leftMenus[$oneLevelMenu['id']] as $twoLevelMenu)
                            <li @if($twoLevelMenu['selected'])class="active-sub" @endif>
                                <a href="{{'#' == $twoLevelMenu['uri'] ? '#' : Route($twoLevelMenu['uri'])}}">
                                    <i class="{{'-' == $twoLevelMenu['icon'] ? '-' : $twoLevelMenu['icon']}}"></i>
                                    <span class="menu-title">
                                        <strong>{{$twoLevelMenu['name']}}</strong>
                                    </span>
                                </a>
                                @if(!empty($leftMenus[$twoLevelMenu['id']]))
                                    <ul class="collapse @if($twoLevelMenu['selected'])in @endif">
                                    @foreach($leftMenus[$twoLevelMenu['id']] as $threeLevelMenu)
                                        <li @if($threeLevelMenu['selected'])class="active-link" @endif><a href="{{'#' == $threeLevelMenu['uri'] ? '#' : Route($threeLevelMenu['uri'])}}">{{$threeLevelMenu['name']}}</a></li>
                                    @endforeach
                                    </ul>
                                @endif
                            </li>
                            @endforeach
                            <li class="list-divider"></li>
                        @endforeach
                    </ul>
                    <!--Widget-->
                    <!--================================-->
                    <div class="mainnav-widget">

                        <!-- Show the button on collapsed navigation -->
                        <div class="show-small">
                            <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                <i class="demo-pli-monitor-2"></i>
                            </a>
                        </div>

                        <!-- Hide the content on collapsed navigation -->
                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                            <ul class="list-group">
                                <li class="list-header pad-no pad-ver">服务器状态</li>
                                <li class="mar-btm">
                                    <span class="label label-primary pull-right">15%</span>
                                    <p>CPU Usage</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-primary" style="width: 15%;">
                                            <span class="sr-only">15%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="mar-btm">
                                    <span class="label label-purple pull-right">75%</span>
                                    <p>Bandwidth</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-purple" style="width: 75%;">
                                            <span class="sr-only">75%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">View Details</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End widget-->

                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>