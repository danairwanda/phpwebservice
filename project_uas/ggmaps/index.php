<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml/">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Google Maps AJAX + WebService Example - Data Jumlah Penduduk Per Propinsi di Indonesia</title>
	<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyClMgpgwWMQCpGqvTrIxRonNjVu_gdSeN4" type="text/javascript"></script>
	<script type="text/javascript">
	
	var map; // inisialisasi map.
	var geocoder; // inisialisasi geocoder.

	// fungsi untuk menampilkan kontrol 
	function load(){
		if (GBrowserIsCompatible()) {//mengecek browser apakah bisa buat google maps atau tidak.
			geocoder = new GClientGeocoder();//membuat inisialisasi geocoder sebagai client  
			map 	 = new GMap2(document.getElementById('map')); //menangkap nilai map pada html.
			map.addControl(new GSmallMapControl());//menampilkan 4 tombol panah dan tombol zoom in dan zoom out.
			map.addControl(new GMapTypeControl());//control untuk menampilkan defaultnya.  
			map.setCenter(new GLatLng(-5.137623, 119.412460), 4); //deklarasi posisi awal default pada peta.
		}
	}

	function searchLocations(){
		var address = document.getElementById('addressInput').value;//mendapatkan nilai dari alamat yang dimasukkan di text input dengan id "address input".
		if (!address) { //jika bukan alamat yang diinputkan
			searchLocationsNear('',0,10); //menjalankan fungsi searchLocationsNear menampilkan seluruh propinsi
		}else{ // jika tidak.
			searchLocationsNear(address);//menjalankan fungsi searchLocationsNear menampilkan berdasarkan alamat yang di inputkan pada inisialisasi address.
		}
	}

	//fungsi pencarian lokasi terdekat, berisi parameter nama propinsi, halaman, dan ukuran halaman.
	function searchLocationsNear(prop_name, page, page_size){  //page dan page size merupakan parameter dari server
		var searchUrl = 'wsc_prop.php?prop_nama=' + prop_name; // inisialisasi untuk menghubungkan pada file wsc_prop.php sesuai dengan nama propinsi yang diinputkan.
		if ((page) & (page_size)) { 
			searchUrl = 'wsc_prop.php?prop_nama=' + prop_name + '&page=' + page + '&page_size' + page_size;
		}
		
		GDownloadUrl(searchUrl, function(data){
			var xml 	= GXml.parse(data);//untuk menguraikan data berupa xml.
			var markers = xml.documentElement.getElementsByTagName('marker');//membuat halaman xml yang menangkap nilai marker, ditampung pada inisialisasi markers
			map.clearOverlays();//untuk membersihkan tanda dan gambar pada map.

			var sidebar = document.getElementById('sidebar');//membuat halaman yang menangkap nilai sidebar, yang nantinya digunakan untuk membuat halam sidebar.
			sidebar.innerHTML = '';//digunakan untuk menetapkan atau mengembalikan teks dari sebuah elemen
			if (markers.length == 0) {//jika tanda panjangnya sama dengan 0.
				sidebar.innerHTML = 'No Result found.';// maka data tidak ditemukan.
				map.setCenter(new GLatLng(-5.137623, 119.412460), 4);//dan kembali pada posisi awal/default.
			}

			var bounds = new GLatLngBounds(); //merepresentasikan persegi ataupun persegi panjang pada koordinat geografis.
			for (var i = 0; i < markers.length; i++) {

				//fungsi untuk mengambil nilai attributte pada wsc.prop
				var prop_nama 			 = markers[i].getAttribute('prop_nama');
				var prop_ibukota   		 = markers[i].getAttribute('prop_ibukota');
				var jml_penduduk    	 = parseFloat(markers[i].getAttribute('prop_penduduk')); 	
				var jml_penduduk_pria    = parseFloat(markers[i].getAttribute('prop_penduduk_pria')); 	
				var jml_penduduk_wanita  = parseFloat(markers[i].getAttribute('prop_penduduk_wanita')); 	
				var prop_website		 = markers[i].getAttribute('prop_website');

				//GLatLng Merupakan point pada koordinat geografis, latitude dan longitude.
				var point 				 = new GLatLng(parseFloat(markers[i].getAttribute('lat')),
														parseFloat(markers[i].getAttribute('lng')));


				//fungsi untuk membuat tanda pada wilayah bersadarkan latitude dan longitude.
				var marker = createMarker(point, prop_nama, prop_ibukota, jml_penduduk, jml_penduduk_pria, jml_penduduk_wanita, prop_website);

				map.addOverlay(marker);

				//fungsi untuk membuat kotak dialog pada sidebar yang berisi data detail propinsi.
				var sidebarEntry = createSidebarEntry(marker, prop_nama, prop_ibukota, jml_penduduk, jml_penduduk_pria, jml_penduduk_wanita, prop_website);
				//fungsi yang digunakan untuk menambahkan suatu elemen setelah elemen lain.
				sidebar.appendChild(sidebarEntry);
				
				bounds.extend(point); 
			}
			//menampilkan lokasi dan terdapat menu zoom pada maps
			map.setCenter(bounds.getCenter(), map.getBoundsZoomLevel(bounds));
		});
}
			

	function createMarker(point, prop_nama, prop_ibukota, jml_penduduk, jml_penduduk_pria, jml_penduduk_wanita, prop_website){
		// Create our "tiny" marker icon

		var iconBlue 				= new GIcon();
		iconBlue.image				= "http://labs.google.com/ridefinder/images/mm_20_blue.png";
		iconBlue.shadow				= "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
		iconBlue.iconSize			= new GSize(24, 40); 
		iconBlue.shadowSize 		= new GSize(34, 40); 
		iconBlue.iconAnchor 		= new GPoint(6, 40); 
		iconBlue.infoWindowAnchor   = new GPoint(5, 1); 

		var iconRed 				= new GIcon();
		iconRed.image				= "http://labs.google.com/ridefinder/images/mm_20_red.png";
		iconRed.shadow				= "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
		iconRed.iconSize			= new GSize(12, 20); 
		iconRed.shadowSize 			= new GSize(22, 20); 
		iconRed.iconAnchor 			= new GPoint(6, 20); 
		iconRed.infoWindowAnchor  	= new GPoint(5, 1); 

		var markerOptions			= {};
		markerOptions.icon 			= G_DEFAULT_ICON;
		if (jml_penduduk > 10000000) {
			markerOptions.icon 		=	iconBlue;
		}
		markerOptions.title			=	prop_nama;
		markerOptions.draggable		=	false;

		var marker 	=	new GMarker(point, markerOptions);
		var html    =	'Propinsi : <b>' + prop_nama + '</b><br/>'
					  + 'Ibukota  :    ' + prop_ibukota + '<br/><br/>'
					  + '<table border=1><thead><th> Kriteria (Kelamin) </th><th> Jumlah </th><thead>'
					  + '<tbody>'
					  + '<tr><td> Pria </td> <td align="right">'+jml_penduduk_pria+'</td></tr>'	
					  + '<tr><td> Wanita </td> <td align="right">'+jml_penduduk_wanita+'</td></tr>'	
					  + '<tr><td> Total </td> <td align="right">'+jml_penduduk+'</td></tr>'
					  + '</tbody><table/>'
					  + '<br/>'
					  + 'Website : <a href="'+prop_website+'" target="_blank">'+prop_website+'</a>'
					  + '<br/><br/>'
					  // + '<img src="http://www.facebook.com/profile/pic.php?oid=AQDtJQ70o7Sx0D-7XkRbq7F0PPulc4x-lcehevpw4vZUZULk-dL7nAuYk_iW5OQpSGg&size=normal">'	
					  + '<br/>'
					  + 'Author : <a href="http://www.mhs.infoterkini.com" target="_blank">www.mhs.infoterkini.com</a>';
					  GEvent.addListener(marker, 'click', function(){
					  	marker.openInfoWindowHtml(html);
					  });
					  return marker;
					}

					function createSidebarEntry(marker, prop_nama, prop_ibukota, jml_penduduk, jml_penduduk_pria, jml_penduduk_wanita, prop_website){
						var div 		 		= document.createElement('div');
						var html 		 		= '<b>' + prop_nama + '</b>(' + jml_penduduk + ')<br/>' + prop_ibukota;
						div.innerHTML	 		= html;
						div.style.cursor 		= 'pointer';
						div.style.marginBottom 	= '5px';
						GEvent.addDomListener(div, 'click', function(){
							GEvent.trigger(marker, 'click');
						});
						GEvent.addDomListener(div, 'mouseover', function(){
							div.style.backgroundColor = '#eee';
						});
						GEvent.addDomListener(div, 'mouseout', function(){
							div.style.backgroundColor = '#fff';
						});
						return div;
					}

	</script>
</head>
<body onload="load()" onunload="GUnload()">
	<h2>Google Maps AJAX + WebService Example - Data Jumlah Penduduk Per Propinsi di Indonesia</h2>

	Propinsi	:	<input type="text" id="addressInput">
					<input type="button" onclick="searchLocations()" value="Search">
					<br>
					<br/>
					<div style="width:1000px; font-family:Arial, sans-serif; font-size:11px; border:1px solid black">
					<table>
						<tbody>
							<tr>
								<td width="200" valign="top">
									<div id="sidebar" style="overflow: auto; height: 500px; font-size: 11px; color: #000">
										
									</div>
								</td>
								<td>
									<div id="map" style="overflow: hidden; width:800px; height:500px"></div>
								</td>
							</tr>
						</tbody>
					</table>
					</div>
</body>
</html>