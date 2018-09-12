@extends('layouts.app')

@section('content')


	<div class="container">

		<h1> Gérant </h1>

<!-- Faire des foreach pour afficher les différentes infos -->
			 <div class="row">

			 	<h2>Derniers utilisateurs signalés</h2>

				<table class="table">
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
							    <tr>
							      <td><img class="card-img-top" style="width:10%" src="{{ asset('storage/' . $user->avatar) }}"></td>
							      <td> {{ $user->pseudo }} </td>
							      <td> {{ $user->description }} </td>
									<td><a href="{{ route('profil.index', $user->id) }}" class="btn btn-primary">Voir</a></td>
									@if ($user->active == false)
							      	<td><a href="{{ route('profil.gerantActiveDesactive', $user->id) }}" class="btn btn-primary" style="background:green">Activé</a></td>
							      @else 
							      	<td><a href="{{ route('profil.gerantActiveDesactive', $user->id) }}" class="btn btn-primary" style="background:red">Désactivé</a></td>
							      @endif
							    </tr>
			            @endforeach

				  </tbody>
				</table>

</div>





<div class="row">
			 	<h2>Derniers avis signalés</h2>


				<table class="table">
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
							    <tr>
							      <td> {{ $avis->pseudo }} </td>
							      <td> {{ $avis->titre }} </td>
							      <td> {{ $avis->comment }} </td>
							      <td><a href="{{ route('profil.gerantAvis', $avis->id) }}" class="btn btn-primary">Supprimer</a></td>
							    </tr>
			            @endforeach

				  </tbody>
				</table>

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