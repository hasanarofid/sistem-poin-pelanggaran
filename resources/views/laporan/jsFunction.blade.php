<script>
    function exportExcel(route) {
        let kelas = $('#kelas').val();
        let siswa = $('#siswa').val();
        let sampai_tanggal = $('#sampaiTanggal').val();
        let dari_tanggal = $('#dariTanggal').val();
        let paramater = "kelas=" + kelas + "&siswa=" + siswa + "&sampai_tanggal=" + sampai_tanggal + "&dari_tanggal=" +
            dari_tanggal;

        var url = route + "?" + paramater;
        window.open(url, '_blank');
    }

    function exportPDF(route) {
        let kelas = $('#kelas').val();
        let siswa = $('#siswa').val();
        let sampai_tanggal = $('#sampaiTanggal').val();
        let dari_tanggal = $('#dariTanggal').val();
        let paramater = "kelas=" + kelas + "&siswa=" + siswa + "&sampai_tanggal=" + sampai_tanggal + "&dari_tanggal=" +
            dari_tanggal;

        var url = route + "?" + paramater;
        window.open(url, '_blank');
    }

    function exportExcelPerKelas(route) {
        let kelas = $('#kelas').val();
        let sampai_tanggal = $('#sampaiTanggal').val();
        let dari_tanggal = $('#dariTanggal').val();
        
        // Validasi: harus pilih kelas untuk laporan per kelas
        if (!kelas) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Silakan pilih kelas terlebih dahulu untuk membuat laporan per kelas.',
                confirmButtonText: 'OK'
            });
            return;
        }
        
        let paramater = "kelas=" + kelas + "&sampai_tanggal=" + sampai_tanggal + "&dari_tanggal=" + dari_tanggal;

        var url = route + "?" + paramater;
        window.open(url, '_blank');
    }

    function setSiswa(kelasId) {
        var siswa = $('#siswa');
        var selectedSiswaId = "{{ request('siswa') }}";

        // Jika ada siswa yang dipilih, load data siswa tersebut
        if (selectedSiswaId && selectedSiswaId !== '') {
            $.ajax({
                url: "{{ route('laporan.setsiswa') }}",
                dataType: 'json',
                type: "GET",
                data: {
                    id: selectedSiswaId,
                    kelas_id: kelasId
                },
                success: function(data) {
                    if (data.length > 0) {
                        var option = new Option(data[0].nama, data[0].id, true, true);
                        siswa.append(option).trigger('change');
                    }
                }
            });
        }
        siswa.select2({
            ajax: {
                url: "{{ route('laporan.setsiswa') }}",
                dataType: 'json',
                delay: 250,
                type: "GET",
                data: function(params) {
                    return {
                        term: params.term,
                        kelas_id: kelasId
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama,
                                id: item.id,
                            };
                        })
                    };
                },
                cache: true
            },
        });
    }

    $(document).ready(function() {
        $('.select2').select2();

        var kelas = $('#kelas');
        var selectedKelasId = "{{ request('kelas') }}";
        var userRole = "{{ auth()->user()->role }}";

        // Untuk guru, otomatis set kelas berdasarkan kelas_id user
        if (userRole === 'Guru') {
            var guruKelasId = "{{ auth()->user()->kelas_id }}";
            var guruKelasNama = "{{ auth()->user()->kelas->nama_kelas ?? '' }}";
            var guruKelasSubkelas = "{{ auth()->user()->kelas->subkelas ?? '' }}";
            
            // Set kelas otomatis untuk guru
            if (guruKelasId && guruKelasNama) {
                var option = new Option(guruKelasNama + ' (' + guruKelasSubkelas + ')', guruKelasId, true, true);
                kelas.append(option).trigger('change');
                
                // Load siswa untuk kelas guru
                setSiswa(guruKelasId);
            }
            
            // Disable select2 untuk guru
            kelas.prop('disabled', true);
        } else {
            // Jika ada kelas yang dipilih, load data kelas tersebut
            if (selectedKelasId && selectedKelasId !== '') {
                $.ajax({
                    url: "{{ route('laporan.setkelas') }}",
                    dataType: 'json',
                    type: "GET",
                    data: {
                        id: selectedKelasId
                    },
                    success: function(data) {
                        if (data.length > 0) {
                            var option = new Option(data[0].nama_kelas + ' (' + data[0].subkelas + ')',
                                data[0].id, true, true);
                            kelas.append(option).trigger('change');
                        }
                    }
                });
            }

            kelas.select2({
                ajax: {
                    url: "{{ route('laporan.setkelas') }}",
                    dataType: 'json',
                    delay: 250,
                    type: "GET",
                    data: function(params) {
                        return {
                            term: params.term,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama_kelas + ' (' + item.subkelas + ')',
                                    id: item.id,
                                };
                            })
                        };
                    },
                    cache: true
                },
            });
        }
    });
</script>
