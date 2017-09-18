@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Organizations</h1>
    </div>

    @if(auth()->user()->roles[0]->name!='contributor')
        <a class="btn btn-success" href="{{ route('organizations.create') }}">Create</a>
    @endif

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>COUNTRY</th>
                        <th>NAME</th>
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
                    <td>{{$organization->id}}</td>
                    <td>{{$organization->country_name($organization->country)}}</td>
                    <td>{{$organization->name}}</td>
                    <td>{{$organization->org_type($organization->org_type)}}</td>
                    <td>{{$organization->address}}</td>

                        <td class="text-right">
                            <a class="btn btn-info" href="{{ route('organizations.show', $organization->id) }}">View</a>
                            <?php if(Auth::user()->roles[0]->name!='contributor') { ?>
                                <a class="btn btn-success" href="{{ route('organization.users', $organization->id) }}">Users</a>
                                <!--<form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>-->
                            <?php } ?>
                        </td>

                </tr>

                @endforeach

                </tbody>

            </table>

            <div class="paginator"> <?php echo $organizations->render(); ?></div>
        </div>
    </div>


@endsection