@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">

		<div class="col-md-12">
			<h1> Vos conversations </h1>
			<br>
		</div>
		
		@include('messages.users', ['users' => $users, 'unread' => $unread])

		<div class="col-md-9">
			<div class="card">
				<div class="card-header"> <h4>{{ $user->pseudo }}</h4> </div>
				<div class="card-body conversations">

					@if ($messages->hasMorePages())
						<div class="text-center">
							<a href="{{ $messages->nextPageUrl() }}" class="btn btn-light"> Voir les messages précédents</a>
						</div>
					@endif
					
					@foreach (array_reverse($messages->items()) as $message) 
					
					<div class="row">
						<div class="col-md-10 {{ $message->from->id !== $user->id ? 'offset-md-2 text-right' : '' }}">
							<p>
								<strong> {{ $message->from->id !== $user->id ? 'Moi' : $message->from->pseudo }}</strong><br>
								{!! nl2br(e($message->content)) !!}
							</p>
						</div>
					</div>
					<hr>

					@endforeach

					@if ($messages->hasMorePages())
						<div class="text-center">
							<a href="{{ $messages->previousPageUrl() }}" class="btn btn-light"> Voir les messages suivants</a>
						</div>
					@endif

					<form action="" method="post">
						{{ csrf_field() }}

						<div class="form-group">
							<textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : ''}}" name="content" placeholder="Écrivez votre message..."></textarea>
							@if ($errors->has('content'))
						        <span class="invalid-feedback text-danger">
						            <small>{{ $errors->first('content') }}</small>
						        </span>
						    @endif
						</div>
						<button class="btn btn-primary" type="submit"> Envoyer </button>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection


