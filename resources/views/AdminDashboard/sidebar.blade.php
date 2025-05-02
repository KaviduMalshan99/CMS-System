<!-- Page Sidebar Start-->
<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('index') }}" class="mt-0">
                {{-- <img class="img-fluid for-light " src="{{ asset('storage/' . $company->company_logo) }}" alt="Company Logo"  style="width:50px;height:50px;">
                <img class="img-fluid for-dark " src="{{ asset('storage/' . $company->company_logo) }}" alt="Company Logo"  style="width:50px;height:50px;" > --}}

            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"></i></div>
        </div>

        <div class="logo-icon-wrapper">
            <a href="{{ route('index') }}">
                <img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt="">
            </a>
        </div>

        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>

            @if (Auth::check())
                @php
                    $userType = Auth::user()->user_type;
                @endphp

                @if ($userType === 'User')
                    {{-- Do not show anything --}}
                    <p>Please wait for SuperAdmin to grant permission.</p>
                @elseif(in_array($userType, ['Admin', 'Cashier', 'SuperAdmin']))
                    {{-- Show everything --}}
                    <p id="welcome-message" class="ps-5 my-5" style="display: none;">Welcome, {{ $userType }}. You
                        have access to all features.</p>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            if (!localStorage.getItem("welcomeMessageShown")) {
                                document.getElementById("welcome-message").style.display = "block";
                                localStorage.setItem("welcomeMessageShown", "true");
                            }
                        });
                    </script>

                    {{-- Add your content here --}}

                    <script>
                        // Hide the welcome message after 10 seconds
                        setTimeout(() => {
                            const message = document.getElementById('welcome-message');
                            if (message) {
                                message.style.display = 'none';
                            }
                        }, 10000); // 10000 milliseconds = 10 seconds
                    </script>

                    <div id="sidebar-menu">
                        <ul class="sidebar-links" id="simple-bar">
                            <li class="back-btn">
                                <a href="{{ route('index') }}">
                                    <img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}"
                                        alt="">
                                </a>
                                <div class="mobile-back text-end">
                                    <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                                </div>
                            </li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6 class="lan-1">General</h6>
                                </div>
                            </li>

                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="{{ route('index') }}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}">
                                        </use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                                    </svg>
                                    <span class="lan-3">Dashboard</span>
                                </a>
                            </li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6 class="lan-8">Management</h6>
                                </div>
                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="8" r="4"></circle>
                                        <path d="M6 20c0-2.21 1.79-4 4-4h4c2.21 0 4 1.79 4 4"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                                    </svg><span>Customers</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('customers.create') }}">Add Customer</a></li>
                                    <li><a
                                            href="{{ request()->query('ref') === 'view' ? route('customers.show', $customer->id) : route('customers.index') }}">View
                                            Customer</a></li>

                                </ul>
                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="8" r="4"></circle>
                                        <path d="M6 20c0-2.21 1.79-4 4-4h4c2.21 0 4 1.79 4 4"></path>
                                        <rect x="3" y="13" width="18" height="7" rx="2" ry="2">
                                        </rect>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                                    </svg><span>Supplier</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('suppliers.create') }}">Add Supplier</a></li>
                                    <li><a
                                            href="{{ request()->query('ref') === 'view' ? route('suppliers.show', $customer->id) : route('suppliers.index') }}">View
                                            Supplier</a></li>

                                </ul>
                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v13a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6l-3-4z"></path>
                                        <path d="M3 6h18"></path>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                                    </svg><span>Purchase</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('purchases.create_battery') }}">Add New Battery Purchase</a>
                                    </li>
                                    <li><a
                                            href="{{ request()->query('ref') === 'view' ? route('purchases.show', $purchase->id) : route('purchases.index') }}">View
                                            Battery Purchase</a></li>

                                </ul>
                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 7l-4 4"></path>
                                        <path
                                            d="M14.5 2.5a2.121 2.121 0 0 1 3 0l4 4a2.121 2.121 0 0 1 0 3L16 17a2 2 0 0 1-2.83 0L8 11.83a2 2 0 0 1 0-2.83l6.5-6.5z">
                                        </path>
                                        <path d="M4 20l1.5-1.5"></path>
                                        <path d="M2 22l1.5-1.5"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                                    </svg><span>Repair</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('repairs.create') }}">Add New Repair Battery</a></li>
                                    <li><a
                                            href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}">View
                                            Repair Battery</a></li>

                                </ul>
                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="7" width="16" height="10" rx="2"
                                            ry="2">
                                        </rect>
                                        <line x1="22" y1="11" x2="22" y2="13"></line>
                                        <path d="M6 10v4"></path>
                                        <path d="M10 10v4"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                                    </svg><span>Old Battery</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('oldBatteries.create') }}">Add New Old Battery</a></li>
                                    <li><a
                                            href="{{ request()->query('ref') === 'view' ? route('oldBatteries.show', $oldBattery->id) : route('oldBatteries.index') }}">View
                                            Old Battery</a></li>

                                </ul>
                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 10l9-7 9 7"></path>
                                        <path d="M9 21V11h6v10"></path>
                                        <circle cx="16" cy="17" r="2"></circle>
                                        <path d="M18 15l2-2"></path>
                                        <path d="M20 17l-2-2"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                                    </svg><span>Rental</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('rentals.create') }}">Add New Rental</a></li>
                                    <li><a
                                            href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}">View
                                            Rental</a></li>

                                </ul>
                            </li>



                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="10" width="18" height="11" rx="2"
                                            ry="2">
                                        </rect>
                                        <path d="M7 10V6h10v4"></path>
                                        <line x1="7" y1="6" x2="17" y2="6"></line>
                                        <line x1="9" y1="14" x2="9" y2="16"></line>
                                        <line x1="15" y1="14" x2="15" y2="16"></line>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                                    </svg><span>POS</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('POS.index') }}">Battery POS</a></li>
                                    <li><a href="{{ route('POS.lubricant') }}">Lubricant POS</a></li>
                                    {{-- <li><a
                            href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}">View
                            Rental</a></li> --}}

                                </ul>
                            </li>

                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M8 21h8a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2z">
                                        </path>
                                        <path d="M8 10V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"></path>
                                        <line x1="12" y1="14" x2="12" y2="18"></line>
                                        <line x1="10" y1="16" x2="14" y2="16"></line>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                                    </svg><span>Reports</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('reports.IncomesIndex') }}">Income Report</a>
                                        {{-- <li><a href="{{ route('reports.incomeIndex') }}">Income Report</a> --}}
                                    </li>
                                    <li><a href="{{ route('reports.customerIndex') }}">Customer Report</a></li>
                                    <li><a href="{{ route('reports.supplierIndex') }}">Supplier Report</a></li>
                                    <li><a href="{{ route('reports.batteryPurchaseIndex') }}">Battery Purchase
                                            Report</a></li>
                                    <li><a href="{{ route('reports.repairIndex') }}">Repair Report</a></li>
                                    <li><a href="{{ route('reports.repairCompleteIndex') }}">Complete Repair
                                            Report</a></li>
                                    <li><a href="{{ route('reports.RentalIndex') }}">Rental Report</a></li>
                                    <li><a href="{{ route('reports.completeRentalIndex') }}">Complete Rental
                                            Report</a></li>
                                    <li><a href="{{ route('reports.batteryIndex') }}">Battery Report</a></li>
                                    <li><a href="{{ route('reports.LubricantIndex') }}">Lubricant Report</a></li>
                                    <li><a href="{{ route('reports.batteryOrderIndex') }}">Battery POS Report</a></li>
                                    <li><a href="{{ route('reports.batteryOrderPaymentNotCompletedIndex') }}">Battery
                                            POS Payment Not Completed Report</a></li>

                                    <li><a href="{{ route('reports.lubricantOrderIndex') }}">Lubricant POS Report</a>
                                    <li><a href="{{ route('reports.lubricantOrderPaymentNotCompletedIndex') }}">Lubricant
                                            POS Payment Not Completed Report</a>
                                    </li>
                                    <li><a href="{{ route('reports.replacementOrderIndex') }}">Replacement Report</a>
                                    <li><a href="{{ route('adminregistration') }}">Admin Registration</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="{{ route('history.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM12 6v6l4 2">
                                        </path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                                    </svg><span>History</span></a>

                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="7" height="18"></rect>
                                        <rect x="14" y="6" width="7" height="15"></rect>
                                        <line x1="6.5" y1="9" x2="6.5" y2="9"></line>
                                        <line x1="6.5" y1="13" x2="6.5" y2="13"></line>
                                        <line x1="17.5" y1="9" x2="17.5" y2="9"></line>
                                        <line x1="17.5" y1="13" x2="17.5" y2="13"></line>
                                        <line x1="6.5" y1="17" x2="6.5" y2="17"></line>
                                        <line x1="17.5" y1="17" x2="17.5" y2="17"></line>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                                    </svg><span>Settings</span></a>

                                <ul class="sidebar-submenu">


                                    <li><a class="submenu-title" href="#">Company<span class="sub-arrow"><i
                                                    class="fa fa-angle-right"></i></span></a>
                                        <ul class="nav-sub-childmenu submenu-content">
                                            <li><a href="{{ route('company.create') }}">Add Comapany Details</a></li>
                                            <li><a href="{{ route('company.index') }}">View Company</a></li>


                                        </ul>
                                    </li>

                                    <li><a class="submenu-title" href="#">Tax<span class="sub-arrow"><i
                                                    class="fa fa-angle-right"></i></span></a>
                                        <ul class="nav-sub-childmenu submenu-content">
                                            <li><a href="{{ route('tax.create') }}">Add Tax</a></li>
                                            <li><a href="{{ route('tax.index') }}">View Tax </a></li>


                                        </ul>
                                    </li>

                                </ul>

                            </li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Battery & Lubricant</h6>
                                </div>
                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M8 12l4-4l4 4"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-table') }}"></use>
                                    </svg><span>Brand</span></a>
                                <ul class="sidebar-submenu">

                                    <li><a href="{{ route('brand.create') }}">Add Brand </a></li>
                                    <li><a href="{{ route('brand.index') }}">View Brand</a></li>

                                </ul>
                            </li>


                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="4" y="7" width="16" height="10" rx="2"
                                            ry="2">
                                        </rect>
                                        <line x1="20" y1="12" x2="20" y2="12"></line>
                                        <path d="M4 8h16"></path>
                                    </svg>


                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-form') }}"> </use>
                                    </svg><span>Battery</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a class="submenu-title" href="{{ route('batteries.create') }}">Add
                                            Battery<span class="sub-arrow"><i
                                                    class="fa fa-angle-right"></i></span></a>

                                    </li>
                                    <li><a class="submenu-title" href="{{ route('batteries.index') }}">View
                                            Battery<span class="sub-arrow"><i
                                                    class="fa fa-angle-right"></i></span></a>

                                    </li>
                                    <li><a class="submenu-title" href="#">Brand<span class="sub-arrow"><i
                                                    class="fa fa-angle-right"></i></span></a>
                                        <ul class="nav-sub-childmenu submenu-content">
                                            <li><a href="{{ route('brand.index') }}">View Brand</a></li>
                                            <li><a href="{{ route('brand.create') }}">Add Brand </a></li>


                                        </ul>
                                    </li>
                                </ul>
                            </li>


                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="6" y="4" width="12" height="16" rx="2"
                                            ry="2">
                                        </rect>
                                        <path d="M12 1v3"></path>
                                        <circle cx="12" cy="18" r="3"></circle>
                                        <path d="M9 18h6"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-table') }}"></use>
                                    </svg><span>Lubricant</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a class="submenu-title" href="{{ route('lubricants.create') }}">Add
                                            Lubricant<span class="sub-arrow"><i
                                                    class="fa fa-angle-right"></i></span></a>

                                    </li>
                                    <li><a class="submenu-title" href="{{ route('lubricants.index') }}"> View
                                            Lubricant<span class="sub-arrow"><i
                                                    class="fa fa-angle-right"></i></span></a>

                                    </li>

                                    <li><a class="submenu-title" href="{{ route('lubricant_purchases.index') }}">
                                            View
                                            purchases<span class="sub-arrow"><i
                                                    class="fa fa-angle-right"></i></span></a>

                                    </li>

                                </ul>
                            </li>


                            {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                    class="sidebar-link sidebar-title" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M8 12l4-4l4 4"></path>
                                    </svg>

                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-table') }}"></use>
                                    </svg><span>Brand</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('brand.index') }}">View Brand</a></li>
                                    <li><a href="{{ route('brand.create') }}">Add Brand </a></li>

                                </ul>
                            </li> --}}

                            <br />
                        </ul>
                    </div>
                @else
                    {{-- Fallback for unexpected user_type --}}
                    <p>Unauthorized access.</p>
                @endif
            @else
                <p>You need to log in to access this page.</p>
            @endif

            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->

<style>
    .logo-wrapper img {
        height: 70px;
        /* Adjust height as needed */
        width: auto;
        /* Maintain aspect ratio */
        max-width: 150px;
        /* Set max width if necessary */
    }

    .logo-wrapper img.for-dark {
        height: 70px;
        /* Ensure dark mode logo has the same height */
        width: auto;
        max-width: 150px;
    }
</style>
