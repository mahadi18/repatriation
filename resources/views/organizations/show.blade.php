@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Organizations / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                {{--<div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$organization->id}}</p>
                </div>--}}
                <div class="form-group">
                     <label for="name">Name</label>
                     <p class="form-control-static">{{$organization->name}}</p>
                </div>
                <div class="form-group">
                     <label for="name">Type</label>
                     <p class="form-control-static">{{$organization->org_type($organization->org_type)}}</p>
                </div>
                    <div class="form-group">
                     <label for="description">DESCRIPTION</label>
                     <p class="form-control-static">{!! $organization->description !!}</p>

                </div>
                    <div class="form-group">
                     <label for="address">ADDRESS</label>
                     <p class="form-control-static">{{$organization->address}}</p>
                </div>
                    <div class="form-group">
                     <label for="country">COUNTRY</label>
                     <p class="form-control-static">{{$organization->country_name($organization->country)}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ route('organizations.index') }}">Back</a>
            <a class="btn btn-warning" href="{{ route('organizations.edit', $organization->id) }}">Edit</a>
           <!-- <form action="#/{{$organization->id}}" method="DELETE" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">Delete</button></form>-->

            @if(auth()->user()->roles[0]->name!='contributor')
                <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
            @endif

            @if(auth()->user()->organization_id == $organization->id)
                <a class="btn btn-success" href="{{ route('shelterhomes.create') }}">Add Shelter Home</a>
            @endif

        </div>
    </div>
<?php if((count($organizations) > 0) && ($organization->org_type==1)) { ?>
<div class="row">
    <div class="col-md-12">
        <h3>Shelter homes under {{$organization->name}}</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                {{--<th>ID</th>--}}
                <th>District</th>
                <th>Name</th>
                <th style="width: 20%">Type</th>
                <th style="width: 20%">Point of Contact</th>
                <?php if(Auth::user()->roles[0]->name!='contributor') { ?>
                    <th class="text-right">OPTIONS</th>
                <?php } ?>
            </tr>
            </thead>

            <tbody>

            @foreach($organizations as $organization)
            <tr>
                {{--<td>{{$organization->id}}</td>--}}
                <td>{{$organization->district_name($organization->district_id)}}</td>
                <td>{{$organization->name}}</td>
                <td>{{$organization->org_type($organization->org_type)}}</td>
                <td>{{$organization->address}}</td>

                <td class="text-right">
                    <a class="btn btn-info" href="{{ route('organizations.show', $organization->id) }}">View</a>
                    <?php if(Auth::user()->roles[0]->name!='contributor') { ?>
                        <a class="btn btn-success" href="{{ route('organization.users', $organization->id) }}">Users</a>
                        <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    <?php } ?>
                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

        <div class="paginator"> <?php echo $organizations->render(); ?></div>
    </div>
</div>
<?php } ?>

@endsection
