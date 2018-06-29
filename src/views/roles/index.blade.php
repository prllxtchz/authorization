@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Page content -->
        <div class="page-content">


            <!-- Main content -->
            <div class="content-wrapper">


                <!-- Content area -->
                <div class="content">

                    <!-- Basic datatable -->
                    <div class="panel panel-flat border-top-info border-bottom-info">
                        <div class="panel-heading">
                            <h5 class="panel-title">Roles</h5>
                        </div>

                        <table class="table datatable-basic table-xs">
                            <thead>
                            <tr>
                                <th>Role ID</th>
                                <th>Name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($roles as $role)

                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            @can('MODIFY USER_ROLE')
                                                <a href="{{route('roles.edit', ['id' => $role->id])}}" data-popup="tooltip" title="Modify Role">Edit</a>
                                            @endcan

                                            @can('DELETE USER_ROLE')

                                                <form action="{{ route('roles.destroy',[$role->id]) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-link" data-popup="tooltip">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </ul>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /basic datatable -->

                    <!-- Footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

@endsection
