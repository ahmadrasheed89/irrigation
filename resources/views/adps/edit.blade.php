<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Tender') }}
        </h2>
    </x-slot> --}}
    <div class="content">
					<!-- Basic layout -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit ADP ({{ __($adp->adp_code) }})</h5>
            </div>
            <div class="card-body border-top">
                <form action="{{ route('adps.update', $adp) }}" method="POST" >
                    @csrf
                    @method('PUT')
                    @include('adps.form')
                </form>
            </div>
        </div>
        <!-- /basic layout -->
    </div> <!-- Content area -->
</x-app-layout>
