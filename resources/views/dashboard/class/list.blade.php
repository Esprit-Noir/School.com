@extends('layouts.base')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mx-1">
                    <div class="col-sm-6">
                        <h3>Liste des Classes</h3>
                    </div>
                    <div class="col-sm-6" style="text-align: end">
                        <a href="{{route('admin.classes.add')}}" class="btn btn-sm text-light" style="background: #6c63ff">Ajouter un classe</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <!-- /.col -->
                <div class="col-md-12">

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Recherche classe</h3>
                        </div>
                        <div class="card-body">
                            <form method="get" action="">
                                <div class="row d-flex align-items-center">
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control" id="name" value="{{Request::get('name')}}"  name="name"
                                               placeholder="Nom">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="date" class="form-control" id="date" value="{{Request::get('date')}}"  name="date">
                                    </div>
                                    <div class="form-group col-md-3 d-flex align-items-center ">
                                        <button type="submit" class="btn btn-md text-light" style="background: #6c63ff !important;">Recherche</button>
                                        <a href="{{route('admin.classes.list')}}" class="btn btn-md text-light btn-success ml-2">Effacer</a>
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
                                    <th>Status</th>
                                    <th>Auteur</th>
                                    <th>Date de création</th>
                                    <th >Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($classes as $classe)
                                    <tr>
                                        <td>{{$classe->id}}</td>
                                        <td>{{$classe->name}}</td>
                                        <td>
                                            @if($classe->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>{{$classe->created_by_name}}</td>
                                        <td>{{date('d-m-Y H:i A', strtotime($classe->created_at))}}</td>
                                        <td>
                                            <a href="{{ route('admin.classes.get-class-edit', ['class' => $classe])}}" class="btn btn-sm btn-success {{$user->id !== $classe->created_by ? 'disabled': ''}}"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.classes.delete-class', ['class' => $classe])}}" class="btn btn-sm btn-danger {{$user->id !== $classe->created_by ? 'disabled': ''}}"><i class="fa fa-trash-alt "></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer" >{{$classes->links()}}</div>
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
