<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#0d0072">
  <meta name="description" content="Membuat Aplikasi PWA Pertama">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontend/logo/apple-icon-72x72.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/logo/favicon-32x32.png') }}" alt="favicon icon">
  <meta name="msapplication-TileImage" content="{{ asset('frontend/logo/ms-icon-310x310.png') }}">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="{{ asset('frontend/bootstrap/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="{{ asset('frontend/js/jquery-3.5.1.slim.min.js') }}"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/berita.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/calender.css') }}">
  <script src="{{ asset('frontend/js/index.js') }}"></script>
  <link rel="manifest" href="{{ asset('frontend/js/manifest.json') }}">
  <script src="{{ asset('frontend/js/moment.min.js') }}"></script>
  <?php
  if(!isset($bahasa)){
      $bahasa= 2;
  }
  ?>
  @php
      $settings=DB::table('settings')->get();
  @endphp
  @foreach($settings as $h)

  <title>{{$h->short_des}}</title>

  <link rel="shortcut icon" href="{{ asset('storage/photos/1/Favicon/android-icon-96x96.png') }}">


  @endforeach

  <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(odd) {
  background-color: #dddddd;
}
</style>
</head>
