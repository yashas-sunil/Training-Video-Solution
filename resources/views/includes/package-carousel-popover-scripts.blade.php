@once
@push('script')
    <script id="cart-save-for-later">
        $(document).ready(function () {

            $('.cart-save-for-later').on('click', function (e) {
                e.preventDefault();

                let packageID = $(this).data('id');

                $.ajax({
                    type:'POST',
                    url:'{{ route('save-for-later.store') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'package_id': packageID
                    },
                    success:function(data) {
                        if (!data) {
                            $('#toast-already-exist').toast('show');
                        } else {
                            $('#toast-save-for-later').toast('show');
                        }

                        $('body').trigger('change.cart');
                    }
                });
            });


        });
    </script>
@endpush
@endonce
