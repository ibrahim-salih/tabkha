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
        <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="nav.page_layouts.main">المنيو</span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='menus') class="active" @endif><a class="menu-item" href="{{ route('cooker.menus.index') }}" data-i18n="nav.page_layouts.1_column">عرض المنيو</a>
            </li>
          </ul>
        </li>

        <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الطلبات</span></a>
          <ul class="menu-content">
            <li @if(Session::get('page')=='nationalities') class="active" @endif><a class="menu-item" href="" data-i18n="nav.page_layouts.1_column">عرض الجنسيات</a>
            </li>
          </ul>
        </li>


      </ul>
    </div>
  </div>