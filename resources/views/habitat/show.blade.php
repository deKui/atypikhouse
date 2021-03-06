@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
            <div class="col-md-8">

                <!-- Affichage des informations de l'habitat -->

                <div class="card atypikcard2">
                    <img class="card-img2" style="background-image:url({{ asset('storage/' . $habitats->photo) }})">
                        <br>
                        <h4 class="logement-titre ">{{ $habitats->titre }}</h4>
                        <p class="logement-description">{{ $habitats->description }} </p>
                        <br/>
                        <br/>
                        <h4 class="logement-titre ">Caractéristiques</h4>
                        <span class="label logement-label">Propriétaire : <a href="{{ route('profil.show', $habitats->id_proprietaire) }}"> {{ $habitats->proprio->pseudo }} </a></span>
                        <span class="label logement-label">Type : {{ $habitats->type->nom }} </span>
                        <span class="label logement-label">Adresse : {{ $habitats->adresse }} {{ $habitats->code_postal }} {{ $habitats->ville }} </span>
                        <span class="label logement-label">Lit(s) simple(s) : {{ $habitats->nb_lit_simple }} </span>
                        <span class="label logement-label">Lit(s) double(s) : {{ $habitats->nb_lit_double }} </span>
                        <span class="label logement-label">Prévu pour {{ $habitats->nb_personne_max }} personnes maximum </span>
                        <span class="label logement-label">Disponibilité : Du {{ $habitats->date_debut_dispo }} au {{ $habitats->date_fin_dispo }} </span>
                        <span class="label logement-label"><a href="{{ route('planning.show', [$habitats, intval(date('m')), intval(date('Y'))]) }}"> Voir le planning de disponibilité </a></span>

                        

                </div>
            </div> 

            <!-- Affichage de l'interface pour réserver l'habitat pour les utilisateurs lambda-->

            @guest

            <div class="col-md-4">
                <div class="card atypikcard">

                    <form method="GET" action="{{ route('reservation.create', ['habitat' => $habitats]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Prix par nuit : {{ $habitats->prix }} €</li>

                            <!-- Date d'arrivée --> 
                            <li class="list-group-item">Arrivée : 
                                <input id="date_debut" type="date" class="form-control" name="date_debut" 
                                min="{{ date_create('now')->format('Y-m-d') }}" required>

                                @if ($errors->has('date_debut'))
                                    <span class="invalide-feedback text-danger">
                                        <small>{{ $errors->first('date_debut') }}</small>
                                    </span>
                                @endif
                            </li>
                            
                            <!-- Date de départ  --> 
                            <li class="list-group-item">Départ : 
                                <input id="date_fin" type="date" class="form-control" name="date_fin" required>

                                @if ($errors->has('date_fin'))
                                    <span class="invalide-feedback text-danger">
                                        <small>{{ $errors->first('date_fin') }}</small>
                                    </span>
                                @endif
                            </li>

                            <!-- Nombre de voyageurs  -->
                            <li class="list-group-item">Nombre de personnes : 
                                <select id="nb_personne" name="nb_personne" class="form-control">

                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>

                                </select>
                            </li>

                            <li class="list-group-item"> 
                                <button type="submit" class="btn btn-primary">
                                    Réserver
                                </button>
                            </li>
                        </ul> 
                    </form>
                </div>
            </div>

            @endguest

            @auth

            @if ($habitats->id_proprietaire !== Auth()->user()->id)

            <div class="col-md-4">
                <div class="card atypikcard">

                    <form method="GET" action="{{ route('reservation.create', ['habitat' => $habitats]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Prix par nuit : {{ $habitats->prix }} €</li>

                            <!-- Date d'arrivée --> 
                            <li class="list-group-item">Arrivée : 
                                <input id="date_debut" type="date" class="form-control" name="date_debut" 
                                min="{{ date_create('now')->format('Y-m-d') }}" required>

                                @if ($errors->has('date_debut'))
                                    <span class="invalide-feedback text-danger">
                                        <small>{{ $errors->first('date_debut') }}</small>
                                    </span>
                                @endif
                            </li>
                            
                            <!-- Date de départ  --> 
                            <li class="list-group-item">Départ : 
                                <input id="date_fin" type="date" class="form-control" name="date_fin" required>

                                @if ($errors->has('date_fin'))
                                    <span class="invalide-feedback text-danger">
                                        <small>{{ $errors->first('date_fin') }}</small>
                                    </span>
                                @endif
                            </li>

                            <!-- Nombre de voyageurs  -->
                            <li class="list-group-item">Nombre de personnes : 
                                <select id="nb_personne" name="nb_personne" class="form-control">

                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>

                                </select>
                            </li>

                            <li class="list-group-item"> 
                                <button type="submit" class="btn btn-primary">
                                    Réserver
                                </button>
                            </li>
                        </ul> 
                    </form>
                </div>
                <div class="card atypikcard">
                    <img class="card-img" style="background-image:url({{ asset('storage/' . $habitats->proprio->avatar) }})">
                    <div class="card-header">
                        <h3 style="text-align:center;">Votre hôte</h3>
                    <span class="label label-default atypik-badge2"><a href="{{ route('profil.show', $habitats->id_proprietaire) }}">{{ $habitats->proprio->pseudo }}</a></span>
                    </div>
                </div>
            </div>

            @endif

            @endauth
            
    </div>
    <br>

    <div class="row">
        <div class="col-md-12">

            @auth
            
            @if ($reservation < date_create('now')->format('Y-m-d'))

            <!-- Affiche le formulaire pour laisser un avis uniquement si l'user connecté est différent du proprietaire -->
            @if (auth()->user()->id !== $habitats->proprio->id)

            <div class="card">
                <div class="card-header">Laisser votre avis</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}
                            
                            <!-- Note du commentaire -->
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
                            
                            <!-- contenu du commentaire -->
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

            @endif

            @endauth
                
                <!-- Récupère et affiche les avis si au moins un est laissé -->
                @if($messages !== [])

                @foreach($messages as $avis)

                    <div class="card">
                        <div class="card-header">
                            {{ $avis->from->pseudo }}
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

                    <!-- VAL - L'utilisateur authentifié ne peux pas signaler son commentaire -->
                    @auth

                    @if ((auth()->user()->id) !== $avis->id_utilisateur)

                        <div class="card-footer">
                            <a href="{{ route('profil.signaleAvis', $avis->id) }}" class="btn btn-primary">Signaler</a>
                        </div>
                        
                    @endif

                    @endauth
                
                <br>

                @endforeach

                @endif
            </div>
        </div>

</div>

<!-- <script type="text/javascript">
    let date_debut = document.getElementById('date_debut');
    let date_fin = document.getElementById('date_fin');
    let nb_personne = document.getElementById('nb_personne');
    let detail = document.getElementById('detail');

    detail.addEventListener('click', affichePrix);

    function affichePrix(e) {
        alert(date_debut);
    }
</script> -->


@endsection