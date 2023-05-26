@extends('layouts.app') @section('content')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('employees.store') }}" class="text-decoration-none"><span class="text-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</span></a>
                <h5>Update Data Pegawai</h5>
            </div>
            <div class="card border-0 shadow-sm rounded-3 p-4 mt-3">
                <div class="card-body">
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="">Nama</label>
                            <input type="text" class="mt-2 form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $employee->nama }}" placeholder="Masukkan Nama Pegawai">
                    
                            @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label> </label>

                            <select class="mt-2 form-control @error('jabatan') is-invalid @enderror" name="jabatan" selected="{{ $employee->jabatan }}"  value="{{ old('jabatan') }}">
                                <option value="">Pilih Jabatan</option>
                                <option value="Junior Programmer" 
                                    @if ($employee->jabatan == "Junior Programmer") 
                                    selected="selected"
                                    @endif >Junior Programmer</option>
                                <option value="Direktur"
                                    @if ($employee->jabatan == "Direktur") 
                                    selected="selected"
                                    @endif >Direktur</option>
                            </select>
                        
                            <!-- error message untuk title -->
                            @error('jabatan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="mt-2 form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $employee->tanggal_lahir }}" placeholder="Masukkan Umur Pegawai">
                        
                            <!-- error message untuk title -->
                            @error('tanggal_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label>Alamat</label>
                            <textarea  class="mt-2 form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan Alamat Pegawai" id="" cols="30" rows="5">{{ $employee->alamat }}</textarea>                        
                            <!-- error message untuk title -->
                            @error('alamat')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-md btn-primary w-100">Simpan</button>
                        </div>

                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection