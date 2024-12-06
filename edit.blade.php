<x-layout>
    <x-setting :heading="'Edit Book: ' . $book->title">
        <form method="POST" action="/admin/books/{{ $book->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Book Title -->
            <x-form.input name="title" :value="old('title', $book->title)" required />

            <!-- Book Author -->
            <x-form.field>
                <x-form.input name="author_name" :value="old('author_name', optional($book->author)->name)" required />
                <x-form.error name="author_name" />
            </x-form.field>

            <!-- Book Position -->
            <x-form.input name="position" :value="old('position', $book->position)" required />

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
