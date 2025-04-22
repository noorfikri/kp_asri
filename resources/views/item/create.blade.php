<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Item</h3>

      <div class="card-tools">
        <button type="button" class="close" data-target="#showcreatemodal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </div>
    <form method="POST" action="{{route('items.store')}}">
        @csrf
        <div class="card-body">
        <div class="form-group">
            <label for="inputName">Item Name</label>
            <input type="text" id="inputName" name="name" class="form-control">
          </div>
            <div class="form-group">
            <label for="inputCategory">Category</label>
            <select id="inputCategory" name="category_id" class="form-control custom-select">
                <option selected="" disabled="">Select one</option>
                @foreach ($category as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputSize">Size</label>
            <select id="inputSize" name="size_id" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              @foreach ($size as $s)
              <option value="{{$s->id}}">{{$s->name}}</option>
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputColour">Colour</label>
            <select id="inputColour" name="colour_id" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              @foreach ($colour as $co)
              <option value="{{$co->id}}">{{$co->name}}</option>
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputBrand">Brand</label>
            <select id="inputBrand" name="brand_id" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              @foreach ($brand as $b)
              <option value="{{$b->id}}">{{$b->name}}</option>
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputPrice">Item Price</label>
            <input type="text" id="inputPrice" name="price" class="form-control">
          </div>
          <div class="form-group">
            <label for="inputStock">Item Stock</label>
            <input type="text" id="inputStock" name="stock" class="form-control">
          </div>
          <div class="form-group">
            <label for="inputNote">Note</label>
            <textarea id="inputNote" name="note" class="form-control" rows="4"></textarea>
          </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#showcreatemodal" data-dismiss="modal">Cancel</a>
                <input type="submit" value="Create" class="btn btn-success float-right">
            </div>
        </div>
    </form>
    <!-- /.card-body -->
  </div>
