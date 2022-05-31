<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('products.detail') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="flex justify-start max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-6">
                <x-link href="{{ route('product-overview') }}">
                    Back to {{ __('products.overview') }}
                </x-link>
            </div>
        </div>
    </div>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Name: {{ $product->name }}<br>
                    Description: {{ $product->description }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
