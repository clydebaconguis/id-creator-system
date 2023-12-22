<style>
    .nav-font ul li a i,
    p {
        color: rgb(212, 209, 209);
    }
</style>
<nav class="mt-2 nav-font">
    <ul class="nav nav-pills nav-sidebar flex-column side" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="/"
                class="nav-link {{ Request::url() == url('/home') || Request::url() == url('/') ? 'active' : '' }} ">
                <i class="nav-icon fa fa-home"></i>
                <p>
                    Home
                </p>
            </a>

        </li>

        <li class="nav-item">
            <a href="/template" class="nav-link {{ Request::url() == url('/template') ? 'active' : '' }}">
                <i class="nav-icon fas fa-id-card"></i>
                <p>
                    Template
                </p>
            </a>

        </li>
        {{-- <li class="nav-item">
            <a href="/myfiles" class="nav-link {{ Request::url() == url('/myfiles') ? 'active' : '' }} ">
                <i class="nav-icon fas fa-file-image"></i>
                <p>
                    Myfiles
                </p>
            </a>

        </li> --}}

        {{-- <li class="nav-item has-treeview {{ Request::url() == url('/addsysteminfo') ? 'menu-open' : '' }}">
            <a href="#"class="nav-link {{ Request::url() == url('/addsysteminfo') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    System Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview udernavs">
                <li class="nav-item">
                    <a href="javascript:void(0)" id="addSystemModal"
                        class="nav-link {{ Request::getRequestUri() == '/addsysteminfo' ? 'active' : '' }}">
                        <i class="nav-icon  far fa-circle"></i>
                        <p>
                            Add System Info
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/editsysteminfo"
                        class="nav-link {{ Request::getRequestUri() == '/editsysteminfo' ? 'active' : '' }}">
                        <i class="nav-icon  far fa-circle"></i>
                        <p>
                            Edit System Info
                        </p>
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- <li class="nav-item">
            <a href="/addstudent" class="nav-link {{ Request::url() == url('/addstudent') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>Add Student</p>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a href="/bulkprinting" class="nav-link {{ Request::url() == url('/bulkprinting') ? 'active' : '' }}">
                <i class="nav-icon fas fa-print"></i>
                <p>Batch Printing</p>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a href="/bulkregistration"
                class="nav-link {{ Request::url() == url('/bulkregistration') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Batch Registration</p>
            </a>
        </li> --}}
    </ul>
</nav>
