@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			
			<div class="jumbotron">
			  	<div class="container">
			    	<h2 class="display-3">Détail de votre réservation </h2>
			    	<br/>

			    	<ul class="list-group list-group-flush">
					  	<li class="list-group-item">Séjour du {{ $date_debut }} au {{ $date_fin }} </li>
					  	<li class="list-group-item">Pour {{ $nbpersonne }} personne(s) </li>
					  	<li class="list-group-item">Prix par nuit : {{ $habitat->prix }} € </li>
					  	<li class="list-group-item">Prix total : {{ $duree }} nuit(s) x {{ $habitat->prix }} € : {{ $prixtotal }} € </li>
					</ul>

				  
			    	<a class="btn btn-secondary atypikbutton" style="text-align:right;" href="{{ route('paypal', ['habitat' => $habitat, 'montant' => $prixtotal, 'date_debut' => $date_debut, 'date_fin' => $date_fin]) }}" role="button"> Payer via Paypal </a>
			  	</div>
			</div>
			
		</div>
	</div>
</div>

@endsection