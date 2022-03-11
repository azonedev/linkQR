@extends('master')
@section('page-title', 'Anti spam controll')

@section('page-section')
      <!-- anti-spam section -->
      <section id="anti-spam" class="pt-5 row">
        <div class="p-3"></div>

        <div class="block-area bg-white rounded shadow-sm p-3" >
            <h4>If you want to protect spamming you can do here,</h4>
            <p> <span class="h4">Like, </span>
                if anyone uses the address more than 3 times from the same IP within 1 minute, we will block the IP for 5 minutes.
            </p>

            <div class="p-3"></div>

            @foreach ($links as $link)
            <form action="{{url('anti-spam')}}/{{$link->id}}" method="POST">
                @csrf
                @method('put')
                <h5>{{$link->long_url}}</h5>
                <div  class="d-flex justify-content-between">

                    <div class="mb-3">
                        <label for="" class="form-label text-primary">Times :</label>
                        <input type="number" class="form-control" name="loadlimit" value="{{$link->loadlimit}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-primary">Winthin <code>minutes</code> :</label>
                        <input type="number" class="form-control" name="within" value="{{$link->within}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-primary">Block for <code>minutes</code> :</label>
                        <input type="number" class="form-control" name="blockfor" value="{{$link->blockfor}}" required>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-blue mt-4"><img src="./assets/icons/loader.svg" alt=""> Update</button>
                    </div>
                </div>
            </form>
            <hr>    
            @endforeach
        </div>

    </section> <!-- #anti-spam section-->
    <div class="p-4"></div>
@endsection