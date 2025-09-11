<script>
    function showLoading() {
        const btn = document.getElementById('importBtn');
        const btnText = document.getElementById('btnText');
        const uploadIcon = document.getElementById('uploadIcon');
        const fileInput = document.getElementById('file');
        const filePath = fileInput.value;
        const allowedExtensions = /(\.xlsx|\.xls|\.csv)$/i;

        // Cek apakah file sudah dipilih dan formatnya benar
        if (!filePath) {
            alert('Silakan pilih file terlebih dahulu.');
            return;
        } else if (!allowedExtensions.exec(filePath)) {
            alert('Format file harus .xlsx atau .xls.');
            fileInput.value = '';
            return;
        }

        // Disable tombol
        btn.disabled = true;

        // Ganti icon dengan spinner
        uploadIcon.className = 'loading-spinner';

        // Ganti text
        btnText.textContent = 'Harap tunggu...';

        // Tambahkan class untuk styling disabled
        btn.classList.add('disabled');

        // Submit form
        document.querySelector('form').submit();
    }

    function validatePassword() {
        event.preventDefault();
        const password = document.getElementById("passwordBaru").value;
        const confirmPassword = document.getElementById("konfirmasiPassword").value;

        if (password.length < 8) {
            alert("Password minimal 8 karakter!");
            return; // hentikan proses, tidak lanjut submit
        }

        if (password !== confirmPassword) {
            alert("Password dan Konfirmasi Password tidak sama!");
            return; // hentikan proses, tidak lanjut submit
        }

        // Jika semua validasi lolos, lanjutkan submit
        document.querySelector('form').submit();
    }
</script>
