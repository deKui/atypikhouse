@extends('layouts.app')

@section('content')


	<div class="container">

		<h1> Gérant </h1>

<!-- Faire des foreach pour afficher les différentes infos -->
			 <div class="row">


			 	<h2>Derniers utilisateurs signalés</h2>

			            @foreach($userSignale as $user)

			            <div class="col-md-4">
			                <div class="card">
			                    <ul class="list-group list-group-flush">
			                    	<li class="list-group-item">Avatar : {{ $user->pseudo }} </li>
			                        <li class="list-group-item">Pseudo : {{ $user->pseudo }} </li>
			                        <li class="list-group-item">Description : {{ $user->description }} </li>
			                        <li class="list-group-item"> <a href="{{ route('profil.index', $user->id) }}" class="btn btn-primary">Voir</a></li>
			                        <!--<li class="list-group-item"> <a href="{{ route('profil.index', $user->id) }}" class="btn btn-primary">Désactivé</a></li>-->
			                    </ul> 
			                </div>
			            </div> 

			            @endforeach
</div>
<div class="row">
			 	<h2>Derniers avis signalés</h2>

			            @foreach($avisSignale as $avis)

			            <div class="col-md-4">
			                <div class="card">
			                    <ul class="list-group list-group-flush">
			                        <li class="list-group-item">Utilisateur : {{ $avis->id_utilisateur }} </li>
			                        <li class="list-group-item">Habitat : {{ $avis->id_habitat }} </li>
			                        <li class="list-group-item">Commentaire / Avis : {{ $avis->comment }} </li>
			                        <!--<li class="list-group-item"> <a href="{{ route('profil.index', $user->id) }}" class="btn btn-primary">Supprimé</a></li>-->
			                    </ul> 
			                </div>
			            </div> 

			            @endforeach

</div>
<div class="row">
			    <h2>Dernieres photos signalées</h2>

			            @foreach($habitatSignale as $photo)

			            <div class="col-md-4">
			                <div class="card">

			                    <ul class="list-group list-group-flush">
			                    	<li class="list-group-item"><img class="card-img-top" src="{{ asset('storage/' . $photo->photo) }}"></li>
			                        <li class="list-group-item">Photo : {{ $photo->id_utilisateur }} </li>
			                        <li class="list-group-item">Utilisateur : {{ $photo->id_habitat }} </li>
			                        <!--<li class="list-group-item"> <a href="{{ route('profil.index', $user->id) }}" class="btn btn-primary">Voir</i>-->
			                    </ul> 
			                </div>
			            </div> 

			            @endforeach

	</div>	

@endsection