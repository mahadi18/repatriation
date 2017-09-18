@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Users</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{ route('users.create') }}">Create</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th style="width: 20%">DESCRIPTION</th>
                        <th style="width: 20%">Last Login</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td style="width: 20%">
                        <?php
                            echo \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login))->diffForHumans()
                        ?>

                    </td>
                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ route('users.show', $user->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ route('users.edit', $user->id) }}">Edit</a>
                        <?php
                        $msg = $user->status==1? 'Deactivate':'Activate';

                        ?>
                        <form action="{{ route('users.update', $user->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure?')) { return true } else {return false };">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="status" value="<?php echo $user->status == 1 ? '0' : '1' ?>">
                            <button class="btn btn-danger" style="background-color: #E9EAED; color: #EC6459" type="submit"><?php echo $msg ?></button>
                        </form>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>


        </div>
    </div>

    <div class="paginagor"> <?php echo $users->render(); ?></div>


@endsection