@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

            <div class="col-md-4">
                <div class="card">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nous sommes sur la page de cet habitat </li>
                        <li class="list-group-item">Titre : {{ $habitat->titre }} </li>
                        <li class="list-group-item">Description : {{ $habitat->description }} </li>
                        <li class="list-group-item">Propriétaire : <a href="{{ route('profil.show', $habitat->getNameUser($habitat->id_proprietaire)) }}" > {{ $habitat->getNameUser($habitat->id_proprietaire) }} </a> </li>
                        <li class="list-group-item">Type : {{ $habitat->getNameType($habitat->id_type_habitat) }} </li>
                        <li class="list-group-item">Adresse : {{ $habitat->adresse }} {{ $habitat->code_postal }} {{ $habitat->ville }} </li>
                        <li class="list-group-item">Lit(s) simple(s) : {{ $habitat->nb_lit_simple }} </li>
                        <li class="list-group-item">Lit(s) double(s) : {{ $habitat->nb_lit_double }} </li>
                        <li class="list-group-item">Prévu pour {{ $habitat->nb_personne_max }} personnes maximum </li>
                        <li class="list-group-item">Disponibilité : Du {{ $habitat->date_debut_dispo }} au {{ $habitat->date_fin_dispo }} </li>
                    </ul> 

                </div>
            </div> 

    </div>

</div>


@endsection