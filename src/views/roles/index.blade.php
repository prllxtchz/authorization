@extends('layouts.app')


@section('content')

    <div class="container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Role ID</th>
                            <th>Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>ID</td>
                            <td>Role Name</td>
                            <td class="text-center">
                                <ul class="icons-list">
                                        <a href="#" data-popup="tooltip" title="Modify Role">Edit</a>
                                        <form action="#" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-link">
                                                Delete
                                            </button>
                                        </form>
                                </ul>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
