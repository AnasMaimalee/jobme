@props(['error'])

@error($error)
<p class="mt-1 text-sm text-red-500 font-bold"> {{$message}}</p>
@enderror
