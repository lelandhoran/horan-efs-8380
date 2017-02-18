@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to Eagle Financial Services</div>

                <div class="panel-body">
					@if(Auth::check())
					We are commited to providing the best finacial services available.	
					@endif
					
					@if(Auth::guest())
						<a href="login" class="btn btn-info">Please Login</a>
					 or 
					<a href="register" class="btn btn-info">Register</a>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
