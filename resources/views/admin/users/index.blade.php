@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-end mb-4">

            <div>
                <h3 class="fw-bold mb-1">Data Pengguna</h3>
                <p class="text-muted mb-0">Kelola semua user dalam sistem</p>
            </div>

            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm px-4 shadow-sm rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah User
            </a>

        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- CARD --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle table-hover mb-0">

                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 text-muted">No</th>
                                <th class="py-3 text-muted">Nama</th>
                                <th class="py-3 text-muted">Email</th>
                                <th class="py-3 text-muted">Role</th>
                                <th class="py-3 text-muted">Status</th>
                                <th class="py-3 text-muted">Dibuat</th>
                                <th class="text-center pe-4 py-3 text-muted">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($users as $user)
                                <tr class="border-bottom">

                                    <td class="ps-4 text-muted">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="fw-semibold text-dark">
                                        {{ $user->name }}
                                    </td>

                                    <td class="text-muted">
                                        {{ $user->email }}
                                    </td>

                                    {{-- ROLE --}}
                                    <td>
                                        @if ($user->role === 'admin')
                                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                                Admin
                                            </span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">
                                                User
                                            </span>
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
                                        @if ($user->is_active)
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-muted">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>

                                    {{-- ACTION --}}
                                    <td class="text-center pe-4">

                                        <div class="d-flex justify-content-center gap-2">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                                class="btn btn-sm btn-light border rounded-circle shadow-sm" title="Detail">
                                                <i class="bi bi-eye text-info"></i>
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-sm btn-light border rounded-circle shadow-sm" title="Edit">
                                                <i class="bi bi-pencil-square text-warning"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-sm btn-light border rounded-circle shadow-sm"
                                                    title="Hapus">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>
                            @empty

                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Belum ada data pengguna
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- PAGINATION --}}
        <div class="mt-3 d-flex justify-content-end">
            {{ $users->links() }}
        </div>

    </div>
@endsection
