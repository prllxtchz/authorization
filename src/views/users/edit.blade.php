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
                                - Users</h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="/users" class="btn btn-link btn-float text-size-small has-text"><i
                                            class="icon-list text-primary"></i><span>View All Users</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <div class="row">
                        <div class="col-md-6">

                            <!-- Basic datatable -->
                            <div class="panel panel-flat border-top-info border-bottom-info">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Update User</h5>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
                                        {{ csrf_field() }}
                                        {{method_field('PUT')}}
                                        <fieldset class="content-group">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Login Name</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="{{$user->name}}" name="nick_name" placeholder="This name uses to login">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Full Name</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="{{$user->name}}" name="full_name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Email</label>
                                                <div class="col-md-8">
                                                    <input type="email" class="form-control" value="{{$user->email}}" name="email">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Role</label>
                                                <div class="col-md-8">
                                                    <select data-placeholder="Click to select" multiple="multiple" class="select" name="roles[]">
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}" {{$role->selected ? ' selected' : ''}}>{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block">(You can select more than one role.)</span>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>

                                        </fieldset>

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
