@extends('master')
@section('page-title','Login')

@section('page-section')
        <!-- login -->
        <section id="login" class="p-5 row">
            <div class="col-md-3"></div> <!-- for speacing-->

            <div class="mt-5 p-5 col-md-6 rounded shadow-sm bg-white text-center">
                <h4 class="">Register OR Login with ... </h4>

                <div class="p-3"></div>

                <button class="btn btn-primary mt-2"><img src="/assets/icons/google.svg" alt=""> Google</button>
                
                <a href="{{url('/auth/github')}}">
                    <button class="btn btn-success mt-2"><img src="/assets/icons/github.svg" alt=""> Github</button>
                </a>

                <button class="btn btn-blue mt-2"> <img src="/assets/icons/facebook.svg" alt=""> Facebook</button>
            </div>

            <div class="col-md-3"></div> <!-- for speacing-->
        </section> <!-- #login-->
        <div class="p-4"></div>
@endsection