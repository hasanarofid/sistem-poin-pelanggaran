<script>
    function exportExcel(){
        let kelas = $('#kelas').val();
        let sampai_tanggal = $('#sampaiTanggal').val();
        let dari_tanggal = $('#dariTanggal').val();
        let paramater = "kelas=" + kelas + "&sampai_tanggal=" + sampai_tanggal + "&dari_tanggal=" + dari_tanggal;

      var url = "{{ Route('laporan.export') }}?" + paramater;
      window.open(url, '_blank');
    }

    $(document).ready(function() {
        $('.select2').select2();

        var kelas = $('#kelas');
        var selectedKelasId = "{{ request('kelas') }}";
        
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
                        var option = new Option(data[0].nama_kelas + ' (' + data[0].subkelas + ')', data[0].id, true, true);
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

    });
</script>
