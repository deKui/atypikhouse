@extends('layouts.app')

@section('content')


	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-4">
				<div class="card atypikcard">
					<form method="POST" action="{{ route('habitat.storeType') }}">
	            		{{ csrf_field() }}

						<div class="card-body">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">Nom du type : 
									<input id="typeHabitat" type="text" class="form-control" name="typeHabitat" required>

									@if ($errors->has('typeHabitat'))
								        <span class="invalide-feedback text-danger">
								            <small>{{ $errors->first('typeHabitat') }}</small>
								        </span>
								    @endif
							    </li>
							</ul>
						</div>

						<div class="card-footer">
							<button type="submit" class="btn btn-primary atypikbutton">
	                            Valider
	                        </button>
						</div>
						
					</form>
				</div>
			</div>	
		</div>
	</div>	

@endsection