@section('title', 'Dashboard CRM Urbanet')
@include('template.head')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('template.sidebar')
            <div class="menu-mobile-toggler d-xl-none rounded-1">
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                    <i class="ti tabler-menu icon-base"></i>
                    <i class="ti tabler-chevron-right icon-base"></i>
                </a>
            </div>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                @include('template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Layout Demo -->
                        <div class="layout-demo-wrapper">
                            <div class="layout-demo-placeholder">
                                <img
                                    src="../../assets/img/layouts/layout-container-light.png"
                                    class="img-fluid"
                                    alt="Layout container"
                                    data-app-light-img="layouts/layout-container-light.png"
                                    data-app-dark-img="layouts/layout-container-dark.png" />
                            </div>
                            <div class="layout-demo-info">
                                <h4>Layout container</h4>
                                <p>Container layout sets a <code>max-width</code> at each responsive breakpoint.</p>
                            </div>
                        </div>
                        <!--/ Layout Demo -->
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('template.footer')

</body>

</html>