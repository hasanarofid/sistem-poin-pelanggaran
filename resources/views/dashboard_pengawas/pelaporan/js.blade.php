@section('script')

{{-- <script src="{{ asset('theme/assets/js/modal-edit-user.js') }}"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
  $(document).ready(function () {
    // $(".select2").select2();
            ClassicEditor
            .create( document.querySelector('#deskripsi_permasalahan'))
            .catch( error => {
                console.error( error );
            } );

            ClassicEditor
            .create( document.querySelector('#target_capaian') )
            .catch( error => {
                console.error( error );
            });

            ClassicEditor
            .create( document.querySelector('#deskripsi_permasalahan_edit'))
            .catch( error => {
                console.error( error );
            } );

            ClassicEditor
            .create( document.querySelector('#target_capaian_edit') )
            .catch( error => {
                console.error( error );
            });

            ClassicEditor
            .create( document.querySelector('#catatan_evaluasi') )
            .catch( error => {
                console.error( error );
            });

            ClassicEditor
            .create( document.querySelector('#saran_rekomendasi') )
            .catch( error => {
                console.error( error );
            });

   //   alert(3);
    var table = $('#dataTable').DataTable({
     
        processing: true,
        serverSide: true,
        ajax: "{{ route('pengawas.pelaporan.getdata') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'sasaran', name: 'sasaran'},
            {data: 'judul', name: 'judul'},
            {data: 'nama_kategori', name: 'nama_kategori'},
            {data: 'tgl_pendampingan', name: 'tgl_pendampingan'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });

  // function lihatPerencanaan(id) {      
  //   $.ajax({
  //       url: '{{ route("pengawas.pelaporan.edit", ":id") }}'.replace(':id', id),
  //       type: 'GET',
  //       success: function(response) {
  //           // Tampilkan data dalam modal
  //           $('#editPerencanaan #id').val(response.id); 
  //           $('#editPerencanaan #tahun_ajaran_edit').val(response.tahun_ajaran); 
  //           $('#editPerencanaan #nama_program_kerja_edit').val(response.nama_program_kerja); 
  //           $('#editPerencanaan #judul_edit').val(response.judul); 
  //           $('#editPerencanaan #kategoriprogram_id').val(response.kategoriprogram_id); 
  //           $('#editPerencanaan #kategoriprogram_id_edit').val(response.kategoriprogram_id).trigger('change');
  //           $('#editPerencanaan #tenggat_waktu_edit').val(response.tenggat_waktu).trigger('change');
  //           var selectedValues = response.sekolah_id.split(',').map(Number); // Ubah string menjadi array integer
  //           $('#editPerencanaan #sekolah_id_edit').val(selectedValues).trigger('change');
           
         
  //           $('#editPerencanaan #deskripsi_permasalahan_edit').val(response.deskripsi_permasalahan);
  //           $('#editPerencanaan #target_capaian_edit').val(response.target_capaian);


           

         

            
  //           $('#editPerencanaan').modal('show');
  //       },
  //       error: function(xhr, status, error) {
  //           console.error(xhr.responseText);
  //       }
  //   });
  // }

  function setKategory(id){
    // alert(id);
    $("#id_kategory").val(id);
  }



  function pilihSasaran(obj){
    var sasaran = $(obj).val();
    var program = $("#sub_kategori").val();
    $.ajax({
        url: "{{ route('pengawas.pelaporan.getProgramKerjaSasaran') }}", // Define your route
        type: 'GET',
        data: { 
          sasaran: sasaran,
          program: program
         },
        success: function(response) {
        // Clear and populate the dropdown with options
        $('#object_sasaran').empty();
        $('#object_sasaran').append($('<option>').text('Select').attr('value', ''));

        // Iterate over each category and append it to the dropdown
        $.each(response.objek, function(category, categoryName) {
            $('#object_sasaran').append($('<option>').text(categoryName).attr('value', category));
        });

        // Reinitialize Select2
        // $('#sub_kategori').select2();


        },
        error: function(xhr, textStatus, errorThrown) {
            console.log('Error:', errorThrown);
        }
    });
   
  }

  function pilihKategory(obj) {
    var kategoriId = $(obj).val();
    
    // Make AJAX request
    $.ajax({
        url: "{{ route('pengawas.pelaporan.getSubKategori') }}", // Define your route
        type: 'GET',
        data: { kategori_id: kategoriId },
        success: function(response) {
        // Clear and populate the dropdown with options
        $('#sub_kategori').empty();
        $('#sub_kategori').append($('<option>').text('Select').attr('value', ''));

        // Iterate over each category and append it to the dropdown
        $.each(response.subcategories, function(category, categoryName) {
            $('#sub_kategori').append($('<option>').text(categoryName).attr('value', category));
        });

        // Reinitialize Select2
        // $('#sub_kategori').select2();


        },
        error: function(xhr, textStatus, errorThrown) {
            console.log('Error:', errorThrown);
        }
    });
}

function pilihSubKategory(obj) {
    var kategoriIdsub = $(obj).val();
    $.ajax({
        url: "{{ route('pengawas.pelaporan.getProgramKerja') }}", // Define your route
        type: 'GET',
        data: { id: kategoriIdsub },
        success: function(response) {
          
            $('#editUser #deskripsi_permasalahan').val(response.rencana.deskripsi_permasalahan);
            $('#editUser #target_capaian').val(response.rencana.target_capaian);




        },
        error: function(xhr, textStatus, errorThrown) {
            console.log('Error:', errorThrown);
        }
    });
}

  
</script>

@endsection