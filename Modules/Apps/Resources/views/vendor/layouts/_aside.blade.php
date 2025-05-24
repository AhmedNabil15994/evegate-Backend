<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>


            <li class="nav-item {{ active_menu('home') }}">
                <a href="{{ url(route('vendor.home')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ __('apps::vendor.home.title') }}</span>
                    <span class="selected"></span>
                </a>
            </li>


            <li class="heading">
                <h3 class="uppercase">{{ __('apps::vendor._layout.aside._tabs.catalog') }}</h3>
            </li>

            

            @permission('show_workers')
            <li class="nav-item {{ active_menu('workers') }}">
                <a href="{{ url(route('vendor.workers.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('apps::vendor._layout.aside.workers') }}</span>
                </a>
            </li>
            @endpermission

        


           

          

       


         


            

        </ul>
    </div>
</div>
