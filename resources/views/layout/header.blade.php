<div class="sidebar-toggle-box">
    <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
</div>
<!--logo start-->
<a href="{{ URL::route('home-dashboard') }}" class="logo">OR<span>MA</span></a>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">

            <ul class="dropdown-menu extended tasks-bar">
                <div class="notify-arrow notify-arrow-green"></div>

                <li>
                    <a href="#">
                        <div class="task-info">
                            <div class="desc">Dashboard v1.3</div>
                            <div class="percent">40%</div>
                        </div>
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span class="sr-only">40% Complete (success)</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info">
                            <div class="desc">Database Update</div>
                            <div class="percent">60%</div>
                        </div>
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                <span class="sr-only">60% Complete (warning)</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info">
                            <div class="desc">Iphone Development</div>
                            <div class="percent">87%</div>
                        </div>
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 87%">
                                <span class="sr-only">87% Complete</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info">
                            <div class="desc">Mobile App</div>
                            <div class="percent">33%</div>
                        </div>
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
                                <span class="sr-only">33% Complete (danger)</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info">
                            <div class="desc">Dashboard v1.3</div>
                            <div class="percent">45%</div>
                        </div>
                        <div class="progress progress-striped active">
                            <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                <span class="sr-only">45% Complete</span>
                            </div>
                        </div>

                    </a>
                </li>
                <li class="external">
                    <a href="#">See All Tasks</a>
                </li>
            </ul>
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->
        <li id="header_inbox_bar" class="dropdown">

            <ul class="dropdown-menu extended inbox">
                <div class="notify-arrow notify-arrow-red"></div>

                <li>
                    <a href="#">
                        {{--<span class="photo"><img alt="avatar" src="./etsb/img/avatar-mini.jpg"></span>--}}
                                    <span class="subject">
                                    <span class="from">Jonathan Smith</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        {{--<span class="photo"><img alt="avatar" src="./etsb/img/avatar-mini2.jpg"></span>--}}
                                    <span class="subject">
                                    <span class="from">Jhon Doe</span>
                                    <span class="time">10 mins</span>
                                    </span>
                                    <span class="message">
                                     Hi, Jhon Doe Bhai how are you ?
                                    </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        {{--<span class="photo"><img alt="avatar" src="./etsb/img/avatar-mini3.jpg"></span>--}}
                                    <span class="subject">
                                    <span class="from">Jason Stathum</span>
                                    <span class="time">3 hrs</span>
                                    </span>
                                    <span class="message">
                                        This is awesome dashboard.
                                    </span>
                    </a>
                </li>

                <li>
                    <a href="#">See all messages</a>
                </li>
            </ul>
        </li>
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">


        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav ">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder="Search">
        </li>
        <li class="center"><p><b> {!! isset(Auth::user()->first_name) ?Auth::user()->first_name:'' !!}</b> <br><span>
                    @if(isset(Auth::user()->type))
                       ({!! (Auth::user()->type) !!})
                     @endif
                    </span></p></li>

        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                {!! Html::image('/etsb/img/avatar2.png', 'title', array()) !!}
                {{--<span class="username">Jhon Doue</span>--}}
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <div class="log-arrow-up"></div>
                {{--<li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="icon-cog"></i> Setting</a></li>
                  <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>--}}

            @if(isset(Auth::user()->id))
                <li><a href="#"><i ></i></a></li>
                <li><a href="{{ URL::to('user/profile-info') }}"><i class="icon-cog"></i>Profile</a></li>
                <li><a href="#"><i ></i> </a></li>
                <li><a href={{ route('user.logout') }}><i class="icon-key"></i> Log Out</a></li>
                @else
                    <li><a href={{ route('user-login') }}><i class="icon-key"></i> Sign In</a></li>
            @endif
            </ul>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!--search & user info end-->
</div>

<style>
    .center{
padding-top: 10px;
    }
</style>