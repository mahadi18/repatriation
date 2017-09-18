@extends('layout')

@section('content')
<div class="page-header">
    <h1>Care Plans / Show </h1>
</div>

<div class="row">

    <div class="col-sm-12">

        <div class="row">
            <div class="col-lg-12">

                <section class="panel-body">
                    <form action="#" class="form-horizontal">
                        <?php
                        //dd($litigation->shelterhome);
                        if ($litigation->shelterhome) {
                            ?>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="col-sm-5" for="nome">Shelter Home</label>

                                    <div class="col-sm-7"><span class="form-control-static">{{$litigation->shelterhome->name}}</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </form>
                    <?php if ($litigation->carePlans) { ?>
                        <form class="form-horizontal" action="/cases/{{$litigation->id }}/attach-care-plan"
                              method="POST">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                {!! Form::label('careplans', 'Care Plans', array('class' => 'col-sm-5 col-lg-5
                                control-label')) !!}
                                <div class="form-group col-md-7">

                                    <?php
                                    $selected_care_plans = NULL;

                                    //
                                    if ($litigation->carePlans) {
                                        $count = 0;
                                        foreach ($litigation->carePlans as $careplan) {
                                            $selected_care_plans[$count++] = $careplan->id;
                                        }
                                    } else {
                                        $selected_care_plans = null;
                                    }
                                    ?>
                                    {!! Form::select('cps[]', $cps, $selected_care_plans, array('class' =>
                                    'multi-select',
                                    'multiple' =>
                                    'multiple', 'id' => 'my_multi_select4')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-7">
                                    {!! Form::submit('Attach', ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>

                        </form>
                    <?php } ?>
                    <?php
                    //dd($care_plans);
                    ?>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            @foreach($care_plans as $care_plan)
                            <div class="row" style="margin-top: 20px;">
                                <form class="form-horizontal" action="/cases/{{$litigation->id}}/care-plans"
                                      method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label class="col-sm-5" for="age">{{$care_plan->title}}</label>
                                    <input type="hidden" name="care_plan_id" value="{{$care_plan->id}}">

                                    <div class="col-sm-5">
                                        <select name="status" class="form-control">
                                            @foreach($statuses as $status)
                                            <option
                                                value="{{$status['title']}}" <?php if ($status['title'] == $care_plan->status) {
                                                echo 'selected = "selected"';
                                            } ?> >{{$status['title']}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button value="Save">Save</button>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </div>


                </section>

            </div>
        </div>

    </div>
</div>
</div>
</div>
</div>


@endsection