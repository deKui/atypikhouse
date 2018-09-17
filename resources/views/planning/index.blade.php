@extends('layouts.homepage')

<style type="text/css">
	.calendar_table{
		width: 100%;
		height: calc(100vh - 350px);
	}

	.calendar_table td{
		padding: 10px;
		border: 1px solid #ccc;
		vertical-align: top;
		width: 10%;
		height: 10%;
	}

	.calendar_weekday{
		font-weight: bold;
	}

	.calendar_othermonth .calendar_day{
		opacity: 0.4;
	}


</style>

@section('content')

<div class="container">
	<div class="row">
        <div class="col-md-12">

        	<div class="d-flex flex-row align-items-center justify-content-between mx-ms-3">
        		<h1> {{ $planning->toString() }} </h1>
        		<div>
        			<a href="{{ route('planning.index', [$planning->previousMonth()->month, $planning->previousMonth()->year]) }}" class="btn btn-primary"> &lt; </a>  
        			<a href="{{ route('planning.index', [$planning->nextMonth()->month, $planning->nextMonth()->year]) }}" class="btn btn-primary"> &gt; </a>  
        		</div>
        	</div>
		
			
			<table class="calendar_table">

				@for ($i = 0; $i < $weeks; $i++)

				    <tr>

				    	@foreach ($planning->days as $k => $day)
				    		<?php 
				    		$date = (clone $start)->modify('+' . ($k + $i * 7) . ' days');  
				    		$eventsForDay = $reservations[$date->format('Y-m-d')] ?? [];
				    		?>

					    	<td class="{{ $planning->withinMonth($date) ? '' : 'calendar_othermonth' }}">

					    		@if ($i === 0)

					    		<div class="calendar_weekday"> {{ $day }} </div>

					    		@endif

					    		<div class="calendar_day"> 
					    			{{ $date->format('d') }}			
					    		</div>
					    		<br>

					    		@foreach ($eventsForDay as $event)
									
									<div class="calendar_event">
										<a href="{{ route('reservation.show', auth()->user()->id) }}"> {{ $event->habitats->titre}} </a>
										<br>
										<a href="{{ route('profil.show', $event->id_locataire) }}"> {{ $event->users->pseudo}} </a>
									</div>

					    		@endforeach

					    	</td>

				    	@endforeach
				    </tr>
				@endfor
			</table>
		</div>
	</div>
</div>

@endsection