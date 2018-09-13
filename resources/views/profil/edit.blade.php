
@extends('layouts.app')

@section('content')


	<div class="container">
		<form method="POST" action="{{ route('profil.update', auth()->user()->id) }}" enctype="multipart/form-data">
	            {{ csrf_field() }}
            	{{ method_field('PUT') }}

			<div class="row justify-content-md-center">

				<div class="col-md-4">
					<img class="card-img-top" src="{{ asset('../storage/app/public/' . $user->avatar) }}">
					<input id="avatar" type="file" class="form-control" name="avatar" required>

					@if ($errors->has('avatar'))
						<span class="invalide-feedback text-danger">
							<small>{{ $errors->first('avatar') }}</small>
						</span>
					@endif
				</div>

				<div class="card col-md-6">

					<div class="card-body">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Pseudo : {{ $user->pseudo }}</li>
						    <li class="list-group-item">Prenom : 
								<input id="prenom" type="text" class="form-control" name="prenom" value="{{ $user->prenom}}" required>

								@if ($errors->has('prenom'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('prenom') }}</small>
							        </span>
							    @endif
						    </li>
						    <li class="list-group-item">Nom : 
								<input id="nom" type="text" class="form-control" name="nom" value="{{ $user->nom}}">

								@if ($errors->has('nom'))
							        <span class="invalide-feedback text-danger">
							            <small>{{ $errors->first('nom') }}</small>
							        </span>
							    @endif
						    </li>
						    <li class="list-group-item">Mail : {{ $user->email }}</li>  
						    <li class="list-group-item">Date de naissance : {{ $user->date_naissance }}</li>  
						    <li class="list-group-item">Note : {{ $user->note_eval }}</li>  
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