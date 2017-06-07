<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->avatarUrl }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <p>{{ auth()->user()->points }} points</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ isActiveRoute('admin.dashboard.index') }}">
                <a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a>
            <li class="{{ isActiveRoute('admin.books.index') }}">
                <a href="{{ route('admin.books.index') }}">
                    <i class="fa fa-book"></i>
                    <span>Books</span>
                </a>
            </li>
            <li class="{{ isActiveRoute('admin.quizzes.index') }}">
                <a href="{{ route('admin.quizzes.index') }}">
                    <i class="fa fa-question"></i>
                    <span>Quizzes</span>
                </a>
            </li>
            @if(auth()->user()->superadmin)
                <li class="{{ isActiveRoute('admin.admins.index') }}">
                    <a href="{{ route('admin.admins.index') }}">
                        <i class="fa fa-user"></i>
                        <span>Admins</span>
                    </a>
                </li>
            @endif
            <li class="{{ isActiveRoute('admin.libraries.index') }}">
                <a href="{{ route('admin.libraries.index') }}">
                    <i class="fa fa-building"></i>
                    <span>Libraries</span>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-play"></i>
                    <span>Players</span>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-map-marker"></i>
                    <span>Map</span>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-hourglass-start"></i>
                    <span>Onboarding</span>
                </a>
            </li>
            <li class="{{ isActiveRoute('admin.citations.index') }}">
                <a href="{{ route('admin.citations.index') }}">
                    <i class="fa fa-quote-left"></i>
                    <span>Citations</span>
                </a>
            </li>
            <li class="{{ isActiveRoute('admin.avatars.index') }}">
                <a href="{{ route('admin.avatars.index') }}">
                    <i class="fa fa-picture-o"></i>
                    <span>Avatars</span>
                </a>
            </li>
            <li class="{{ isActiveRoute('admin.badges.index') }}">
                <a href="{{ route('admin.badges.index') }}">
                    <i class="fa fa-star"></i>
                    <span>Badges</span>
                </a>
            </li>
            <li class="{{ isActiveRoute('admin.levels.index') }}">
                <a href="{{ route('admin.levels.index') }}">
                    <i class="fa fa-level-up"></i>
                    <span>Levels</span>
                </a>
            </li>
            <li class="{{ isActiveRoute('admin.tableOfFame.index') }}">
                <a href="{{ route('admin.tableOfFame.index') }}">
                    <i class="fa fa-table"></i>
                    <span>Table of fame</span>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-feed"></i>
                    <span>Feedback</span>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa phpdebugbar-fa-money"></i>
                    <span>Statistics</span>
                </a>
            </li>
            <li class="{{ isActiveRoute('admin.dashboard.index') }}">
                <a href="{{ route('admin.logs.index') }}">
                    <i class="fa fa-list-ul"></i>
                    <span>Logs</span>
                </a>
            </li>
            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-edit"></i> <span>Forms</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>--}}
            {{--<li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>--}}
            {{--<li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-table"></i> <span>Tables</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>--}}
            {{--<li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="pages/calendar.html">--}}
            {{--<i class="fa fa-calendar"></i> <span>Calendar</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<small class="label pull-right bg-red">3</small>--}}
            {{--<small class="label pull-right bg-blue">17</small>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="pages/mailbox/mailbox.html">--}}
            {{--<i class="fa fa-envelope"></i> <span>Mailbox</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<small class="label pull-right bg-yellow">12</small>--}}
            {{--<small class="label pull-right bg-green">16</small>--}}
            {{--<small class="label pull-right bg-red">5</small>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-folder"></i> <span>Examples</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>--}}
            {{--<li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>--}}
            {{--<li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>--}}
            {{--<li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>--}}
            {{--<li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>--}}
            {{--<li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>--}}
            {{--<li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>--}}
            {{--<li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>--}}
            {{--<li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-share"></i> <span>Multilevel</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>--}}
            {{--<li>--}}
            {{--<a href="#"><i class="fa fa-circle-o"></i> Level One--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>--}}
            {{--<li>--}}
            {{--<a href="#"><i class="fa fa-circle-o"></i> Level Two--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>--}}
            {{--<li class="header">LABELS</li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>