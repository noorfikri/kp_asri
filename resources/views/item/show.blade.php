
    <!-- /.card-header -->
        <div class="card modal-body card-primary shadow-lg p-0">
            <div class="card-header">
                <h3 class="card-title">Detail || {{$data->name}}</h3>
                <button type="button" class="close" data-dismiss="modal" data-target="show{{$data->id}}" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <img class="img-fluid pad" src="https://placehold.co/400x400?text=Placeholder+Image" alt="Photo">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Name : </td>
                            <td>{{$data->name}}</td>
                        </tr>
                        <tr>
                            <td>Id : </td>
                            <td>{{$data->id}}</td>
                        </tr>
                        <tr>
                            <td>Brand : </td>
                            <td>{{$data->brand->name}}</td>
                        </tr>
                        <tr>
                            <td>Category : </td>
                            <td>{{$data->category->name}}</td>
                        </tr>
                        <tr>
                            <td>Colour : </td>
                            <td>{{$data->colour->name}}</td>
                        </tr>
                        <tr>
                             <td>Size : </td>
                             <td>{{$data->size->name}}</td>
                        </tr>
                        <tr>
                              <td>Price : </td>
                              <td>{{$data->price}}</td>
                        </tr>
                        <tr>
                              <td>Stock : </td>
                              <td>{{$data->stock}}</td>
                        </tr>
                        <tr>
                            <td>Note : </td>
                            <td>{{$data->note}}</td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>


