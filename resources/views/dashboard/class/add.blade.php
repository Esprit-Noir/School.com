@extends('layouts.base')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mx-1">
                    <div class="col-sm-6">
                        @if(Request::segment(3)== 'add')
                            <h3>Ajouter Classes</h3>
                        @elseif(Request::segment(3)== 'edit')
                            <h3>Modifier {{$class->name}}</h3>
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
                                        @if(Request::segment(3)== 'add')
                                        <form method="post" action="{{route('admin.classes.create-class')}}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Nom de la classe</label>
                                                <input type="text" class="form-control" id="name"  name="name"
                                                       placeholder="Nom de la classe">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-md text-light" style="background: #6c63ff">Sauvegarder</button>
                                        </form>
                                        @elseif(Request::segment(3)== 'edit')
                                            <form method="post" action="{{route('admin.classes.edit-class', ['class'=> $class])}}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="name">Nom de la classe</label>
                                                    <input type="text" class="form-control" id="name" value="{{$class->name}}"  name="name"
                                                           placeholder="Nom de la classe">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" name="status" value="{{$class->name}}">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
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
