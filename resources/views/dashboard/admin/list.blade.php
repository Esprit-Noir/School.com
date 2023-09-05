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
                        <a href="{{route('admin.add')}}" class="btn btn-sm text-light" style="background: #6c63ff">Ajouter Administrateur</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                    <!-- /.col -->
                    <div class="col-md-12">
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
                                            <td>{{$admin->created_at}}</td>
                                            <td>
                                                <a href="{{ route('admin.get-admin-edit', ['id' => $admin->id])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
