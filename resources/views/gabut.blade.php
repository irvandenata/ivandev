<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>WOW WEW Ini apa</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
		integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
		crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
		integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
		crossorigin=""></script>
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<style>
		body {
			font-family: 'Poppins';
			font-size: 22px;
		}
	</style>
</head>

<body>
	<div class="container mt-4">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Halo Gaaesss !</h5>
						<p class="card-text">Website ini ni dibuat sepontan dan karne gabut <br>Jadi Halaman ini bise tau kau tu dimana
							WKWKWK
							<br>Gitu jak :v
						</p>
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="">Alamat</label>
									<input type="text" class="form-control" id="alamat" placeholder="Alamat" disabled>
								</div>
							</div>
							<div id="map" style="width: 100%; height: 400px;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
		crossorigin="anonymous"></script>

	<script>
		var ip;
		$.ajax({
			url: 'https://ipapi.co/json/',
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				ip = data.ip
				$.ajax({
					url: 'https://ipinfo.io/' + ip + '?token=35463c2f73b5fa',
					type: 'GET',
					success: function(data) {
						// console.log(data);
						$('#alamat').val(data.city + ', ' + data.region + ', ' + data.country);
						var map = L.map('map').setView([data.loc.split(',')[0], data.loc.split(',')[
							1]], 16);

						L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
							maxZoom: 18,
							attribution: 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a>'
						}).addTo(map);
						L.marker([data.loc.split(',')[0], data.loc.split(',')[1]]).addTo(map)
						// L.marker([-6.1829957, 106.8444433]).addTo(map);
					}
				});
			}
		})
	</script>
</body>

</html>
