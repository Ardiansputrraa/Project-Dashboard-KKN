<!DOCTYPE html>
<html lang="en">

<head>

    <x-header></x-header>
    <script>
        function data() {
            let form_data = new FormData();
            let role = "{{ $users->role }}";
            let file = $("#foto")[0].files[0];
            let namaLengkap = $("#namaLengkap").val() || @json($users->getTableDatabase()->namaLengkap);
            let email = $("#email").val() || @json($users->getTableDatabase()->email);
            let gelar = $("#gelar").val() || @json($users->getTableDatabase()->gelar);
            let inisial = $("#inisial").val() || @json($users->getTableDatabase()->inisial);
            let npm = $("#npm").val() || @json($users->getTableDatabase()->npm);
            let fakultas = $("#fakultas").val() || @json($users->getTableDatabase()->fakultas);
            let prodi = $("#prodi").val() || @json($users->getTableDatabase()->prodi);
            let nomerWhatsapp = $("#nomerWhatsapp").val() || @json($users->getTableDatabase()->nomerWhatsapp);

            form_data.append("foto", file);

            if (role == 'Admin') {
                form_data.append("_token", "{{ csrf_token() }}");
                form_data.append("namaLengkap", namaLengkap);
                form_data.append("email", email);
                form_data.append("nomerWhatsapp", nomerWhatsapp);
            } else if (role == 'Mahasiswa') {
                form_data.append("_token", "{{ csrf_token() }}");
                form_data.append("namaLengkap", namaLengkap);
                form_data.append("npm", npm);
                form_data.append("fakultas", fakultas);
                form_data.append("prodi", prodi);
                form_data.append("email", email);
                form_data.append("nomerWhatsapp", nomerWhatsapp);
            } else if (role == 'Dpl') {
                form_data.append("_token", "{{ csrf_token() }}");
                form_data.append("namaLengkap", namaLengkap);
                form_data.append("gelar", gelar);
                form_data.append("inisial", inisial);
                form_data.append("fakultas", fakultas);
                form_data.append("prodi", prodi);
                form_data.append("email", email);
                form_data.append("nomerWhatsapp", nomerWhatsapp);
            }

            return form_data;
        }

        function updateProfile() {
            $.ajax({
                type: "POST",
                url: "{{ route('profile.update') }}",
                data: data(),
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: "Update Berhasil",
                        text: "Profile Berhasil Diubah!",
                        icon: "success",
                        confirmButtonText: "Oke",
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Update Failed!",
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

                <h1 class="app-page-title">Profil {{ $users->role }}</h1>
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
                                        <h4 class="app-card-title">Data Diri</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label mb-2"><strong>Foto</strong></div>
                                            <div class="item-data">
                                                <img class="profile-image img-fluid"
                                                    src="{{ asset(Auth::user()->getTableDatabase()->foto) }}"
                                                    alt=""
                                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;" />
                                            </div>
                                        </div><!--//col-->
                                        <div class="col text-end">
                                            <div class="col-md-10">
                                                <input type="file" class="form-control" id="foto"
                                                    placeholder="Foto" accept="image/*" />

                                            </div>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//item-->


                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="namaLengkap" class="form-label"><strong>Nama
                                                    Lengkap</strong></label>
                                            <input type="text" class="form-control" id="namaLengkap"
                                                placeholder="{{ $users->getTableDatabase()->namaLengkap }}" />
                                        </div>

                                    </div>
                                </div>
                                @if (Auth::check() && Auth::user()->role == 'Dpl')
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="gelar" class="form-label"><strong>Gelar</strong></label>
                                                <input type="text" class="form-control" id="gelar"
                                                    placeholder="{{ $users->getTableDatabase()->gelar }}" />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="inisial"
                                                    class="form-label"><strong>Inisial</strong></label>
                                                <input type="text" class="form-control" id="inisial"
                                                    placeholder="{{ $users->getTableDatabase()->inisial }}" />
                                            </div>

                                        </div>
                                    </div>
                                @endif

                                @if (Auth::check() && Auth::user()->role == 'Mahasiswa')
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="npm" class="form-label"><strong>NPM</strong></label>
                                                <input type="text" class="form-control" id="npm"
                                                    placeholder="{{ $users->getTableDatabase()->npm }}" />
                                            </div>

                                        </div>
                                    </div>
                                @endif

                                @if ((Auth::check() && Auth::user()->role == 'Mahasiswa') || Auth::user()->role == 'Dpl')
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="falkutas"
                                                    class="form-label"><strong>Fakultas</strong></label>
                                                <select class="form-control" id="fakultas" name="fakultas">
                                                    <option disabled selected>Pilih Fakultas</option>
                                                    <option value="Fakultas Kedokteran"
                                                        {{ $users->getTableDatabase()->fakultas == 'Fakultas Kedokteran' ? 'selected' : '' }}>
                                                        Fakultas Kedokteran</option>
                                                    <option value="Fakultas Kedokteran Gigi"
                                                        {{ $users->getTableDatabase()->fakultas == 'Fakultas Kedokteran Gigi' ? 'selected' : '' }}>
                                                        Fakultas Kedokteran Gigi</option>
                                                    <option value="Fakultas Psikologi"
                                                        {{ $users->getTableDatabase()->fakultas == 'Fakultas Psikologi' ? 'selected' : '' }}>
                                                        Fakultas Psikologi</option>
                                                    <option value="Fakultas Ekonomi"
                                                        {{ $users->getTableDatabase()->fakultas == 'Fakultas Ekonomi' ? 'selected' : '' }}>
                                                        Fakultas Ekonomi</option>
                                                    <option value="Fakultas Teknologi Informasi"
                                                        {{ $users->getTableDatabase()->fakultas == 'Fakultas Teknologi Informasi' ? 'selected' : '' }}>
                                                        Fakultas Teknologi Informasi</option>
                                                    <option value="Fakultas Hukum"
                                                        {{ $users->getTableDatabase()->fakultas == 'Fakultas Hukum' ? 'selected' : '' }}>
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
                                                        {{ $users->getTableDatabase()->prodi == 'Prodi Kedokteran' ? 'selected' : '' }}>
                                                        Prodi Kedokteran</option>
                                                    <option value="Prodi Kedokteran Gigi"
                                                        {{ $users->getTableDatabase()->prodi == 'Prodi Kedokteran Gigi' ? 'selected' : '' }}>
                                                        Prodi Kedokteran Gigi</option>
                                                    <option value="Prodi Psikologi"
                                                        {{ $users->getTableDatabase()->prodi == 'Prodi Psikologi' ? 'selected' : '' }}>
                                                        Prodi Psikologi</option>
                                                    <option value="Prodi Akutansi"
                                                        {{ $users->getTableDatabase()->prodi == 'Prodi Akutansi' ? 'selected' : '' }}>
                                                        Prodi Akutansi</option>
                                                    <option value="Prodi Manajemen"
                                                        {{ $users->getTableDatabase()->prodi == 'Prodi Manajemen' ? 'selected' : '' }}>
                                                        Prodi Manajemen</option>
                                                    <option value="Prodi Teknik Informatika"
                                                        {{ $users->getTableDatabase()->prodi == 'Prodi Teknik Informatika' ? 'selected' : '' }}>
                                                        Prodi Teknik Informatika</option>
                                                    <option value="Prodi Perpustakaan Sains Informasi"
                                                        {{ $users->getTableDatabase()->prodi == 'Prodi Perpustakaan Sains Informasi' ? 'selected' : '' }}>
                                                        Prodi Perpustakaan Sains Informasi</option>
                                                    <option value="Prodi Hukum"
                                                        {{ $users->getTableDatabase()->prodi == 'Prodi Hukum' ? 'selected' : '' }}>
                                                        Prodi Hukum</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="email" class="form-label"><strong>Email</strong></label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="{{ Auth::user()->getTableDatabase()->email }}" />
                                        </div>

                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="nomerWhatsapp" class="form-label"><strong>Nomer
                                                    Whatsapp Aktif</strong></label>
                                            <input type="text" class="form-control" id="nomerWhatsapp"
                                                placeholder="{{ Auth::user()->getTableDatabase()->nomerWhatsapp }}" />
                                        </div>

                                    </div>
                                </div>

                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <button class="btn app-btn-secondary" type="button" onclick="updateProfile()">Update
                                    Profile</button>
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
