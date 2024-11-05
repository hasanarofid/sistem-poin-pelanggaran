<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappMessagesLogTable extends Migration
{
    public function up()
    {
        Schema::create('whatsapp_messages_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rencana_kerja_id')->constrained('rencakakerja_t')->onDelete('cascade');
            
            // Ubah referensi ke tabel guru_m
            $table->foreignId('kepala_sekolah_id')->nullable()->constrained('guru_m')->onDelete('set null');
            
            $table->string('phone_number', 20);
            $table->text('message');
            $table->boolean('is_sent')->default(false);
            $table->string('failure_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('whatsapp_messages_log');
    }
}
