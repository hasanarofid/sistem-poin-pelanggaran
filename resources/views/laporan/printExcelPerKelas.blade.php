<div style="text-align: center;">
    <table style="margin: 0 auto;">
        <tr>
            <td colspan="{{ count($data['jenisPelanggaran']) + 2 }}" style="text-align: center; vertical-align: middle; font-size: 18px; font-weight: bold;">
               PENCATATAN POIN TARUNA-TARUNI
            </td>
        </tr>
        <tr>
            <td colspan="{{ count($data['jenisPelanggaran']) + 2 }}" style="text-align: center; vertical-align: middle;">
                Kelas: {{ $data['kelas']->nama_kelas }} ({{ $data['kelas']->subkelas }})
            </td>
        </tr>
        <tr>
            <td colspan="{{ count($data['jenisPelanggaran']) + 2 }}" style="text-align: center; vertical-align: middle;">
                Periode: {{ $data['dari_tanggal'] ? \Carbon\Carbon::parse($data['dari_tanggal'])->format('d-m-Y') : 'Semua' }} 
                @if($data['sampai_tanggal'])
                    Sampai {{ \Carbon\Carbon::parse($data['sampai_tanggal'])->format('d-m-Y') }}
                @endif
            </td>
        </tr>
    </table>
</div>

<table class="table table-bordered mb-0" style="border: 1px solid #000; width: 100%;">
    <thead>
        <!-- Header Row 1: Kode -->
        <tr style="background-color: #E3F2FD;">
            <th style="border: 1px solid #000; padding: 8px; font-weight: bold; text-align: center; vertical-align: middle; width: 5%;">
                NO
            </th>
            <th style="border: 1px solid #000; padding: 8px; font-weight: bold; text-align: center; vertical-align: middle; width: 25%;">
                NAMA
            </th>
            @foreach($data['jenisPelanggaran'] as $jenis)
                <th style="border: 1px solid #000; padding: 4px; font-weight: bold; text-align: center; vertical-align: middle; font-size: 10px;">
                    {{ $jenis->kode }}
                </th>
            @endforeach
        </tr>
        
        <!-- Header Row 2: Poin -->
        <tr style="background-color: #F3E5F5;">
            <th style="border: 1px solid #000; padding: 8px; font-weight: bold; text-align: center; vertical-align: middle;">
                &nbsp;
            </th>
            <th style="border: 1px solid #000; padding: 8px; font-weight: bold; text-align: center; vertical-align: middle;">
                &nbsp;
            </th>
            @foreach($data['jenisPelanggaran'] as $jenis)
                <th style="border: 1px solid #000; padding: 4px; font-weight: bold; text-align: center; vertical-align: middle; font-size: 10px;">
                    {{ $jenis->poin > 0 ? '+' : '' }}{{ $jenis->poin }}
                </th>
            @endforeach
        </tr>
    </thead>
    
    <tbody>
        @foreach($data['siswa'] as $index => $siswa)
            <tr>
                <!-- No -->
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                    {{ $index + 1 }}
                </td>
                
                <!-- Nama Siswa -->
                <td style="border: 1px solid #000; padding: 8px; vertical-align: middle;">
                    {{ $siswa->nama }}
                </td>
                
                <!-- Data Poin untuk setiap jenis pelanggaran -->
                @foreach($data['jenisPelanggaran'] as $jenis)
                    @php
                        $historiSiswa = $data['historiData'][$siswa->id] ?? collect();
                        $count = $historiSiswa->where('kode', $jenis->kode)->count();
                    @endphp
                    <td style="border: 1px solid #000; padding: 4px; text-align: center; vertical-align: middle; font-size: 10px;">
                        @if($count > 0)
                            {{ $count }}
                        @else
                            &nbsp;
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        
        <!-- Baris kosong jika kurang dari 38 siswa -->
        @for($i = count($data['siswa']); $i < 38; $i++)
            <tr>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                    {{ $i + 1 }}
                </td>
                <td style="border: 1px solid #000; padding: 8px; vertical-align: middle;">
                    &nbsp;
                </td>
                @foreach($data['jenisPelanggaran'] as $jenis)
                    <td style="border: 1px solid #000; padding: 4px; text-align: center; vertical-align: middle; font-size: 10px;">
                        &nbsp;
                    </td>
                @endforeach
            </tr>
        @endfor
    </tbody>
</table>

<!-- Footer -->
<div style="margin-top: 30px;">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: left; font-size: 12px;">
                Tangerang, {{ \Carbon\Carbon::now()->format('d F Y') }}
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-size: 12px; padding-top: 20px;">
                Wali Kelas<br><br><br>
                _________________________<br>
                NIP. _____________________
            </td>
        </tr>
    </table>
</div>
