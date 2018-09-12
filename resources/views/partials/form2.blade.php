    <div class="col-md-6">
    <label class="col-md-12 atypikform2" for="{{ $name }}">{{ $title }} :</label>
		<input id="{{ $name }}" type="{{ $type }}" class="form-control" name="{{ $name }}" value="{{ old($name, isset($value) ? $value : '') }}" {{ $required ? 'required' : ''}}>

		@if ($errors->has($name))
	        <span class="invalide-feedback text-danger">
	            <small>{{ $errors->first($name) }}</small>
	        </span>
	    @endif
	</div>	
