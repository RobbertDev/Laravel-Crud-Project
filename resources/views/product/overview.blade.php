<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('products.overview') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="flex justify-end max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-6">
                <x-link href="{{ route('product-create') }}">
                    {{ __('products.create') }}
                </x-link>
            </div>
        </div>
    </div>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="table w-full">
                        <div class="table-header-group">
                            <div class="table-row">
                                <div class="table-cell text-left">Name</div>
                                <div class="table-cell text-left">Description</div>
                                <div class="table-cell text-left">Actions</div>
                            </div>
                        </div>
                        <div class="table-row-group">
                            @foreach($products as $product)
                                <div class="table-row">
                                    <div class="table-cell text-left"><a class="text-blue-600 hover:text-blue-900" href="{{ route('product-detail', ['id' => $product->id]) }}">{{ $product->name }}</a></div>
                                    <div class="table-cell text-left">{{ $product->description }}</div>
                                    <div>
                                        <a href="{{ route('product-delete', ['id'=>$product->id]) }}">{{ __('Delete') }}</a>
{{--                                        <a href="{{ route('product-edit', ['id'=>$product->id]) }}">{{ __('Edit') }}</a>--}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
