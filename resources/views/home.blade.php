@extends('layouts.homepage')

@section('content')
<div class="cover">
</div>
	<div class="tv">
		  <div class="screen mute" id="tv"></div>
    </div>
    
<div class="container">
    <div class="row justify-content-lg-center">
        <div class="col-sm-12 col-lg-6">
            <div class="card atypikcard">
                <div class="card-header"><h3>Réservez votre logement insolite :</h3> </div>

                <div class="card-body">
                    <form method="GET" action="{{ route('recherche') }}">

                        @include('partials.form3', [
                            'title' => __('Destination'),
                            'type' => 'text',
                            'name' => 'destination',
                            'required' => true,
                            ])

                        <div class="form-group row">
                                <div class="col-md-12">
                                    <select id="voyageurs" name="voyageurs" class="form-control" required="true">

                                        <option value="" disabled selected hidden>Voyageurs</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        
                                    </select>    
                                </div>
                        </div> 
                        <div class="form-group row">

                            <div class="col-md-6">
                            <label class="col-md-12 atypikform2" for="depart">Départ :</label>
                                <input id="depart" type="date" class="form-control" name="depart" min="{{ date_create('now')->format('Y-m-d') }}">

                                @if ($errors->has('depart'))
                                    <span class="invalide-feedback text-danger">
                                        <small>{{ $errors->first('depart') }}</small>
                                    </span>
                                @endif
                            </div>

                            @include('partials.form2', [
                                'title' => __('Retour'),
                                'type' => 'date',
                                'name' => 'retour',
                                'required' => true,
                                ])
                        </div>
                        

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary atypikbutton">
                                    Rechercher
                                </button>    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="map">
        
    </div>

</div>


@endsection

