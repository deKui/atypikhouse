@extends('layouts.app')

@section('content')


	<div class="container">
		<div class="row justify-content-md-center">
				<div class="col-md-4 atypikcard">
					<img class="card-img" style="background-image:url({{ asset('storage/' . $user->avatar) }})">
					<div class="card-header"><h3 style="text-align:center;">{{ $user->prenom }} {{ $user->nom }}</h3></div>
					<span class="label label-default">{{ $user->role }}</span>
				</div>

				<div class="card atypikcard2 col-md-6">

					<div class="card-body">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Pseudo : {{ $user->pseudo }}</li>
						    <li class="list-group-item">Prenom : {{ $user->prenom }}</li>
						    <li class="list-group-item">Nom : {{ $user->prenom }}</li>
						    <li class="list-group-item">Mail : {{ $user->email }}</li>  
						    <li class="list-group-item">Date de naissance : {{ $user->date_naissance }}</li>  
						    <li class="list-group-item">Note : {{ $user->note_eval }} / 5</li>  
						</ul>
					</div>

					@if (Auth()->user()->id == $user->id )

					<div class="card-footer">
						<a class="btn btn-primary atypikbutton" href="{{ route('profil.edit', auth()->user()->id) }}"> Modifier </a>
					</div>

					@endif
						
				</div>
		</div>
	</div>	

@endsection