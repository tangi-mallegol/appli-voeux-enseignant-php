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
                                            <span style="opacity: 1; left: 246px; top: 10.5px; width: 19px; min-width: 19px; height: 13px; position: absolute; border: none; display: inline; visibility: visible; z-index: 2; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAANCAYAAABLjFUnAAAACXBIWXMAAAsTAAALEwEAmpwYAAABMmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarZG9SsNQGIaf04qCQxAJbsLBQVzEn61j0pYiONQokmRrkkMVbXI4Of508ia8CAcXR0HvoOIgOHkJboI4ODgECU4i+EzP9w4vL3zQWPE6frcxB6PcmqDnyzCK5cwj0zQBYJCW2uv3twHyIlf8RMD7MwLgadXr+F3+xmyqjQU+gc1MlSmIdSA7s9qCuATc5EhbEFeAa/aCNog7wBlWPgGcpPIXwDFhFIN4BdxhGMXQAHCTyl3AtercArQLPTaHwwMrN1qtlvSyIlFyd1xaNSrlVp4WRhdmYFUGVPuq3Z7Wx0oGPZ//JYxiWdnbDgIQC5M6q0lPzOn3D8TD73fdMb4HL4Cp2zrb/4DrNVhs1tnyEsxfwI3+AvOlUD7FY+VVAAAAIGNIUk0AAHolAACAgwAA9CUAAITRAABtXwAA6GwAADyLAAAbWIPnB3gAAAECSURBVHjapNK9K8UBFIfxD12im8LEYLgZjcpgUFgUCUlZTJRkMpqUxR+hDFIGhWwGwy0MFiUxSCbZ5DXiYjnqdvvpvnim0+mcZ/ieU9U6tySBNEbQjBpMoANZnGIdl4VLKcm8YCPqbgzhAT1ox1mSrFpxjtCHLdygH5tJgymlMYhhtKH+r6FishYsYBpN0dvFHu5wi9okWToC/0AmcpqM+pd7PKMRDajDNb5xlS97Qyem0BsL8IT9uOAhXpGLvL/wGXO5fFkOO7FwHvJtLOOilGALM8vE1d6xiFVlkP8aXTjAI8bKFeXLBuJ3shjFiQpIYR6zWMFaXFOlsnHM4Ng/+RkAdVE2mEeC7WYAAAAASUVORK5CYII=); background-size: 19px 13px; background-position: 0px 0px; background-repeat: no-repeat;"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span>
                                            <input class="form-control" id="password" name="password" placeholder="Mot de passe" type="password">
                                            <span style="opacity: 1; left: 246px; top: 10.5px; width: 19px; min-width: 19px; height: 13px; position: absolute; border: none; display: inline; visibility: visible; z-index: 2; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAANCAYAAABLjFUnAAAACXBIWXMAAAsTAAALEwEAmpwYAAABMmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarZG9SsNQGIaf04qCQxAJbsLBQVzEn61j0pYiONQokmRrkkMVbXI4Of508ia8CAcXR0HvoOIgOHkJboI4ODgECU4i+EzP9w4vL3zQWPE6frcxB6PcmqDnyzCK5cwj0zQBYJCW2uv3twHyIlf8RMD7MwLgadXr+F3+xmyqjQU+gc1MlSmIdSA7s9qCuATc5EhbEFeAa/aCNog7wBlWPgGcpPIXwDFhFIN4BdxhGMXQAHCTyl3AtercArQLPTaHwwMrN1qtlvSyIlFyd1xaNSrlVp4WRhdmYFUGVPuq3Z7Wx0oGPZ//JYxiWdnbDgIQC5M6q0lPzOn3D8TD73fdMb4HL4Cp2zrb/4DrNVhs1tnyEsxfwI3+AvOlUD7FY+VVAAAAIGNIUk0AAHolAACAgwAA9CUAAITRAABtXwAA6GwAADyLAAAbWIPnB3gAAAECSURBVHjapNK9K8UBFIfxD12im8LEYLgZjcpgUFgUCUlZTJRkMpqUxR+hDFIGhWwGwy0MFiUxSCbZ5DXiYjnqdvvpvnim0+mcZ/ieU9U6tySBNEbQjBpMoANZnGIdl4VLKcm8YCPqbgzhAT1ox1mSrFpxjtCHLdygH5tJgymlMYhhtKH+r6FishYsYBpN0dvFHu5wi9okWToC/0AmcpqM+pd7PKMRDajDNb5xlS97Qyem0BsL8IT9uOAhXpGLvL/wGXO5fFkOO7FwHvJtLOOilGALM8vE1d6xiFVlkP8aXTjAI8bKFeXLBuJ3shjFiQpIYR6zWMFaXFOlsnHM4Ng/+RkAdVE2mEeC7WYAAAAASUVORK5CYII=); background-size: 19px 13px; background-position: 0px 0px; background-repeat: no-repeat;"></span></div>
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