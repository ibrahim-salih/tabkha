<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="index.html"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">لوحة تحكم المطبخ</span><span class="badge badge badge-info badge-pill float-right mr-2">3</span></a>
          <ul class="menu-content">
            <!-- <li class="active"><a class="menu-item" href="cooker-ecommerce.html" data-i18n="nav.dash.ecommerce">eCommerce</a>
            </li> -->
            <li @if(Session::get('page')=='cooker') class="active" @endif><a class="menu-item" href="{{ route('cooker.welcome') }}" data-i18n="nav.dash.crypto">الرئيسية</a>
            </li>
            <!-- <li><a class="menu-item" href="#" data-i18n="nav.dash.sales">Sales</a>
            </li> -->
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="la la-columns"></i><span class="menu-title" data-i18n="nav.page_layouts.main">المطبخ</span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='menus') class="active" @endif><a class="menu-item" href="{{ route('cooker.menus.index') }}" data-i18n="nav.page_layouts.1_column"> <i class="la la-file-text"></i><span class="menu-title" data-i18n="nav.page_layouts.main">المنيو</span></a></li>
          </ul>
        </li>

        <li class=" nav-item"><a href="#"><i class="la la-setting"></i><span class="menu-title" data-i18n="nav.page_layouts.main"><i class="la la-code-fork"></i><span class="menu-title" data-i18n="nav.page_layouts.main">حسابى</span></span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='settings') class="active" @endif><a class="menu-item" href="{{ route('cooker.settings') }}" data-i18n="nav.page_layouts.1_column"> <i class="la la-support"></i><span class="menu-title" data-i18n="nav.page_layouts.main">التوثيق</span></a></li>
            <li @if(Session::get('page')=='package') class="active" @endif><a class="menu-item" href="{{ route('cooker.package') }}" data-i18n="nav.page_layouts.1_column"> <i class="la la-tablet"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الباقة</span></a></li>
            <li @if(Session::get('page')=='charge') class="active" @endif><a class="menu-item" href="{{ route('cooker.charge') }}" data-i18n="nav.page_layouts.1_column"> <i class="la la-bar-chart"></i><span class="menu-title" data-i18n="nav.page_layouts.main">رصيدى</span></a></li>
          </ul>
        </li>

        <li class=" nav-item"><a href="#"><i class="la la-server"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الطلبات</span></a>
          <ul class="menu-content">
            <li ><a class="menu-item" href="" data-i18n="nav.page_layouts.1_column">عرض الجميع</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>