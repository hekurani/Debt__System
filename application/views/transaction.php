<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/admin">Users</a>
  <a class="navbar-brand" href="/admin/transaction">Transactions</a>
  <a class="navbar-brand" href="/users">Profile</a>

</nav>
<div class="container-fluid">
  <div class="row">

    <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
      <h2 class="mt-3">Dashboard</h2>


      <table class="table mt-4">
        <thead>
          <tr>
            <th>Id</th>
            <th>sender</th>
            <th>receiver</th>
            <th>Shuma</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?php echo isset($transaction->id) ? $transaction->id : ''; ?></td>
                        <td><?php echo $transaction->senderId; ?></td>
                        <td><?php echo $transaction->receiverId; ?></td>
                        <td><?php echo $transaction->Shuma; ?></td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
      </table>
    </main>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>