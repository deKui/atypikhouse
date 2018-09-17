<div class="row form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	
	<div class="col-md-12">
		<input id="{{ $name }}" type="{{ $type }}" class="form-control" placeholder="{{ $title }}" name="{{ $name }}" value="{{ old($name, isset($value) ? $value : '') }}" {{ $required ? 'required' : ''}}>

		@if ($errors->has($name))
	        <span class="invalide-feedback text-danger">
	            <small>{{ $errors->first($name) }}</small>
	        </span>
	    @endif
	</div>	
</div>