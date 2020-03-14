<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TP PHP (MUMBERE MALULE Jaques) Dirigé par Dr. Patrick MUKALA</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

  </head>
 <body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">TP PHP (MUMBERE MALULE Jaques) Dirigé par Dr. Patrick MUKALA </a>
    </div>
    </div>
  </nav>
<div class="container-fluid">
      <div class="row">
		
      	<div class="col-sm-12 col-md-4 main ">
      		<h2 class="sub-header">Formulaire</h2>
      		<form class="form-horizontal" method="post" style="float: left; width: 100%">

            <?php if (!isset($_SESSION['client'])): ?>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <input type="text" name="client" class="form-control" id="inputPassword3" placeholder="Nom du client" >
                </div>
              </div>
            <?php endif ?>
      		<div class="form-group">

			    <div class="col-sm-offset-2 col-sm-10" >
			    	<h5>Produits</h5>
			      <select class="form-control" name="product" id="product" >

            <?php foreach ($unitPrice as $product => $price): ?>
               <option value="<?= $product ?>"><?= $product ?></option>
            <?php endforeach ?> 
					</select>
			    </div>
			  </div>
			  <br>
			 <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label"></label>
			    <div class="col-sm-10">
			      <input type="number" name="quatity" class="form-control" id="inputPassword3" placeholder="Quantité" >
			    </div>
			  </div>

			  
			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="facture" class="btn btn-primary " value="Facturer">
			      <button type="submit" class="btn btn-success" name="add">Ajouter à la facture</button>

			    </div>
			  </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            
          </div>
        </div>
      
			</form>

      </div>
       
        <div class="col-sm-12 col-md-8 main">

          <div class="row">
            <div class="col-md-6">
              <h2 class="sub-header">Facture de :
               <?=  (isset($_SESSION['client'])) ? $_SESSION['client']  : '' ; ?>
              </h2>
            </div>

            <div class="col-md-6">
              <h3 >Date : <?= date('d-m-Y') ?></h3>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Quantité</th>
                  <th>Prix Unitaire ($)</th>
                  <th>Prix Total ($)</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php $i = 1; $agregatedPrice = 0;?>
              <?php foreach ($facture as $product => $quatity): ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= ucfirst($product) ?></td>
                  <td><?= $quatity ?></td>
                  <td><?= $unitPrice[$product] ?></td>
                  <td><?= ($quatity * $unitPrice[$product]) ?></td>
                  <td>
                    <form method="post">
                      <input type="hidden" name="prod" value="<?= $product ?>">
                      <input type="submit" name="delete" value="Retirer" class="btn btn-danger">
                    </form>
                  </td>
                </tr>
                <?php $agregatedPrice += $quatity * $unitPrice[$product];?>
                <?php $i++;?>
              <?php endforeach ?>
              <tr>
                <td>--------</td>
                <td>--------</td>
                <td>--------</td>
                <td>--------</td>
                <td><strong>Totaux</strong></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong><?= $agregatedPrice ?> $</strong></td>
              </tr>
    
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
     </body>
<!--  -->
</html>
