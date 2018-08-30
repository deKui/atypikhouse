@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
            <div class="col-md-4">
                <div class="card">

                    <img class="card-img-top" src="{{ asset('storage/' . $habitats->photo) }}">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nous sommes sur la page de cet habitat </li>
                        <li class="list-group-item">Titre : {{ $habitats->titre }} </li>
                        <li class="list-group-item">Description : {{ $habitats->description }} </li>
                        <li class="list-group-item">Propriétaire : <a href="{{ route('profil.show', $habitats->id_proprietaire) }}"> {{ $habitats->proprio->pseudo }} </a></li>
                        <li class="list-group-item">Type : {{ $habitats->type->nom }} </li>
                        <li class="list-group-item">Adresse : {{ $habitats->adresse }} {{ $habitats->code_postal }} {{ $habitats->ville }} </li>
                        <li class="list-group-item">Lit(s) simple(s) : {{ $habitats->nb_lit_simple }} </li>
                        <li class="list-group-item">Lit(s) double(s) : {{ $habitats->nb_lit_double }} </li>
                        <li class="list-group-item">Prévu pour {{ $habitats->nb_personne_max }} personnes maximum </li>
                        <li class="list-group-item">Disponibilité : Du {{ $habitats->date_debut_dispo }} au {{ $habitats->date_fin_dispo }} </li>
                        
                    </ul> 

                </div>
            </div> 
    </div>
    <br>

    <div class="row">
        <div class="col-md-12">
            
            <!-- Affiche le formulaire pour laisser un avis uniquement si l'user connecté est différent du proprietaire -->
            @if(auth()->user()->id !== $habitats->proprio->id)

            <div class="card">
                <div class="card-header">Laisser votre avis</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}

                            <div class="form-group">
                                <label for="note"> Note </label>
                                <select id="note" name="note" class="form-control">

                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>

                                </select>
                            </div> 

                            <div class="form-group">
                                <label for="comment">Avis</label>
                                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : ''}}" id="comment" name="comment" rows="3"></textarea>
                                
                                @if($errors->has('comment'))
                                    <div class="invalid-feedback">
                                        {{ implode(',', $errors->get('comment')) }}
                                    </div>
                                
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                                
                    </form>
                </div>
            </div>
            <br>

            @endif
                
                <!-- Récupère les avis si au moins un est laissé -->
                @if($messages !== [])

                @foreach($messages as $avis)

                <div class="card">
                    <div class="card-header">
                        {{ $avis->from->name }}
                        @for ($i = 0; $i < $avis->note; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p> {{ $avis->comment }} </p>
                            <footer class="blockquote-footer"> {{ $avis->created_at }} </footer>
                        </blockquote>
                    </div>
                </div>
                <br>

                @endforeach

                @endif

        </div>
    </div>

</div>


@endsection