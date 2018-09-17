@extends('layouts.app')
@section('content')
<main role="main">
<div class="jumbotron">
  <div class="container">
    <img src="{{ asset('images/habitat_2.png') }}" width="25%">
    <h2 class="display-3">Dernières trouvailles</h2>
    <br/>
    <p>Découvrez la selection atypik et réservez votre séjour inoubliable
    </p>
  </div>
</div>
<hr>
<div class="jumbotron">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <h2 class="display-3">Les logements</h2>
        <br/>
        </div>
        <br/>
        <br/>
            @foreach($habitats->sortBy('created_at') as $habitat)
            <div class="col-md-4">
                <div class="card atypikcard">
                    <img class="card-img-top" src="{{ asset('storage/' . $habitat->photo) }}">
                    <h4>{{ $habitat->titre }}</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Titre : {{ $habitat->titre }} </li>
                        <li class="list-group-item">Description : {{ $habitat->description }} </li>
                        <li class="list-group-item">Propriétaire : {{ $habitat->proprio->pseudo }} </li>
                        <li class="list-group-item">Type : {{ $habitat->type->nom }} </li>
                        <li class="list-group-item">Adresse : {{ $habitat->adresse }} {{ $habitat->code_postal }} {{ $habitat->ville }} </li>
                        <li class="list-group-item">Lit(s) simple(s) : {{ $habitat->nb_lit_simple }} </li>
                        <li class="list-group-item">Lit(s) double(s) : {{ $habitat->nb_lit_double }} </li>
                        <li class="list-group-item">Prévu pour {{ $habitat->nb_personne_max }} personnes maximum </li>
                        <li class="list-group-item">Disponibilité : Du {{ $habitat->date_debut_dispo }} au {{ $habitat->date_fin_dispo }} </li>
                        <li class="list-group-item"> <a href="{{ route('habitat.show', $habitat->id) }}" class="btn btn-primary atypikbutton">Voir</a> </li>
                    </ul> 
                </div>
            </div> 
            @endforeach
    </div>
    </div> <!-- /container -->
</div>
</main>
@endsection