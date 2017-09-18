@extends('layout')

@section('content')
    <div class="page-header">
        <h1>User / Create </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <!--<form class="form-horizontal" role="form" method="POST" action="{{ url('/users/store') }}">-->
                <form class="form-horizontal" role="form"  action="{{ route('users.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Organization</label>
                    <div class="col-md-6">
                        <select name="organization_id" class="form-control">
                            <option>Select One</option>
                            @foreach ($organizations as $organization)
                            <option value="{{$organization->id}}">{{$organization->name}},{{$organization->org_type($organization->org_type)}},{{$organization->country_name($organization->country)}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Role</label>
                    <div class="col-md-6">
                        <select name="role" class="form-control">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" selected="3">{{$role->display_name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Confirm Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection