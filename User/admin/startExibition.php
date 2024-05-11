<div class="card">
    <form class="needs-validation" novalidate="" action = "includes/controller.php" method = "POST"  enctype = "multipart/form-data">
        <div class="card-header">
            <h4>Open gift for everyone!</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Exhibition Title</label>
                <input type="text" name = "Title" class="form-control" required="">
                <div class="invalid-feedback">
                    What's your title?
                </div>
            </div>
            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>Starting date & time</label>
                                <input  type="datetime-local" class="form-control"  name = "Start" required="">
                                <div class="invalid-feedback">
                                  Please fill in the starting datetime
                                </div>
                              </div>
                              <div class="form-group col-md-6 col-12">
                                <label>Ending date and time</label>
                                <input  type="datetime-local" class="form-control"  name="End" required="">
                                <div class="invalid-feedback">
                                  Please fill in the ending datetime
                                </div>
                              </div>
            </div>
        </div>
        <div class="card-footer ">
            <button name= "start_exhibition" class="btn btn-primary">Start</button>
        </div>
    </form>
</div>