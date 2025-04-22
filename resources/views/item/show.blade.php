
    <div class="modal-header">
        <h3 class="card-title">Detail</h3>
        <button type="button" class="close" data-dismiss="modal" data-target="show{{$data->id}}" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>
    <!-- /.card-header -->
    <div class="modal-body">
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
            </tbody>
        </table>
    </div>


