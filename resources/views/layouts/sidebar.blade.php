          <!-- Left Sidebar  -->
            <div class="left-menu ">
                <div class="menubar-content">
                    <nav class="animated bounceInDown">
                        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" id="sidebar">
                            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                                <a href="{{ route('dashboard') }}"><i class="bi fs-5 pe-2 bi-graph-up-arrow"></i><span
                                        class="hide-menu ">{{ __('en.Dashboard') }}</span></a>
                            </li>
                            <li class="{{ request()->is('product') ? 'active' : '' }}">
                                <a href="{{ route('product.index') }}"><i class="bi fs-5 pe-2 bi-boxes"></i><span
                                    class="hide-menu ">{{ __('en.Products') }}</span></a>
                            </li>

                            <li class="{{ request()->is('sale') ? 'active' : '' }}">
                                <a href="{{ route('sale.index') }}"><i class="bi fs-5 pe-2 bi-cart4"></i><span
                                        class="hide-menu ">{{ __('en.Sale') }}</span></a>
                            </li>

                            <li class="{{ request()->is('purchase') ? 'active' : '' }}">
                                <a href="{{ route('purchase.index') }}"><i class="bi fs-5 pe-2 bi-receipt-cutoff"></i><span
                                        class="hide-menu ">{{ __('en.Purchase') }}</span></a>
                            </li>

                            <li class="{{ request()->is('expense') ? 'active' : '' }}">
                                <a href="{{ route('expense.index') }}"><i class="bi fs-5 pe-2 bi-wallet2"></i><span
                                        class="hide-menu ">{{ __('en.Expense') }}</span></a>
                            </li>
                            {{-- Manage Users routes --}}
                            {{-- <li class="{{ request()->is('manageUser/*') ? 'active' : '' }} collapsed"
                                data-bs-toggle="collapse" data-bs-target="#ManageUser" aria-expanded="true">
                                <a href="#"><i
                                        class="bi fs-5 pe-2 bi-person-square"></i><span>{{ __('en.Manage Users') }}</span>
                                    <i class="bi bi-caret-down-fill right"></i></a>
                            </li>
                            <ul class="submenu collapse {{ request()->is('manageUser/*') ? 'show' : '' }}"
                                id="ManageUser">
                                <li class="{{ request()->route()->getName() == 'group'? 'active': '' }}">
                                    <a href="{{ route('group') }}"><i class="bi fs-5 pe-2 bi-bounding-box"></i><span
                                            class="hide-menu">{{ __('en.Groups') }}
                                        </span></a>
                                </li>
                                <li class="{{ request()->route()->getName() == 'module'? 'active': '' }}">
                                    <a href="{{ route('module') }}"><i class="bi fs-5 pe-2 bi-ui-checks-grid"></i><span
                                            class="hide-menu">{{ __('en.Modules') }}</span></a>
                                </li>
                                <li class="{{ request()->route()->getName() == 'user'? 'active': '' }}">
                                    <a href="{{ route('user') }}"><i class="bi fs-5 pe-2 bi-people-fill"></i><span
                                            class="hide-menu">{{ __('en.Users') }}</span></a>
                                </li>
                                <li class="{{ request()->route()->getName() == 'blog'? 'active': '' }}">
                                    <a href="{{ route('blog') }}"><i class="bi fs-5 pe-2 bi-journal-richtext"></i><span
                                            class="hide-menu">{{ __('en.Blogs') }}</span></a>
                                </li>

                            </ul> --}}

                              {{-- setting Route --}}
                            {{-- <li class="{{ request()->is('settings/*') ? 'active' : '' }} collapsed"
                                data-bs-toggle="collapse" data-bs-target="#settings" aria-expanded="true">
                                <a href="#"><i class="bi fs-5 pe-2 bi-gear"></i><span>{{ __('en.Settings') }}</span>
                                    <i class="bi bi-caret-down-fill right"></i></a>
                            </li>
                            <ul class="submenu collapse {{ request()->is('settings/*') ? 'show' : '' }}"
                                id="settings">
                                <li class="collapsed" data-bs-toggle="collapse" data-bs-target="#emails"
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
                                    <li class="{{ request()->route()->getName() == 'email-template'? 'active': '' }}">
                                        <a href="{{ route('email-template') }}"><i class="bi fs-5 pe-2 bi-bookmark-star-fill"></i><span
                                                class="hide-menu">{{ __('en.Template') }}</span></a>
                                    </li>
                                </ul>
                                  <li class="{{ request()->route()->getName() == 'setting'? 'active': '' }}">
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
