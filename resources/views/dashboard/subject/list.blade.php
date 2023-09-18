@extends('layouts.base')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mx-1">
                    <div class="col-sm-6">
                        <h3>Liste des Sujets</h3>
                    </div>
                    <div class="col-sm-6" style="text-align: end">
                        <a href="{{route('admin.subject.add')}}" class="btn btn-sm text-light" style="background: #6c63ff">Ajouter un sujet</a>
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
                            <h3 class="card-title">Recherche Sujet</h3>
                        </div>
                        <div class="card-body">
                            <form method="get" action="">
                                <div class="row d-flex align-items-center">
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control" id="name" value="{{Request::get('name')}}"  name="name"
                                               placeholder="Nom">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" name="type" value="{{Request::get('type')}}">
                                            <option>Selectioner un Type</option>
                                            <option value="Theorie">Theorie</option>
                                            <option value="Pratique">Pratique</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="date" class="form-control" id="date" value="{{Request::get('date')}}"  name="date">
                                    </div>
                                    <div class="form-group col-md-3 d-flex align-items-center ">
                                        <button type="submit" class="btn btn-md text-light" style="background: #6c63ff !important;">Recherche</button>
                                        <a href="{{route('admin.subject.list')}}" class="btn btn-md text-light btn-success ml-2">Effacer</a>
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
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Auteur</th>
                                    <th>Date de création</th>
                                    <th >Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{$subject->id}}</td>
                                        <td>{{$subject->name}}</td>
                                        <td>{{$subject->type}}</td>
                                        <td>
                                            @if($subject->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>{{$subject->created_by_name}}</td>
                                        <td>{{date('d-m-Y H:i A', strtotime($subject->created_at))}}</td>
                                        <td>
                                            <a href="{{ route('admin.subject.get-subject-edit', ['subject' => $subject])}}" class="btn btn-sm btn-success {{$user->id !== $subject->created_by ? 'disabled': ''}}"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.subject.delete-subject', ['subject' => $subject])}}" class="btn btn-sm btn-danger {{$user->id !== $subject->created_by ? 'disabled': ''}}"><i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer" >{{$subjects->links()}}</div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
    <!-- /.container-fluid -->
        </section>
    <!-- /.content -->
    </div>
@endsection
