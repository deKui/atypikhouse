
@extends('layouts.app')

@section('content')


	<div class="container">
		<form method="POST" action="{{ route('habitat.update', $habitat->id) }}" enctype="multipart/form-data">
	            {{ csrf_field() }}
	            {{ method_field('PUT') }}

			<div class="row justify-content-md-center">

				<div class="card col-md-6">

					<div class="card-body">
						<ul class="list-group list-group-flush">
							<img class="card-img" src="{{ asset('storage/' . $habitat->photo) }}">
								<input id="photo" type="file" class="form-control" name="photo" required>

								@if ($errors->has('photo'))
									<span class="invalide-feedback text-danger">
										<small>{{ $errors->first('photo') }}</small>
									</span>
								@endif
							<li class="list-group-item">Titre :
								<input id="titre" type="text" class="form-control" name="titre" value="{{ $habitat->titre}}" required>

								@if ($errors->has('titre'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('titre') }}</small>
							        </span>
							    @endif
							</li>

							<li class="list-group-item">Description : 
								<input id="description" type="text" class="form-control" name="description" value="{{ $habitat->description}}" required>

								@if ($errors->has('description'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('description') }}</small>
							        </span>
							    @endif
						    </li>

						    <li class="list-group-item">Adresse : 
								<input id="adresse" type="text" class="form-control" name="adresse" value="{{ $habitat->adresse}}" required>
								@if ($errors->has('adresse'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('adresse') }}</small>
							        </span>
							    @endif

							    <input id="code_postal" type="text" class="form-control" name="code_postal" value="{{ $habitat->code_postal}}" required>
								@if ($errors->has('code_postal'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('code_postal') }}</small>
							        </span>
							    @endif

							    <input id="ville" type="text" class="form-control" name="ville" value="{{ $habitat->ville}}" required>
								@if ($errors->has('ville'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('ville') }}</small>
							        </span>
							    @endif
						    </li>

						    <li class="list-group-item">Nombre de lit simple : 
								<input id="nb_lit_simple" type="text" class="form-control" name="nb_lit_simple" value="{{ $habitat->nb_lit_simple}}" required>

								@if ($errors->has('nb_lit_simple'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('nb_lit_simple') }}</small>
							        </span>
							    @endif
						    </li>

						    <li class="list-group-item">Nombre de lit double : 
								<input id="nb_lit_double" type="text" class="form-control" name="nb_lit_double" value="{{ $habitat->nb_lit_double}}" required>

								@if ($errors->has('nb_lit_double'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('nb_lit_double') }}</small>
							        </span>
							    @endif
						    </li>

						    <li class="list-group-item">Nombre de personne maximum : 
								<input id="nb_personne_max" type="text" class="form-control" name="nb_personne_max" value="{{ $habitat->nb_personne_max}}" required>

								@if ($errors->has('nb_personne_max'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('nb_personne_max') }}</small>
							        </span>
							    @endif
						    </li>

						    <li class="list-group-item">Date début de dispo : 
								<input id="date_debut_dispo" type="date" class="form-control" name="date_debut_dispo" value="{{ $habitat->date_debut_dispo}}" required>

								@if ($errors->has('date_debut_dispo'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('date_debut_dispo') }}</small>
							        </span>
							    @endif
						    </li>

						    <li class="list-group-item">Date fin de dispo : 
								<input id="date_fin_dispo" type="date" class="form-control" name="date_fin_dispo" value="{{ $habitat->date_fin_dispo}}" required>

								@if ($errors->has('date_fin_dispo'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('date_fin_dispo') }}</small>
							        </span>
							    @endif
						    </li>

						</ul>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">
                            Valider
                        </button>
					</div>
					
				</div>	
			</div>
		</form>
	</div>	

@endsection