
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11%22%3E"></script>

@if (session('msg'))
<script>
    Swal.fire(
    'Good job!',
    '{{ session("msg") }}',
    'success'
    )
</script>
@endif

<script>
    $('.btn-delete').on('click', function() {
        let form = $(this).next('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
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
