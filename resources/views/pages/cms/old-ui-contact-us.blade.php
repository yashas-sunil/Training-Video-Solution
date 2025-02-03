@extends('layouts.master')

@section('title', 'Contact Us')

@section('content')
    <main class="contact-us" role="main">
        <section class="position-relative overflow-hidden">
            <div class="bg-diamond bg-diamond-left bg-diamond-top" style="transform: translateX(-40%) translateY(-10%);">
                <div class="bg-diamond-lg"></div>
            </div>
            <div class="container-fluid">
                <h1 class="text-secondary px-2 px-md-4 pt-4 pb-5 my-0"><b>Contact Us</b></h1>
            </div>
        </section>

        <section class="bg-secondary">
            <div class="container-fluid">
                <div class="px-2 px-md-4">
                    <div class="row align-items-md-stretch">
                        <form name="contact-form" id="contact_form" method="POST" action="{{url('enquiries')}}">
                            @csrf
                            <input type="hidden" name="form" value="contactform">
                            <input type="hidden" name="otpcontactus_token" id="otpcontactus_token">
                            <input type="hidden" name="otpcontactus_code" id="otpcontactus_code">
                            <div class="col-md-5" style="max-width: 500px;">
                                <div class="bg-white text-dark border shadow p-4" style="height: calc(100% + 40px); position: relative; top: -20px;">
                                    @if (\Session::has('success'))
                                        <div class="alert alert-success">
                                            <ul>
                                                <li>{!! \Session::get('success') !!}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    @if (\Session::has('error'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li>{!! \Session::get('error') !!}</li>
                                            </ul>
                                        </div>
                                    @endif


                                    @if (session()->has('successtest'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            We will contact you soon.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form>
                                        <div class="row row-cols-2">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input name="name" type="text" value="{{old('name')}}" class="form-control" id="name" aria-describedby="name_help">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('name') }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="mobile">Mobile</label>
                                                    <input name="mobile" type="text" value="{{old('mobile')}}" class="form-control" id="mobile">
                                                    @error('mobile')
                                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('mobile') }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input name="email" type="email" value="{{old('email')}}" class="form-control" id="email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('email') }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="comment">Comment</label>
                                                    <textarea name="comment" id="comment" cols="8" class="form-control">{{old('comment')}}</textarea>
                                                    @error('comment')
                                                    <span class="invalid-feedback" role="alert" style="display: inline;">{{ $errors->first('comment') }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <button id="btn-contact-us" type="SUBMIT" class="btn btn-primary">Submit</button> -->
                                        <button id="btn-contact-us" type="button" class="btn btn-primary px-4">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </form>
                        <div class="col-md mt-4 mt-md-0">
                            <div class="text-light p-3">
                                <h4 class="pt-2">Contact Information</h4>
                                <span>For any queries, feel free to contact us</span>
                                <p class="mt-4"><i class="fa fa-map-marker-alt mr-3"></i>Shraddha, 4th Floor, Near Chinai College, Old Nagardas Road. Andheri (E), Mumbai - 400 069</p>
                                <p><i class="fa fa-phone-alt mr-3"></i>8070400900</p>
                                <p><i class="fa fa-envelope mr-3"></i>helpdesk@jkshahclasses.com</p>
                                <p class="mb-2"><i class="fa mr-3" style="width: 16px">&nbsp;</i>Follow Us</p>
                                <div class="">
                                    <i class="fa mr-3" style="width: 16px">&nbsp;</i>
                                    <a target="_blank" href="https://www.facebook.com/officialjksc" class="btn btn-dark btn-circle btn-circle-sm border mr-1"><i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a target="_blank" href="https://www.youtube.com/c/JKShahClassesOnline" class="btn btn-dark btn-circle btn-circle-sm border mr-1"><i class="fab fa-youtube"></i>
                                        <a target="_blank" href="https://www.instagram.com/officialjksc" class="btn btn-dark btn-circle btn-circle-sm border mr-1"><i class="fab fa-instagram-square"></i>
                                        </a>
                                        <a target="_blank" href="https://www.instagram.com/officialjksc" class="btn btn-dark btn-circle btn-circle-sm border"><i class="fab fa-linkedin"></i>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-primary">
            <div class="text-center p-4 text-secondary text-bold">
                <small class="mb-2">For any technical issues, please MESSAGE or WHATSAPP on this number</small>
                <h2>
                    7304454714
                </h2>
            </div>
        </section>

        <section class="pt-4">
            <div class="container-fluid">
                <div class="px-2 px-md-4">
                    <h4 class="text-secondary py-4 my-0"><b>Our Presence</b></h4>
                    <?php
                    $cities = [
                        "Ahmedabad",
                        "Bengaluru",
                        "Chennai",
                        "Coimbatore",
                        "Delhi",
                        "Hubali",
                        "Hyderabad",
                        "Indore",
                        "Jaipur",
                        "Jamnagar",
                        "Junagadh",
                        "Mumbai",
                        "Raipur",
                        "Rajkot",
                        "Surat",
                        "Vadodara",
                        "Veraval",
                    ];
                    ?>
                    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5">
                        @foreach($cities as $city)
                            <h4 class="col mb-4"><span class="badge badge-secondary p-3 shadow w-100">{{ $city }}</span></h4>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-4 position-relative overflow-hidden" style="min-height: 300px;">
            <div class="bg-diamond bg-diamond-right bg-diamond-bottom" style="transform: translateX(20%) translateY(20%);">
                <div class="bg-diamond-md"></div>
            </div>
            <div class="container-fluid">
                <div class="px-2 px-md-4">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <div id="map" class="map w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

@push('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8
            });
        }

        $(document).ready(function() {

            //         $('#btn-contact-us').click(function () {
            //             let name = $('#name').val();
            //             let email = $('#email').val();
            //             let mobile = $('#mobile').val();
            //             let comment = $('#comment').val();

            //             $.ajax({
            //                 type:'POST',
            //                 url:'{{ route('save-for-later.store') }}',
            //                 data: {
            //                     '_token': '{{ csrf_token() }}',
            //                     'name': name,
            //                     'email': email,
            //                     'mobile': mobile,
            //                     'comment': comment,
            //                 },
            //                 success:function() {
            // //alert('success');
            //                    // $('#toast-contact-us').toast('show');
            //                 }
            //             });
            //         });
        });

        $('#contact_form').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 191
                },
                mobile: {
                    required: true,
                    maxlength: 10,
                    minlength: 10
                },
                email: {
                    required: true,
                },
                comment: {
                    required: true,
                }
            }
        });


        // $('#contact_form').on('submit', function(e) {
        //     let isValid = $(this).valid();
        //     if (isValid) {
        //         e.preventDefault();
        //         $('#btn-contact-us').prop('disabled', true);
        //         $.ajax({
        //             type: 'POST',
        //             url: $(this).attr('action'),
        //             data: $(this).serialize(),
        //             success: function(response){
        //                 $('#btn-contact-us').prop('disabled', false);
        //                 $('#contact_form')[0].reset();
        //                 swal("Thank You! ","We will contact you shortly!","success");
        //             }
        //         });
        //     }
        // });


        //
        $('#btn-contact-us').click(function(e) {

            e.preventDefault();

            if (!$('#contact_form').valid()) {
                return;
            }
            saveforlater();

            $('#modal-otpcontactus').find('#otpcontactus_mobile').val($('#mobile').val());

            $('#modal-otpcontactus').modal('show');

        });


        $('#modal-otpcontactus').on('hide.bs.modal', function() {

            $('#contact_form').find('#otpcontactus_token').val($('#modal-otpcontactus').find('#otpcontactus_token').val());
            $('#contact_form').find('#otpcontactus_code').val($('#modal-otpcontactus').find('#otpcontactus_code').val());

            $('#contact_form').submit();

        });

        function saveforlater() {
            let name = $('#name').val();
            let email = $('#email').val();
            let mobile = $('#mobile').val();
            let comment = $('#comment').val();

            $.ajax({
                type:'POST',
                url:'{{ route('save-for-later.store') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'name': name,
                    'email': email,
                    'mobile': mobile,
                    'comment': comment,
                },
                success: function() {
                    //alert('success');
                    // $('#toast-contact-us').toast('show');
                }
            });
        }

        function submitcontactform() {

            $('#btn-contact-us').prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    $('#btn-contact-us').prop('disabled', false);
                    $('#contact_form')[0].reset();
                    swal("Thank You! ", "We will contact you shortly!", "success");
                }
            });

        }


        //
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_map.key') }}&callback=initMap" async defer></script>
@endpush
