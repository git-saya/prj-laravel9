<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 5.2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
      <div class="row mb-5">
        <div class="col-sm-12 text-center">
          <img src="https://getbootstrap.com/docs/5.2/assets/brand/bootstrap-logo.svg" alt="Logo" width="100">
        </div>
      </div>
      <ul class="nav justify-content-center mb-5">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/getbootstrap/index">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="getbootstrap/blog">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Themes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Icons</a>
        </li>
      </ul>

      @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>