@extends('layouts.app')

@section('content')

<div class="container">



 <!-- Réservation futures -->

    <div class="row">

<!-- Si aucunes données : Ecrire :: Quel sera votre prochain logement atypique ? + lien vers la recherche -->
        <h2> Vos futures réservations </h2>

        @if ( $reservFuture->isEmpty()  )
            <p>Quel sera votre prochain logement atypique ? </p>
            <a href="{{ route('home')}}"> Effectuer une recherche</a>
        @else
            @foreach($reservFuture as $reserv)
                <div class="col-md-4">
                    <div class="card">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Habitat : {{ $reserv->titre }} </li>
                            <li class="list-group-item">Loué par : {{ $reserv->pseudo }} </li>
                            <li class="list-group-item">Du : {{ $reserv->date_debut }} au : {{ $reserv->date_fin }}</li>
                            <li class="list-group-item">Montant : {{ $reserv->montant }} € </li>
                        </ul> 

                    </div>
                </div> 
             @endforeach
        @endif
      
    </div>

 <!-- Réservation précèdentes -->

    <div class="row">
           <h2> Vos voyages précédents  </h2>
        <!-- Si aucunes données : Ecrire :: Vous n'avez pas encore effectué de voyage -->


    @if ( $reservPassee->isEmpty() )
        <p>Vous n'avez pas encore de voyages  </p>
    @else
            @foreach($reservPassee as $reserv)
                <div class="col-md-4">
                    <div class="card">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Habitat : {{ $reserv->titre }} </li>
                            <li class="list-group-item">Loué par : {{ $reserv->pseudo }} </li>
                            <li class="list-group-item">Du : {{ $reserv->date_debut }} au : {{ $reserv->date_fin }}</li>
                            <li class="list-group-item">Montant : {{ $reserv->montant }} € </li>
                        </ul> 

                    </div>
                </div> 
              @endforeach
    @endif
    </div>

</div>


@endsection