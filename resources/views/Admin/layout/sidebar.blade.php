<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            {{--<li class="nav-title">E-shop</li>--}}
            {{--<li class="nav-item"><a class="nav-link" href="#"><i class="icon-basket"></i> Orders</a></li>--}}
            {{--<li class="nav-item"><a class="nav-link" href="#"><i class="icon-grid"></i> Products</a></li>--}}
            {{--<li class="nav-item"><a class="nav-link" href="#"><i class="icon-people"></i> Customers</a></li>--}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="icon-location-pin"></i> <span class="nav-link-text">{{ __('Translations') }}</span></a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="icon-settings"></i> <span class="nav-link-text">{{ __('Configuration') }}</span></a></li>--}}
            <li class="sidebar-collapse">
                <i class="fa fa-angle-double-left"></i>
                <i class="fa fa-angle-double-right"></i>
            </li>
        </ul>
    </nav>
</div>