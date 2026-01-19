<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="http://cdn.tailwindcss.com"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
          setTimeout(() => {
          document.getElementById("alert").style.display = "none";
          }, 5000);
          setTimeout(() => {
          document.getElementById("alert-error").style.display = "none";
          }, 5000);
          
          // MODAL EDIT ALAT
    function openEditModal(id, nama, kategori, stok) {
        // Set action form secara dinamis
        const form = document.getElementById('editForm');
        form.action = `/admin/alat/${id}`; // Sesuaikan dengan route PUT kamu

        // Isi field input
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_kategori').value = kategori;
        document.getElementById('edit_stok').value = stok;

        // Tampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Menutup modal jika klik di luar area modal
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target == modal) {
            closeEditModal();
        }
    }
    
    // MODAL EDIT KATEGORI
    function openEditKategori(id, nama) {
        const form = document.getElementById('formKategori');
        form.action = `/admin/kategori/${id}`;
        document.getElementById('edit_nama_kategori').value = nama;
        document.getElementById('modalKategori').classList.remove('hidden');
    }
    function closeKategori() {
    document.getElementById('modalKategori').classList.add('hidden'); }
    
    // MODAL EDIT USER
    function openEditUser(id, name, email, role) {
        document.getElementById('formUser').action = `/admin/users/${id}`;
        document.getElementById('edit_user_name').value = name;
        document.getElementById('edit_user_email').value = email;
        document.getElementById('edit_user_role').value = role;
        document.getElementById('modalUser').classList.remove('hidden');
    }
    function closeUser() {
    document.getElementById('modalUser').classList.add('hidden'); }

        </script>
    </body>
</html>
