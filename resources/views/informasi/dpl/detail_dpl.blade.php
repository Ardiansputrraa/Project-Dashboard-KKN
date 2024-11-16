<!DOCTYPE html>
<html lang="en">

<head>

    <x-header></x-header>
    <script>
        function updateDetailDpl() {
            let username = "{{ $user->username }}";
            let namaLengkap = $("#namaLengkap").val() || @json($user->getTableDatabase()->namaLengkap);
            let email = $("#email").val() || @json($user->getTableDatabase()->email);
            let gelar = $("#gelar").val() || @json($user->getTableDatabase()->gelar);
            let inisial = $("#inisial").val() || @json($user->getTableDatabase()->inisial);
            let fakultas = $("#fakultas").val() || @json($user->getTableDatabase()->fakultas);
            let prodi = $("#prodi").val() || @json($user->getTableDatabase()->prodi);
            let nomerWhatsapp = $("#nomerWhatsapp").val() || @json($user->getTableDatabase()->nomerWhatsapp);

            $.ajax({
                type: "POST",
                url: "{{ route('update.detail.dpl') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: username,
                    namaLengkap: namaLengkap,
                    gelar: gelar,
                    inisial: inisial,
                    fakultas: fakultas,
                    prodi: prodi,
                    email: email,
                    nomerWhatsapp: nomerWhatsapp,
                },
                success: function(response) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Data DPL Berhasil Diubah!",
                        icon: "success",
                        confirmButtonText: "Oke",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('dpl') }}";
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Gagal!",
                        text: xhr.responseText,
                        icon: "error",
                        confirmButtonText: "Oke",
                    });
                }
            });
        }
    </script>
</head>

<body class="app">
    <header class="app-header fixed-top">

        <x-navbar></x-navbar>

        <x-sidebar></x-sidebar>


    </header><!--//app-header-->

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Profil {{ $user->role }}</h1>
                <div class="row gy-4">
                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                            </svg>
                                        </div><!--//icon-holder-->

                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Data Diri {{ $user->namaLengkap }}</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="namaLengkap" class="form-label"><strong>Nama
                                                    Lengkap</strong></label>
                                            <input type="text" class="form-control" id="namaLengkap"
                                                placeholder="{{ $user->getTableDatabase()->namaLengkap }}" />
                                        </div>

                                    </div>
                                </div>
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="gelar" class="form-label"><strong>Gelar</strong></label>
                                            <input type="text" class="form-control" id="gelar"
                                                placeholder="{{ $user->getTableDatabase()->gelar }}" />
                                        </div>

                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="inisial" class="form-label"><strong>Inisial</strong></label>
                                            <input type="text" class="form-control" id="inisial"
                                                placeholder="{{ $user->getTableDatabase()->inisial }}" />
                                        </div>

                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="falkutas" class="form-label"><strong>Fakultas</strong></label>
                                            <select class="form-control" id="fakultas" name="fakultas">
                                                <option disabled selected>Pilih Fakultas</option>
                                                <option value="Fakultas Kedokteran"
                                                    {{ $user->getTableDatabase()->fakultas == 'Fakultas Kedokteran' ? 'selected' : '' }}>
                                                    Fakultas Kedokteran</option>
                                                <option value="Fakultas Kedokteran Gigi"
                                                    {{ $user->getTableDatabase()->fakultas == 'Fakultas Kedokteran Gigi' ? 'selected' : '' }}>
                                                    Fakultas Kedokteran Gigi</option>
                                                <option value="Fakultas Psikologi"
                                                    {{ $user->getTableDatabase()->fakultas == 'Fakultas Psikologi' ? 'selected' : '' }}>
                                                    Fakultas Psikologi</option>
                                                <option value="Fakultas Ekonomi"
                                                    {{ $user->getTableDatabase()->fakultas == 'Fakultas Ekonomi' ? 'selected' : '' }}>
                                                    Fakultas Ekonomi</option>
                                                <option value="Fakultas Teknologi Informasi"
                                                    {{ $user->getTableDatabase()->fakultas == 'Fakultas Teknologi Informasi' ? 'selected' : '' }}>
                                                    Fakultas Teknologi Informasi</option>
                                                <option value="Fakultas Hukum"
                                                    {{ $user->getTableDatabase()->fakultas == 'Fakultas Hukum' ? 'selected' : '' }}>
                                                    Fakultas Hukum</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="prodi" class="form-label"><strong>Prodi</strong></label>
                                            <select class="form-control" id="prodi" name="prodi">
                                                <option disabled selected>Pilih Program Studi</option>
                                                <option value="Prodi Kedokteran"
                                                    {{ $user->getTableDatabase()->prodi == 'Prodi Kedokteran' ? 'selected' : '' }}>
                                                    Prodi Kedokteran</option>
                                                <option value="Prodi Kedokteran Gigi"
                                                    {{ $user->getTableDatabase()->prodi == 'Prodi Kedokteran Gigi' ? 'selected' : '' }}>
                                                    Prodi Kedokteran Gigi</option>
                                                <option value="Prodi Psikologi"
                                                    {{ $user->getTableDatabase()->prodi == 'Prodi Psikologi' ? 'selected' : '' }}>
                                                    Prodi Psikologi</option>
                                                <option value="Prodi Akutansi"
                                                    {{ $user->getTableDatabase()->prodi == 'Prodi Akutansi' ? 'selected' : '' }}>
                                                    Prodi Akutansi</option>
                                                <option value="Prodi Manajemen"
                                                    {{ $user->getTableDatabase()->prodi == 'Prodi Manajemen' ? 'selected' : '' }}>
                                                    Prodi Manajemen</option>
                                                <option value="Prodi Teknik Informatika"
                                                    {{ $user->getTableDatabase()->prodi == 'Prodi Teknik Informatika' ? 'selected' : '' }}>
                                                    Prodi Teknik Informatika</option>
                                                <option value="Prodi Perpustakaan Sains Informasi"
                                                    {{ $user->getTableDatabase()->prodi == 'Prodi Perpustakaan Sains Informasi' ? 'selected' : '' }}>
                                                    Prodi Perpustakaan Sains Informasi</option>
                                                <option value="Prodi Hukum"
                                                    {{ $user->getTableDatabase()->prodi == 'Prodi Hukum' ? 'selected' : '' }}>
                                                    Prodi Hukum</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="email" class="form-label"><strong>Email</strong></label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="{{ $user->getTableDatabase()->email }}" />
                                        </div>

                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="nomerWhatsapp" class="form-label"><strong>Nomer
                                                    Whatsapp Aktif</strong></label>
                                            <input type="text" class="form-control" id="nomerWhatsapp"
                                                placeholder="{{ $user->getTableDatabase()->nomerWhatsapp }}" />
                                        </div>

                                    </div>
                                </div>

                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <button class="btn app-btn-secondary" type="button"
                                    onclick="updateDetailDpl()">Update
                                    Data</button>
                            </div><!--//app-card-footer-->

                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->

            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <x-footer></x-footer>

    </div><!--//app-wrapper-->

</body>
<!-- Javascript -->
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script>

</html>
