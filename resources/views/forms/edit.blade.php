@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Forms / Edit </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('forms.update', $form->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$form->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value="{{$form->title}}"/>
                </div>
                <div class="form-group">
                     <label for="body">Task</label>
                     <!--<input type="text" name="task_id" class="form-control" value="{{$form->task_id}}"/>-->
                        <select name="task_id" class="form-control">
                        <?php foreach ($tasks as $task) { ?>
                            <option value="{{$task->id}}" <?php if($task->id==$form->task_id) {echo 'selected="selected"';}?>>{{$task->title}}</option>
                        <?php } ?>
                        </select>
                </div>
                <div class="form-group">
                     <label for="body">Destination Country</label>
                     <!--<input type="text" name="task_id" class="form-control" value="{{$form->task_id}}"/>-->
                        <select name="country_id" class="form-control">
                        <?php foreach ($countries as $country) { ?>
                            <option value="{{$country->id}}" <?php if($country->id==$form->country_id) {echo 'selected="selected"';}?>>{{$country->name}}</option>
                        <?php } ?>
                        </select>
                </div>
                <div class="form-group">
                     <label for="body">Generic</label>
                     <!--<input type="text" name="task_id" class="form-control" value="{{$form->task_id}}"/>-->
                    <input name="generic" type="radio" value="1" <?php if($form->generic==1) echo "checked"; ?>> Yes
                    <input name="generic" type="radio" value="0"<?php if($form->generic==0) echo "checked"; ?>> No
                </div>
                <div class="form-group">
                     <label for="body">Order</label>
                     <input type="text" name="order" class="form-control" value="{{$form->order}}"/>
                </div>



            <a class="btn btn-default" href="{{ route('forms.index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Save</button>
            </form>
        </div>
    </div>


@endsection