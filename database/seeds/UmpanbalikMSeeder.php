<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UmpanbalikMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('umpanbalik_m')->insert([
            [
                'id'=>1,
                'pertanyaan'=>'Pelayanan apakah yang diberikan oleh Pengawas sekolah saat ini?',
                'jawaban'=>'supervisi managerial,supervisi Akademik,Evaluasi pendidikan,penelitian dan pengembangan,Pendampingan Tematik ( PPDB, MPLS, Uji Kompetensi, dll)',
                'type_input'=>'radiobutton',
                'aspek'=>'pendampingan',
                'status'=>true,
                'urutan'=>1,
            ],
            [
                'id'=>2,
                'pertanyaan'=>'Apakah Pengawas sekolah menyampaikan rencana pendampingan sebelum pelaksanaan pendampingan',
                'jawaban'=>'Ya,Tidak',
                'type_input'=>'radiobutton',
                'aspek'=>'pendampingan',
                'status'=>true,
                'urutan'=>2,
            ],
            [
                'id'=>3,
                'pertanyaan'=>'Bagiaman Pelaksanaan pendampingan apakah sesuai dengan rencana?',
                'jawaban'=>'Ya,Tidak',
                'type_input'=>'radiobutton',
                'aspek'=>'pendampingan',
                'status'=>true,
                'urutan'=>3,
            ],
            [
                'id'=>4,
                'pertanyaan'=>'Bagaiamana pengawas sekolah melibatkan saudara dalam diskusi selama proses pendampingan?',
                'jawaban'=>'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang',
                'type_input'=>'radiobutton',
                'aspek'=>'pendampingan',
                'status'=>true,
                'urutan'=>4,
            ],
            [
                'id'=>5,
                'pertanyaan'=>'Bagaimana intetraksi yang terjadi selama proses pendampingan?',
                'jawaban'=>'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang',
                'type_input'=>'radiobutton',
                'aspek'=>'pendampingan',
                'status'=>true,
                'urutan'=>5,
            ],
            [
                'id'=>6,
                'pertanyaan'=>'Bagaimana suasana yang tercipta selama proses pendampingan?',
                'jawaban'=>'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang',
                'type_input'=>'radiobutton',
                'aspek'=>'pendampingan',
                'status'=>true,
                'urutan'=>6,
            ],
            [
                'id'=>7,
                'pertanyaan'=>'Bagaimana penguasaan materi/ Pengetahuan  yang dimiliki Pengawas Sekolah',
                'jawaban'=>'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang',
                'type_input'=>'radiobutton',
                'aspek'=>'kompetensi',
                'status'=>true,
                'urutan'=>7,
            ],
            [
                'id'=>8,
                'pertanyaan'=>'Bagaimana Komunikasi yang dilakukan selama proses pendampingan?',
                'jawaban'=>'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang',
                'type_input'=>'radiobutton',
                'aspek'=>'kompetensi',
                'status'=>true,
                'urutan'=>8,
            ],
            [
                'id'=>9,
                'pertanyaan'=>'Bagaimana ketepatan waktu pelaksanaan pendampingan?',
                'jawaban'=>'Sangat Baik,Baik,Cukup,Kurang,Sangat Kurang',
                'type_input'=>'radiobutton',
                'aspek'=>'kompetensi',
                'status'=>true,
                'urutan'=>9,
            ],
            [
                'id'=>10,
                'pertanyaan'=>'Berikan saran , hal apa yang harus ditingkatkan dari pelayanan Pengawas sekolah?',
                'jawaban'=>null,
                'type_input'=>'textarea',
                'aspek'=>'lainnya',
                'status'=>true,
                'urutan'=>10,
            ],
            [
                'id'=>11,
                'pertanyaan'=>'Kebutuhan layanan supervisi / pendampingan seperti apa yang saudara harapkan?',
                'jawaban'=>null,
                'type_input'=>'textarea',
                'aspek'=>'lainnya',
                'status'=>true,
                'urutan'=>11,
            ],
            
        ]);
    }
}
