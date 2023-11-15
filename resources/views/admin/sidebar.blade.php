{{-- @php
    $admin =
@endphp --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">My Admin</span>
    </a>

    <div class="sidebar">
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
            <div class="image">
                {{-- <img src="{{$user->image}}" class="img-circle elevation-2" alt="{{$user->name}}"> --}}
            </div>
            <div class="info">
                {{-- <a href="javascript:void(0)" class="d-block">{{$user->name}}</a> --}}
                <a href="javascript:void(0)" class="d-block">Admin</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.countries') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-earth-americas"></i>
                        <p>
                            Globals
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.countries')  }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Countries</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-box"></i>
                        <p>
                            Hotels
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.hotel.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Hotels</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.hotel.tours.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tours</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.hotel.tags.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tags</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.hotel.extrafeatures.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Extra Features</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.hotel.bookings')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Bookings</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa-regular fa-user"></i>
                        <p>
                            User
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.users')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users.online')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Now Online</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa-solid fa-store"></i>
                        <p>
                            Store
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.store.configuration')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Configuration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.store.attribute')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attributes</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
