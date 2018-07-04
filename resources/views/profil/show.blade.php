@extends('layouts.app')

@section('content')


	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-10">
				<div class="card">

					<div class="card-body">
						<ul class="list-group list-group-flush">
							<li class="list-group-item"> Informations personnelles</li>
						    <li class="list-group-item">Nom : {{ $user->name }}</li>
						    <li class="list-group-item">Mail : {{ $user->email }}</li>  
						    <li class="list-group-item"> <a href="{{ route('messages.conversation', $user->name) }}" class="btn btn-primary"> Contacter </a></li>  
						</ul>
					</div>
				</div>
			</div>

				
		</div>
	</div>	

@endsection