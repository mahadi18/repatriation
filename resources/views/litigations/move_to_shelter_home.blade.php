@extends('layout')

@section('content')
<div class="page-header">
    <h1>Cases / Show </h1>
</div>


<div class="row">
    <div class="col-md-12">

        <form action="#" class="form-horizontal">
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="nome">ID</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->id}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="Victim Name">Victim Name</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->name_during_rescue}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="other_names">Other Names</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->other_names}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="alias">Alias</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->alias}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="age">Age</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->age}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="age">Home Country</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->country_of_origin}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="age">Home District</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->home_district}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="age">Rescue Place</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->rescue_place}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="dob">Birth Date</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->dob}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="gender">Gender</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->gender}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="religion">Religion</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->religion}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="spouse_name">Spouse Name</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->spouse_name}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="father_name">Father's Name</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->father_name}}</span></div>
            </div>
            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="mother_name">Mother's Name</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->mother_name}}</span></div>
            </div>

            <div class="form-group col-lg-6">
                <label class="col-sm-5" for="mother_name">Description</label>

                <div class="col-sm-7"><span class="form-control-static">{{$litigation->description}}</span></div>
            </div>
        </form>
    </div>
    <div class="col-sm-12">

        <div class="row">
            <div class="col-lg-12">

                <form class="form-horizontal" action="/cases/{{$litigation->id }}/store_in_shelter" method="POST">
                    <section class="panel-body">
                        <!--                        <input type="hidden" name="_method" value="PUT">-->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="form-group col-lg-6">
                            <div class="row">
                                <label class="col-sm-5" for="age">Shelter home</label>

                                <div class="col-sm-7">
                                    <!--<input type="text" name="country_of_origin" class="form-control" value=""/>-->
                                    <?php
                                    if ($litigation->shelterHome()->get()->toArray()) {
                                        $selected_id = $litigation->shelterHome()->get()[0]->id;
                                    } else {
                                        $selected_id = 0;

                                    }
                                    ?>
                                    <select name="shelter_home" class="form-control">
                                        @foreach($shelter_homes as $shelter_home)
                                        <option
                                            value="{{$shelter_home['id']}}" <?php if ($shelter_home['id'] == $selected_id) {
                                            echo 'selected = "selected"';
                                        } ?> >{{$shelter_home['name']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                {!! Form::submit('Attach', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>


    </div>
</div>
</div>
</div>


@endsection