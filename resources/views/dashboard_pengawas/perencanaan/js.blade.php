@section('script')


<script src="{{ asset('theme/assets/js/modal-edit-user.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/3.2.6/js/froala_editor.pkgd.min.js"></script> --}}
{{-- <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Include SweetAlert2 -->
<script>
    ClassicEditor
        .create( document.querySelector( '#deskripsi_permasalahan' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#target_capaian' ) )
        .catch( error => {
            console.error( error );
        } );
        // var element = document.querySelector("#deskripsi_permasalahan");
        // if (element) {
        //     var editor = new Trix.Editor(element);
        // }

        // var target_capaian = document.querySelector("#target_capaian");
        // if (target_capaian) {
        //     var editor = new Trix.Editor(target_capaian);
        // }


    //   new FroalaEditor('#deskripsi_permasalahan');
    //   new FroalaEditor('#target_capaian');

      function editPerencanaan(id) {
        ClassicEditor
        .create( document.querySelector( '#deskripsi_permasalahan_edit' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#target_capaian_edit' ) )
        .catch( error => {
            console.error( error );
        } );
//         var deskripsi_permasalahan_edit = document.querySelector("#deskripsi_permasalahan_edit");
// if (deskripsi_permasalahan_edit) {
//     var editor = new Trix.Editor(deskripsi_permasalahan_edit);
// }

// var target_capaian_edit = document.querySelector("#target_capaian_edit");
// if (target_capaian_edit) {
//     var editor = new Trix.Editor(target_capaian_edit);
// }


        // new FroalaEditor('#deskripsi_permasalahan_edit');
        // new FroalaEditor('#target_capaian_edit');
       
    $.ajax({
        url: '{{ route("pengawas.perencanaan.edit", ":id") }}'.replace(':id', id),
        type: 'GET',
        success: function(response) {
            // Tampilkan data dalam modal
            $('#editPerencanaan #id').val(response.id); 
            $('#editPerencanaan #tahun_ajaran_edit').val(response.tahun_ajaran); 
            $('#editPerencanaan #nama_program_kerja_edit').val(response.nama_program_kerja); 
            $('#editPerencanaan #kategoriprogram_id_edit').val(response.kategoriprogram_id).trigger('change');
            $('#editPerencanaan #tenggat_waktu_edit').val(response.tenggat_waktu).trigger('change');
            var selectedValues = response.sekolah_id.split(',').map(Number); // Ubah string menjadi array integer
            $('#editPerencanaan #sekolah_id_edit').val(selectedValues).trigger('change');
            $('#editPerencanaan #deskripsi_permasalahan_edit').val(response.deskripsi_permasalahan);
            $('#editPerencanaan #target_capaian_edit').val(response.target_capaian);

            $('#editPerencanaan').modal('show');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
  }

      
  $(document).ready(function () {
   //   alert(3);
    var table = $('#dataTable').DataTable({
     
        processing: true,
        serverSide: true,
        ajax: "{{ route('pengawas.perencanaan.getdata') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'tahun_ajaran', name: 'tahun_ajaran'},
            {data: 'nama_program_kerja', name: 'nama_program_kerja'},
            {data: 'nama_kategori', name: 'nama_kategori'},
            {data: 'nama_sekolah', name: 'nama_sekolah'},
            {data: 'tenggat_waktu', name: 'tenggat_waktu'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    

  });

  function deletePerencanaan(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this data!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // User confirmed, proceed with AJAX delete request
            $.ajax({
                url: '{{ route("pengawas.perencanaan.hapus", ":id") }}'.replace(':id', id),
                type: 'DELETE', // Ensure the request method is DELETE
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                 },
                success: function (response) {
                    // Handle success response (e.g., refresh the page)
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        }
    });
}
</script>

@endsection