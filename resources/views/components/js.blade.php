
@if ((app()->currentLocale() == 'ar'))
 <!-- JAVASCRIPT -->
 <script src="{{ asset('adminassets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('adminassets/libs/simplebar/simplebar.min.js') }}"></script>
 <script src="{{ asset('adminassets/libs/node-waves/waves.min.js') }}"></script>
 <script src="{{ asset('adminassets/libs/feather-icons/feather.min.js') }}"></script>
 <script src="{{ asset('adminassets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
 <script src="{{ asset('adminassets/js/plugins.js') }}"></script>

 <!-- apexcharts -->
 <script src="{{ asset('adminassets/libs/apexcharts/apexcharts.min.js') }}"></script>

 <!-- Vector map-->
 <script src="{{ asset('adminassets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
 <script src="{{ asset('adminassets/libs/jsvectormap/maps/world-merc.js') }}"></script>

 <!--Swiper slider js-->
 <script src="{{ asset('adminassets/libs/swiper/swiper-bundle.min.js') }}"></script>

 <!-- Dashboard init -->
 <script src="{{ asset('adminassets/js/pages/dashboard-ecommerce.init.js') }}"></script>

 <!-- App js -->
 <script src="{{ asset('adminassets/js/app.js') }}"></script>
 <script src="https://kit.fontawesome.com/d6355a45bc.js" crossorigin="anonymous"></script>




 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



 <script>



     $('.btn-delete').on('click', function() {
         let form = $(this).next('form');
         Swal.fire({
         title: 'هل أنت متاكد؟',
         text: "لن تتمكن من التراجع عن هذا!",
         icon: 'warning',
         // showCancelButton: true,

         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'نعم ، احذفها!'
     }).then((result) => {
         if (result.isConfirmed) {
         form.submit();
     }
     })
     })

 </script>


    @yield('scripts')
@else


<script src="{{ asset('adminassets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminassets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('adminassets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('adminassets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('adminassets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('adminassets/js/plugins.js') }}"></script>
<!-- apexcharts -->
<script src="{{ asset('adminassets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector map-->
<script src="{{ asset('adminassets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('adminassets/libs/jsvectormap/maps/world-merc.js') }}"></script>

<!--Swiper slider js-->
<script src="{{ asset('adminassets/libs/swiper/swiper-bundle.min.js') }}"></script>

<!-- Dashboard init -->
<script src="{{ asset('adminassets/js/pages/dashboard-ecommerce.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('adminassets/js/app.js') }}"></script>

{{-- fonts --}}
<script src="https://kit.fontawesome.com/d6355a45bc.js" crossorigin="anonymous"></script>




{{-- bootstrap --}}

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> --}}


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>



    $('.btn-delete').on('click', function() {
        let form = $(this).next('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            // showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    })

</script>

@yield('scripts')

@endif











