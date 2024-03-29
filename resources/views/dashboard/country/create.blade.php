@extends('dashboard.layout')

@section('script')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>

    <!-- /theme JS files -->

@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('country_store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ Form::token() }}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"> {{ trans('dash.add_new_country') }} </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.name_ar') }}</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="name_ar" placeholder="{{ trans('dash.name_ar') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.name_en') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="name_en" class="form-control" placeholder="{{ trans('dash.name_en') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.show_key') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="show_key" class="form-control" placeholder="{{ trans('dash.show_key') }}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.show_tel') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="tel_key" class="form-control" placeholder="{{ trans('dash.show_tel') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label display-block"> {{ trans('dash.country') }} </label>
                            <div class="col-lg-9">
                                <select name="continent" class="select-border-color border-warning" >
                                    <optgroup label="{{ trans('dash.choose_continent') }}">
                                            <option value="Africa"> Africa </option>
                                            <option value="Europe"> Europe </option>
                                            <option value="USA"> USA </option>
                                            <option value="Asia"> Asia </option>
                                            <option value="Amirca"> South America </option>

                                    </optgroup>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('dash.image') }}</label>
                            <div class="col-lg-9">
                                <input type="file" class="file-styled" name="image">
                                <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                            </div>
                        </div>

                        <div class="text-right">
                            <input type="submit" class="btn btn-primary" name="forward" value=" {{ trans('dash.add_forword_2_places') }} " />
                            <input type="submit" class="btn btn-success" name="back" value=" {{ trans('dash.add_and_come_back') }} " />
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->

        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('dash.latest_countries') }} </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">

                    <table class="table table-bordered table-hover">
                        <tr class="text-center">
                            <th> {{ trans('dash.name_ar') }} </th>
                            <th> {{ trans('dash.name_en') }} </th>
                            <th> {{ trans('dash.image') }} </th>
                        </tr>
                        @foreach($latest_countries as $country)
                            <tr>
                                <td> {{ $country->name_ar }} </td>
                                <td> {{ $country->name_en }} </td>
                                <td> <img height="80px" src="{{ $country->imageurl }}" /> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>



            </div>
        </div>
    </div>

    </div>


    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 24.7135517, lng: 46.67529569},
                zoom: 13
            });

            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29),
                draggable: true
            });


            google.maps.event.addListener(map, 'click', function (event) {
                document.getElementById("geo_lat").value = event.latLng.lat();
                document.getElementById("geo_lng").value = event.latLng.lng();
                marker.setPosition(event.latLng);
            });


            marker.addListener('position_changed', printMarkerLocation);
            function printMarkerLocation() {
                document.getElementById('geo_lat').value = marker.position.lat();
                document.getElementById('geo_lng').value = marker.position.lng();

                // console.log('Lat: ' + marker.position.lat() + ' Lng:' + marker.position.lng() );
            }
            autocomplete.addListener('place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setIcon(({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);

                //Location details
                for (var i = 0; i < place.address_components.length; i++) {
                    if (place.address_components[i].types[0] == 'postal_code') {
                        document.getElementById('postal_code').value = place.address_components[i].long_name;
                    }
                    if (place.address_components[i].types[0] == 'country') {
                        document.getElementById('country').value = place.address_components[i].long_name;
                    }
                }
                document.getElementById('location').value = place.formatted_address;
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyAjdMytwoM-D-4So4VDptfXUcYUX0Nuang" ></script>
    <style>
        #map {
            height: 400px;
        }
    </style>

@endsection
