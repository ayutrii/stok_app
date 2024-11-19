@extends('main')

@section('title')
    Suplier
@endsection

@section('content')
    <div class="container-fluid">    
        <h3 class="mb-3 mt-2">Data Suplier</h3>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Data Suplier</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100 pt-1">
                                <strong>Data Suplier</strong>
                            </div>
                            <div class="w-100 text-end">
                                <a href="{{url('/suplier')}}" class="btn btn-outline-primary btn-sm">
                                    Refresh Data <i class="bi bi-arrow-clockwise"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        @if (Session::has('message'))
                            <div class="alert alert-success" id="flash-message">
                               <strong> {{Session::get('message')}} </strong>
                            </div>
                            <script>
                                setTimeout(function (){
                                    document.getElementById('flash-message').style.display='none';
                                }, {{ session('timeout', 5000) }});
                            </script>
                        @endif

                        <div class="row mx-3 my-4">
                            <div class="col-6 bg-">
                                <a href="{{ url('/suplier/add') }}" class="btn btn-primary btn-sm">
                                    Suplier Baru <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                            <div class="col-6">
                                <form action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Cari Nama Suplier ...">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="bi bi-search"></i> Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="70px"></th>
                                    <th width="20px">No</th>
                                    <th>Nama</th>
                                    <th class="text-center" width="100px">Email</th>
                                    <th class="text-center">Telp</th>
                                    <th>Terdaftar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        

                    </div>
                </div>
            </div>
        </div>
    </div> 

@endsection