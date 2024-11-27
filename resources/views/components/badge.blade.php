@props(['status'])

<div>
    <!-- Status Badge -->
    @if ($status === 'active')
        <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Active</span>
    @elseif ($status === 'inactive')
        <span class="inline-block px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Inactive</span>
    @elseif ($status === 'pending')
        <span class="inline-block px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">Pending</span>
    @else
        <span class="inline-block px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">Unknown</span>
    @endif
</div>
