@extends('user')

@section('content')
<div class="container-fluid">
    <a class="mca-app-logo" href="#"><img alt="" src="{!! asset('img/mca-app-logo-public.png') !!}"></a>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<!--<div class="panel-heading">Login</div>-->
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>					
                                        @endif
                                        @if (session('csrf_error'))
                                            <div class="alert alert-danger">
                                            {{ session('csrf_error') }}
                                            </div>                                          
                                        @endif                                             
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						{!! Form::hidden('user_timezone', '', ['id' => 'user_timezone']) !!}

						<div class="form-group">
							<label class="col-md-4 control-label">Email Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4" style="text-align: left">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4" style="text-align: left">
								<button type="submit" class="btn btn-primary">Login</button>
								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
