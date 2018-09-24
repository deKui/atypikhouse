@extends('layouts.app')

@section('content')


	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-10">
				<div class="card atypikcard">
				<div class="card-header"><h4>Informations personnelles</h4></div>
					<div class="card-body">
						<ul class="list-group list-group-flush">
						    <li class="list-group-item">Nom : {{ $users->pseudo }}</li>
						    <li class="list-group-item">Mail : {{ $users->email }}</li>

						    @if ($reservations->isNotEmpty())
						    <li class="list-group-item">
						    	<a class="btn btn-primary atypikbutton" href="{{ route('messages.show', $users) }}"> Envoyer un message </a>
						    </li>
						    @endif
						    <li class="list-group-item">
						    	<a class="btn btn-primary atypikbutton" href="{{ route('profil.noter', $users->id) }}"> Noter </a>
						    </li>
						<!-- VAL - L'utilisateur authentifié ne peux pas signaler son profil -->
						@if ((auth()->user()->id) !== $users->id)
						    <li class="list-group-item"><a href="{{ route('profil.signaleUtil', $users->id) }}" class="btn btn-primary atypikbutton">Signaler</a></li>
						@endif
						</ul>
					</div>
				</div>
			</div>

				
		</div>
	</div>	

@endsection