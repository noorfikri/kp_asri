<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Item</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="inputName">Project Name</label>
        <input type="text" id="inputName" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Project Description</label>
        <textarea id="inputDescription" class="form-control" rows="4"></textarea>
      </div>
      <div class="form-group">
        <label for="inputStatus">Status</label>
        <select id="inputStatus" class="form-control custom-select">
          <option selected="" disabled="">Select one</option>
          <option>On Hold</option>
          <option>Canceled</option>
          <option>Success</option>
        </select>
      </div>
      <div class="form-group">
        <label for="inputClientCompany">Client Company</label>
        <input type="text" id="inputClientCompany" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputProjectLeader">Project Leader</label>
        <input type="text" id="inputProjectLeader" class="form-control">
      </div>
    </div>
    <div class="card-footer">
        <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Edit" class="btn btn-success float-right">
        </div>
    </div>
    <!-- /.card-body -->
  </div>
