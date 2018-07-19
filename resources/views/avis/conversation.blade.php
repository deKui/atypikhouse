@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<form class="form-horizontal" method="POST" action="{{ route('messages.store', [$user->id, auth()->user()->id]) }}">
		        {{ csrf_field() }}

					<div class="form-group">
					    <label for="content">Message</label>
					    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
					</div>

		            <div class="form-group">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                        
		    </form>

		    @if($messages != [])
			
			@foreach($messages as $message)

				<div class="card">
				  	<div class="card-header">
				    	{{ auth()->user()->name }}
				  	</div>
					<div class="card-body">
					    <blockquote class="blockquote mb-0">
					      	<p> {{ $message->content }} </p>
					      	<footer class="blockquote-footer"> {{ $message->created_at }} </footer>
					    </blockquote>
					</div>
				</div>

			@endforeach	

			@endif

		</div>
	</div>
</div>

@endsection