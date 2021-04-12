<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Users
                </div>
                @if(isset($users) && count($users)>0)
                    @foreach($users as $user)
                        <div class="mt-4 search-user-parent" style="border-bottom: 1px solid #CCC">
                            <table class="table-tbl table-bordered">
                                @if(isset($user->image))
                                    <td>
                                        <img style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;" src="{{ asset('uploads/'. $user->image) }}">
                                    </td>
                                @else
                                    <td>
                                        <img style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;" src="{{ asset('uploads/7620.webp') }}">
                                    </td>
                                @endif
                                <td>
                                    <h1>
                                        {{ $user->name }}
                                    </h1>
                                </td>
                            </table>
                        </div>
                    @endforeach
                @else
                    <h1>No Result</h1>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
