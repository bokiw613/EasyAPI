@extends('layouts.app')

@section('content')
<style>
/* Remove shadow and make background transparent */
.no-shadow {
    box-shadow: none !important;
    background-color: transparent;
}

/* Ensure that the GIF matches the size of pattern-image */
.pattern-image-first {
    width: 250px; /* Width of GIF */
    height: 250px; /* Height of GIF */
    object-fit: cover; /* Maintains aspect ratio */
}

/* Make the card blend seamlessly with the page background */
.card {
    border: none; /* Removes the border around the card */
}

/* Ensure responsiveness */
@media (max-width: 768px) {
    .col-4, .col-8 {
        flex: 0 0 100%;
        max-width: 100%;
        text-align: center; /* Center content on small screens */
    }
}

/* Add more space on the right */
.card-body {
    padding-right: 20px; /* Adjust this value as needed */
}

/* Add margin to the right of the main container */
.container {
    margin-left: 173px; /* Adjust this value to move the container to the right */
}
</style>

<div class="container" style="margin-top: 120px; width: 100%;">

<div class="row d-flex justify-content-center">
    <!-- Functional Card with GIF and Text -->
    <div class="col-lg-10 col-xl-10 col-xxl-10 mb-5"> <!-- Ubah ukuran kolom -->
        <div class="card no-shadow bg-transparent">
            <div class="card-body d-flex align-items-center ps-4">
                <!-- GIF on the Left with Pattern-Image Styling -->
                <!-- Text on the Right with Dashboard Title -->
                <div class="col-8">
                    <h4 class="mb-2">{{ __('Dashboard') }}</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    <br>
                    {{ __('Welcome, :name!', ['name' => Auth::user()->name]) }}
                </div>
            </div>
        </div>
    </div>
</div>




<script src="{{ asset('js/custom.min.js') }}"></script>
	<script src="{{ asset('js/dlabnav-init.js') }}"></script>
	<script src="{{ asset('js/demo.js') }}"></script>
    <script src="{{ asset ('js/styleSwitcher.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>

    <script src="{{ asset('js/dashboard/dashboard-1.js')}}"></script>
@endsection
