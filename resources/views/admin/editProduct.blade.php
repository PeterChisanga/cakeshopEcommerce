@extends('master')
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Product</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('admin.products') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			@if(session()->has('error'))
				<div class="callout callout-danger">
					<p>{{ session('error') }}</p>
				</div>
			@endif

			<form class="form-horizontal" action="/admin/products/update/{{ $product->id }}" method="post" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="id" value="{{ $product->id }}">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Product Name</label>
							<div class="col-sm-4">
								<input type="text" name="name" class="form-control" readonly value="{{ $product->name }}">
							</div>
							<div class="col-sm-4">
								<input type="text" name="name" class="form-control" value="{{ $product->name }}" placeholder="Enter updated product name">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Current Price</label>
							<div class="col-sm-4">
								<input type="text" name="price" class="form-control" readonly value="{{ $product->price }}">
							</div>
							<div class="col-sm-4">
								<input type="text" name="price" class="form-control" value="{{ $product->price }}" placeholder="Enter updated product price">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Category</label>
							<div class="col-sm-4">
								<input type="text" name="category" class="form-control" readonly value="{{ $product->category }}">
							</div>
							<div class="col-sm-4">
                                <input type="text" name="category" class="form-control" value="{{ $product->category }}" placeholder="Enter updated product category">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Image</label>
							<div class="col-sm-4">
								<img src="{{ asset('images/products/'.$product->gallery) }}" alt="" style="width: 100px;">
							</div>
							<div class="col-sm-4">
								<input type="file" name="image" class="form-control">
							</div>
						</div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea name="description" class="form-control" cols="30" rows="10" id="editor1">{{ $product->description }}</textarea>
                            </div>
                        </div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Update Product</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection
