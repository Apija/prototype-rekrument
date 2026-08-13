@extends('layout.layout')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-6 gy-6">
                <div class="col-xxl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Tambah Data Rekrutmen</h5>
                            <a href="{{ route('rekrutment') }}" class="btn btn-sm btn-secondary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('rekrutment.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Lowongan (Foreign Key) -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_lowongan">Lowongan</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('id_lowongan') is-invalid @enderror"
                                            id="id_lowongan" name="id_lowongan">
                                            <option value="" selected disabled>-- Pilih Lowongan --</option>
                                            @foreach ($lowongans as $lowongan)
                                                <option value="{{ $lowongan->id_lowongan }}"
                                                    {{ old('id_lowongan') == $lowongan->id_lowongan ? 'selected' : '' }}>
                                                    {{ $lowongan->nama_lowongan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_lowongan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Lengkap -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="nama_lengkap">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('nama_lengkap') is-invalid @enderror"
                                            id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                            placeholder="Masukkan nama lengkap">
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}"
                                            placeholder="contoh@email.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nomor Telepon -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="nomor_telepon">Nomor Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('nomor_telepon') is-invalid @enderror"
                                            id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                            placeholder="08123456789">
                                        @error('nomor_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="alamat">Alamat Lengkap</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                            placeholder="Masukkan alamat domisili">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status Perkawinan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="status_perkawinan">Status Perkawinan</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('status_perkawinan') is-invalid @enderror"
                                            id="status_perkawinan" name="status_perkawinan">
                                            <option value="" selected disabled>-- Pilih Status Perkawinan --</option>
                                            <option value="Belum Menikah"
                                                {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum
                                                Menikah</option>
                                            <option value="Menikah"
                                                {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah
                                            </option>
                                            <option value="Cerai"
                                                {{ old('status_perkawinan') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                        </select>
                                        @error('status_perkawinan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jumlah Tanggungan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="jumlah_tanggungan">Jumlah
                                        Tanggungan</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0"
                                            class="form-control @error('jumlah_tanggungan') is-invalid @enderror"
                                            id="jumlah_tanggungan" name="jumlah_tanggungan"
                                            value="{{ old('jumlah_tanggungan', 0) }}">
                                        @error('jumlah_tanggungan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Gaji Terakhir -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="gaji_terakhir">Gaji Terakhir (Rp)</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0" step="any"
                                            class="form-control @error('gaji_terakhir') is-invalid @enderror"
                                            id="gaji_terakhir" name="gaji_terakhir"
                                            value="{{ old('gaji_terakhir', 0) }}" placeholder="Contoh: 5000000">
                                        @error('gaji_terakhir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Gaji Harapan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="gaji_harapan">Gaji Harapan (Rp)</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any"
                                            class="form-control @error('gaji_harapan') is-invalid @enderror"
                                            id="gaji_harapan" name="gaji_harapan" value="{{ old('gaji_harapan') }}"
                                            placeholder="Contoh: 6000000">
                                        @error('gaji_harapan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- File CV -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="file_cv">File CV</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control @error('file_cv') is-invalid @enderror"
                                            id="file_cv" name="file_cv">
                                        @if (isset($id) && $id->file_cv)
                                            <small class="text-muted mt-1 d-block">
                                                File saat ini: <a href="{{ asset('storage/' . $id->file_cv) }}"
                                                    target="_blank">Lihat CV</a>
                                            </small>
                                        @endif
                                        <div class="form-text text-muted">Bisa mengunggah semua format file (Maks. 5MB)</div>
                                        @error('file_cv')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- File KTP -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="file_ktp">File KTP</label>
                                    <div class="col-sm-10">
                                        <input type="file"
                                            class="form-control @error('file_ktp') is-invalid @enderror" id="file_ktp"
                                            name="file_ktp">
                                        @if (isset($id) && $id->file_ktp)
                                            <small class="text-muted mt-1 d-block">
                                                File saat ini: <a href="{{ asset('storage/' . $id->file_ktp) }}"
                                                    target="_blank">Lihat KTP</a>
                                            </small>
                                        @endif
                                        <div class="form-text text-muted">Bisa mengunggah semua format file (Maks. 5MB)</div>
                                        @error('file_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- File Surat Lamaran -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="file_surat_lamaran">Surat Lamaran</label>
                                    <div class="col-sm-10">
                                        <input type="file"
                                            class="form-control @error('file_surat_lamaran') is-invalid @enderror"
                                            id="file_surat_lamaran" name="file_surat_lamaran">
                                        @if (isset($id) && $id->file_surat_lamaran)
                                            <small class="text-muted mt-1 d-block">
                                                File saat ini: <a href="{{ asset('storage/' . $id->file_surat_lamaran) }}"
                                                    target="_blank">Lihat Surat Lamaran</a>
                                            </small>
                                        @endif
                                        <div class="form-text text-muted">Bisa mengunggah semua format file (Maks. 5MB)</div>
                                        @error('file_surat_lamaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- File Portofolio -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="file_portofolio">File Portofolio </label>
                                    <div class="col-sm-10">
                                        <input type="file"
                                            class="form-control @error('file_portofolio') is-invalid @enderror"
                                            id="file_portofolio" name="file_portofolio">
                                        @if (isset($id) && $id->file_portofolio)
                                            <small class="text-muted mt-1 d-block">
                                                File saat ini: <a href="{{ asset('storage/' . $id->file_portofolio) }}"
                                                    target="_blank">Lihat Portofolio</a>
                                            </small>
                                        @endif
                                        <div class="form-text text-muted">Opsional. Bisa mengunggah semua format file (Maks. 10MB)</div>
                                        @error('file_portofolio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="status">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                            <option value="" selected disabled>-- Pilih Status --</option>
                                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="Seleksi Berkas"
                                                {{ old('status') == 'Seleksi Berkas' ? 'selected' : '' }}>Seleksi Berkas
                                            </option>
                                            <option value="Wawancara"
                                                {{ old('status') == 'Wawancara' ? 'selected' : '' }}>Wawancara</option>
                                            <option value="Diterima" {{ old('status') == 'Diterima' ? 'selected' : '' }}>
                                                Diterima</option>
                                            <option value="Ditolak" {{ old('status') == 'Ditolak' ? 'selected' : '' }}>
                                                Ditolak</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tombol Kirim -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
