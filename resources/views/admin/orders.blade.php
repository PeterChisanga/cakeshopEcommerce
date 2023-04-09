@extends('master')
@section("content")
<div class="box box-info">
    <div class="box-body table-responsive">
		<table id="example1" class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Customer</th>
					<th>Product Details</th>
					<th>Total Amount</th>
					<th>Payment Method</th>
					<th>Payment Status</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $key = 0; $previousUser_id = 1000; $totalPrice = 0;?>
				@foreach ($orders as $order)
					<?php if($key == 0){$currentUser_id = $order->user_id;} ?>
					<tr class="{{ $order->payment_status == 'pending' ? 'bg-r' : 'bg-g' }}">
						@if($order->user_id != $previousUser_id)
							<td>{{ $key += 1 }}</td>
						@else
							<td></td>	
						@endif
						<td>
							@if($order->user_id != $previousUser_id)
								<b>Name</b><br>{{ $order->name }}<br>
								<b>Email</b><br> {{ $order->email }}<br><br>
								<a href="#" data-toggle="modal" data-target="#model-{{ $key }}" class="btn btn-warning btn-xs" style="width:100%;margin-bottom:4px;">Send Message</a>
								<div id="model-{{ $key }}" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title" style="font-weight: bold;">Send Message</h4>
											</div>
											<div class="modal-body" style="font-size: 14px">
												<form action="/admin/send" method="POST">
            										 @csrf
													<input type="hidden" name="cust_id" value="{{ $order->user_id }}">
													<input type="hidden" name="email" value="{{ $order->email }}">
													<table class="table table-bordered">
														<tr>
															<td>Subject</td>
															<td>
																<input type="text" name="subject" class="form-control" style="width: 100%;">
															</td>
														</tr>
														<tr>
															<td>Message</td>
															<td>
																<textarea name="message" class="form-control" cols="30" rows="10" style="width:100%;height: 200px;"></textarea>
															</td>
														</tr>
														<tr>
															<td></td>
															<td><input type="submit" value="Send Message" name="form1"></td>
														</tr>
													</table>
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							@endif
						</td>
						<td>
							<h4>{{ $order->price }} Dh</h4>
							{{ $order->description }}
							<?php
								if ($order->user_id == $currentUser_id){ 
									$totalPrice += $order->price;
								}else{
									$totalPrice = 0;
									$totalPrice += $order->price;
								} 
							?>
						</td>
						<td><h4>{{$totalPrice}} Dh</h4></td>
						@if($order->user_id != $previousUser_id)
							<td>
							<b>Payment Method:</b> <span style="color:red;"><b>{{ $order->payment_method }}</b></span>
						</td>
						<td>{{ $order->payment_status }}</td>
						<td>{{ $order->address }}</td>
						<td>
							<a href="" class="btn btn-primary btn-xs" style="width:100%;margin-bottom:4px;">View</a>
							<form action="{{ url('admin/orders/delete/' . $order->id) }}" method="get">
								@csrf
								@method('DELETE')
								<button type="submit" onclick="return confirm('Are you sure you want to delete this order? This will delete all the orders done by this Customer')" class="btn btn-danger btn-xs" style="width:100%;">Delete</button>
							</form>
						</td>
						@else
							<td></td>	
							<td></td>	
							<td></td>	
							<td></td>	
						@endif
						
					</tr>
					<?php $currentUser_id = $order->user_id; $previousUser_id = $order->user_id; ?>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>#</th>
					<th>Customer</th>
					<th>Product Details</th>
					<th>Total Amount</th>
					<th>Payment Method</th>
					<th>Payment Status</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>
<!-- /.box-body -->
</div>
@endsection