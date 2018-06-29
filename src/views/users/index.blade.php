@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Page content -->
        <div class="page-content">


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4>
                                <i class="icon-arrow-left52 position-left"></i>
                                <span class="text-semibold">Home</span>
                                - Users
                            </h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="{{route('users.create')}}" class="btn btn-link btn-float text-size-small has-text"><i class="icon-plus3 text-primary"></i><span>Add New User</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    @if (session('status'))
                        <div class="alert bg-success alert-styled-left">
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span><span class="sr-only">Close</span>
                            </button>
                            {{session('status')}}
                        </div>
                @endif

                <!-- Basic datatable -->
                    <div class="panel panel-flat border-top-info border-bottom-info">
                        <div class="panel-heading">
                            <h5 class="panel-title">Users</h5>
                        </div>

                        <table class="table datatable-basic">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->roles()->pluck('name')->implode(', ')  }}</td>
                                    <td class="text-center">
                                        <a href="{{route('users.edit', [$user->id])}}" data-popup="tooltip" title="Edit">Edit</i></a>
                                        <form action="{{ route('users.destroy',[$user->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-link" data-popup="tooltip">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /basic datatable -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

@endsection
