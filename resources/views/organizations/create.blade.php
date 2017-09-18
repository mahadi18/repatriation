@extends('layout')

@section('content')
<div class="page-header">
    <h1>Organizations / Create </h1>
</div>


<div class="row">
    <div class="col-md-12">

        <form action="{{ route('organizations.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">NAME</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="country">Organization Type</label>
                        {{--<select name="org_type" class="form-control">
                            @foreach($org_types as $org)
                            <option value="{{$org['id']}}"
                            @if (old('country') == $org['id']) selected="selected" @endif >{{$org['name']}}</option>
                            @endforeach
                        </select>--}}
                        {!! Form::select('organization_type', $org_types, null, ['class' => 'form-control m-bot15']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Contact Person</label>
                        <input type="text" name="contact_person" class="form-control" value="{{ old('phone') }}"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="country">Designation</label>
                        <input type="text" name="contact_designation" class="form-control" value="{{ old('email') }}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="country">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}"/>
                    </div>
                </div>
            </div>

            <div class="row addresser" id="addr1">
                    <div class="col-lg-4">
                        <div class="form-group countries">
                            <label for="country">COUNTRY</label>
                            <select name="country" class="form-control">
                                <option value="0"> Please Select </option>
                                @foreach($countries as $country)
                                <option value="{{$country['id']}}"
                                @if (old('country') == $country['id']) selected="selected" @endif >{{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group states">
                            <label for="country">State</label>
                            {{old('state') }}
                            <select name="state" class="form-control">
                                @foreach($states as $state)
                                <option value="{{$state['id']}}"
                                @if (old('state') == $state['id']) selected="selected" @endif >{{$state['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group districts">
                            <label for="country">District</label>
                            <select name="district" class="form-control">
                                @foreach($districts as $district)
                                <option value="{{$district['id']}}"
                                @if (old('district') == $district['id']) selected="selected" @endif >{{$district['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="address">ADDRESS</label>
                        <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            <a class="btn btn-default" href="{{ route('organizations.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" value="Create">Create</button>
        </form>
    </div>
</div>





@endsection