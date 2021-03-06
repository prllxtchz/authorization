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
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span>
                                - Roles</h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="/roles" class="btn btn-link btn-float text-size-small has-text"><i
                                            class="icon-list text-primary"></i><span>View All Roles</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">


                    <div class="row">
                        <div class="col-md-12">

                            @if ($errors->any())
                                <div class="alert alert-danger alert-styled-left alert-bordered">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                <button type="button" class="close" data-dismiss="alert">
                                                    <span>&times;</span><span class="sr-only">Close</span></button>
                                                <span class="text-semibold"></span> {{ $error }}</a>.
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('status'))
                                <div class="alert bg-success alert-styled-left">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                                class="sr-only">Close</span></button>
                                    {{session('status')}}
                                </div>
                        @endif


                        <!-- Basic datatable -->
                            <div class="panel panel-flat border-top-info border-bottom-info">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Update Role</h5>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST"
                                            action="{{ route('roles.update', ['id' => $role->id]) }}">
                                        {{ csrf_field() }}

                                        {{ method_field('PUT') }}

                                        <fieldset class="content-group">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Role Name</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control"
                                                            value="{{$role->name}}" name="role_name">
                                                </div>
                                            </div>

                                        </fieldset>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm ">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>VIEW</th>
                                                    <th>CREATE</th>
                                                    <th>MODIFY</th>
                                                    <th>DELETE</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($grouped_permissions as $module=>$actions)

                                                    {{--{{dd($module, $actions, $role_permissions)}}--}}

                                                    <tr>
                                                        <td>{{$module}}</td>
                                                        <td>
                                                            @if(array_key_exists('VIEW', $actions))
                                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$actions['VIEW']}}" {{array_search($actions['VIEW'], array_column($role_permissions, 'id')) !== FALSE ? ' checked' : NULL}} name="role_permissions[]" class="switchery">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(array_key_exists('CREATE', $actions))
                                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$actions['CREATE']}}" {{array_search($actions['CREATE'], array_column($role_permissions, 'id')) !== FALSE ? ' checked' : NULL}} name="role_permissions[]" class="switchery">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(array_key_exists('MODIFY', $actions))
                                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$actions['MODIFY']}}" {{array_search($actions['MODIFY'], array_column($role_permissions, 'id')) !== FALSE ? ' checked' : NULL}} name="role_permissions[]" class="switchery">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(array_key_exists('DELETE', $actions))
                                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$actions['DELETE']}}" {{array_search($actions['DELETE'], array_column($role_permissions, 'id')) !== FALSE ? ' checked' : NULL}} name="role_permissions[]" class="switchery">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <br>

                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{route('roles.index')}}" class="btn btn-default">Cancel</a>

                                    </form>
                                </div>

                            </div>
                            <!-- /basic datatable -->

                        </div>
                    </div>


                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

@endsection
