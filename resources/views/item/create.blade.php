<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Item</h3>

      <div class="card-tools">
        <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="inputName">Item Name</label>
        <input type="text" id="inputName" class="form-control">
      </div>
        <div class="form-group">
        <label for="inputStatus">Category</label>
        <select id="inputStatus" class="form-control custom-select">
            <option selected="" disabled="">Select one</option>
            @foreach ($category as $cat)
            <option>{{$cat->name}}</option>
            @endforeach
          <option>...</option>
        </select>
      </div>
      <div class="form-group">
        <label for="inputStatus">Size</label>
        <select id="inputStatus" class="form-control custom-select">
          <option selected="" disabled="">Select one</option>
          @foreach ($size as $s)
          <option>{{$s->name}}</option>
          @endforeach
          <option>...</option>
        </select>
      </div>
      <div class="form-group">
        <label for="inputStatus">Colour</label>
        <select id="inputStatus" class="form-control custom-select">
          <option selected="" disabled="">Select one</option>
          @foreach ($colour as $co)
          <option>{{$co->name}}</option>
          @endforeach
          <option>...</option>
        </select>
      </div>
      <div class="form-group">
        <label for="inputStatus">Brand</label>
        <select id="inputStatus" class="form-control custom-select">
          <option selected="" disabled="">Select one</option>
          @foreach ($brand as $b)
          <option>{{$b->name}}</option>
          @endforeach
          <option>...</option>
        </select>
      </div>
      <div class="form-group">
        <label for="inputName">Item Price</label>
        <input type="text" id="inputName" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputName">Item Stock</label>
        <input type="text" id="inputName" class="form-control">
      </div>
      <div class="form-group">
        <label for="inputDescription">Note</label>
        <textarea id="inputDescription" class="form-control" rows="4"></textarea>
      </div>
    </div>
    <div class="card-footer">
        <div class="col-12">
            <a href="#" class="btn btn-secondary" data-target="#showcreatemodal" data-dismiss="modal">Cancel</a>
            <input type="submit" value="Create" class="btn btn-success float-right">
        </div>
    </div>
    <!-- /.card-body -->
  </div>
