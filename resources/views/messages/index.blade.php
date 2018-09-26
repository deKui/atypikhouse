@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">

		@if ($users->isEmpty() == true)

		<div class="jumbotron">
		  <div class="container">
		    <img src="{{ asset('images/habitat_1.png') }}" width="25%">
		    <h2 class="display-3">Désolé</h2>
		    <br/>
		    <p>Aucune conversations disponible
		    </p>
		    <a class="btn btn-secondary atypikbutton" style="text-align:right;" href="{{ route('home') }}" role="button"> Rechercher un logement </a>
		  </div>
		</div>

		@elseif ($users->isEmpty() == false)

		<div class="col-md-12">
			<h1> Vos conversations </h1>
			<br>
		</div>

		@endif
		
		@include('messages.users', ['users' => $users, 'unread' => $unread])

	</div>
</div>

@endsection