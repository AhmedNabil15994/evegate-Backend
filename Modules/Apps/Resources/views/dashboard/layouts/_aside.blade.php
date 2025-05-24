<div class="page-sidebar-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed"
      data-keep-expanded="false"
      data-auto-scroll="true"
      data-slide-speed="200"
      style="padding-top: 20px">
      <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
          <span></span>
        </div>
      </li>

      <li class="nav-item {{ active_menu('home') }}">
        <a href="{{ url(route('dashboard.home')) }}"
          class="nav-link nav-toggle">
          <i class="icon-home"></i>
          <span class="title">{{ __('apps::dashboard.index.title') }}</span>
          <span class="selected"></span>
        </a>
      </li>

      <li class="heading">
        <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.roles_permissions') }}</h3>
      </li>

      @permission('show_roles')
      <li class="nav-item {{ active_menu('roles') }}">
        <a href="{{ url(route('dashboard.roles.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.roles') }}</span>
        </a>
      </li>
      @endpermission


      <li class="heading">
        <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.users') }}</h3>
      </li>



      @permission('show_admins')
      <li class="nav-item {{ active_menu('admins') }}">
        <a href="{{ url(route('dashboard.admins.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.admins') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_users')
      <li class="nav-item {{ active_menu('users') }}">
        <a href="{{ url(route('dashboard.users.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.users') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_companies')
      <li class="nav-item {{ active_menu('companies') }}">
        <a href="{{ url(route('dashboard.companies.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.companies') }}</span>
        </a>
      </li>
      @endpermission


      <li class="heading">
        <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.areas') }}</h3>
      </li>

      @permission('show_countries')
      <li class="nav-item {{ active_menu('countries') }}">
        <a href="{{ url(route('dashboard.countries.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.countries') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_cities')
      <li class="nav-item {{ active_menu('cities') }}">
        <a href="{{ url(route('dashboard.cities.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.cities') }}</span>
        </a>
      </li>
      @endpermission




      @permission('show_states')
      <li class="nav-item {{ active_menu('states') }}">
        <a href="{{ url(route('dashboard.states.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.states') }}</span>
        </a>
      </li>
      @endpermission






      <li class="heading">
        <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.catalog') }}</h3>
      </li>


      @permission('show_sections')
      <li class="nav-item {{ active_menu('sections') }}">
        <a href="{{ url(route('dashboard.sections.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.sections') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_attributes')
      <li class="nav-item {{ active_menu('attributes') }}">
        <a href="{{ url(route('dashboard.attributes.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.attributes') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_categories')
      <li class="nav-item {{ active_menu('categories') }}">
        <a href="{{ url(route('dashboard.categories.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.categories') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_addations')
      <li class="nav-item {{ active_menu('addations') }}">
        <a href="{{ url(route('dashboard.addations.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.addations') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_ad_types')
      <li class="nav-item {{ active_menu('ad_types') }}">
        <a href="{{ url(route('dashboard.ad_types.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.ad_types') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_ads')
      <li class="nav-item {{ active_menu('ads') }}">
        <a href="{{ url(route('dashboard.ads.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.ads') }}</span>
        </a>
      </li>
      @endpermission


      @permission('show_payments')
      <li class="nav-item {{ active_menu('payments') }}">
        <a href="{{ url(route('dashboard.payments.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.payments') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_coupons')
      <li class="nav-item {{ active_menu('coupons') }}">
        <a href="{{ url(route('dashboard.coupons.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.coupons') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_coins')
      <li class="nav-item {{ active_menu('rd.coins') }}">
        <a href="{{ url(route('dashboard.coins.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.coins') }}</span>
        </a>
      </li>

      <li class="nav-item {{ active_menu('rd.coins_transactions') }}">
        <a href="{{ url(route('dashboard.coins_transactions.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.coins_transactions') }}</span>
        </a>
      </li>
      @endpermission

      <li class="heading">
        <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.other') }}</h3>
      </li>
      {{--
      @permission('show_advertisement')
      <li class="nav-item {{ active_menu('advertisement') }}">
        <a href="{{ url( route('dashboard.advertisement.index') ) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.advertisement') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_slider')
      <li class="nav-item {{ active_menu('slider') }}">
        <a href="{{ url(route('dashboard.slider.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.slider') }}</span>
        </a>
      </li>
      @endpermission


      @permission('show_offers')
      <li class="nav-item {{ active_menu('offers') }}">
        <a href="{{ url(route('dashboard.offers.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.offers') }}</span>
        </a>
      </li>
      @endpermission --}}


      @permission('show_shipping_companies')
      <li class="nav-item {{ active_menu('shipping_companies') }}">
        <a href="{{ url(route('dashboard.shipping_companies.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.shipping_companies') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_contact')
      <li class="nav-item {{ active_menu('contact') }}">
        <a href="{{ url(route('dashboard.contact.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.contact') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_pages')

      <li class="nav-item {{ active_menu('pages') }}">
        <a href="{{ url(route('dashboard.pages.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.pages') }}</span>
        </a>
      </li>
      @endpermission

      {{-- @permission('show_questions')
      <li class="nav-item {{ active_menu('questions') }}">
        <a href="{{ url(route('dashboard.questions.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.questions') }}</span>
        </a>
      </li>
      @endpermission --}}


      @permission('edit_settings')
      <li class="nav-item {{ active_menu('setting') }}">
        <a href="{{ url(route('dashboard.setting.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.setting') }}</span>
        </a>
      </li>
      @endpermission

      @permission('show_notifications')
      <li class="nav-item {{ active_menu('notifications') }}">
        <a href="{{ url(route('dashboard.notifications.index')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.notifications') }}</span>
        </a>
      </li>
      @endpermission
      @permission('show_telescope')
      <li class="nav-item {{ active_menu('telescope') }}">
        <a href="{{ url(route('telescope')) }}"
          class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">{{ __('apps::dashboard._layout.aside.telescope') }}</span>
        </a>
      </li>
      @endpermission

    </ul>
  </div>
</div>
