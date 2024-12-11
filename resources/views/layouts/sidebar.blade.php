<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" />
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li @class(['nav-item', 'active' => Route::is('home')])>
                <a href="{{ route('home') }}">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22">
                            <path
                                d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z" />
                        </svg>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->code== 'A')
            <li @class([
                'nav-item nav-item-has-children',
                'active' => Route::is('purchases.*'),
            ])>
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_pembelian"
                    aria-controls="menu_pembelian" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <i class="lni lni-wallet"></i>
                    </span>
                    <span class="text">Pembelian</span>
                </a>
                <ul id="menu_pembelian" @class(['collapse dropdown-nav', 'show' => Route::is('purchases.*')])>
                    <li>
                        <a @class(['active' => Route::is('purchases.cash.*')]) href="{{ route('purchases.cash.index') }}">Cash </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('purchases.debt.*')]) href="{{ route('purchases.debt.index') }}">Hutang </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('purchases.transfer.*')]) href="{{ route('purchases.transfer.index') }}">Transfer </a>
                    </li>
                </ul>
            </li>
            <li @class([
                'nav-item nav-item-has-children',
                'active' => Route::is('sales.*'),
            ])>
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_penjualan"
                    aria-controls="menu_penjualan" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <i class="lni lni-cart"></i>
                    </span>
                    <span class="text">Penjualan</span>
                </a>
                <ul id="menu_penjualan" @class(['collapse dropdown-nav', 'show' => Route::is('sales.*')])>
                    <li>
                        <a @class(['active' => Route::is('sales.cash.*')]) href="{{ route('sales.cash.index') }}">Cash </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('sales.receivable.*')]) href="{{ route('sales.receivable.index') }}">Piutang </a>
                    </li>
                    {{-- <li>
                        <a @class(['active' => Route::is('sales.transfer.*')]) href="{{ route('sales.transfer.index') }}">Transfer </a>
                    </li> --}}
                </ul>
            </li>

            <li @class([
                'nav-item nav-item-has-children',
                'active' => Route::is('receivable-payments.*'),
            ])>
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_piutang"
                    aria-controls="menu_piutang" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <i class="lni lni-money-location"></i>
                    </span>
                    <span class="text">Pembayaran Piutang Cash</span>
                </a>
                <ul id="menu_piutang" @class([
                    'collapse dropdown-nav',
                    'show' => Route::is('receivable-payments.*'),
                ])>
                    <li>
                        <a @class(['active' => Route::is('receivable-payments.cash.*')]) href="{{ route('receivable-payments.cash.index') }}">Cash </a>
                    </li>
                    {{-- <li>
                        <a @class(['active' => Route::is('receivable-payments.transfer.*')])
                            href="{{ route('receivable-payments.transfer.index') }}">Transfer </a>
                    </li> --}}
                </ul>
            </li>

            <li @class([
                'nav-item nav-item-has-children',
                'active' => Route::is('report.*'),
            ])>
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_5"
                    aria-controls="ddmenu_5" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.75 4.58325H16.5L15.125 6.41659L13.75 4.58325ZM4.58333 1.83325H17.4167C18.4342 1.83325 19.25 2.65825 19.25 3.66659V18.3333C19.25 19.3508 18.4342 20.1666 17.4167 20.1666H4.58333C3.575 20.1666 2.75 19.3508 2.75 18.3333V3.66659C2.75 2.65825 3.575 1.83325 4.58333 1.83325ZM4.58333 3.66659V7.33325H17.4167V3.66659H4.58333ZM4.58333 18.3333H17.4167V9.16659H4.58333V18.3333ZM6.41667 10.9999H15.5833V12.8333H6.41667V10.9999ZM6.41667 14.6666H15.5833V16.4999H6.41667V14.6666Z" />
                        </svg>
                    </span>
                    <span class="text"> Laporan </span>
                </a>
                <ul id="ddmenu_5" @class(['collapse dropdown-nav', 'show' => Route::is('report.*')])>
                    <li>
                        <a @class(['active' => Route::is('report.sales')]) href="{{ route('report.sales') }}">
                            Penjualan
                        </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('report.purchases')]) href="{{ route('report.purchases') }}">
                            Pembelian
                        </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('report.receivable-payments')]) href="{{ route('report.receivable-payments') }}">
                            Pembayaran Piutang
                        </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('report.debt-payments')]) href="{{ route('report.debt-payments') }}">
                            Pembayaran Hutang
                        </a>
                    </li>
                </ul>
            </li>
            <li @class([
                'nav-item nav-item-has-children',
                'active' => Route::is('users.*'),
            ])>
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_6"
                    aria-controls="ddmenu_6" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.66675 4.58325V16.4999H19.2501V4.58325H3.66675ZM5.50008 14.6666V6.41659H8.25008V14.6666H5.50008ZM10.0834 14.6666V11.4583H12.8334V14.6666H10.0834ZM17.4167 14.6666H14.6667V11.4583H17.4167V14.6666ZM10.0834 9.62492V6.41659H17.4167V9.62492H10.0834Z" />
                        </svg>
                    </span>
                    <span class="text">Management </span>
                </a>
                <ul id="ddmenu_6" @class([
                    'collapse dropdown-nav',
                    'show' => Route::is('products.*') || Route::is('users.*'),
                ])>
                    <li>
                        <a @class(['active' => Route::is('users.*')]) href="{{ route('users.index') }}">Pengguna </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('products.*')]) href="{{ route('products.index') }}">Barang </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('banks.*')]) href="{{ route('banks.index') }}">Bank </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('norekenings.*')]) href="{{ route('norekenings.index') }}">No Rekening </a>
                    </li>
                </ul>
            </li>
            @else
            <li @class([
                'nav-item nav-item-has-children',
                'active' => Route::is('sales.*'),
            ])>
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_penjualan"
                    aria-controls="menu_penjualan" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <i class="lni lni-cart"></i>
                    </span>
                    <span class="text">Penjualan</span>
                </a>
                <ul id="menu_penjualan" @class(['collapse dropdown-nav', 'show' => Route::is('sales.*')])>
                    <li>
                        <a @class(['active' => Route::is('sales.cash.*')]) href="{{ route('sales.cash.index') }}">Cash </a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('sales.receivable.*')]) href="{{ route('sales.receivable.index') }}">Piutang </a>
                    </li>
                    {{-- <li>
                        <a @class(['active' => Route::is('sales.transfer.*')]) href="{{ route('sales.transfer.index') }}">Transfer </a>
                    </li> --}}
                </ul>
            </li>

            <li @class([
                'nav-item nav-item-has-children',
                'active' => Route::is('receivable-payments.*'),
            ])>
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_piutang"
                    aria-controls="menu_piutang" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <i class="lni lni-money-location"></i>
                    </span>
                    <span class="text">Pembayaran Piutang Cash</span>
                </a>
                <ul id="menu_piutang" @class([
                    'collapse dropdown-nav',
                    'show' => Route::is('receivable-payments.*'),
                ])>
                    <li>
                        <a @class(['active' => Route::is('receivable-payments.cash.*')]) href="{{ route('receivable-payments.cash.index') }}">Cash </a>
                    </li>
                    {{-- <li>
                        <a @class(['active' => Route::is('receivable-payments.transfer.*')])
                            href="{{ route('receivable-payments.transfer.index') }}">Transfer </a>
                    </li> --}}
                </ul>
            </li>

            <li @class([
                'nav-item nav-item-has-children',
                'active' => Route::is('report.*'),
            ])>
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_5"
                    aria-controls="ddmenu_5" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.75 4.58325H16.5L15.125 6.41659L13.75 4.58325ZM4.58333 1.83325H17.4167C18.4342 1.83325 19.25 2.65825 19.25 3.66659V18.3333C19.25 19.3508 18.4342 20.1666 17.4167 20.1666H4.58333C3.575 20.1666 2.75 19.3508 2.75 18.3333V3.66659C2.75 2.65825 3.575 1.83325 4.58333 1.83325ZM4.58333 3.66659V7.33325H17.4167V3.66659H4.58333ZM4.58333 18.3333H17.4167V9.16659H4.58333V18.3333ZM6.41667 10.9999H15.5833V12.8333H6.41667V10.9999ZM6.41667 14.6666H15.5833V16.4999H6.41667V14.6666Z" />
                        </svg>
                    </span>
                    <span class="text"> Laporan </span>
                </a>
                <ul id="ddmenu_5" @class(['collapse dropdown-nav', 'show' => Route::is('report.*')])>
                    <li>
                        <a @class(['active' => Route::is('report.sales')]) href="{{ route('report.sales') }}">
                            Penjualan
                        </a>
                    </li>
                    {{-- <li>
                        <a @class(['active' => Route::is('report.receivable-payments')]) href="{{ route('report.receivable-payments') }}">
                            Pembayaran Piutang
                        </a>
                    </li> --}}
                </ul>
            </li>
            @endif
            
        </ul>
    </nav>
</aside>
<div class="overlay"></div>
<!-- ======== sidebar-nav end =========== -->
