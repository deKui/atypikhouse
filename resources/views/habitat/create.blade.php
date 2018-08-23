@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enregistrer un nouvel habitat</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('habitat.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!-- Type d'habitat -->
                        <div class="form-group">
                            <label for="type_habitat"> Type d'habitat </label>
                                <select id="type_habitat" name="type_habitat" class="form-control">

                                    @foreach($type_habitat as $type)
                                        <option value="{{ $type->id }}">{{ $type->nom }}</option>
                                    @endforeach

                                </select>
                        </div>

                        <!-- Titre -->
                        @include('partials.form', [
                            'title' => __('Titre'),
                            'type' => 'text',
                            'name' => 'titre',
                            'required' => true,
                            ])

                        <!-- Description -->
                        @include('partials.form', [
                            'title' => __('Description'),
                            'type' => 'text',
                            'name' => 'description',
                            'required' => true,
                            ])

                        <!-- Image -->
                        @include('partials.form', [
                            'title' => __('Image'),
                            'type' => 'file',
                            'name' => 'image',
                            'required' => true,
                            ])

                        <!-- Adresse -->
                        @include('partials.form', [
                            'title' => __('Adresse'),
                            'type' => 'text',
                            'name' => 'adresse',
                            'required' => true,
                            ])

                        <!-- Code postal -->
                        @include('partials.form', [
                            'title' => __('Code postal'),
                            'type' => 'number',
                            'name' => 'code_postal',
                            'required' => true,
                            ])

                        <!-- Ville -->
                        @include('partials.form', [
                            'title' => __('Ville'),
                            'type' => 'text',
                            'name' => 'ville',
                            'required' => true,
                            ])
                        
                        <!-- Nombre de lit(s) simple(s) -->
                        <div class="form-group">
                            <label for="nb_lit_simple"> Nombre de lit(s) simple(s)</label>
                                <select id="nb_lit_simple" name="nb_lit_simple" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                        </div>

                        <!-- Nombre de lit(s) simple(s) -->
                        <div class="form-group">
                            <label for="nb_lit_double"> Nombre de lit(s) double(s)</label>
                                <select id="nb_lit_double" name="nb_lit_double" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                        </div> 

                        <!-- Nombre de personnes maximales -->
                        <div class="form-group">
                            <label for="nb_personne_max"> Nombre de personnes maximales</label>
                                <select id="nb_personne_max" name="nb_personne_max" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                        </div>   

                        <!-- Date de début de disponibilité -->
                        @include('partials.form', [
                            'title' => __('Date de début de disponibilité'),
                            'type' => 'date',
                            'name' => 'date_debut_dispo',
                            'required' => true,
                            ])

                        <!-- Date de fin de disponibilité -->
                        @include('partials.form', [
                            'title' => __('Date de fin de disponibilité'),
                            'type' => 'date',
                            'name' => 'date_fin_dispo',
                            'required' => true,
                            ])

                        <!-- Prix par nuit -->
                        @include('partials.form', [
                            'title' => __("Prix d'une nuit"),
                            'type' => 'number',
                            'name' => 'prix',
                            'required' => true,
                            ])

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Valider
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection