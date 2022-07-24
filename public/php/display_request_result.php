<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="icon" href="../api.png" />
  <title>PZ | Display Results</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-lg">
      <a class="navbar-brand fs-2 p-3">PZ | Gateway Tester</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="container-lg p-4">
    <div class="row g-5">
      <!-- left col -->
      <div class="col-3 p-4">
        <h1 class="fs-4">
          Transaction Results
        </h1>
      </div>

      <!-- right col -->
      <div class="col p-4">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">Field</th>
              <th scope="col">Value</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
foreach ($_POST as $key => $value) {
 echo '
                            <tr>
                              <td>' . $key . '</td>
                              <td>' . $value . '</td>
                            </tr>';
}
?>

          </tbody>
        </table>
      </div>


    </div>
  </div>

  <!-- footer -->
  <div class="bg-light">
    <footer class="container-lg">
      <div class="row p-5">
        <h3>Credits</h3>

        <a href="https://www.flaticon.com/free-icons/api" title="api icons">Api icons created by Circlon Tech -
          Flaticon</a>
      </div>
    </footer>
  </div>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
  </script>
</body>

</html>