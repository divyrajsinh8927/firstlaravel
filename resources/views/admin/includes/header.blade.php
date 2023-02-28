<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">
            <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="search-box pull-left">
                <form action="#">
                    <input type="text" name="search" placeholder="Search..." required>
                    <i class="ti-search"></i>
                </form>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li class="dropdown">
                    <i class="fa fa-user" data-toggle="dropdown"></i><i class="fa fa-caret-down" style="font-size:20px"></i>
                    <a class="dropdown-menu" href="{{ route('admin.logout') }}" style="background-color: black; color: white; text-align: center;">log-Out</a>
                </li>
            </ul>
        </div>
    </div>
</div>