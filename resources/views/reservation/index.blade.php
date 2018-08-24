@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
            @foreach($reservation as $reserv)
        <div class="col-md-4">
                <div class="card">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Habitat : {{ $reserv->id_habitat }} </li>
                        <li class="list-group-item">Date début : {{ $reserv->date_debut }} </li>
                        <li class="list-group-item">Montant : {{ $reserv->montant }} </li>
                    </ul> 

                </div>
            </div> 
              @endforeach
    </div>

</div>


@endsection