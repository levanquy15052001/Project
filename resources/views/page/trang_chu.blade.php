@extends('include.Master_layout')
@push('style')

@endpush
@section('content')
<!-- Flexbox container for aligning the toasts -->
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>

						@foreach ($Product as $item)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<a href="{{route('show_detail',['id' =>$item->product_id])}}">
												<img src={{asset('Eshopper/images/product-details/'.$item->product_img)}} height="250" alt="" />
											</a>
											<h2>{{number_format($item->product_price)}} VND</h2>
											<p>{{$item->product_name}}</p>
											{{-- <form action="{{route('add_cart')}}" method="POST"> 
												
											--}}
												<form> 
												@csrf
												{{-- <input type="hidden" name="data" id="data" value="{{$Product}}"> --}}
												<input type="hidden" min="1" value="1"  name="qty"/>
												<input type="hidden" name="id" id="id_product_{{$item->product_id}}" value="{{$item->product_id}}">
												
											{{-- <button  type="submit" class="btn btn-fefault cart">
												<i class="fa fa-shopping-cart"></i>
												Add to cart
											</button>	 --}}
											<button type="button" name="add-to-cart" data-id_product="{{$item->product_id}}" id="add-to-cart" class="btn btn-fefault cart add-to-cart"><i class="fa fa-shopping-cart"></i> Add to cart Ajax</button>
											</form>			
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div><!--features_items-->
						{{ $Product->links() }}
				</div>
			</div>
		</div>
	</section>
    @endsection
@push('script')
	<script> 
		$(document).ready(function() {
			$('.add-to-cart').click(function(){
				var id_products = $(this).data('id_product');
				var _token = $('input[name="_token"]').val()
				
				$.ajax({
                    method: 'POST',
                    url: "{{route('ajax_add_cart')}}",
                    data: {
                        id: id_products,
						_token:_token,
                    },
                    success:function(data){
						if(data.success)
						{
							swal("Good job!", data.success, "success");
						}
						else
						{
							swal({
								title:data.errors,
								icon: "warning",
								dangerMode: true,
								})
						}	
                    }
                });
			});
		});
		function launch_toast() {
			var x = document.getElementById("toast")
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
		}
	</script>
@endpush