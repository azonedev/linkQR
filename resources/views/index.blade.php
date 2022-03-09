@extends('master')
@section('page-title','LinkQR: short url with qr code')

@section('page-section')
    <!-- link-block -->
    <section id="link-block" class="row">
        <!-- input link -->
            <div class="col-md-6 pt-5" id="link-input">
                <form action="" id="link-form" class="pt-5">
                    <div class="input-group">
                        <input type="url" name="url" placeholder="Enter your link" class="form-control" id="long-url">
                    </div>
                    <div class="my-3 row">
                        <div class="col-6 pt-2">
                        
                            
                            <div class="input-group mb-3">
                                <span class="pe-3" id="basic-addon1"> 
                                    <input type="checkbox" class="form-check-input" id="date-check" name="date_check" checked>
                                </span>
                                <label for="date-check" aria-describedby="basic-addon1">Add expire date ?</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <input type="date" name="expire_date" class="form-control" id="expire-date">
                        </div>
                    </div>
                    
                    <button class="btn btn-blue font-primary p-3"><img src="{{asset('/')}}assets/icons/refresh-cw.svg" alt=""> Generate Link</button>
                </form>
            </div> <!-- #link-output-->

            <!-- output generated link & qr code -->
            <div class="col-md-6 p-5" id="link-output">
                <div id="qr" class="text-center shadow pt-5 bg-white">

                    <div class="text-center">
                        
                        <label class="mr-2" for="date-check" aria-describedby="link-copy-sm">
                            <input type="text" class="border-0" value="https://url.azonedev.com/Xn3j5a" id="short-url">
                        </label>
                        <button class="btn btn-sm btn-blue" id="copy-btn-sm"> 
                            <img src="{{asset('/')}}assets/icons/copy.svg" alt="">
                        </button>
                    </div>

                    <img class="mt-4" src="https://api.qrserver.com/v1/create-qr-code/?data=mail@abdullahme.com&bgcolor=3DBCF9&color=FFFFFF">

                    <div class="p-4">
                        <button class="btn btn-info ms-auto"><img src="{{asset('/')}}assets/icons/download.svg" alt=""> QR</button>
                        <button class="btn btn-blue me-auto" id="copy-btn"><img src="{{asset('/')}}assets/icons/copy.svg" alt=""> URL</button>
                    </div>

                </div>
            </div> <!-- #link-output-->

        </section> <!-- #link-block-->
@endsection