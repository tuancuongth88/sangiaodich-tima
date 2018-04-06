<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
     data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
            <a href="index.html" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            Dashboard
                        </span>
                        <span class="m-menu__link-badge">
                            <span class="m-badge m-badge--danger">2</span>
                        </span>
                    </span>
                </span>
            </a>
        </li>
        <li class="m-menu__section">
            <h4 class="m-menu__section-text">
                Components
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-tea-cup"></i>
                <span class="m-menu__link-text">
                    Tin tức
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ action('Administrators\News\NewsCategoryController@index') }}"
                           class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Danh mục
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ action('Administrators\News\NewsController@index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Bài viết
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-tea-cup"></i>
                <span class="m-menu__link-text">
                    Hỏi đáp
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ action('Administrators\Faqs\FaqCategoriesController@index') }}"
                           class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Danh mục
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ action('Administrators\Faqs\FaqController@index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Bài viết
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-users"></i>
                <span class="m-menu__link-text">
                    User
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ action('Administrators\Users\UserController@index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Danh sách
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- quan ly doi tac -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-layers"></i>
                <span class="m-menu__link-text">
                    Đối tác
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ action('Administrators\Partner\PartnerCategoryController@index') }}"
                           class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Danh mục
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ route('partner.index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Đối tác
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-layers"></i>
                <span class="m-menu__link-text">
                   Dịch vụ
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item">
                        <a href="{{ route('service.index') }}" class="m-menu__link ">
                            <i class="fa fa-list-ul"></i> Danh sách dịch vụ
                        </a>
                    </li>
                    <li class="m-menu__item">
                        <a href="{{ action('Administrators\Services\ServiceController@create') }}" class="m-menu__link ">
                            <i class="fa fa-list-ul"></i> Thêm mới
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- cấu hình hệ thống -->
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
            <a href="#" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-layers"></i>
                <span class="m-menu__link-text">
                    Contact Form
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item " aria-haspopup="true">
                        <a href="{{ route('contact.index') }}" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                Contact Form
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- cấu hình hệ thống -->
        <li class="m-menu__item">
            <a href="{{ action('Administrators\Systems\DashboardController@getLocation') }}" class="m-menu__link">
                <i class="m-menu__link-icon flaticon-layers"></i>
                <span class="m-menu__link-text">
                    Danh mục tỉnh, thành
                </span>
            </a>
        </li>
    </ul>
</div>