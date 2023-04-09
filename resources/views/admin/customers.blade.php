@extends('master')
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>View Customers</h1>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th width="10">#</th>
								<th width="180">Name</th>
								<th width="150">Email Address</th>
								<th width="100">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; ?>
							@foreach ($customers as $customer) 
								<tr class="bg-g">
									<td><?php echo $i; $i++; ?></td>
									<td>{{$customer['name']}}</td>
									<td>{{$customer['email']}}</td>
									<td>
										<a href="#" class="btn btn-danger btn-xs" data-href="customer-delete.php?id=" data-toggle="modal" data-target="#confirm-delete">Delete</a>
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

@endsection