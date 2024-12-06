<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        <span class="text-blue-500">Birtalanék's bookshelf</span>
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
        <!-- Author dropdown -->
        <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
            {{-- <div class="relative lg:inline-flex bg-gray-100 rounded-xl">
                <x-author-dropdown />
            </div> --}}

            <!-- Search -->
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-4 py-2"
                style="min-width: 200px;">
                <form method="GET" action="/books" class="w-full">
                    @if (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif

                    <input type="text" name="search" placeholder="Search by title or author"
                        class="bg-transparent placeholder-black font-semibold text-sm w-full"
                        value="{{ request('search') }}">
                </form>
            </div>
        </div>
</header>
