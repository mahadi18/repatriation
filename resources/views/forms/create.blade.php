@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Forms / Create </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('forms.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value=""/>
                </div>

                <div class="form-group">
                    <label for="body">Task</label>
                    <select name="task_id" class="form-control" >
                        <?php foreach ($tasks as $task) {?>
                        <option value="<?php echo $task->id; ?>"><?php echo $task->title; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="order">Order</label>
                    <input type="text" name="order" class="form-control" value=""/>
                </div>
                <div class="form-group">
                    <label for="body">Destination Country</label>

                    <select name="country_id" class="form-control">
                        <?php foreach ($countries as $country) { ?>
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        <?php } ?>
                    </select>
                </div>
                <a class="btn btn-default" href="{{ route('forms.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Create</button>
            </form>
        </div>
    </div>


@endsection