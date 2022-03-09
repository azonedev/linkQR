<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title')</title>

    <!-- CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('/')}}assets/css/style.css">

    {{-- toaster notification --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


    {{-- template-css: write css that you need on current page/tempalte --}}
    @yield('template-css')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


</head>

<body>

    <header class="fixed-top">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <div class="container-fluid">
                <a class="navbar-brand h1 mt-2" href="index.html">
                    <span class="first-brand">Link</span>
                    <span class="last-brand">QR</span>
                </a>

                <!-- nav toggle btn -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- speacing -->
                        <li class="nav-item d-none d-md-block">
                            <a class="px-5"></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn-sm btn-blue btn-active " href="dashboard.html">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="links.html">Shorted Links</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="anti-spam.html">Anti Spam</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="#" class="btn btn-info">
                            <img src="{{asset('/')}}assets/icons/log-out.svg" alt="">
                        </a>
                        <!-- <a href="login.html" class="btn btn-info">
                            Login <img src="{{asset('/')}}assets/icons/log-in.svg" alt=""> 
                        </a> -->
                    </div>
                </div>
            </div>
        </nav>
    </header>