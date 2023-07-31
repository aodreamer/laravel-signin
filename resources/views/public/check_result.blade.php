@if ($data)
<h2>Data Sertifikat:</h2>
<ul>
    @foreach ($data as $key => $value)
        <li><strong>{{ $key }}:</strong> {{ $value }}</li>
    @endforeach
</ul>
@else
<p>Tidak ada data sertifikat yang ditemukan dalam PDF.</p>
@endif