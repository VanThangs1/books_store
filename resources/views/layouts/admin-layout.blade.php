


<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

@php
    $page_title = $page_title ?? 'Dashboard';
    $sub_page_title = $sub_page_title ?? $page_title;
@endphp
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Admiria - Responsive Flat Admin Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- DataTables -->
        <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- C3 charts css -->
        <link href="{{asset('plugins/c3/c3.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Basic Css files -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

        <!-- Alertify css -->
        <link href="{{asset('plugins/alertify/css/alertify.css')}}" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">
        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="">
                        <!--<a href="index.html" class="logo text-center">Admiria</a>-->
                        <a href="index.html" class="logo"><img src="{{asset('assets/images/logo-sm.png')}}" height="36" alt="logo"></a>
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">
                    @include('partials.admin.sidebar')
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->


            <!-- Start right Content here -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    @include('partials.admin.navbar')
                    <!-- Top Bar End -->

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper">

                        <div class="container-fluid">
                            @yield('main')
                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <div class="modal fade bs-delete-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="modal_confirm-title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body" id = "modal_confirm-body">
                                
                            </div>
                            <form class="modal-footer" id = "modal_confirm-action" action = "" method = "POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Confirm</button>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <footer class="footer">
                    © 2017 - 2019 Admiria <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</span>
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('assets/js/waves.js')}}"></script>
        <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>

        <!-- Jquery-Ui -->
        <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('plugins/moment/moment.js')}}"></script>

        <!-- Alertify js -->
        <script src="{{asset('plugins/alertify/js/alertify.js')}}"></script>
        <script src="{{asset('assets/pages/alertify-init.js')}}"></script>

        

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>

        <!-- Parsley js -->
        <script type="text/javascript" src="{{asset('plugins/parsleyjs/parsley.min.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>

        

        <div class="alertify-logs" style = "z-index: 10000">
            @if(session('success'))
                <div class="alert success alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success!</strong> {{session('success')}}
                </div>
            @elseif(session('error'))
                <div class="alert error alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Oh Snap!</strong> {{session('error')}}
                </div>
            @elseif($errors -> any() > 0)
                @foreach($errors -> all() as $error)
                    <div class="alert error alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Oh Snap!</strong> {{$error}}
                    </div>
                @endforeach
            @endif
        </div>
        
        <script>
            const $d = document.querySelector.bind(document);
            const $dd = document.querySelectorAll.bind(document);

            const modalConfirmDelete = (title, body, route) => {  
                $d('#modal_confirm-title').innerHTML = title ?? 'Xác nhận';
                $d('#modal_confirm-body').innerHTML = body;
                $d('#modal_confirm-action').action = route;
            }
        </script>

        
        @yield('scripts')

    </body>
</html>