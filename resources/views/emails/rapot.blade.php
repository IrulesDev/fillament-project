<x-mail::message>
# Laporan Rapot Siswa

**Tahun Akademik:** {{ $rapotData['academy_year'] ?? 'N/A' }}

**Skor Keseluruhan:** {{ $rapotData['overall_score'] ?? 'N/A' }}

**Kekuatan:**  
{{ $rapotData['strengths'] ?? 'Tidak ada data' }}

**Kelemahan:**  
{{ $rapotData['weaknesses'] ?? 'Tidak ada data' }}

<x-mail::button :url="url('/rapot/detail')">
Lihat Detail Rapot
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
