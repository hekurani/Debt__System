<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php 
if($userDetails->role==='superadmin' || $userDetails->role==='admin'){
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/admin">Users</a>
    <a class="navbar-brand" href="/admin/transaction">Transactions</a>
    <a class="navbar-brand" href="/users">Profile</a>
  </nav>
  ';
}
else{
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/users">Profile</a>
  </nav>';
}

?>
    <div class="container">
        <form id="searchForm" class="search-form">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Search user..." aria-label="Search user" aria-describedby="search-button">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="search-button">Search</button>
                </div>
            </div>
        </form>
      
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">

                <img src="<?php echo ('../profile/' . $userDetails->image); ?>" class="card-img-top" alt="User Profile Image">
                    <div class="card-body">
                        <h5 class="card-title">Name: <?php echo $userDetails->Full_Name?></h5>
                        <p class="card-text">Username:  <?php echo $userDetails->username?></p>
                        <p class="card-text">Bilance:  <?php echo $userDetails->bilanci ?></p>
                    </div>
                   
                </div>
            </div>
        </div>
      
        <div class="mt-4">
                        <h5>Transactions</h5>
            <form id="transaction">
                <div class="form-group">
                    <label for="transactionAmount">Enter Amount:</label>
                    <input type="number" id="bilance" name="bilance" class="form-control" id="transactionAmount" placeholder="Amount">
                </div>
                <button type="submit" class="transactionBt" id="<?php echo $userDetails->username?>" class="btn btn-success">Send</button>
            </form>
        </div>
    </div>
    <p class="error"></p>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    
        const errorElement = document.querySelector('.error');
        $(document).ready(function(){
            $(document).ready(function(){
    $('#searchForm').submit(function(event){
        event.preventDefault(); 
        var searchValue = $('#searchInput').val(); 
        console.log(searchValue);
        
      
        searchValue = searchValue.replace(/ /g, '');
        
        var url = '/users/' + encodeURIComponent(searchValue);
        window.location.href = url; 
    });
});
            });
        

        $(document).ready(function(){
            $('#transaction').on('submit', function(event){
                event.preventDefault();
                const button = $('.transactionBt');
                const username = button.attr('id');
                var bilance = $('#bilance').val();
               
                console.log(username, bilance);
                $.ajax({
                    url: 'Transaction/' + username, 
                    type: 'POST', 
                    data: {
                        bilanci: bilance
                    },
                    success: function(response){
                        
                        console.log(response);
                        errorElement.innerText = 'Transaction completed';
                    },
                    error: function(xhr, status, error){
                       
                        errorElement.innerText = 'Transaction didn\'t succeed';
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>
</html>
