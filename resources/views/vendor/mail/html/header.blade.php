@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'WinterBike')
<img src="{{ asset('images/logo.webp') }}" class="logo" style="width: 100px; height:100px;" alt="WinterBike Logo">
<h1 
    style="font-weight: bold; font-size: 2rem; color: black;">
    WinterBike
</h1>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
