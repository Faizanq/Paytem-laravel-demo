<html>
<head>
	<meta charset="UTF-8">
	<title>Check Out Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<form action="{{url('/order')}}" method="POST">
					  	{{csrf_field()}}
					    <div class="form-group">
					      <label for="price">Price</label>
					      <input type="text" class="form-control" id="price" aria-describedby="priceHelp" placeholder="Enter Price" name="price">
				    <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>

</body>
</html>