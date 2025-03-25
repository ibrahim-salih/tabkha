<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="index.html"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">لوحة التحكم</span><span class="badge badge badge-info badge-pill float-right mr-2">3</span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='dashboard') class="active" @endif><a class="menu-item" href="{{ route('dashboard.welcome') }}" data-i18n="nav.dash.ecommerce">الرئيسية</a>
            </li>
            <!-- <li><a class="menu-item" href="{{ route('dashboard.welcome') }}" data-i18n="nav.dash.crypto">Crypto</a>
            </li>
            <li><a class="menu-item" href="#" data-i18n="nav.dash.sales">Sales</a>
            </li> -->
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="la la-navicon"></i><span class="menu-title" data-i18n="nav.page_layouts.main">المناطق</span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='countries') class="active" @endif><a class="menu-item" href="{{ route('dashboard.countries.index') }}" data-i18n="nav.page_layouts.1_column">عرض المناطق</a>
            </li>
            <li @if(Session::get('page')=='staties') class="active" @endif><a class="menu-item" href="{{ route('dashboard.staties.index') }}" data-i18n="nav.page_layouts.1_column">عرض المدن</a>
          </ul>
        </li>

        
        <li class=" nav-item"><a href="#"><i class="la la-image"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الجنسيات</span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='nationalities') class="active" @endif><a class="menu-item" href="{{ route('dashboard.nationalities.index') }}" data-i18n="nav.page_layouts.1_column">عرض الجنسيات</a>
            </li>
          </ul>
        </li>

        <li class=" nav-item"><a href="#"><i class="la la-terminal"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الاقسام</span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='sections') class="active" @endif><a class="menu-item" href="{{ route('dashboard.sections.index') }}" data-i18n="nav.page_layouts.1_column">الاقسام</a>
            </li>
            <li @if(Session::get('page')=='sections-trashed') class="active" @endif><a class="menu-item" href="{{ route('dashboard.sections.trashed') }}" data-i18n="nav.page_layouts.2_columns">المهملات</a>
            </li>
          </ul>
        </li>

        <li class=" nav-item"><a href="#"><i class="la la-file-text"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الفئات</span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='categories') class="active" @endif><a class="menu-item" href="{{ route('dashboard.categories.index') }}" data-i18n="nav.page_layouts.1_column">الفئات</a>
            </li>
            <li @if(Session::get('page')=='categories-trashed') class="active" @endif><a class="menu-item" href="{{ route('dashboard.categories.trashed') }}" data-i18n="nav.page_layouts.2_columns">المهملات</a>
            </li>
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="la la-android"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الطباخين</span><span class="badge badge badge-pill badge-danger float-right mr-2">جديد</span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='cookers-activated') class="active" @endif><a class="menu-item" href="{{ route('dashboard.cookers.activated') }}" data-i18n="nav.page_layouts.1_column">النشطين</a>
            </li>
            <li @if(Session::get('page')=='cookers-not-activated') class="active" @endif><a class="menu-item" href="{{ route('dashboard.cookers.not-activated') }}" data-i18n="nav.page_layouts.2_columns">الموقوفين</a>
            </li>
            <li @if(Session::get('page')=='cookers') class="active" @endif><a class="menu-item" href="{{ route('dashboard.cookers.index') }}" data-i18n="nav.page_layouts.1_column">الجميع</a>
            </li>
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="la la-user"></i><span class="menu-title" data-i18n="nav.users.main">العملاء</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="user-profile.html" data-i18n="nav.users.user_profile">Users Profile</a>
            </li>
            <li><a class="menu-item" href="user-cards.html" data-i18n="nav.users.user_cards">Users Cards</a>
            </li>
            <li><a class="menu-item" href="users-contacts.html" data-i18n="nav.users.users_contacts">Users List</a>
            </li>
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="la la-server"></i><span class="menu-title" data-i18n="nav.users.main">الطلبات</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="user-profile.html" data-i18n="nav.users.user_profile">Users Profile</a>
            </li>
            <li><a class="menu-item" href="user-cards.html" data-i18n="nav.users.user_cards">Users Cards</a>
            </li>
            <li><a class="menu-item" href="users-contacts.html" data-i18n="nav.users.users_contacts">Users List</a>
            </li>
          </ul>
        </li>
        
        

      </ul>
    </div>
  </div>