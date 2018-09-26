@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Mes dernières demande de réservation</h2> 
            <a href="{{ route('habitat.create') }}" class="btn btn-primary atypikbutton">Proposer votre habitat</a>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Logement </th>
                        <th scope="col">Date</th>
                        <th scope="col">Statut</th>
                    </tr>
                </thead>
                
                <tbody>

                    @foreach($reservationProprio as $reserv)
                        <tr>
                            <td> {{ $reserv->users->pseudo }} </td>
                            <td> {{ $reserv->habitats->titre }}  -  {{ $reserv->habitats->ville }} </td>
                            <td> Du {{ $reserv->date_debut }}  au  {{ $reserv->date_fin }} </td>
                            <td> {{ $reserv->statut }} </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>  
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h2>Mes habitats </h2>
            <hr>
                
                @foreach($habitatProprio as $habitat)

                    <div class="col-md-4">
                        <div class="card">

                            <ul class="list-group list-group-flush">
                                <img class="card-img" src="{{ asset('storage/' . $habitat->photo) }}">
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
    </div>

</div>

@endsection