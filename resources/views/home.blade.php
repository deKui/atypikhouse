@extends('layouts.app')

@section('content')

<div class="container">
    
    <!-- <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in !
                </div>
            </div>
        </div>
    </div> -->


    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Réserver votre séjour</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('recherche') }}">

                        @include('partials.form', [
                            'title' => __('Destination'),
                            'type' => 'text',
                            'name' => 'destination',
                            'required' => true,
                            ])

                        <div class="form-group">
                            <label class="col-md-4" for="voyageurs"> Voyageurs</label>
                                <div class="col-md-12">
                                    <select id="voyageurs" name="voyageurs" class="form-control">

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

                        @include('partials.form', [
                            'title' => __('Départ'),
                            'type' => 'date',
                            'name' => 'depart',
                            'required' => true,
                            ])

                        @include('partials.form', [
                            'title' => __('Retour'),
                            'type' => 'date',
                            'name' => 'retour',
                            'required' => true,
                            ])

                        

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Rechercher
                                </button>    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
