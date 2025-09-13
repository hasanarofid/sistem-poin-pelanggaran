<?php

use Illuminate\Database\Seeder;
use App\Models\JenisPelanggaran;
use App\Models\Kategori;

class PointSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat 2 kategori utama
        $kategoriPelanggaran = Kategori::firstOrCreate(
            ['nama_kategori' => 'Pelanggaran'],
            ['nama_kategori' => 'Pelanggaran', 'is_aktif' => true]
        );

        $kategoriPenghargaan = Kategori::firstOrCreate(
            ['nama_kategori' => 'Penghargaan'],
            ['nama_kategori' => 'Penghargaan', 'is_aktif' => true]
        );

        // Data Pelanggaran dari Excel (60 data)
        $pelanggaranData = [
            // P1 - Keterlambatan
            ['kode' => 'P1.1a', 'nama_pelanggaran' => 'Terlambat masuk kelas pertama 10-20 menit', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -1],
            ['kode' => 'P1.1b', 'nama_pelanggaran' => 'Terlambat masuk kelas pertama 20-30 menit', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -2],
            ['kode' => 'P1.1c', 'nama_pelanggaran' => 'Terlambat masuk kelas pertama > 30 menit', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -3],
            ['kode' => 'P1.2', 'nama_pelanggaran' => 'Terlambat masuk setelah istirahat', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -1],

            // PI - Ketidakhadiran
            ['kode' => 'PI.1', 'nama_pelanggaran' => 'Tidak masuk dengan izin (bukan dispensasi)', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -1],
            ['kode' => 'PI.2', 'nama_pelanggaran' => 'Tidak masuk tanpa keterangan', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -2],
            ['kode' => 'PI.3', 'nama_pelanggaran' => 'Tidak masuk dengan keterangan palsu', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -3],
            ['kode' => 'PI.4', 'nama_pelanggaran' => 'Bolos/membolos', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -4],
            ['kode' => 'PI.5', 'nama_pelanggaran' => 'Tidak mengikuti upacara rutin senin pagi', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -4],
            ['kode' => 'PI.6', 'nama_pelanggaran' => 'Tidak mengikuti kegiatan wajib taruna', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -10],
            ['kode' => 'PI.7', 'nama_pelanggaran' => 'Tidak mengikuti kegiatan susulan taruna', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -2],

            // PII - Seragam & Penampilan
            ['kode' => 'PII.1a', 'nama_pelanggaran' => 'Atribut sekolah tidak lengkap 1-4 item', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -1],
            ['kode' => 'PII.1b', 'nama_pelanggaran' => 'Atribut sekolah tidak lengkap 5-8 item', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -2],
            ['kode' => 'PII.1c', 'nama_pelanggaran' => 'Atribut sekolah tidak lengkap >8 item', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -3],
            ['kode' => 'PII.2', 'nama_pelanggaran' => 'Mengenakan seragam tidak rapi atau baju tidak dimasukkan', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -1],
            ['kode' => 'PII.3', 'nama_pelanggaran' => 'Mengenakan sepatu tanpa kaos kaki', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -1],
            ['kode' => 'PII.4', 'nama_pelanggaran' => 'Mengenakan jilbab tidak sesuai aturan', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -1],
            ['kode' => 'PII.5', 'nama_pelanggaran' => 'Seragam tidak sesuai aturan', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -2],
            ['kode' => 'PII.6', 'nama_pelanggaran' => 'Warna/jenis sepatu tidak sesuai aturan', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -2],
            ['kode' => 'PII.7', 'nama_pelanggaran' => 'Mengenakan jaket/sweater/pakaian hangat di kelas tanpa izin wali kelas', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -3],

            // PIV - Perilaku & Sikap
            ['kode' => 'PIV.1', 'nama_pelanggaran' => 'Menggunakan kosmetik berlebihan atau berdandan untuk taruni', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -1],
            ['kode' => 'PIV.2', 'nama_pelanggaran' => 'Mengenakan aksesoris atau perhiasan (gelang, anting, kalung, tindik, dll) untuk taruna', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -1],
            ['kode' => 'PIV.3', 'nama_pelanggaran' => 'Panjang rambut tidak sesuai aturan untuk taruna/taruni', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -4],
            ['kode' => 'PIV.4', 'nama_pelanggaran' => 'Mewarnai rambut selain hitam', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -5],
            ['kode' => 'PIV.5', 'nama_pelanggaran' => 'Menggunakan bahasa kasar/umpatan kepada sesama taruna', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -5],
            ['kode' => 'PIV.6', 'nama_pelanggaran' => 'Menggunakan bahasa kasar/umpatan kepada guru/orang tua/masyarakat sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -10],
            ['kode' => 'PIV.7', 'nama_pelanggaran' => 'Membawa alat kosmetik', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -10],
            ['kode' => 'PIV.8', 'nama_pelanggaran' => 'Mengancam/menakut-nakuti/membully sesama taruna', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -10],
            ['kode' => 'PIV.9', 'nama_pelanggaran' => 'Mengancam/menakut-nakuti/membully kepala sekolah, guru, masyarakat sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -15],
            ['kode' => 'PIV.10', 'nama_pelanggaran' => 'Mencuri barang milik orang lain/milik sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -15],
            ['kode' => 'PIV.11', 'nama_pelanggaran' => 'Mengaktifkan HP saat kegiatan belajar mengajar tanpa izin guru pengajar', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -15],

            // PV - Pelanggaran Berat
            ['kode' => 'PV.1', 'nama_pelanggaran' => 'Membuang sampah sembarangan, mencoret-coret, merusak fasilitas sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -15],
            ['kode' => 'PV.2', 'nama_pelanggaran' => 'Merusak fasilitas sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -15],
            ['kode' => 'PV.3', 'nama_pelanggaran' => 'Bersikap bermusuhan dengan sesama taruna', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -15],
            ['kode' => 'PV.4', 'nama_pelanggaran' => 'Mengganggu ketenangan kelas saat kegiatan belajar mengajar', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -15],
            ['kode' => 'PV.5', 'nama_pelanggaran' => 'Melompat pagar sekolah untuk masuk/keluar', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -20],
            ['kode' => 'PV.6', 'nama_pelanggaran' => 'Membuat audio/video yang tidak sesuai aturan', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -25],

            // PVI - Rokok & Narkoba
            ['kode' => 'PVI.1', 'nama_pelanggaran' => 'Membawa segala bentuk rokok ke dalam kelas atau lingkungan sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -25],
            ['kode' => 'PVI.2', 'nama_pelanggaran' => 'Merokok segala bentuk rokok di dalam kelas atau lingkungan sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -50],
            ['kode' => 'PVI.3', 'nama_pelanggaran' => 'Menjual segala bentuk rokok di sekolah dan lingkungan sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -50],
            ['kode' => 'PVI.4', 'nama_pelanggaran' => 'Merokok segala bentuk rokok di manapun saat mengenakan seragam sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -50],

            // PVII - Pornografi & Senjata
            ['kode' => 'PVII.1', 'nama_pelanggaran' => 'Membawa buku/majalah/stensil/kaset/video/CD/link/media lain yang mengandung pornografi', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -30],
            ['kode' => 'PVII.2', 'nama_pelanggaran' => 'Menjual buku/majalah/stensil/kaset/video/CD/link/media lain yang mengandung pornografi', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -40],
            ['kode' => 'PVII.3', 'nama_pelanggaran' => 'Melihat/membaca buku/majalah/stensil/kaset/video/CD/link/media lain yang mengandung pornografi', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -50],

            // PVIII - Senjata
            ['kode' => 'PVIII.1', 'nama_pelanggaran' => 'Membawa senjata tajam/senjata api tanpa izin tertulis dari orang tua/wali atau pihak berwenang', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -50],
            ['kode' => 'PVIII.2', 'nama_pelanggaran' => 'Menggunakan senjata tajam/senjata api dengan maksud mengancam atau melukai orang lain', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -50],
            ['kode' => 'PVIII.3', 'nama_pelanggaran' => 'Menjual senjata tajam/senjata api di manapun', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -50],

            // PIX - Narkoba
            ['kode' => 'PIX.1', 'nama_pelanggaran' => 'Membawa narkoba/alkohol ke dalam lingkungan sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -100],
            ['kode' => 'PIX.2', 'nama_pelanggaran' => 'Menggunakan narkoba/alkohol di dalam lingkungan sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -100],
            ['kode' => 'PIX.3', 'nama_pelanggaran' => 'Menjual narkoba/alkohol di manapun', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -100],

            // PX - Perkelahian
            ['kode' => 'PX.1', 'nama_pelanggaran' => 'Berkelahi/bermusuhan antar sesama taruna', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -100],
            ['kode' => 'PX.2', 'nama_pelanggaran' => 'Berkelahi/bermusuhan dengan siswa sekolah lain', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -100],
            ['kode' => 'PX.3', 'nama_pelanggaran' => 'Menjadi provokator perkelahian', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -100],
            ['kode' => 'PX.0.1', 'nama_pelanggaran' => 'Mengancam dan menakut-nakuti kepala sekolah, guru, dan masyarakat sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -100],
            ['kode' => 'PX.0.2', 'nama_pelanggaran' => 'Memalak/membully sesama taruna di lingkungan sekolah', 'kategori_id' => $kategoriPelanggaran->id, 'poin' => -75],
        ];

        // Data Penghargaan dari Excel (18 data)
        $penghargaanData = [
            ['kode' => 'R.1', 'nama_pelanggaran' => 'Selalu tepat waktu/tidak pernah terlambat dalam seminggu', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 5],
            ['kode' => 'R.2', 'nama_pelanggaran' => 'Selalu mengenakan seragam sesuai aturan dan atribut lengkap dari ujung kepala sampai ujung kaki dalam seminggu', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 5],
            ['kode' => 'R.3', 'nama_pelanggaran' => 'Selalu mengikuti rutinitas dalam seminggu', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 5],
            ['kode' => 'R.4', 'nama_pelanggaran' => 'Melaksanakan piket kelas selama satu bulan', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 5],
            ['kode' => 'R.5', 'nama_pelanggaran' => 'Melaporkan jika melihat tindakan indisipliner oleh taruna', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 20],
            ['kode' => 'R.6', 'nama_pelanggaran' => 'Memperingatkan sesama taruna yang akan melakukan tindakan indisipliner', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 20],
            ['kode' => 'R.7', 'nama_pelanggaran' => 'Mengikuti LKS tingkat Kabupaten/Kota', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 4],
            ['kode' => 'R.8', 'nama_pelanggaran' => 'Mengikuti LKS tingkat Provinsi', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 6],
            ['kode' => 'R.9', 'nama_pelanggaran' => 'Mengikuti LKS tingkat Nasional', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 8],
            ['kode' => 'R.10', 'nama_pelanggaran' => 'Mengikuti sebagai peserta lomba/seminar/undangan kegiatan dari instansi lain', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 5],
            ['kode' => 'R.11', 'nama_pelanggaran' => 'Menang/berprestasi dalam lomba atau kejuaraan tingkat Kabupaten/Kota', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 20],
            ['kode' => 'R.12', 'nama_pelanggaran' => 'Menang/berprestasi dalam lomba atau kejuaraan tingkat Provinsi', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 45],
            ['kode' => 'R.13', 'nama_pelanggaran' => 'Menang/berprestasi dalam lomba atau kejuaraan tingkat Nasional', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 80],
            ['kode' => 'R.14', 'nama_pelanggaran' => 'Menang/berprestasi dalam lomba atau kejuaraan tingkat Internasional', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 100],
            ['kode' => 'R.15', 'nama_pelanggaran' => 'Menjadi Komandan/Wakil Komandan Resimen', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 25],
            ['kode' => 'R.16', 'nama_pelanggaran' => 'Menjadi Komandan Batalyon/Kompi', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 15],
            ['kode' => 'R.17', 'nama_pelanggaran' => 'Menjadi Komandan Peleton', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 10],
            ['kode' => 'R.18', 'nama_pelanggaran' => 'Menjadi Ketua Ekstrakurikuler', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 10],
            ['kode' => 'R.19', 'nama_pelanggaran' => 'Aktif mengikuti sebagai anggota panitia ekstrakurikuler', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 5],
            ['kode' => 'R.20', 'nama_pelanggaran' => 'Mengikuti kegiatan wajib taruna', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 10],
            ['kode' => 'R.22', 'nama_pelanggaran' => 'Mengikuti kegiatan susulan taruna', 'kategori_id' => $kategoriPenghargaan->id, 'poin' => 5],
        ];

        // Insert data pelanggaran (60 data)
        foreach ($pelanggaranData as $data) {
            JenisPelanggaran::firstOrCreate(
                ['kode' => $data['kode']],
                $data
            );
        }

        // Insert data penghargaan (18 data)
        foreach ($penghargaanData as $data) {
            JenisPelanggaran::firstOrCreate(
                ['kode' => $data['kode']],
                $data
            );
        }

        $this->command->info('Data sistem poin berhasil diimport!');
        $this->command->info('Kategori: 2 data (Pelanggaran, Penghargaan)');
        $this->command->info('Jenis Poin: 78 data (60 pelanggaran + 18 penghargaan)');
    }
}
