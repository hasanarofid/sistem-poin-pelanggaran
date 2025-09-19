<div style="text-align: center;">
    <table style="margin: 0 auto;">
        <tr>
            <td colspan="7" style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">
               Laporan Pelanggaran
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: center; vertical-align: middle;">{{ \Carbon\Carbon::parse($dari_tanggal)->format('d-m-Y') }} Sampai {{ \Carbon\Carbon::parse($sampai_tanggal)->format('d-m-Y') }}</td>
        </tr>
        @if($modKelas)
            <tr>
                <td colspan="7" style="text-align: center; vertical-align: middle;">Kelas: {{ $modKelas->nama_kelas }} ({{ $modKelas->subkelas }})</td>
            </tr>
        @endif
    </table>
</div>
<table class="table table-bordered mb-0" style="border: none;">
    <thead style="background-color: #f8f9fa;">
        <tr>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                NO</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                TANGGAL</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                SISWA</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                KELAS</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                PELANGGARAN</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                KETERANGAN</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                POIN</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; border-top: none; text-align: center; vertical-align: middle;">
                PELAPOR</th>
        </tr>
    </thead>
    <tbody>
        @forelse($laporanPelanggaran as $groupKey => $group)
            @php $rowspan = $group->count(); @endphp
            @foreach ($group as $i => $item)
                <tr>
                    @if ($i == 0)
                        <td rowspan="{{ $rowspan }}" style="text-align: center; vertical-align: middle;">
                            {{ $loop->parent->iteration }}.
                        </td>
                        <td rowspan="{{ $rowspan }}" style="text-align: center; vertical-align: middle;">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                        </td>
                        <td rowspan="{{ $rowspan }}" style="vertical-align: middle;">{{ $item->nama }}</td>
                        <td rowspan="{{ $rowspan }}" style="vertical-align: middle;">
                            {{ $item->nama_kelas . ' (' . $item->subkelas . ')' }}
                        </td>
                    @endif
                    <td style="vertical-align: middle;">{{ $item->nama_pelanggaran }}</td>
                    <td style="vertical-align: middle;">{{ $item->keterangan }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->poin }}</td>
                    @if ($i == 0)
                        <td rowspan="{{ $rowspan }}" style="vertical-align: middle;">{{ $item->pelapor }}</td>
                    @endif
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="7" class="text-center" style="font-style:italic;">
                    Tidak ada data pelanggaran
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
