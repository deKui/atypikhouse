<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">

	<label for="{{ $name }}">{{ $title }}</label>
		
	<input id="{{ $name }}" type="{{ $type }}" class="form-control" name="{{ $name }}" value="{{ old($name, isset($value) ? $value : '') }}" {{ $required ? 'required' : ''}}>

	@if ($errors->has($name))
        <span class="invalide-feedback text-danger">
            <small>{{ $errors->first($name) }}</small>
        </span>
    @endif

</div>
