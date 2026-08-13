@extends('layout.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <h5 class="card-header">Lowongan Pekerjaan</h5>
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <a href="{{ route('lowongan.create') }}" class="btn btn-primary text-nowrap">
                                Add Data
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lowongan</th>
                                    <th>Jumlah Kebutuhan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($lowongan as $l)
                                    <tr>
                                        <td>
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        <td>{{ $l->nama_lowongan }}</td>
                                        <td>{{ $l->jumlah_kebutuhan }} Orang</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('lowongan.edit', $l->id_lowongan) }}">
                                                        <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <!-- Form Hapus (Ubah route ke lowongan.destroy jika Resource Route) -->
                                                    <form id="delete-form-{{ $l->id }}"
                                                        action="{{ route('lowongan.destroy', $l->id_lowongan) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                        onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data ini?')) {
                                                            document.getElementById('delete-form-{{ $l->id }}').submit();
                                                        }">
                                                        <i class="icon-base bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection