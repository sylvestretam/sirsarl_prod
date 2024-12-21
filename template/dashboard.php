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
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb -float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <div class="container-fluid">
      <div class="card">
            <div class="card-header">

              <div class="row">
              <div class="col-md-3 animation__transright">
                  <div class="info-box bg-info">
                      <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                      <div class="info-box-content">
                          <span class="info-box-text"> ACHAT </span>
                          <span class="info-box-number"> <?= $total_achat ?> </span>

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
                  <div class="info-box bg-secondary">
                      <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                      <div class="info-box-content">
                          <span class="info-box-text"> CONSOMMMATION </span>
                          <span class="info-box-number"> <?= $total_consommation ?> </span>

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
                          <span class="info-box-text"> PRODUCTION </span>
                          <span class="info-box-number"> <?= $total_production ?> </span>

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
                      <span class="info-box-text"> EXPEDITION </span>
                      <span class="info-box-number"> <?= $total_expedition ?> </span>

                      <div class="progress">
                          <div class="progress-bar" style="width: 00%"></div>
                      </div>
                      <span class="progress-description">
                          BTL
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
                              <h3 class="card-title">  MATIERES PREMIERES </h3>
                          </div>

                          <div class="card-body">

                              <table class="table table-bordered tableordered table-stripper">

                                  <thead>
                                      <tr>
                                          <th> Matiere Première </th>
                                          <th> Unite </th>
                                          <th> Achat à date </th>
                                          <th> Conso à date </th>
                                          <th> Stock </th>
                                      </tr>
                                  </thead>

                                  <tbody class='fts'>
                                    <?php
                                      foreach ($matieres_premieres as $matiere_premiere) { 
                                    ?>
                                      <tr>
                                        <td> <?= $matiere_premiere->designation ?></td>
                                        <td> <?= $matiere_premiere->unite ?></td>
                                        <td> <?= $matiere_premiere->quantite_a_date ?></td>
                                        <td> <?= $matiere_premiere->quantite_conso_a_date ?></td>
                                        <td> <?= $matiere_premiere->quantite_a_date - $matiere_premiere->quantite_conso_a_date ?></td>
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
                              <h3 class="card-title"> Articles  </h3>
                          </div>

                          <div class="card-body">

                              <table class="table table-bordered tableordered table-stripper">

                                  <thead>
                                      <tr>
                                          <th> Article </th>
                                          <th> Unite </th>
                                          <th> Prod à date </th>
                                          <th> Exped. à date </th>
                                          <th> Stock </th>
                                      </tr>
                                  </thead>

                                  <tbody class='fts'>
                                    <?php
                                      foreach ($unites_articles as $unite_article) { 
                                    ?>
                                      <tr>
                                        <td> <?= $unite_article->article ?></td>
                                        <td> <?= $unite_article->unite ?></td>
                                        <td> <?= $unite_article->qte_prod_a_date ?></td>
                                        <td> <?= $unite_article->qte_exp_a_date ?></td>
                                        <td> <?= $unite_article->qte_prod_a_date - $unite_article->qte_exp_a_date ?></td>
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
    
  </div>
  
</div>

<?php require('template/import/foot.php'); ?>
