@extends('layouts.app')

@section('content')

<div class="container">



 <!-- Réservation futures -->

    <div class="row atypikcard2">

<!-- Si aucunes données : Ecrire :: Quel sera votre prochain logement atypique ? + lien vers la recherche -->
        <div class="col-md-12 card-header"> <h4>Vos futures réservations</h4><br/></div>

        @if ( $reservFuture->isEmpty() )
        <div class="col-md-12">
            <p>Quel sera votre prochain logement atypique ? </p>
            <a href="{{ route('home')}}" class="btn btn-secondary atypikbutton"> Effectuer une recherche</a>
        </div>
        @else
            @foreach($reservFuture as $reserv)
                <div class="col-md-4">
                    <div class="card atypikcard">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Habitat : {{ $reserv->habitats->titre }} </li>
                            <li class="list-group-item">Loué par : {{ $reserv->users->pseudo }} </li>
                            <li class="list-group-item">Du : {{ $reserv->date_debut }} au : {{ $reserv->date_fin }}</li>
                            <li class="list-group-item">Montant : {{ $reserv->montant }} € </li>
                        </ul> 

                    </div>
                </div> 
             @endforeach
        @endif
      
    </div>
    <hr>

 <!-- Réservation précèdentes -->

    <div class="row atypikcard2">
        <div class="col-md-12 card-header"> <h4>Vos voyages précédents</h4><br/></div>
        <!-- Si aucunes données : Ecrire :: Vous n'avez pas encore effectué de voyage -->


    @if ( $reservPassee->isEmpty() )
    <div class="col-md-12">
        <p>Vous n'avez pas encore de voyages  </p>
    </div>
    @else
            @foreach($reservPassee as $reserv)
                <div class="col-md-4">
                    <div class="card atypikcard">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Habitat : {{ $reserv->habitats->titre }} </li>
                            <li class="list-group-item">Loué par : {{ $reserv->users->pseudo }} </li>
                            <li class="list-group-item">Du : {{ $reserv->date_debut }} au : {{ $reserv->date_fin }}</li>
                            <li class="list-group-item">Montant : {{ $reserv->montant }} € </li>
                        </ul> 

                    </div>
                </div> 
              @endforeach
    @endif
    </div>
    <hr>

<!-- Réservation en cours -->

    <div class="row atypikcard2">
        <div class="col-md-12 card-header"> <h4>Vos réservations en cours</h4><br/></div>
        <!-- Si aucunes données : Ecrire :: Vous n'avez pas encore effectué de voyage -->


    @if ( $reservEnCours->isEmpty() )
    <div class="col-md-12">
        <p>Vous n'avez pas encore de voyages  </p>
    </div>
    @else
            @foreach($reservEnCours as $reserv)
                <div class="col-md-4">
                    <div class="card atypikcard">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Habitat : {{ $reserv->habitats->titre }} </li>
                            <li class="list-group-item">Loué par : {{ $reserv->users->pseudo }} </li>
                            <li class="list-group-item">Du : {{ $reserv->date_debut }} au : {{ $reserv->date_fin }}</li>
                            <li class="list-group-item">Montant : {{ $reserv->montant }} € </li>
                        </ul> 

                    </div>
                </div> 
              @endforeach
    @endif
    </div>
    <hr>

</div>


@endsection