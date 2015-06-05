<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Veuillez vous connecter</strong>
                </div>
                <div class="panel-body">
                <p style="color:red"></p>
                    <?php echo form_open('welcome/login'); ?>
                        <fieldset>

                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">

                                    <div class="form-group">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                </span>
                                            <input class="form-control" id="login" name="login" placeholder="Login" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span>
                                            <input class="form-control" id="password" name="password" placeholder="Mot de passe" type="password">
                                        </div>    
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Connexion">
                                    </div>

                                </div>
                            </div>
                        </fieldset></form>

                </div>
                <div class="panel-footer ">
                    <a href="/Admin/set-password">Changer de mot de passe</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
</body>
</html>