@extends('layout.layout')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout & Basic with Icons -->
            <div class="row mb-6 gy-6">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Lowongan</h5>
                            <a href="{{ route('lowongan') }}" class="btn btn-sm btn-secondary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <!-- PERBAIKAN 1: Mengubah route ke lowongan.update dan mengganti $id menjadi $lowongan -->
                            <form action="{{ route('lowongan.update', $lowongan->id_lowongan) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Nama Lowongan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="nama_lowongan">Nama Lowongan</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('nama_lowongan') is-invalid @enderror"
                                            id="nama_lowongan" 
                                            name="nama_lowongan" 
                                            value="{{ old('nama_lowongan', $lowongan->nama_lowongan) }}">
                                        @error('nama_lowongan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jumlah Kebutuhan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="jumlah_kebutuhan">Jumlah Kebutuhan</label>
                                    <div class="col-sm-10">
                                        <input type="number"
                                            class="form-control @error('jumlah_kebutuhan') is-invalid @enderror"
                                            id="jumlah_kebutuhan" 
                                            name="jumlah_kebutuhan" 
                                            value="{{ old('jumlah_kebutuhan', $lowongan->jumlah_kebutuhan) }}">
                                        @error('jumlah_kebutuhan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tombol Action -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <a href="{{ route('lowongan') }}" class="btn btn-outline-secondary me-2">Batal</a>
                                        <button type="submit" class="btn btn-primary">Update</button>
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