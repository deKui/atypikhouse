<div class="form-group {{ $errors->has($name) ? ' has-error' : '' }}">

	<label for="{{ $name }}">{{ $title }}</label>
		
		

		    	<input id="{{ $name }}" type="{{ $type }}" class="form-control" name="{{ $name }}" value="{{ old($name, isset($value) ? $value : ' ') }}" {{ $required ? 'required' : ''}}>

		    	@if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first($name) }}</strong>
                    </span>
                @endif
                
		
</div>