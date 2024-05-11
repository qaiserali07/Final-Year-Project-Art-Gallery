<div class="card">
                  <div class="card-header">
                    <h4><?php echo $Art['PaintName'] ?></h4>
                    <div class="card-header-action">
                      <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                        <div class="dropdown-menu">
                          <a href="edit_art.php?edit=<?php echo $Art['ID'] ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                          <div class="dropdown-divider"></div>
                          <a href="#" data-toggle="modal" data-target="#deleteModel" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                            Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="mb-2 text-muted"><?php echo $Art['Description'] ?></div>
                    <div class="chocolat-parent">
                      <a href="..\Content/Upload/<?php echo $Art['UID'] ?>/Art/<?php echo $Art['Image'] ?>" class="chocolat-image" title="Just an example">
                        <div data-crop-image="285">
                          <img alt="image" src="..\Content/Upload/<?php echo $Art['UID'] ?>/Art/<?php echo $Art['Image'] ?>" height = 200px class="img-fluid">
                        </div>
                      </a>
                    </div>
                    <div class="mb-2 text-muted float-right"><?php echo $Art['DateTime'] ?></div>
                  </div>
                </div>
</div>