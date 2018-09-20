<div class="col-md-3">
	<div class="list-group">
		
		@foreach ($users as $user)
					
			<a href="{{ route('messages.show', $user->id) }}" class="list-group-item d-flex justify-content-between"> 
				{{ $user->pseudo }} 

				@if (isset($unread[$user->id]))

					<span class="badge badge-pill badge-primary">{{ $unread[$user->id] }}</span> 

				@endif
			</a>
						
		@endforeach

	</div>
</div>