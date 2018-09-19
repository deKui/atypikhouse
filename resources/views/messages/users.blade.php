<div class="col-md-3">
	<div class="list-group">
		
		@foreach ($users as $user)
					
			<a href="{{ route('messages.show', $user->id) }}" class="list-group-item"> 
				{{ $user->pseudo }} 

				@if (isset($unread[$user->id]))

					({{ $unread[$user->id] }})

				@endif
			</a>
						
		@endforeach

	</div>
</div>