<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        {{-- <img alt="image" class="img-circle" src="img/profile_small.jpg" /> --}}
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="<?=$_ENV['BASE_URL']?>admin/">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Son Dinh</strong>
                            </span> <span class="text-muted text-xs block">Art Director <b
                                    class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="<?=$_ENV['BASE_URL']?>admin/user/"><i class="fa fa-th-large"></i> <span class="nav-label">Account</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?=$_ENV['BASE_URL']?>admin/user/">Quản lý Account</a></li>
                </ul>
            </li>
            <li>
                <a href="<?=$_ENV['BASE_URL']?>admin/category/"><i class="fa fa-th-large"></i> <span class="nav-label">Danh mục</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?=$_ENV['BASE_URL']?>admin/category/">Quản lý danh mục</a></li>
                </ul>
            </li>
            <li>
                <a href="<?=$_ENV['BASE_URL']?>admin/product/"><i class="fa fa-th-large"></i> <span class="nav-label">Sản phẩm</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?=$_ENV['BASE_URL']?>admin/product/">Quản lý Sản phẩm</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>