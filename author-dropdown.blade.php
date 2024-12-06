<x-dropdown>
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{ isset($currentAuthor) ? ucwords($currentAuthor->name) : 'Authors' }}
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />
        </button>
    </x-slot>

    <x-dropdown-item href="/books?{{ http_build_query(request()->except('author', 'page')) }}" :active="request()->routeIs('books.index') && is_null(request()->getQueryString())">
        All
    </x-dropdown-item>

    @foreach (\App\Models\Author::all()->sortBy('name')->take(10) as $author)
        <x-dropdown-item class="dropdown-item" style="white-space: nowrap;"
            href="/books?author={{ $author->id }}&{{ http_build_query(request()->except('author', 'page')) }}"
            :active="request()->fullUrlIs('?author=' . $author->id . '*')">
            {{ ucwords($author->name) }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>
