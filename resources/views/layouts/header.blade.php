<header class="header purple-bg">
    <!--<div class="sidebar-toggle-box">
        <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
    </div>-->
    <!--logo start-->
    <a href="/organization/dashboard" class="logo"><img alt="" src="{!! asset('img/mca-app-logo.png') !!}"></a>
    <!--logo end-->

    <div class="top-nav ">
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- notification dropdown start-->
                <li id="header_notification_bar" class="dropdown notification">
                    <?php $notifications = initial_notifications(); ?>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-globe"></i>
                        <span class="badge bg-important"><?php if (count($notifications) > 0) echo count($notifications);?></span>
                    </a>

                    <ul class="dropdown-menu extended notification">
                        <div class="notify-arrow notify-arrow-yellow"></div>
                        <li>
                            <p class="yellow">You have <span
                                        class="your-notifications"><?php echo count($notifications);?></span> new
                                notifications</p>
                        </li>

                        <?php
                        $count = 0;
                        foreach($notifications as $notification) {
                        if($count < 5){
                        ?>
                        <li>
                            <a href="<?php echo $notification->url; ?>">
                                <span class="label label-warning"><i class="fa fa-bell"></i></span>
                                <span>{{$notification->subject}}</span>
                                <div class="small italic"><?php echo $notification->created_at;?></div>
                            </a>
                        </li>
                        <?php
                        $count++;
                        }
                        }
                        ?>
                        <li>
                            <a href="/notifications/all">See all notifications</a>
                        </li>
                    </ul>
                </li>
                <!-- notification dropdown end -->
                <!-- message dropdown start-->
                <li id="header_message_bar" class="dropdown message">
                    <?php $messages = initial_messages(); ?>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-envelope-o fa-fw"></i>
                        <span class="badge"><?php if (count($messages) > 0) echo count($messages);?></span>
                    </a>
                    <ul class="dropdown-menu extended message">
                        <div class="notify-arrow notify-arrow-white "></div>
                        <li class="">
                            <div class="bar-green"></div>
                            <ul class="white">
                                <li>
                                    <a href="/messages">
                                        <i class="fa fa-inbox"></i><br>
                                        Inbox <?php echo isset($messages) && count($messages)> 0? '<span class="btn-danger  btn-xs">'.count( $messages). '</span>': ''?>
                                    </a>
                                </li>
                                <li>
                                    <a href="/messages/sent">
                                        <i class="fa fa-reply" aria-hidden="true"></i><br>
                                        Sent Messages
                                    </a>
                                </li>
                                <li>
                                    <a href="/messages/create">
                                        <i class="fa fa-paper-plane-o"></i><br> Create Message
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- message dropdown end -->
            </ul>
        </div>
        <ul class="nav pull-right top-menu">
            <li class="create-an-intake">
                {{ header_link()}}
            </li>
            <li>
                <form method="GET" action="/search/case">
                    <input type="text" name="query" class="form-control search"
                           placeholder="Search Survivor's Name, Case ID etc...">
                </form>
            </li>
            <!-- user login dropdown start-->
            <li class="dropdown profile">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="{!! asset('img/default_user_small.jpg') !!}">
                    <span class="username">
                                    @if (!Auth::guest())
                            {!! \App\Organization::find(auth()->user()->organization_id)->name !!}
                            {{--{{ Auth::user()->name }}, {{Auth::user()->roles[0]->name}}--}}
                        @endif
                                </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li><a href="<?php echo '/organizations/' . Auth::user()->organization_id?>"><i
                                    class=" fa fa-suitcase"></i>Org. Profile</a></li>
                    <li><a href="<?php echo '/users/' . Auth::user()->id . '/edit'?>"><i class="fa fa-cog"></i>User
                            Settings</a></li>
                    <li><a href="/notifications/all"><i class="fa fa-bell-o"></i> Notification</a></li>
                    <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>

    </div>
</header>
