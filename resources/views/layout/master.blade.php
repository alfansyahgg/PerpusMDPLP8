<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head')

    <title>@yield('title')</title>
    @stack('css')
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">        
        @include('layout.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">            
            @include('layout.topbar')
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('heading')</h1>
                        @stack('top')
                    </div>
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            @include('layout.footer')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layout.modal')

    @include('layout.script')

    @stack('scripts')
</body>
</html>