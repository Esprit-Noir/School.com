@extends('layouts.base')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mx-1">
                    <div class="col-sm-6">
                        @if(Request::segment(2)== 'add')
                            <h3>Ajouter Administrateur</h3>
                        @elseif(Request::segment(2)== 'edit')
                            <h3>Modifier {{$admin->name}}</h3>
                        @endif
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.col -->
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Form Basic -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        @if(Request::segment(2)== 'add')
                                        <form method="post" action="{{route('admin.create-admin')}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Nom</label>
                                                <input type="text" class="form-control" id="name" required  name="name"
                                                       placeholder="Nom">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" required name="email"
                                                       placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Mot de passe</label>
                                                <input type="password" class="form-control" id="password" required name="password" placeholder="Mot de passe">
                                            </div>

                                            <button type="submit" class="btn btn-md text-light" style="background: #6c63ff">Sauvegarder</button>
                                        </form>
                                        @elseif(Request::segment(2)== 'edit')
                                            <form method="post" action="{{route('admin.edit', ['id'=> $admin->id])}}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="name">Nom</label>
                                                    <input type="text" class="form-control" id="name" required value="{{$admin->name}}"  name="name"
                                                           placeholder="Nom">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" required name="email" value="{{$admin->email}}"
                                                           placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Mot de passe</label>
                                                    <input type="password" class="form-control" id="password" required name="password" placeholder="Mot de passe">
                                                </div>
                                                <div class="form-group">
                                                    <label for="user_type">Type</label>
                                                    <input type="number" class="form-control" id="user_type" required name="user_type" value="{{$admin->user_type}}"
                                                           placeholder="Type">
                                                </div>

                                                <button type="submit" class="btn btn-md text-light" style="background: #6c63ff">Sauvegarder</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.col -->
            </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
