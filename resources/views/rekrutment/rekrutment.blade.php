@extends('layout.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <h5 class="card-header">Data Rekrutmen</h5>
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex align-items-center gap-2" style="width: auto;">
                            <a href="{{ route('rekrutment.create') }}" class="btn btn-primary text-nowrap">
                                <i class="bx bx-plus me-1"></i> Add Data
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Lowongan Dilamar</th>
                                    <th>Email</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status Perkawinan</th>
                                    <th>Jml Tanggungan</th>
                                    <th>Gaji Terakhir</th>
                                    <th>Gaji Harapan</th>
                                    <th>File CV</th>
                                    <th>File KTP</th>
                                    <th>Surat Lamaran</th>
                                    <th>Portofolio</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($rekrutment as $r)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $r->nama_lengkap }}</strong></td>
                                        <td>
                                            <span class="badge bg-label-info">
                                                {{ $r->lowongan->nama_lowongan ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $r->email }}</td>
                                        <td>{{ $r->nomor_telepon }}</td>
                                        <td>{{ Str::limit($r->alamat, 20) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->tanggal_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $r->jenis_kelamin }}</td>
                                        <td>{{ $r->status_perkawinan }}</td>
                                        <td>{{ $r->jumlah_tanggungan }}</td>
                                        <td>Rp {{ number_format($r->gaji_terakhir, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($r->gaji_harapan, 0, ',', '.') }}</td>

                                        <!-- File CV -->
                                        <td>
                                            @if ($r->file_cv)
                                                <a href="{{ asset('storage/' . $r->file_cv) }}" target="_blank"
                                                    class="btn btn-xs btn-outline-primary">
                                                    <i class="bx bx-file me-1"></i>Lihat CV
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        <!-- File KTP -->
                                        <td>
                                            @if ($r->file_ktp)
                                                <a href="{{ asset('storage/' . $r->file_ktp) }}" target="_blank"
                                                    class="btn btn-xs btn-outline-secondary">
                                                    <i class="bx bx-id-card me-1"></i>KTP
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        <!-- File Surat Lamaran -->
                                        <td>
                                            @if ($r->file_surat_lamaran)
                                                <a href="{{ asset('storage/' . $r->file_surat_lamaran) }}" target="_blank"
                                                    class="btn btn-xs btn-outline-info">
                                                    <i class="bx bx-envelope me-1"></i>Surat
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        <!-- File Portofolio -->
                                        <td>
                                            @if ($r->file_portofolio)
                                                <a href="{{ asset('storage/' . $r->file_portofolio) }}" target="_blank"
                                                    class="btn btn-xs btn-outline-dark">
                                                    <i class="bx bx-folder me-1"></i>Portofolio
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        <!-- Badge Status -->
                                        <td>
                                            <div class="dropdown">
                                                <button type="button"
                                                    class="btn btn-sm 
                                                    @if (($r->status ?? 'Pending') == 'Pending') btn-outline-warning
                                                    @elseif($r->status == 'Seleksi Berkas') btn-outline-primary
                                                    @elseif($r->status == 'Wawancara') btn-outline-info
                                                    @elseif($r->status == 'Diterima') btn-outline-success
                                                    @elseif($r->status == 'Ditolak') btn-outline-danger
                                                    @else btn-outline-secondary @endif
                                                    dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                    {{ $r->status ?? 'Pending' }}
                                                </button>

                                                <div class="dropdown-menu">
                                                    {{-- Option: Pending --}}
                                                    <form action="{{ route('rekrutment.updateStatus', $r->id_rekrutment) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Pending">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-time-five me-1 text-warning"></i> Pending
                                                        </button>
                                                    </form>

                                                    {{-- Option: Seleksi Berkas --}}
                                                    <form action="{{ route('rekrutment.updateStatus', $r->id_rekrutment) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Seleksi Berkas">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-file me-1 text-primary"></i> Seleksi Berkas
                                                        </button>
                                                    </form>

                                                    {{-- Option: Wawancara --}}
                                                    <form action="{{ route('rekrutment.updateStatus', $r->id_rekrutment) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Wawancara">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-conversation me-1 text-info"></i> Wawancara
                                                        </button>
                                                    </form>

                                                    {{-- Option: Diterima --}}
                                                    <form action="{{ route('rekrutment.updateStatus', $r->id_rekrutment) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Diterima">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-check-circle me-1 text-success"></i> Diterima
                                                        </button>
                                                    </form>

                                                    {{-- Option: Ditolak --}}
                                                    <form action="{{ route('rekrutment.updateStatus', $r->id_rekrutment) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Ditolak">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-x-circle me-1 text-danger"></i> Ditolak
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Action Dropdown -->
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('rekrutment.edit', $r->id_rekrutment) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>

                                                    <form id="delete-form-{{ $r->id_rekrutment }}"
                                                        action="{{ route('rekrutment.delete', $r->id_rekrutment) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="if (confirm('Yakin ingin menghapus data rekrutmen ini?')) { document.getElementById('delete-form-{{ $r->id_rekrutment }}').submit(); }">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="18" class="text-center py-4">Data Rekrutmen belum tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
