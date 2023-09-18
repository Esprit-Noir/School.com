<aside class="main-sidebar sidebar-dark-primary elevation-0 samaSidebar" >
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{url('dist/img/sama.png')}}" alt="samaSchool" class="brand-image img-circle elevation-2" style="opacity: .8">
        <span class="brand-text font-weight-bolder samaSchool">SAMA SCHOOL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{$user->name}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if($user->user_type == 1)
                    <li class="nav-item">
                        <a href="{{route('admin.home')}}" class="nav-link  @if(Request::segment(2)== 'dashboard') actif text-light @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Tableau de bord
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.admins.list')}}" class="nav-link  @if(Request::segment(2)== 'list') actif text-light @endif">
                            <i class="nav-icon fa fa-users"></i>

                            <p>
                                Administrateurs
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.classes.list')}}" class="nav-link  @if(Request::segment(2)== 'class') actif text-light @endif">
                            <i class="nav-icon fa fa-graduation-cap"></i>
                            <p>
                                Classes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.subject.list')}}" class="nav-link  @if(Request::segment(2)== 'subject') actif text-light @endif">
                            <i class="nav-icon fa fa-graduation-cap"></i>
                            <p>
                                Sujets
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.assign_subject.list')}}" class="nav-link  @if(Request::segment(2)== 'assign_subject') actif text-light @endif">
                            <i class="nav-icon fa fa-graduation-cap"></i>
                            <p>
                                Sujets assignés
                            </p>
                        </a>
                    </li>
                @elseif($user->user_type == 2)
                    <li class="nav-item">
                        <a href="{{url('teacher/dashboard')}}" class="nav-link @if(Request::segment(2)== 'dashboard') actif text-light @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Tableau de bord
                            </p>
                        </a>
                    </li>
                @elseif($user->user_type == 3)
                    <li class="nav-item">
                        <a href="{{url('student/dashboard')}}" class="nav-link @if(Request::segment(2)== 'dashboard') actif text-light @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Tableau de bord
                            </p>
                        </a>
                    </li>
                @elseif($user->user_type == 4)
                    <li class="nav-item">
                        <a href="{{url('parent/dashboard')}}" class="nav-link @if(Request::segment(2)== 'dashboard') actif text-light @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Tableau de bord
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('auth.logout')}}" class="nav-link">
                        <i class="nav-icon fa fa-unlock-alt"></i>
                        <p>
                            Déconnexion
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<style>
    .actif{
        background: #6c63ff !important;
    }
    .samaSchool{
        color: #6c63ff !important;
    }
</style>
