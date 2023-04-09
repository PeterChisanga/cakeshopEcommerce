@extends('master')
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Product</h1>
	</div>
	<div class="content-header-right">
		<a href="product.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			@if(($errors) > 0)
			<div class="callout callout-danger">
				<h4>Validation errors occurred:</h4>
				<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
			@endif

			@if(session('success'))
			<div class="callout callout-success">
				<p>{{ session('success') }}</p>
			</div>
			@endif

			<form class="form-horizontal" action="/admin/products/add" method="post" enctype="multipart/form-data">
				 @csrf
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Product Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="name" class="form-control">
							</div>
						</div>	
						<!-- <div class="form-group">
							<label for="" class="col-sm-3 control-label">Old Price</label>
							<div class="col-sm-4">
								<input type="text" name="p_old_price" class="form-control">
							</div>
						</div> -->
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Current Price <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="price" class="form-control">
							</div>
						</div>	
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Category <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="category" class="form-control">
							</div>
						</div>
						<!-- <div class="form-group">
							<label for="" class="col-sm-3 control-label">Select Weight</label>
                            <small class="form-text text-muted">Select one or more weights</small>
							<div class="col-sm-4">
								<select name="weight" class="form-control select2" multiple="multiple">
                                    <option value="1">1 Kg</option>
                                    <option value="1.5">1.5 Kg</option>
                                    <option value="2">2 Kg</option>
                                    <option value="3">3 Kg</option>
								</select>
							</div>
						</div> -->
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Featured Photo <span>*</span></label>
							<div class="col-sm-4" style="padding-top:4px;">
								<input type="file" name="image">
							</div>
						</div>
						<!-- <div class="form-group">
							<label for="" class="col-sm-3 control-label">Other Photos</label>
							<div class="col-sm-4" style="padding-top:4px;">
								<table id="ProductTable" style="width:100%;">
			                        <tbody>
			                            <tr>
			                                <td>
			                                    <div class="upload-btn">
			                                        <input type="file" name="photo[]" style="margin-bottom:5px;">
			                                    </div>
			                                </td>
			                                <td style="width:28px;"><a href="javascript:void()" class="Delete btn btn-danger btn-xs">X</a></td>
			                            </tr>
			                        </tbody>
			                    </table>
							</div>
							<div class="col-sm-2">
			                    <input type="button" id="btnAddNew" value="Add Item" style="margin-top: 5px;margin-bottom:10px;border:0;color: #fff;font-size: 14px;border-radius:3px;" class="btn btn-warning btn-xs">
			                </div>
						</div> -->
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Description</label>
							<div class="col-sm-8">
								<textarea name="description" class="form-control" cols="30" rows="10" id="editor1"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Add Product</button>
							</div>
						</div>
					</div>
				</div>

			</form>


		</div>
	</div>

</section>


@endsection
