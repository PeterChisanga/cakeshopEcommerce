@extends('master')
@section('content')
<section class="content-header">
    <div class="content-header-left">
        <h1>View Products</h1>
    </div>
    <div class="content-header-right">
        <a href="/admin/products/add" class="btn btn-primary btn-sm">Add Product</a>
    </div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
					<thead class="thead-dark">
                            <td> <h3>Total: <?php echo $totalProducts; ?></h3></td>
							<tr>
								<th width="30">#</th>
								<th>Photo</th>
								<th width="160">Product Name</th>
								<th width="60">Old Price</th>
								<th width="60">Current Price</th>
								<th width="60">Category</th>
								<th width="60">Description</th>
								<th width="80">Action</th>
							</tr>
						</thead>
						<tbody>
                            <?php  $i = 1; ?>
							@foreach ($products as $item)
								<tr>
                                    <td><?php echo $i; $i++; ?></td>
									<td style="width:82px;"><img src="{{asset('images/products/' . $item['gallery'])}}" alt="{{$item['name']}}" style="width:80px;"></td>
									<td>{{$item['name']}}</td>
									<td>{{$item['price']}} Dh</td>
									<td>{{$item['price']}} Dh</td>
									<td>{{$item['category']}}</td>
									<td>{{$item['description']}}</td>
									<td>										
										<a href="/admin/products/update/{{$item['id']}}" class="btn btn-primary btn-xs">Edit</a>
										<a href="#" class="btn btn-danger btn-xs" data-href="/admin/products/delete/{{$item['id']}}" data-toggle="modal" data-target="#confirm-delete" data-id="{{$item['id']}}">Delete</a>  
									</td>
								</tr>
                            @endforeach    
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body" style="color:red;">
                <p>Are you sure want to delete this item? </p>
                <p style="color:red;">Be careful! This product will be deleted from the order table, payment table, size table, color table and rating table also.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" href="/admin/products/delete/{{$item['id']}}">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
	$('#confirm-delete').on('show.bs.modal', function(e) {
    var deleteBtn = $(e.relatedTarget);
    var id = deleteBtn.data('id');
    var href = deleteBtn.data('href');

    $(this).find('.modal-body').html('Are you sure want to delete this item? id=' + id);
    $(this).find('.btn-ok').attr('href', href);
   });
</script>

@endsection