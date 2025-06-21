@extends('layout.dashboard.dashboard')

@section('title', 'Sea Catering - Dashboard User')

@section('content')
<div class="mb-8">
    <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-white mb-2">👋 Hello, {{ $user->name }}</h1>
    <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400">Manage your subscription here.</p>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8">
    <h2 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white mb-4">📦 Active Subscription</h2>

    <div id="subscription-card" class="space-y-4 text-sm text-gray-700 dark:text-gray-300">
        <div class="text-gray-400 text-sm">Loading subscription data...</div>
    </div>
</div>

@push('script')
    <script src="{{ url('assets/js/dashboard/user/index.js') }}"></script>
@endpush
@endsection
