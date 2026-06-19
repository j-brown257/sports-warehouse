<nav class="bg-sw-dark rounded-lg mb-6 px-2 flex flex-wrap">
    <a href="{{ route('admin.items.index') }}"
       class="px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.items.*') ? 'text-white border-b-2 border-sw-orange' : 'text-gray-300 hover:text-white' }}">
        Manage Products
    </a>
    <a href="{{ route('admin.categories.index') }}"
       class="px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.categories.*') ? 'text-white border-b-2 border-sw-orange' : 'text-gray-300 hover:text-white' }}">
        Manage Categories
    </a>
    <span class="px-4 py-3 text-sm font-semibold text-gray-500 cursor-not-allowed" title="Coming soon">
        Manage Orders
        <span class="ml-1 text-[10px] uppercase bg-gray-600 text-gray-200 rounded px-1.5 py-0.5">Soon</span>
    </span>
    <span class="px-4 py-3 text-sm font-semibold text-gray-500 cursor-not-allowed" title="Coming soon">
        Manage Customers
        <span class="ml-1 text-[10px] uppercase bg-gray-600 text-gray-200 rounded px-1.5 py-0.5">Soon</span>
    </span>
        <span class="px-4 py-3 text-sm font-semibold text-gray-500 cursor-not-allowed" title="Coming soon">
        Manage Users
        <span class="ml-1 text-[10px] uppercase bg-gray-600 text-gray-200 rounded px-1.5 py-0.5">Soon</span>
    </span>
</nav>