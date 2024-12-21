<?php require('template/import/head.php'); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php require('template/import/navbar.php'); ?>
  <?php require('template/import/aside.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">PRODUCTION</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb -float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content sect_list_production">

      <div class="container-fluid">
          <div class="card">
            <div class="card-header">

              <div class="row">
                <div class="col-md-3 animation__transright">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> TOTAL </span>
                            <span class="info-box-number"> <?= $total_prod ?> </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 00%"></div>
                        </div>
                        <span class="progress-description">
                            PROD
                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 animation__transright">
                    <div class="info-box bg-secondary">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> Nbre de Date </span>
                            <span class="info-box-number"> <?= $nbre_prod ?> </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 00%"></div>
                        </div>
                        <span class="progress-description">
                            BTL
                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 animation__transright">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> MOYENNE PROD </span>
                            <span class="info-box-number"> <?= $moyenne_prod ?> </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 00%"></div>
                        </div>
                        <span class="progress-description">
                            BTL
                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 animation__transright">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"> LAST PROD </span>
                        <span class="info-box-number"> <?= $last_prod->date_prod ?> </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 00%"></div>
                        </div>
                        <span class="progress-description">
                          <?= $last_prod->quantite ?> 
                        </span>
                        </div>
                    </div>
                </div>

              </div>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-6 p-1">
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title"> production à Date </h3>
                          </div>

                          <div class="card-body">

                              <table class="table table-bordered tableordered table-stripper">

                                  <thead>
                                      <tr>
                                          <th> Article </th>
                                          <th> Quantite </th>
                                          <th> Unite </th>
                                      </tr>
                                  </thead>

                                  <tbody class='fts'>
                                    <?php
                                      foreach ($unites_articles as $unite_article) { 
                                    ?>
                                      <tr>
                                        <td> <?= $unite_article->article ?></td>
                                        <td> <?= $unite_article->qte_prod_a_date ?></td>
                                        <td> <?= $unite_article->unite ?></td>
                                      </tr>
                                    <?php
                                      }
                                    ?>
                                  </tbody>

                              </table>

                          </div>

                      </div>
                    </div>

                    <div class="col-6 p-1">
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title"> Dates productions </h3>
                              <div class="card-tools">
                                <button type="submit" class="btn btn-sm btn-dark font-weight-bold" onclick="back('.sect_list_production','.sect_add_production')">
                                  <i class="fas fa-plus"></i> AJOUTER
                                </button>
                              </div>
                          </div>

                          <div class="card-body">

                              <table class="table table-bordered tableordered table-stripper">

                                  <thead>
                                      <tr>
                                          <th> Date </th>
                                          <th> Quantite </th>
                                          <th> ... </th>
                                      </tr>
                                  </thead>

                                  <tbody class='fts'>
                                    <?php
                                      foreach ($productions as $production) { 
                                    ?>
                                      <tr>
                                        <td> <?= $production->date_prod ?></td>
                                        <td> <?= ($production->quantite) ?></td>
                                        <td> 
                                          <button class="btn btn-default btn-sm" onclick="showPRODUCTION('<?= $production->prod_id ?>')"> <i class="fas fa-search"></i> </button>  
                                        </td>
                                      </tr>
                                    <?php
                                      }
                                    ?>
                                  </tbody>

                              </table>

                          </div>

                      </div>
                    </div>

                </div>

            </div>
            
          </div>
        </div>

    </section>

    <section class="content sect_add_production invisible">

        <div class="container-fluid">

          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-sm btn-dark font-weight-bold" onclick="back('.sect_add_production','.sect_list_production')">
                <i class="fas fa-arrow-left"></i> RETOUR
              </button>
            </div>

            <div class="card-body">
              
              <div class="row">
                
                <div class="col-md-10  mx-auto">

                  <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">AJOUTER</h3>
                        
                    </div>

                    <form action='./?action=production&subaction=saveProduction' method='POST'>
                      <div class="card-body">

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="codeprojet"> Date de production </label>
                                <input type="date" class="form-control" name="date_prod" required>
                            </div>

                            <div class="form-group col-6">
                                <label for=""> Commentaire </label>
                                <input type="text" class="form-control" name="observation" required>
                            </div>

                        </div>

                        <div class="row border m-1 p-1">

                            <div class="col-12 text-center p-1">
                                <span class="font-weight-bold display-5"> ARTICLES </span>
                            </div>

                            <div class="form-group col-3">
                              <label for="interet"> Article </label>
                              <select class="form-control" id="article">
                                <!-- <option disabled selected> Article </option> -->
                                <?php
                                  foreach ($articles as $article) {
                                ?>
                                
                                  <option value="<?=$article->code?>"> <?=$article->designation?> </option>

                                <?php
                                  }
                                ?>
                              </select>
                            </div>

                            <div class="form-group col-3">
                              <label for="interet"> Quantite </label>
                              <input type="number" min="1" class="form-control" id="quantite">
                            </div>

                            <div class="form-group col-3">
                              <label for="unite"> Unité </label>
                              <select class="form-control" id="unite">
                                <!-- <option disabled selected> Article </option> -->
                                <?php
                                  foreach ($unites as $unite) {
                                ?>
                                
                                  <option value="<?=$unite->code_unite?>"> <?=$unite->designation?> </option>

                                <?php
                                  }
                                ?>
                              </select>
                            </div>

                            <div class="form-group col-3">
                              <label for="interet"> Valeur </label>
                              <input type="number" min="1" step="1" class="form-control" id="valeur" disabled>
                            </div>

                            <div class="form-group col-4 mx-auto">
                              <span class="btn btn-dark btn-block font-weight-bold" onclick="addLignePRODUCTION()"> AJOUTER <i class="fas fa-arrow-down"></i> </span>
                            </div>

                            <div class="form-group col-12">
                                <input type="text" class="form-control production" disabled>
                                <input type="hidden" class="form-control production" name="ligne_production">
                            </div>

                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th> Article </th>
                                        <th> Quantite </th>
                                        <th> Unité </th>
                                    </tr>
                                </thead>

                                <tbody class='fts ligneproduction'>

                                </tbody>
                            </table>

                        </div>


                      </div>

                      <div class="card-footer text-center">
                        <button type="submit" class="btn btn-dark font-weight-bold"> 
                          <i class="fas fa-save"></i> ENREGISTRER
                        </button>
                      </div>
                    </form>

                  </div>

                </div>

              </div>

            </div>
          </div>

        </div>
        
    </section>

    <section class="content sect_mod_production invisible">

        <div class="container-fluid">

          <div class="card">

            <div class="card-header">

              <button type="button" class="btn btn-sm btn-dark font-weight-bold" onclick="back('.sect_mod_production','.sect_list_production')">
                <i class="fas fa-arrow-left"></i> RETOUR
              </button>

            </div>

            <div class="card-body">
              
              <div class="row">
                
                <div class="col-md-10  mx-auto">

                  <div class="card card-secondary">

                    <div class="card-header">
                        <h3 class="card-title"> Details production </h3>
                        
                        <div class="card-tools">
                          <form action="./?action=production&subaction=deleteproduction" method="post">
                            <input type="hidden" class="form-control prod_id" name="prod_id">
                            <button type="submit" class="btn btn-sm btn-dark font-weight-bold">
                              <i class="fas fa-trash"></i> SUPPRIMER
                            </button>
                          </form>
                        </div>
                    </div>

                    <div class="card-body">

                      <div class="row">
                          <div class="form-group col-6">
                              <label for="codeprojet"> Date de production </label>
                              <input type="date" class="form-control date_prod" disabled>
                          </div>

                          <div class="form-group col-6">
                              <label for=""> Quantite </label>
                              <input type="text" class="form-control quantite" disabled>
                          </div>

                      </div>

                      <div class="row border m-1 p-1">

                          

                          <table class="table table-bordered table-striped">

                              <thead>
                                  <tr>
                                      <th> Article </th>
                                      <th> Quantite </th>
                                      <th> Unité </th>
                                  </tr>
                              </thead>

                              <tbody class='fts ligneproduction'>

                              </tbody>
                          </table>

                      </div>


                    </div>

                  </div>

                </div>

              </div>

            </div>
          </div>

        </div>
        
    </section>
    
  </div>
  
</div>
<script>
  const productions = <?= json_encode($productions) ?>
</script>
<?php require('template/import/foot.php'); ?>
