<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->check())
            <p>Welcome, {{ auth()->user()->nama }}!</p>

            @if(auth()->user()->isadmin())
                <div class="alert alert-success">
                    <p>You have admin access.</p>
                </div>
            @endif

            @if(auth()->user()->issuperAdmin())
                <div class="alert alert-warning">
                    <p>You have super admin access.</p>
                </div>
            @endif

            @if(auth()->user()->isguest())
                <div class="alert alert-info">
                    <p>You are viewing this as a guest.</p>
                </div>
            @endif
        @else
            <p>Please log in to access this dashboard.</p>
        @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
