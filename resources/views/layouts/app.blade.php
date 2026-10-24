<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sports Warehouse')</title>
    <meta name="description" content="@yield('meta_description', 'Shop footwear, apparel and equipment across soccer, running, training and more at Sports Warehouse — fast delivery across Australia.')">
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">

    {{-- Google Fonts: Open Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Tailwind compiled by Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-800 bg-white">

    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:bg-sw-dark focus:text-white focus:px-4 focus:py-2 focus:rounded">Skip to content</a>

    {{-- ================ HEADER ================ --}}
    <header>

        {{-- Top nav bar (sky blue) --}}
        <div class="bg-sw-blue text-sw-dark">
            <div class="container-960 py-3 flex justify-between items-center gap-4">
                <nav class="hidden md:flex items-center gap-4 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-sw-orange whitespace-nowrap">Home</a>
                    <a href="#" class="hover:text-sw-orange whitespace-nowrap">About SW</a>
                    <a href="{{ route('contact.show') }}" class="hover:text-sw-orange whitespace-nowrap">Contact Us</a>
                    <a href="{{ route('products.index') }}" class="hover:text-sw-orange whitespace-nowrap">View Products</a>
                </nav>
                <div class="flex items-center gap-4 text-sm ml-auto">
                    @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
                    @auth
                    <a href="{{ route('admin.items.index') }}" class="hover:text-sw-orange whitespace-nowrap"><i class="fas fa-cog mr-1.5"></i> Manage</a>
                    <a href="{{ route('account.password') }}" class="hidden md:inline-flex items-center hover:text-sw-orange whitespace-nowrap">
                    <i class="fas fa-user mr-1.5"></i> {{ auth()->user()->userName }}</a>
                    {{-- <span class="hidden md:inline-flex items-center"><i class="fas fa-user mr-1.5"></i> {{ auth()->user()->userName }}</span> --}}
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                     @csrf
                    <button type="submit" class="hover:text-sw-orange whitespace-nowrap"><i class="fas fa-sign-out-alt mr-1.5"></i> Logout</button>
                    </form>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:inline-flex items-center hover:text-sw-orange whitespace-nowrap">
                        <i class="fas fa-lock mr-1.5"></i> Login</a>
                    @endauth
                    <a href="{{ route('cart.index') }}" class="hover:text-sw-orange whitespace-nowrap">
                        <i class="fas fa-shopping-cart mr-1.5"></i> View Cart
                    </a>
                    <a href="{{ route('cart.index') }}" class="inline-block px-4 py-1 rounded-full bg-sw-dark text-white hover:bg-sw-orange whitespace-nowrap">
                        {{ $cartCount }} {{ $cartCount == 1 ? 'item' : 'items' }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Main header (logo + search) + category nav --}}
        <div class="container-960 py-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                <a href="{{ route('home') }}" class="block">
                    <img src="{{ asset('assets/sports-warehouse-logo-600.png') }}"
                         alt="Sports Warehouse"
                         class="max-h-[60px] md:max-h-[83px] w-auto">
                </a>
                <form action="{{ route('search') }}" method="GET" role="search" class="flex items-center gap-2 w-full md:w-auto">
    <label for="site-search" class="sr-only">Search products</label>
    <input type="search" id="site-search" name="q" placeholder="Search products"
           value="{{ request('q') }}"
           class="w-full md:max-w-[220px] h-10 px-4 rounded-full border border-sw-grey bg-transparent text-sw-grey placeholder:text-sw-grey outline-none focus:outline-2 focus:outline-sw-orange">
                    <button type="submit" aria-label="Search" class="w-10 h-10 flex-shrink-0 bg-sw-dark text-white rounded-full flex items-center justify-center hover:bg-sw-orange">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>

            {{-- Category nav: pulls categories from the database --}}
            @php
                $navCategories = \App\Models\Category::orderBy('categoryId')->get();
            @endphp
            <nav class="bg-sw-dark p-2.5 rounded-lg md:rounded-l-[40px] md:rounded-r-none md:p-0 md:py-2.5">
                <div class="grid grid-cols-2 gap-2 md:flex md:gap-0 md:pl-5">
                    @foreach ($navCategories as $cat)
                        <a href="{{ route('categories.show', $cat->slug) }}"
                           class="text-white text-sm font-normal text-center px-3 py-2 rounded-md md:rounded-full border md:border-0 border-sw-blue hover:bg-sw-blue">
                            {{ $cat->categoryName }}
                        </a>
                    @endforeach
                </div>
            </nav>
        </div>
    </header>

    {{-- ================ MAIN CONTENT ================ --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- ================ FOOTER ================ --}}
    <footer>
        <div class="bg-sw-blue text-sw-dark">
            <div class="container-960 py-6 flex flex-col md:flex-row md:justify-between md:items-stretch gap-6 md:gap-7">

                {{-- Column 1: Site nav --}}
                <div class="w-full md:max-w-[320px] md:flex-1">
                    <h3 class="text-lg font-normal mb-4">Site navigation</h3>
                    <ul class="footer-list">
                        <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                        <li><a href="#" class="hover:underline">About SW</a></li>
                        <li><a href="{{ route('contact.show') }}" class="hover:underline">Contact us</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:underline">View products</a></li>
                        <li><a href="#" class="hover:underline">Privacy policy</a></li>
                    </ul>
                </div>

                {{-- Column 2: Product categories from DB.
                     md:-my-6 makes the orange box bleed past the footer's py-6 padding,
                     so it touches the top and bottom edges of the blue footer area. --}}
                @php
                    $footerCategories = \App\Models\Category::orderBy('categoryId')->get();
                @endphp
                <div class="hidden md:block md:flex-1 md:max-w-[320px] bg-sw-orange px-5 py-6 md:-my-6">
                    <h3 class="text-lg font-normal mb-4">Product categories</h3>
                    <ul class="footer-list">
                        @foreach ($footerCategories as $cat)
                            <li><a href="{{ route('categories.show', $cat->slug) }}" class="hover:text-sw-blue">{{ $cat->categoryName }}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{-- Column 3: Social --}}
                <div class="w-full md:max-w-[320px] md:flex-1">
                    <h3 class="text-lg font-normal mb-4">Contact Sports Warehouse</h3>
                    <div class="flex justify-between gap-4">
                        @foreach ([
                            ['icon' => 'fab fa-facebook-f', 'label' => 'Facebook'],
                            ['icon' => 'fab fa-instagram', 'label' => 'Instagram'],
                            ['icon' => 'fab fa-twitter',    'label' => 'Twitter'],
                            ['icon' => 'fas fa-paper-plane','label' => 'Email'],

                        ] as $social)
                            <a href="#" class="flex flex-col items-center group">
                                <span class="text-3xl border border-white rounded-full w-[68px] h-[68px] flex items-center justify-center text-sw-dark group-hover:bg-sw-orange transition-colors">
                                    <i class="{{ $social['icon'] }}"></i>
                                </span>
                                <span class="mt-2 text-sm text-sw-dark group-hover:text-sw-orange transition-colors">{{ $social['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Sub-footer --}}
        <div class="bg-white text-sw-grey text-center text-xs px-4 py-2.5">
            &copy; Copyright {{ date('Y') }} Sports Warehouse. &nbsp; All rights reserved. &nbsp; Website made by Gelos Enterprises and Jessica Brown
        </div>
    </footer>

</body>
</html>