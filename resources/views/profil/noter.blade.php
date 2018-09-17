@extends('layouts.app')

@section('content')


	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-4">
				<div class="card atypikcard">
					<form method="POST" action="{{ route('profil.eval', $users->id) }}">
	            		{{ csrf_field() }}

						<div class="card-body">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">Note : 
	                                <select id="note" name="note" class="form-control">

	                                    <option value="1">1</option>
	                                    <option value="2">2</option>
	                                    <option value="3">3</option>
	                                    <option value="4">4</option>
	                                    <option value="5">5</option>

	                                </select>
							    </li>
							    	<button type="submit" class="btn btn-primary atypikbutton">
			                            Valider
			                        </button>
							    </li>
							</ul>
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>	

@endsection