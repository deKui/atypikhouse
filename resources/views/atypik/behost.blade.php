@extends('layouts.app')
@section('content')
<main role="main">
<div class="jumbotron">
  <div class="container">
    <img src="{{ asset('images/habitat_1.png') }}" width="25%">
    <h2 class="display-3">Devenir hôte</h2>
    <br/>
    <p>Partagez votre logement pour financer votre retraite, votre prochain voyage, ou simplement rencontrer des voyageurs.
    </p>
    <a class="btn btn-secondary atypikbutton" style="text-align:right;" href="#" role="button">Devenir hôte »</a>
  </div>
</div>
<hr>
<div class="jumbotron">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <h2 class="display-3">L'hébergement de voyageurs en 3 étapes</h2>
        <br/>
        </div>
        <br/>
        <br/>
        <div class="col-md-4">
        <img class="rounded-circle"  width="100%">
        <h4>1. Vous publiez votre annonce gratuitement</h4>
        <br/>
        <p>
        Que vous proposiez un salon partagé ou une résidence secondaire, partagez votre logement sans frais d'inscription.
        </p>
        </div>
        <div class="col-md-4">
        <img class="rounded-circle"  width="100%">
        <h4>2. Vous fixez vos conditions</h4>
        <br/>
        <p>Décidez de votre planning, de vos tarifs ainsi que vos critères de réservation. Nous restons à votre disposition si vous avez besoin d'aide. </p>
        </div>
        <div class="col-md-4">
        <img class="rounded-circle" width="100%">
        <h4>3. Accueillez votre premier voyageur</h4>
        <br/>
        <p>Une fois votre annonce publiée, les voyageurs admissibles pourront vous contacter. Si vous avez des questions à leur poser avant leur séjour, envoyez-leur un message.</p>
        </div>
    </div>
    </div> <!-- /container -->
</div>
</main>
@endsection
