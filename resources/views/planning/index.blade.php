@extends('layouts.homepage')

@section('content')

<div class="container">
	<div class="row">
        <div class="col-md-12">
			<h1> {{ $month->toString() }} </h1>
		</div>
	</div>
</div>

@endsection