<div style="text-align: center;">
    <table style="margin: 0 auto; width: 100%; margin-bottom: 30px;">
        <tr>
            <td colspan="4" style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">
                Laporan Pelanggaran
            </td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">
               SMKN 12 Kabupaten Tangerang
            </td>
        </tr>
    </table>
</div>
@if($modSiswa)
    <div style="text-align: center; margin-bottom: 20px;">
        <table style="margin: 0 auto; width: 100%;">
            <tr>
                <td>
                    Nama Siswa
                </td>
                <td>
                    :
                </td>
                <td>
                    {{ $modSiswa->nama }}
                </td>
            </tr>
            <tr>
                <td>
                    NIS
                </td>
                <td>
                    :
                </td>
                <td>
                    {{ $modSiswa->nis }}
                </td>
            </tr>
            <tr>
                <td>
                    Kelas
                </td>
                <td>
                    :
                </td>
                <td>
                    {{ $modSiswa->kelas->nama_kelas }} ({{ $modSiswa->kelas->subkelas }})
                </td>
            </tr>
            <tr>
                <td>
                    Tempat Lahir
                </td>
                <td>
                    :
                </td>
                <td>
                    {{ $modSiswa->tempat_lahir . ' ' . $modSiswa->tanggal_lahir->format('d-m-Y') }}
                </td>
            </tr>
            <tr>
                <td>
                    Jenis Kelamin
                </td>
                <td>
                    :
                </td>
                <td>
                    {{ $modSiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                </td>
            </tr>
            <tr>
                <td>
                    Alamat
                </td>
                <td>
                    :
                </td>
                <td>
                    {{ $modSiswa->alamat }}
                </td>
            </tr>
        </table>
    </div>
@endif

<table class="table table-bordered mb-0" style="border: none; width: 100%;">
    <thead style="background-color: #f8f9fa;">
        <tr>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; text-align: center; vertical-align: middle;">
                NO</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; text-align: center; vertical-align: middle;">
                TANGGAL</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; text-align: center; vertical-align: middle;">
                PELANGGARAN</th>
            <th
                style="border: 1px solid #e5e7eb; padding: 12px; font-weight: 600; color: #374151; text-align: center; vertical-align: middle;">
                POIN</th>
        </tr>
    </thead>
    <tbody>
        @php $totalPoin = 0; @endphp
        @forelse($laporanPelanggaran as $groupKey => $group)
            @php $rowspan = $group->count(); @endphp
            @foreach ($group as $i => $item)
                <tr>
                    @if ($i == 0)
                        <td rowspan="{{ $rowspan }}" style="text-align: center; vertical-align: middle; border: 1px solid #e5e7eb;">
                            {{ $loop->parent->iteration }}.
                        </td>
                        <td rowspan="{{ $rowspan }}" style="text-align: center; vertical-align: middle; border: 1px solid #e5e7eb;">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                        </td>
                    @endif
                    <td style="vertical-align: middle; border: 1px solid #e5e7eb;">{{ $item->nama_pelanggaran }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #e5e7eb;">{{ $item->poin }}</td>
                    @php $totalPoin += $item->poin; @endphp
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="7" class="text-center" style="font-style:italic; border: 1px solid #e5e7eb;">
                    Tidak ada data pelanggaran
                </td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="text-align: right; font-weight: bold; border: 1px solid #e5e7eb;">Total Poin Pelanggaran</td>
            <td style="text-align: center; font-weight: bold; border: 1px solid #e5e7eb;">{{ $totalPoin }}</td>
        </tr>
    </tfoot>
</table>
