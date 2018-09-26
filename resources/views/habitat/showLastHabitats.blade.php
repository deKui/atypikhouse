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
            @foreach($habitats->sortByDesc('created_at')->take(3) as $habitat)
            
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
            </div> 
            
            @endforeach

    </div>
    </div> <!-- /container -->
</div>
</main>
@endsection