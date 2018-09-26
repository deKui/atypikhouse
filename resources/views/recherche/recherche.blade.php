@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

            @foreach($habitats as $habitat)

            <div class="col-md-4">
            <a href="{{ route('habitat.showAfterSearch', [$habitat->id, $nb_personne, $date_debut, $date_fin, $duree]) }}">
                <div class="card atypikcard2">
                <div class="item">
                    <span class="notify-badge">{{ $habitat->prix }}€</span>
                    <div class="hovereffect">
                    <img class="card-img2" style="background-image:url({{ asset('storage/' . $habitat->photo) }})">
                    <div class="overlay">
                        <h2>{{ $habitat->titre }}</h2>
                        <p>
                            <a href="{{ route('habitat.showAfterSearch', [$habitat->id, $nb_personne, $date_debut, $date_fin, $duree]) }}">VOIR LE LOGEMENT</a>
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
            </div> 

            @endforeach

    </div>

</div>


@endsection