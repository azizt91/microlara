
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="icon" type="image/png" sizes="500x500" href="{{ asset('template') }}/img/logo.png">
  <title>MicroTik</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('template/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('template/css/main.css')}}" rel="stylesheet">


  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Jan 30 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="#" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('template') }}/img/logo.png" alt="logo">
        <h1>Microtik<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ route('ip_binding') }}">Statik Binding</a></li>
          <li><a href="{{ route('pppoe') }}">PPPoE</a></li>
          <li><a href="{{ route('netwatch') }}">Netwatch</a></li>
        </ul>
      </nav><!-- .navbar -->

      {{-- <a class="btn-book-a-table" href="/disconnect">Disconnect</a> --}}
      <a class="btn btn-book-a-table" href="#" onclick="$('#disconnectModal').modal('show')">Disconnect</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->



  @yield('contents')

    <!-- Modal Disconnet -->
    <div class="modal fade" id="disconnectModal" tabindex="-1" role="dialog" aria-labelledby="disconnectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disconnectModalLabel">Disconnect</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to disconnect?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="/disconnect" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>



  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
      </div>
    </div>

    <div class="container">
      <div class="copyright">
         Copyright &copy; 2024 <strong><span>Selinggonet</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Created by <a href="https://wa.me/+6281914170701">@azizt91</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<!-- Template Main JS File -->
<script src="{{asset('template/js/main.js')}}"></script>

<script>
    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            var searchInput = $(this).val().toLowerCase();

            $('#netwatchTable tbody tr').each(function () {
                var rowText = $(this).text().toLowerCase();

                if (rowText.includes(searchInput)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>


<script>
    function showDisconnectModal() {
        $('#disconnectModal').modal('show');
    }
</script>

<script>
    function updateNetwatchData() {
        $.ajax({
            url: '/netwatch',
            method: 'GET',
            success: function(response) {
                // Update data pada view
                $('#netwatchContainer').html(response.netwatchData);
            },
            error: function(error) {
                console.error('Error fetching netwatch data:', error);
            }
        });
    }

    // Panggil fungsi pertama kali
    updateNetwatchData();

    // Set interval agar fungsi dipanggil secara berkala
    setInterval(updateNetwatchData, 3000); // Ganti 5000 dengan interval yang diinginkan (dalam milidetik) 
</script>


</body>
</html>