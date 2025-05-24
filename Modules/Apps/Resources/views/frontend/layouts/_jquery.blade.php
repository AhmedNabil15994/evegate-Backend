<!--[if lt IE 9]>
<script src="/admin/assets/global/plugins/respond.min.js"></script>
<script src="/admin/assets/global/plugins/excanvas.min.js"></script>
<script src="/admin/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
 <!--=====================================
                    JS LINK PART START
        =======================================-->
        <!-- VENDOR -->
        <script src="/frontend/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="/frontend/js/vendor/popper.min.js"></script>
        <script src="/frontend/js/vendor/bootstrap.min.js"></script>
        <script src="/frontend/js/vendor/slick.min.js"></script>

        <!-- CUSTOM -->
        @if(is_rtl() == "rtl")
        <script src="/frontend/js/custom/slick-rt.js"></script>
        @else
        <script src="/frontend/js/custom/slick.js"></script>
        @endif     
        <script src="/frontend/js/custom/main.js"></script>
        <script src="/admin/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
        <!--=====================================
                    JS LINK PART END
        =======================================-->


@yield('scripts')
