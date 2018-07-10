@extends('layouts.app')

@section('content')


	<div class="container">
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Modifier vos informations personnelles</div>

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST" action="{{ route('profil.update', auth()->user()->id) }}">
	                    	{{ csrf_field() }}
            				{{ method_field('PUT') }}

	                        @include('partials.form', [
	                            'title' => __('Nom'),
	                            'type' => 'text',
	                            'name' => 'name',
	                            'required' => true,
	                            'value' => $user->name,
	                            ])

	                        @include('partials.form', [
	                            'title' => __('Mail'),
	                            'type' => 'text',
	                            'name' => 'email',
	                            'required' => true,
	                            'value' => $user->email,
	                            ])

	                    <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Valider
                                </button>
                            </div>
                        </div>

	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>	

@endsection