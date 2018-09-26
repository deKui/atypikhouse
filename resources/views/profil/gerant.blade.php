@extends('layouts.app')

@section('content')


	<div class="container">

<!-- Faire des foreach pour afficher les différentes infos -->
			 <div class="row card atypikcard2">

			 	<div class="card-header"><h4>Derniers utilisateurs signalés : </h4></div>

				<table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">Avatar</th>
				      <th scope="col">Pseudo</th>
				      <th scope="col">Description</th>
				      <th scope="col">Signalé</th>
				      <th scope="col">Activé / Désactivé</th>
				    </tr>
				  </thead>
				  <tbody>

			            @foreach($userSignale as $user)
							    <tr style="text-align: left">
							      <td><img class="avatar" style="float: none; background-image:url({{ asset('storage/' . $user->avatar) }})"></td>
							      <td> {{ $user->pseudo }} </td>
							      <td> {{ $user->description }} </td>
									<td><a href="{{ route('profil.index', $user->id) }}" class="atypik-badge">Voir</a></td>
									@if ($user->active == false)
							      	<td><a href="{{ route('profil.gerantActiveDesactive', $user->id) }}" class="atypik-badge" style="background:green">Activé</a></td>
							      @else 
							      	<td><a href="{{ route('profil.gerantActiveDesactive', $user->id) }}" class="atypik-badge" style="background:red">Désactivé</a></td>
							      @endif
							    </tr>
			            @endforeach

				  </tbody>
				</table>

</div>

<div class="row card atypikcard2">
			<div class="card-header"><h4>Derniers avis signalés : </h4></div>


				<table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">Utilisateur</th>
				      <th scope="col">Habitat</th>
				      <th scope="col">Avis laissés</th>
				      <th scope="col">Supprimer avis</th>
				    </tr>
				  </thead>
				  <tbody>

			            @foreach($avisSignale as $avis)
							    <tr style="text-align: left">
							      <td> {{ $avis->pseudo }} </td>
							      <td> {{ $avis->titre }} </td>
							      <td> {{ $avis->comment }} </td>
							      <td><a href="{{ route('profil.gerantAvis', $avis->id) }}" class="atypik-badge">Supprimer l'avis</a></td>
							    </tr>
			            @endforeach

				  </tbody>
				</table>

</div>


<!-- <div class="row card atypikcard">
				<div class="card-header"><h3>Dernieres photos signalées : </h3></div>

			            @foreach($habitatSignale as $photo)

			            <div class="col-md-4">
			                <div class="card">

			                    <ul class="list-group list-group-flush">
			                    	<li class="list-group-item"><img class="card-img2" style="background-image:url({{ asset('storage/' . $photo->photo) }})"></li>
			                        <li class="list-group-item">Photo : {{ $photo->id_utilisateur }} </li>
			                        <li class="list-group-item">Utilisateur : {{ $photo->id_habitat }} </li>
			                        <li class="list-group-item"> <a href="{{ route('profil.index', $user->id) }}" class="btn btn-primary">Voir</i>
			                    </ul> 
			                </div>
			            </div> 

			            @endforeach

	</div> -->


<div class="row card atypikcard2">
	<div class="card-header">
		<h4> Types d'habitats </h4>
		<a href="{{ route('habitat.addType') }}" class="btn btn-primary"> Ajouter </a>

	</div>

		<table class="table table-striped">
			<tbody>

			    @foreach($typeHabitats as $type)
					<tr style="text-align: left">
						<td> {{ $type->nom }} </td>
					</tr>

			    @endforeach

			</tbody>
		</table>
	</div>
</div>		

@endsection