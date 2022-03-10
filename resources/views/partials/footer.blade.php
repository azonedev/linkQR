    <hr>
    <footer class="text-center p-3">
        <span class="first-brand">Link</span> <span class="last-brand">QR</span> | <a
            href="https://azonedev.com">azOneDev</a> &copy; {{date('Y')}}
    </footer>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- toaster --}}
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    
    {{-- template-script: write javascript that you need on current page/tempalte --}}
    @yield('template-script')
</body>

</html>