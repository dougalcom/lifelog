<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container" style="width:300px;">
		<br/><br/>
      <form id='loginform' method='post' action='index.php?f=login' class="form-signin">
        <h4 class="form-signin-heading"><span class="glyphicon glyphicon-lock"></span></h4>
        <input name='password' class="form-control" type='password' size='30' maxlength='255' placeholder="password" required autofocus>
        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">access</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>
