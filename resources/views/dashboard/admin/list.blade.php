@extends('layouts.base')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mx-1">
                    <div class="col-sm-6">
                        <h3>Liste des Administrateurs</h3>
                    </div>
                    <div class="col-sm-6" style="text-align: end">
                        <a href="{{route('admin.admins.add')}}" class="btn btn-sm text-light" style="background: #6c63ff">Ajouter Administrateur</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                    <!-- /.col -->
                    <div class="col-md-12">

                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Recherche Administrateur</h3>
                            </div>
                            <div class="card-body">
                                    <form method="get" action="">
                                       <div class="row d-flex align-items-center">
                                           <div class="form-group col-md-3">
                                               <input type="text" class="form-control" id="name" value="{{Request::get('name')}}"  name="name"
                                                      placeholder="Nom">
                                           </div>
                                           <div class="form-group col-md-3">
                                               <input type="text" class="form-control" id="email" value="{{Request::get('email')}}"  name="email"
                                                      placeholder="Email">
                                           </div>
                                           <div class="form-group col-md-3">
                                               <input type="date" class="form-control" id="date" value="{{Request::get('date')}}"  name="date">
                                           </div>
                                           <div class="form-group col-md-3 d-flex align-items-center ">
                                                <button type="submit" class="btn btn-md text-light" style="background: #6c63ff !important;">Recherche</button>
                                               <a href="{{route('admin.admins.list')}}" class="btn btn-md text-light btn-success ml-2">Effacer</a>
                                           </div>
                                       </div>
                                    </form>
                            </div>
                        </div>

                        @include('_message')
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Date de création</th>
                                        <th >Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{$admin->id}}</td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td>{{date('d-m-Y H:i A', strtotime($admin->created_at))}}</td>
                                            <td>
                                                <a href="{{ route('admin.admins.get-admin-edit', ['admin' => $admin])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('admin.admins.delete-admin', ['admin' => $admin])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="card-footer" >{{$admins->links()}}</div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
