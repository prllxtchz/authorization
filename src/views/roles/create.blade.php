@extends('layouts.app')

@section('theme_js')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('limitless/js/plugins/forms/styling/switch.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('limitless/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('limitless/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('limitless/js/pages/form_checkboxes_radios.js') }}"></script>

    <script type="text/javascript" src="{{ asset('limitless/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /theme JS files -->

@endsection



@section('content')

    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
        @include('layouts.sidebar')


        <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4>
                                <i class="icon-arrow-left52 position-left"></i>
                                <span class="text-semibold">Home</span>
                                - Roles
                            </h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="/roles" class="btn btn-link btn-float text-size-small has-text"><i class="icon-list text-primary"></i><span>View All Roles</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                                <a href="index.html"><i class="icon-home2 position-left"></i> Home</a>
                            </li>
                            <li class="active">Roles</li>
                        </ul>
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
                                                    <span>&times;</span><span class="sr-only">Close</span>
                                                </button>
                                                <span class="text-semibold"></span> {{ $error }}</a>.
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                        @endif


                        <!-- Basic datatable -->
                            <div class="panel panel-flat border-top-info border-bottom-info">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Add New Role</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li>
                                                <a data-action="collapse"></a>
                                            </li>
                                            <li>
                                                <a data-action="reload"></a>
                                            </li>
                                            <li>
                                                <a data-action="close"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('roles.store') }}">
                                        {{ csrf_field() }}


                                        <fieldset class="content-group">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Role Name</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" value="{{ old('role_name') }}" name="role_name">
                                                </div>
                                            </div>
                                        </fieldset>

                                        {{--{{(old('role_permissions')}}--}}

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-xs">
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

                                                @foreach($permissions as $module=>$actions)

                                                    <tr>
                                                        <td>{{$module}}</td>
                                                        <td>
                                                            @if(array_key_exists('VIEW', $actions))
                                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$actions['VIEW']}}" name="role_permissions[]" class="switchery">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if( array_key_exists('CREATE', $actions))
                                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$actions['CREATE']}}" name="role_permissions[]" class="switchery">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if( array_key_exists('MODIFY', $actions))
                                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$actions['MODIFY']}}" name="role_permissions[]" class="switchery">
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if( array_key_exists('DELETE', $actions))
                                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$actions['DELETE']}}" name="role_permissions[]" class="switchery">
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
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </form>
                                </div>

                            </div>
                            <!-- /basic datatable -->

                        </div>
                    </div>

                    <!-- Footer -->
                @include('layouts.footer')
                <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

@endsection
