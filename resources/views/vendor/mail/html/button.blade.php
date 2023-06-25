@props([
    'url',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
    <a href="{{ $url }}" target="_blank" rel="noopener" 
    style="height: 2.5rem; 
           font-weight: 600; 
           background: linear-gradient(to right, #047076, #10564F
); 
           color: white; 
           padding: 0.5rem 1rem; 
           border-radius: 0.25rem; 
           font-size: 1rem;">
     {{ $slot }}
 </a>
 
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
