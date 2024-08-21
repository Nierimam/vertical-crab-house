<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- loader-->
  <link href="{{asset('css/pace.min.cs')}}" rel="stylesheet" />
  <script src="{{asset('js/pace.min.js')}}"></script>

  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">

  <!--plugins-->
  <link href="{{asset('plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
  <link href="{{asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
  <link href="{{asset('plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />

  <!-- CSS Files -->
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/bootstrap-extended.css')}}" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <link href="{{asset('css/icons.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <!--Theme Styles-->
  <link href="{{asset('css/dark-theme.css')}}" rel="stylesheet" />
  <link href="{{asset('css/semi-dark.css')}}" rel="stylesheet" />
  <link href="{{asset('css/header-colors.cs')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Admin</title>
</head>
<body @guest class="bg-white overflow-y-hidden" @else class="wrapper" @endguest  >
    @guest
    @else
    @include('admin.layouts.layout')
    @endguest
    <div class="page-content-wrapper">
      <div class="page-content">
        @yield('content')
      </div>
    </div>

    <input type="hidden" id="route-persentase" value="{{route('get-penjualan-bulan')}}">

  {{-- Js Files --}}
  <!-- JS Files-->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('plugins/simplebar/js/simplebar.min.js')}}"></script>
  <script src="{{asset('plugins/metismenu/js/metisMenu.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <!--plugins-->
  <script src="{{asset('plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('js/component-popovers-tooltips.js')}}"></script>
  <script src="{{asset('plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
  <script src="{{asset('plugins/easyPieChart/jquery.easypiechart.js')}}"></script>
  <script src="{{asset('plugins/chartjs/chart.min.js')}}"></script>
  <script src="{{asset('js/index.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js?v2" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
  <!-- Main JS-->
  <script src="{{asset('js/main.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script>
        function showLoadingIndicator() {
            $('#login-text').text('Memuat...');
            $('#loading-icon').removeClass('d-none');
        }

        function hideLoadingIndicator() {
            $('#login-text').text('Masuk');
            $('#loading-icon').addClass('d-none');
        }
        $('#login-form').on('submit', function (e) {
            if (e.target && e.target.tagName === 'FORM') {
                showLoadingIndicator();

                const formData = new FormData(e.target);

                $.ajax({
                    type: 'POST',
                    url: e.target.action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                    window.location.href = 'panel/dashboard';
                    },
                    complete: function () {
                        hideLoadingIndicator();
                    }
                });

                e.preventDefault();
            }
        });
    </script> --}}

    <script>
    $(document).ready(function () {
        $('.fancybox').fancybox();
        $('.delete-data').click(function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            var token = $(this).data("token");
            var redirect = $(this).data("redirect");
            Swal.fire({
                title: 'Yakin?',
                text: "Data akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0275d8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: redirect,
                        data: {
                            "id": id,
                            "_method": 'DELETE',
                            "_token": token,
                        },
                        success: function (response) {
                            Swal.fire(
                                'Berhasil!',
                                response.message,
                                'success'
                            )
                            .then((result) => {
                                location.reload();
                            });

                        }
                    });
                }
            })
        });
    });

    </script>

    <script>
        $(document).ready(function () {
            $('.ubah-status-data').click(function (e) {
                e.preventDefault();
                var id = $(this).data("id");
                var token = $(this).data("token");
                var redirect = $(this).data("redirect");
                var url_redirect = '/panel/'+redirect+'/'+'ubah-status'+'/'+id;
                Swal.fire({
                    title: 'Yakin?',
                    text: "Mengubah Status Pegawai",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0275d8',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ubah!',
                    cancelButtonText: 'Batal'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "put",
                            url: url_redirect,
                            data: {
                                "id": id,
                                "_method": 'PUT',
                                "_token": token,
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Berhasil!',
                                    response.message,
                                    'success'
                                )
                                .then((result) => {
                                    location.reload();
                                });

                            }
                        });
                    }
                })
            });
        });

    </script>

    @if(session('success'))
        <script>
        $(document).ready(function() {
            Swal.fire(
                'Berhasil!',
                '{{session("success")}}',
                'success'
            );
        });
        </script>
    @endif

    @if(session('warning'))
        <script>
        $(document).ready(function() {
            Swal.fire(
                'Gagal!',
                '{{session("warning")}}',
                'warning'
            );
        });
        </script>
    @endif

    <script>
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    {{-- Format Rupiah --}}
    <script>
    $(document).ready(function(){
        $('[data-format_rupiah="formatRupiah"]').maskMoney({thousands:'.', decimal:',', precision:0});
    });

    function formatRupiah(str) {
        return str.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    </script>
    {{-- Format Rupiah --}}

  @yield('js-content')

</body>
</html>
