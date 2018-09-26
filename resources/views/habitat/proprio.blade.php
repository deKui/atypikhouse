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
                        
                        <a href="{{ route('habitat.show', $habitat->id) }}">
                            <div class="card atypikcard2">
                            <div class="item">
                                <span class="notify-badge">{{ $habitat->prix }}€</span>
                                <div class="hovereffect">
                                <img class="card-img2" style="background-image:url({{ asset('storage/' . $habitat->photo) }})">
                                <div class="overlay">
                                    <h2>{{ $habitat->titre }}</h2>
                                    <p>
                                        <a href="{{ route('habitat.show', $habitat->id) }}">VOIR LE LOGEMENT</a>
                                    </p>
                                </div>
                            </div>
                            </div>   
                                <span class="label logement-label">{{ $habitat->nb_personne_max }} voyageurs</span>
                                <h4 class="logement-titre ">{{ $habitat->titre }}</h4>
                                <span class="label logement-label">{{ $habitat->type->nom }}</span>
                                <span class="label logement-label">{{ $habitat->prix }}€ par nuit - {{ $habitat->ville }}</span>
                                
                            </div>
                        </a>
                         
                        <div>
                            <a href="{{ route('habitat.edit', $habitat->id) }}" class="btn btn-primary">Modifier</a>
                            <a href="{{ route('habitat.delete', $habitat->id) }}" class="btn btn-primary">Supprimer</a>
                        </div>

                        
                    </div> 

                @endforeach
        </div>
    </div>

</div>

@endsection