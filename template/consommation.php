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
            <h1 class="m-0">CONSOMMATION</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb -float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content sect_list_consommation">

      <div class="container-fluid">
          <div class="card">
            <div class="card-header">

              <div class="row">
                <div class="col-md-3 animation__transright">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> TOTAL CONSOMMATON </span>
                            <span class="info-box-number"> <?= $total_conso ?> </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 00%"></div>
                        </div>
                        <span class="progress-description">
                            CONSOMMATION
                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 animation__transright">
                    <div class="info-box bg-secondary">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> Nbre Date </span>
                            <span class="info-box-number"> <?= $nbre_conso ?> </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 00%"></div>
                        </div>
                        <span class="progress-description">
                            CONSOMMATION
                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 animation__transright">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> MOYENNE CONSOMMATON </span>
                            <span class="info-box-number"> <?= $moyenne_conso ?> </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 00%"></div>
                        </div>
                        <span class="progress-description">
                          CONSOMMATION
                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 animation__transright">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"> LAST CONSOMMATON </span>
                        <span class="info-box-number"> <?= $last_conso->date_conso ?> </span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 00%"></div>
                        </div>
                        <span class="progress-description">
                          <?= $last_conso->valeur ?>
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
                              <h3 class="card-title">
                               Consommation à Date
                              </h3>
                          </div>

                          <div class="card-body">

                              <table class="table table-bordered tableordered table-stripper">

                                  <thead>
                                      <tr>
                                          <th> Matiere Première </th>
                                          <th> Quantite </th>
                                          <th> Unite </th>
                                          <th> Valeur </th>
                                      </tr>
                                  </thead>

                                  <tbody class='fts'>
                                    <?php
                                      foreach ($matieres_premieres as $matiere_premiere) { 
                                    ?>
                                      <tr>
                                        <td> <?= $matiere_premiere->designation ?></td>
                                        <td> <?= $matiere_premiere->quantite_conso_a_date ?></td>
                                        <td> <?= $matiere_premiere->unite ?></td>
                                        <td> <?= $matiere_premiere->consommation_a_date ?></td>
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
                              <h3 class="card-title"> Liste Consommations </h3>
                              
                              <div class="card-tools">
                                <button type="submit" class="btn btn-sm btn-dark font-weight-bold" onclick="back('.sect_list_consommation','.sect_add_consommation')">
                                  <i class="fas fa-plus"></i> AJOUTER
                                </button>
                              </div>
                          </div>

                          <div class="card-body">

                              <table class="table table-bordered tableordered table-stripper">

                                  <thead>
                                      <tr>
                                          <th> Date </th>
                                          <th> Valeur </th>
                                          <th> ... </th>
                                      </tr>
                                  </thead>

                                  <tbody class='fts'>
                                    <?php
                                      foreach ($consommations as $consommation) { 
                                    ?>
                                      <tr>
                                        <td> <?= $consommation->date_conso ?></td>
                                        <td> <?= $consommation->valeur ?></td>
                                        <td> 
                                          <button class="btn btn-default btn-sm" onclick="showConsommation('<?= $consommation->conso_id ?>')"> <i class="fas fa-search"></i> </button>  
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

    <section class="content sect_add_consommation invisible">

        <div class="container-fluid">

          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-sm btn-dark font-weight-bold" onclick="back('.sect_add_consommation','.sect_list_consommation')">
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

                    <form action='./?action=consommation&subaction=saveConsommation' method='POST'>
                      <div class="card-body">

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="codeprojet"> Date de consommation </label>
                                <input type="date" class="form-control" name="date_consommation" required>
                            </div>

                            <div class="form-group col-6">
                                <label for=""> Commentaire </label>
                                <input type="text" class="form-control" name="observation" required>
                            </div>

                        </div>

                        <div class="row border m-1 p-1">

                            <div class="col-12 text-center p-1">
                                <span class="font-weight-bold display-5"> MATIERE PREMIERE </span>
                            </div>

                            <div class="form-group col-3">
                              <label for="interet"> Matiére première </label>
                              <select class="form-control" id="mp" onchange="setUniteMP(this)">
                                <!-- <option disabled selected> Article </option> -->
                                <?php
                                  foreach ($matieres_premieres as $matiere_premiere) { 
                                ?>

                                  <option value="<?= $matiere_premiere->code_mp ?>"> <?= $matiere_premiere->designation ?> </option> 
                                  
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
                              <input type="text" min="1" step="1" class="form-control" id="unitemp" disabled>
                            </div>

                            <div class="form-group col-3">
                              <label for="interet"> Valeur </label>
                              <input type="number" min="1" step="1" class="form-control" id="valeur">
                            </div>

                            <div class="form-group col-4 mx-auto">
                              <span class="btn btn-dark btn-block font-weight-bold" onclick="addLigneconsommation()"> AJOUTER <i class="fas fa-arrow-down"></i> </span>
                            </div>

                            <div class="form-group col-12">
                                <input type="text" class="form-control consommation" disabled>
                                <input type="hidden" class="form-control consommation" name="ligne_consommation">
                            </div>

                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th> Article </th>
                                        <th> Quantite </th>
                                        <th> Unité </th>
                                        <th> Valeur </th>
                                        <th> PU </th>
                                        <th> ... </th>
                                    </tr>
                                </thead>

                                <tbody class='fts ligneconsommation'>

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

    <section class="content sect_mod_consommation invisible">

        <div class="container-fluid">

          <div class="card">

            <div class="card-header">

              <button type="button" class="btn btn-sm btn-dark font-weight-bold" onclick="back('.sect_mod_consommation','.sect_list_consommation')">
                <i class="fas fa-arrow-left"></i> RETOUR
              </button>

            </div>

            <div class="card-body">
              
              <div class="row">
                
                <div class="col-md-10  mx-auto">

                  <div class="card card-secondary">

                    <div class="card-header">
                        <h3 class="card-title"> Details consommation </h3>
                        
                        <div class="card-tools">
                          <form action="./?action=consommation&subaction=deleteConsommation" method="post">
                            <input type="hidden" class="form-control conso_id" name="conso_id">
                            <button type="submit" class="btn btn-sm btn-dark font-weight-bold">
                              <i class="fas fa-trash"></i> SUPPRIMER
                            </button>
                          </form>
                        </div>
                    </div>

                    <div class="card-body">

                      <div class="row">
                          <div class="form-group col-6">
                              <label for="codeprojet"> Date de consommation </label>
                              <input type="date" class="form-control date_conso" disabled>
                          </div>

                          <div class="form-group col-6">
                              <label for=""> Valeur Total </label>
                              <input type="text" class="form-control valeur_total" disabled>
                          </div>

                      </div>

                      <div class="row border m-1 p-1">

                          

                          <table class="table table-bordered table-striped">

                              <thead>
                                  <tr>
                                      <th> Article </th>
                                      <th> Quantite </th>
                                      <th> Unité </th>
                                      <th> PU </th>
                                      <th> Valeur </th>
                                  </tr>
                              </thead>

                              <tbody class='fts ligne_consommation'>

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
  const matieres_premieres = <?= json_encode($matieres_premieres) ?>;
  const consommations = <?= json_encode($consommations) ?>;
  // alert(matieres_premieres);
</script>
<?php require('template/import/foot.php'); ?>
