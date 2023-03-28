          <!-- Left Sidebar  -->
            <div class="left-menu ">
                <div class="menubar-content">
                    <nav class="animated bounceInDown">
                        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" id="sidebar">
                            <li class="lii {{ request()->is('dashboard') ? 'active' : '' }}">
                                <a href="{{ route('dashboard') }}"><i class="bi fs-5 pe-2 bi-graph-up-arrow"></i><span
                                        class="hide-menu ">{{ __('en.Dashboard') }}</span></a>
                            </li>
                            <li class="lii {{ request()->is('customer') ? 'active' : '' }}">
                                <a href="{{ route('customer.index') }}"><i class="bi fs-5 pe-2 bi-people-fill"></i><span
                                    class="hide-menu ">{{ __('en.Customers') }}</span></a>
                            </li>
                            <li class="lii {{ request()->is('product') ? 'active' : '' }}">
                                <a href="{{ route('product.index') }}"><i class="bi fs-5 pe-2 bi-boxes"></i><span
                                    class="hide-menu ">{{ __('en.Products') }}</span></a>
                            </li>
                            <li class="lii {{ request()->is('sale') ? 'active' : '' }}">
                                <a href="{{ route('sale.index') }}"><i class="bi fs-5 pe-2 bi-cart4"></i><span
                                        class="hide-menu ">{{ __('en.Sale') }}</span></a>
                            </li>

                            <li class="lii {{ request()->is('purchase') ? 'active' : '' }}">
                                <a href="{{ route('purchase.index') }}"><i class="bi fs-5 pe-2 bi-receipt-cutoff"></i><span
                                        class="hide-menu ">{{ __('en.Purchase') }}</span></a>
                            </li>

                            <li class="lii {{ request()->is('expense') ? 'active' : '' }}">
                                <a href="{{ route('expense.index') }}"><i class="bi fs-5 pe-2 bi-wallet2"></i><span
                                        class="hide-menu ">{{ __('en.Expense') }}</span></a>
                            </li>
                            
                            <li class="lii {{ request()->is('production') ? 'active' : '' }}">
                                <a href="{{ route('production.index') }}"><i class="bi fs-5 pe-2 bi-repeat"></i><span
                                        class="hide-menu ">{{ __('en.Production') }}</span></a>
                            </li>
                                                        
                            {{-- <li class="lii {{ request()->is('raw') ? 'active' : '' }}">
                                <a href=""><i class="bi fs-5 pe-2 bi-wallet2"></i><span
                                        class="hide-menu ">{{ __('en.Raw Material') }}</span></a>
                            </li> --}}
                            {{-- Manage Users routes --}}
                            {{-- <li class="lii {{ request()->is('manageUser/*') ? 'active' : '' }} collapsed"
                                data-bs-toggle="collapse" data-bs-target="#ManageUser" aria-expanded="true">
                                <a href="#"><i
                                        class="bi fs-5 pe-2 bi-person-square"></i><span>{{ __('en.Manage Users') }}</span>
                                    <i class="bi bi-caret-down-fill right"></i></a>
                            </li>
                            <ul class="submenu collapse {{ request()->is('manageUser/*') ? 'show' : '' }}"
                                id="ManageUser">
                                <li class="lii {{ request()->route()->getName() == 'group'? 'active': '' }}">
                                    <a href="{{ route('group') }}"><i class="bi fs-5 pe-2 bi-bounding-box"></i><span
                                            class="hide-menu">{{ __('en.Groups') }}
                                        </span></a>
                                </li>
                                <li class="lii {{ request()->route()->getName() == 'module'? 'active': '' }}">
                                    <a href="{{ route('module') }}"><i class="bi fs-5 pe-2 bi-ui-checks-grid"></i><span
                                            class="hide-menu">{{ __('en.Modules') }}</span></a>
                                </li>
                                <li class="lii {{ request()->route()->getName() == 'user'? 'active': '' }}">
                                    <a href="{{ route('user') }}"><i class="bi fs-5 pe-2 bi-people-fill"></i><span
                                            class="hide-menu">{{ __('en.Users') }}</span></a>
                                </li>
                                <li class="lii {{ request()->route()->getName() == 'blog'? 'active': '' }}">
                                    <a href="{{ route('blog') }}"><i class="bi fs-5 pe-2 bi-journal-richtext"></i><span
                                            class="hide-menu">{{ __('en.Blogs') }}</span></a>
                                </li>

                            </ul> --}}

                              {{-- setting Route --}}
                            {{-- <li class="lii {{ request()->is('settings/*') ? 'active' : '' }} collapsed"
                                data-bs-toggle="collapse" data-bs-target="#settings" aria-expanded="true">
                                <a href="#"><i class="bi fs-5 pe-2 bi-gear"></i><span>{{ __('en.Settings') }}</span>
                                    <i class="bi bi-caret-down-fill right"></i></a>
                            </li>
                            <ul class="submenu collapse {{ request()->is('settings/*') ? 'show' : '' }}"
                                id="settings">
                                <li class="lii collapsed" data-bs-toggle="collapse" data-bs-target="#emails"
                                    aria-expanded="true">
                                    <a href="#"><i class="bi fs-5 pe-2 bi-envelope-fill"></i>
                                        <span class="hide-menu">{{ __('en.Emails') }}</span><i
                                            class="bi bi-caret-down-fill right"></i></a>
                                </li>
                                <ul class="submenu collapse {{ request()->is('emails/*') ? 'active' : '' }}"
                                    id="emails">
                                    <li
                                        class="{{ request()->route()->getName() == 'email-placeholder'? 'active': '' }}">
                                        <a href="{{ route('email-placeholder') }}"><i class="bi fs-5 pe-2 bi-collection-fill"></i><span
                                                class="hide-menu">{{ __('en.Placeholders') }}</span></a>
                                    </li>
                                    <li class="lii {{ request()->route()->getName() == 'email-template'? 'active': '' }}">
                                        <a href="{{ route('email-template') }}"><i class="bi fs-5 pe-2 bi-bookmark-star-fill"></i><span
                                                class="hide-menu">{{ __('en.Template') }}</span></a>
                                    </li>
                                </ul>
                                  <li class="lii {{ request()->route()->getName() == 'setting'? 'active': '' }}">
                                      <a href="{{ route('setting') }}"><i class="bi fs-5 pe-2 bi-gear"></i><span
                                              class="hide-menu">{{ __('en.General Settings') }}</span></a>
                                  </li>
                            </ul> --}}
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End Left Sidebar  -->

            <div class="content-wrapper">
                <div class="min-height-css">
