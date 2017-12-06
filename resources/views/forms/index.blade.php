@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Forms</h1>
    </div>

    @if(auth()->user()->roles[0]->name!='contributor')
        <a class="btn btn-success" href="{{ route('forms.create') }}">Create</a>
    @endif


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>Task</th>
                        <th>Dest Country</th>
                        <th>Order</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($forms as $form)
                <tr>
                    <td>{{$form->id}}</td>
                    <td>{{$form->title}}</td>
                    <td>{{$form->task['title']}}</td>
                    <td>{{$form->country['name']}}</td>
                    <td>{{$form->order}}</td>

                    <td class="text-right">
                        <?php if($form->generic==true) {?>
                            <span class="btn btn-default">Default</span>
                        <?php } else { ?>
                        <a class="btn btn-primary" href="{{ route('forms.show', $form->id) }}">Fields</a>
                        <?php } ?>
                        <a class="btn btn-warning " href="{{ route('forms.edit', $form->id) }}">Edit</a>
                        <form action="{{ route('forms.destroy', $form->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('forms.create') }}">Create</a>
        </div>
    </div>


@endsection