<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vertical Crab House</title>
  <!--===============================================================================================-->
    <!-- site Favicon -->
    <link rel="icon" href="{{ asset('upload/'.$companyMiddleware->logo) }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('upload/'.$companyMiddleware->logo) }}" />
    <meta name="msapplication-TileImage" content="{{ asset('upload/'.$companyMiddleware->logo) }}" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/ecicons.min.css') }}" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/countdownTimer.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo3.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <!--===============================================================================================-->
</head>
<body>
    <div id="ec-overlay"><span class="loader_img"></span></div>
    @include('user.layouts.navbar')
    @yield('content')
    @include('user.layouts.footer')






  <input type="hidden" id="route-global" value="{{ url('/') }}">
  <!--===============================================================================================-->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js?v2" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>

    <!--Plugins JS-->
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/countdownTimer.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/infiniteslidev2.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/fb-chat.js') }}"></script>

    <!-- Main Js -->
    <script src="{{ asset('assets/js/vendor/index.js') }}"></script>
    <script src="{{ asset('assets/js/demo-3.js') }}"></script>

  <script>
    $(document).ready(function(){
        // $('.fancybox').fancybox();
        getCart();
    })
  </script>

  <script>
    $(document).ready(function(){
        $('.fancybox').fancybox();
    })
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
    function getCart() {
        $.ajax({
            type: "get",
            url: "{{ route('get-cart') }}",
            data: {},
            success: function (response) {
                displayDataCart(response.data);
            }
        });

        function displayDataCart(carts){
            var text = '';
            var total = '';
            var total_produk = 0;
            carts.map((data) => {
                text += `
                <li>
                    <a href="#" class="sidecart_pro_img"><img
                            src="${$('#route-global').val()}/upload/${data.produk_variant.img}" style="max-width: 100px;" alt="product"></a>
                    <div class="ec-pro-content">
                        <a href="#" class="cart_pro_title">${data.produk_variant.nama_variant}</a>
                        <p>asasasas</p>
                        <span class="cart-price"><span>Rp. ${formatRupiah(data.produk_variant.produk.price)}</span> x ${data.qty}</span>

                    </div>
                </li>
                `;
                total_produk += parseFloat(data.total);
            });

            $('#body-cart').html(text);
            $('#total_produk').html('Total: Rp.'+formatRupiah(total_produk));
            $('#cart-notif').html(carts.length)
            $('#cart-notif-2').html(carts.length)
        }
    }

    function formatRupiah(str) {
        return str.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('.add-to-cart').on('click', function () {
      var key = $(this).data('key');
      var produk_id = $(this).data('produk_id');
      var jumlah = $('#jumlah_cart_' + key).val();
      var ukuran = $('#ukuran_cart_' + key).val();
      var stok_ukuran = $('#ukuran_cart_' + key + ' option[value="'+ukuran+'"]').data('stok');

      if (ukuran == '') {
        Swal.fire(
          'Perhatian!',
          'Harap pilih variant terlebih dahulu',
          'warning'
        );

        return false;
      }

      if (jumlah == '' || jumlah <= 0) {
        Swal.fire(
          'Perhatian!',
          'Jumlah yang diinputkan harus lebih dari 0',
          'warning'
        );
        return false;
      }

      if (stok_ukuran < jumlah) {
        Swal.fire(
          'Perhatian!',
          'Jumlah yang diinputkan melebih stok yang disediakan',
          'warning'
        );
        return false;
      }

      $.ajax({
          type: 'POST',
          url: "{{ route('add-cart') }}",
          headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
          data: {
            "_token": "{{ csrf_token() }}",
            "produk_id": produk_id,
            "jumlah": jumlah,
            "ukuran": ukuran,
          },
          success: function (data) {
            console.log(data);
            if (data.error) {
              Swal.fire(
                'Perhatian!',
                data.message,
                'warning'
              );
              getCart();
            } else {
              Swal.fire(
                'Berhasil!',
                data.message,
                'success'
              );
              getCart();
              $('#exampleModal' + produk_id).modal('hide');
            }
          },
      });
    });
    </script>

  @yield('js-content')

</body>
</html>
