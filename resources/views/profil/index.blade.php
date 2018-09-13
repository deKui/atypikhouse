@extends('layouts.app')

@section('content')


	<div class="container">
		<div class="row justify-content-md-center">
				<div class="col-md-4">
					<img class="card-img-top" src="{{ asset('storage/' . $user->avatar) }}">
				</div>

				<div class="card col-md-6">

					<div class="card-body">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Pseudo : {{ $user->pseudo }}</li>
						    <li class="list-group-item">Prenom : {{ $user->prenom }}</li>
						    <li class="list-group-item">Nom : {{ $user->nom }}</li>
						    <li class="list-group-item">Mail : {{ $user->email }}</li>  
						    <li class="list-group-item">Date de naissance : {{ $user->date_naissance }}</li>  
						    <li class="list-group-item">Note : {{ $user->note_eval }} / 5</li>  
						</ul>
					</div>

					@if (Auth()->user()->id == $user->id )

					<div class="card-footer">
						<a class="btn btn-primary" href="{{ route('profil.edit', auth()->user()->id) }}"> Modifier </a>
					</div>

					@endif
						
				</div>
		</div>
	</div>	

@endsection