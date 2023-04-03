@extends('layout.dashboard')

@section('content')
<!-- Rounded Ribbon -->
<div class="page-content">

    <div class="container-fluid">



    <div class="content">
        <form action="{{ route('market.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">{{__('site.market_name')}}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"/>

                @error('name')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
              </div>


              <div class="mb-3">
                <label  class="form-label">{{__('site.description')}}</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4">
                </textarea>
                @error('description')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
              </div>


               <div class="mb-3">
                <label for="formFile" class="form-label">{{__('site.image')}}</label>
                <input class="form-control @error('image') is-invalid @enderror"  type="file" id="formFile" name="image" @error('image') is-invalid @enderror >
                @error('image')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
               </div>


            <div class="mapform" >
                <div class="row">
                    <div class="col-5">
                        <input type="text" class="form-control @error('lat') is-invalid @enderror"  placeholder="lat" name="lat" id="latitude">
                        @error('lat')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control @error('long') is-invalid @enderror"  placeholder="lng" name="long" id="longitude">
                        @error('long')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>


                <div id="map" style="height:400px; width: 800px; margin-top: 10px" ></div>

            </div>

            <button type="submit" class="btn btn-primary">{{__('site.submit')}}</button>

        </form>


    </div>

    </div>
</div>

@endsection


@section('scripts')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <script>
        var map = L.map('map').setView([31.4167, 34.3333], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
            maxZoom: 18
        }).addTo(map);

        // var marker = L.marker([31.4167, 34.3333]).addTo(map);


        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            var marker = L.marker([lat,lng]).addTo(map);

            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;
        });


    </script>

@endsection






