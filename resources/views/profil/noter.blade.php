@extends('layouts.app')

<style type="text/css">

    #map{
        height: 500px;
        width: 600px;
        margin: 0 auto;
    }

</style>

@section('content')


	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-4">
				<div class="card atypikcard">
					<form method="POST" action="{{ route('profil.eval', $users->id) }}">
	            		{{ csrf_field() }}

						<div class="card-body">
							<ul class="list-group list-group-flush">
								<li class="list-group-item">Note : 
	                                <select id="note" name="note" class="form-control">

	                                    <option value="1">1</option>
	                                    <option value="2">2</option>
	                                    <option value="3">3</option>
	                                    <option value="4">4</option>
	                                    <option value="5">5</option>

	                                </select>
							    </li>
							    	<button type="submit" class="btn btn-primary atypikbutton">
			                            Valider
			                        </button>
							    </li>
							</ul>
						</div>
					</form>
				</div>
			</div>	
		</div>
		
		<!-- <div id="map">
			
		</div> -->

	</div>	

@endsection

@section('script')

<script type="text/javascript">
    
    $(document).ready(function() {

    	function geolocalisationInit() {
    		if (navigator.geolocation) {
    			navigator.geolocation.getCurrentPosition(success, fail);
    		}else {
    			alert('échec de la localisation');
    		}
    	}

    	var myLatLng = new google.maps.LatLng(-33.8665433,151.1956316);
        
        // Création de la map
        function createMap(myLatLng) {
        	var map = new google.maps.Map(document.getElementById('map'), {
		        center: myLatLng,
		        scrollwheel: false,
		        zoom: 12
	    	});
        }

        // création d'un marker
        function createMarker(latlng, name) {
        	var marker = new google.maps.Marker({
			    position: latlng,
			    map: map,
			    title: name
	  		});
        }

        // recherche aux alentours
        
        	var request = {
	    		location: myLatLng,
	    		radius: '2500',
	    		types: ['store']
	    	};

	    	service = new google.maps.places.PlacesService(map);
	    	service.nearbySearch(request, callback);

	    	function callback(results, status) {
			  	if (status == google.maps.places.PlacesServiceStatus.OK) {
			    	for (var i = 0; i < results.length; i++) {
			      		var place = results[i];
			      		latlng = place.geometry.location;
			      		name = place.name;

			      		createMarker(latlng, name);
			    	}
			  	}
			}

        createMap(myLatLng);

    	
    });

    
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLiRP37J07HkPyQIQZbht_oP0_bUsuEes&libraries=places" async defer></script>

@endsection
