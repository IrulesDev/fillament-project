<x-mail::message>
<img src="{{ asset('public/images/IrulesDevText.png') }}" alt="{{ config('app.name') }} Logo" style="width: 150px; height: auto;">

# Laporan Rapot Siswa

<div style="font-family: Arial, sans-serif; color: #333;">
    <p><strong>Nama Siswa:</strong> {{ $rapotData['name'] ?? 'N/A' }}</p>
    <p><strong>Email Siswa:</strong> {{ $rapotData['email'] ?? 'N/A' }}</p>
    <p><strong>Tahun Akademik:</strong> {{ $rapotData['academy_year'] ?? 'N/A' }}</p>
    <p><strong>Skor Keseluruhan:</strong> <span style="color: #4CAF50;">{{ $rapotData['overall_score'] ?? 'N/A' }}</span></p>
    <p><strong>Kekuatan:</strong></p>
    <p style="background-color: #e7f3fe; padding: 10px; border-radius: 5px;">{{ $rapotData['strengths'] ?? 'Tidak ada data' }}</p>
    <p><strong>Kelemahan:</strong></p>
    <p style="background-color: #ffebee; padding: 10px; border-radius: 5px;">{{ $rapotData['weaknesses'] ?? 'Tidak ada data' }}</p>
</div>

<x-mail::button :url="url('/rapot/detail')" style="animation: pulse 2s infinite; margin-top: 20px;">
Lihat Detail Rapot
</x-mail::button>

<style>
@keyframes pulse {
    0% { background-color: #3490dc; }
    50% { background-color: #6574cd; }
    100% { background-color: #3490dc; }
}
</style>

<p style="margin-top: 20px;">Terima kasih,<br>
{{ config('app.name') }}</p>
</x-mail::message>
