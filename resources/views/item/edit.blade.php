<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Item</h3>

      <div class="card-tools">
        <button type="button" class="close" data-target="#edit{{$item->id}}" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </div>
    <form method="POST" action="{{url('items/'.$item->id)}}">
        @csrf
        @method('PUT')
        <div class="card-body">
        <div class="form-group">
            <label for="inputName">Item Name</label>
            <input type="text" id="inputName" name="name" class="form-control" value="{{$item->name}}">
          </div>
            <div class="form-group">
            <label for="inputCategory">Category</label>
            <select id="inputCategory" name="category_id" class="form-control custom-select">
                @foreach ($category as $cat)
                @if ($cat->id == $item->category_id)

                    <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                @else

                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endif
                @endforeach
              </select>
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputSize">Size</label>
            <select id="inputSize" name="size_id" class="form-control custom-select">
              @foreach ($size as $s)
              @if ($s->id == $item->size_id)

                    <option value="{{$s->id}}" selected>{{$s->name}}</option>
                @else
                    <option value="{{$s->id}}">{{$s->name}}</option>
                @endif
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputColour">Colour</label>
            <select id="inputColour" name="colour_id" class="form-control custom-select">
              @foreach ($colour as $co)
              @if ($co->id == $item->colour_id)
                    <option value="{{$co->id}}" selected>{{$co->name}}</option>
                @else
                    <option value="{{$co->id}}">{{$co->name}}</option>
              @endif
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputBrand">Brand</label>
            <select id="inputBrand" name="brand_id" class="form-control custom-select">
              @foreach ($brand as $b)
              @if ($b->id == $item->brand_id)
                    <option value="{{$b->id}}" selected>{{$b->name}}</option>
                @else
                    <option value="{{$b->id}}">{{$b->name}}</option>
              @endif
              @endforeach
              <option>...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputPrice">Item Price</label>
            <input type="text" id="inputPrice" name="price" class="form-control" value="{{$item->price}}">
          </div>
          <div class="form-group">
            <label for="inputStock">Item Stock</label>
            <input type="text" id="inputStock" name="stock" class="form-control" value="{{$item->stock}}">
          </div>
          <div class="form-group">
            <label for="inputNote">Note</label>
            <textarea id="inputNote" name="note" class="form-control" rows="4" value="{{$item->note}}">{{ $item->note }}</textarea>
          </div>
        </div>
        <div class="card-footer">
            <div class="col-12">
                <a href="#" class="btn btn-secondary" data-target="#edit{{$item->id}}" data-dismiss="modal">Cancel</a>
                <input type="submit" value="Edit" class="btn btn-success float-right">
            </div>
        </div>
    </form>
    <!-- /.card-body -->
  </div>
