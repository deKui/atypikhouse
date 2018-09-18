@extends('layouts.app')

@section('content')

<div class="container">

	Page propriétaire - Mes habitats

                <a href="{{ route('habitat.create') }}" class="btn btn-primary">Proposer votre habitat</a> 

	    @foreach($habitatProprio as $habitat)

            <div class="col-md-4">
                <div class="card">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Titre : {{ $habitat->titre }} </li>
                        <li class="list-group-item">Description : {{ $habitat->description }} </li>
                        <li class="list-group-item">Adresse : {{ $habitat->adresse }} {{ $habitat->code_postal }} {{ $habitat->ville }} </li>
                        <li class="list-group-item">Lit(s) simple(s) : {{ $habitat->nb_lit_simple }} </li>
                        <li class="list-group-item">Lit(s) double(s) : {{ $habitat->nb_lit_double }} </li>
                        <li class="list-group-item">Prévu pour {{ $habitat->nb_personne_max }} personnes maximum </li>
                        <li class="list-group-item">Disponibilité : Du {{ $habitat->date_debut_dispo }} au {{ $habitat->date_fin_dispo }} </li>
                    </ul> 

                    <div class="card-body">
                        <a href="{{ route('habitat.edit', $habitat->id) }}" class="btn btn-primary">Modifier</a>
                        <a href="{{ route('habitat.delete', $habitat->id) }}" class="btn btn-primary">Supprimer</a>
                    </div>

                </div>
            </div> 

            @endforeach

</div>


@endsection