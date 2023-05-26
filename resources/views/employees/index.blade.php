@extends('layouts.app') @section('content')

<div class="row">
    <div class="col-md-12 mt-5">
        <form id="search-form" action="{{ route('employees.index', ) }}" method="GET">
            <div class="d-flex align-items-center">
                <i class="fa fa-search ps-3 text-secondary" style="position: absolute;" aria-hidden="true"></i>
                <input id="search" name="search" type="text" class="border-0 border-bottom p-3 ps-5 my-3" placeholder="Search" value="{{ $search }}" style="width: 100%; background-color: transparent;">
            </div>
        </form>
        <div class="d-flex justify-content-between align-items-center">
            <h6>Data Pegawai</h6>
            <a
                href="{{ route('employees.create') }}"
                class="btn btn-md btn-primary mb-3 rounded-pill px-3"
                ><i class="fa fa-plus" aria-hidden="true"></i> New</a
            >
        </div>
        <div class="">
            <div class="rounded-3 bg-white" style="overflow: hidden;">
                <table class="table table-borderless" aria-describedby="mytable">
                    <thead>
                        <tr class="border-0 border-bottom">
                            <th class="py-3" scope="col">Nama</th>
                            <th class="py-3" scope="col">Jabatan</th>
                            <th class="py-3" scope="col">Umur</th>
                            <th class="py-3" scope="col">Alamat</th>
                            <th class="py-3 text-center" scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                        <tr class="border-bottom">
                            <td class="py-3">{{ $employee->nama }}</td>
                            <td class="py-3">{{ $employee->jabatan }}</td>
                            <td class="py-3">{{ $employee->umur }}</td>
                            <td class="py-3">{{ $employee->alamat }}</td>
                            <td class="text-center py-3">
                                <form
                                    onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('employees.destroy', $employee->id) }}"
                                    method="POST"
                                >
                                    <a
                                        href="{{ route('employees.edit', $employee->id) }}"
                                        class="btn btn-sm btn-warning rounded-pill m-1 px-3"
                                        ><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a
                                    >
                                    @csrf @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger rounded-pill m-1 px-3"
                                    >
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <div class="alert alert-danger">
                            Data employee belum Tersedia.
                        </div>
                        @endforelse
                    </tbody>
                </table>
                <div class="ms-5">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var typingTimer;
    var doneTypingInterval = 500;
    var input = document.getElementById('search');

    input.addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    input.addEventListener('keydown', function() {
        clearTimeout(typingTimer);
    });

    function doneTyping() {
        document.getElementById('search-form').submit();
    }
</script>

@endsection
