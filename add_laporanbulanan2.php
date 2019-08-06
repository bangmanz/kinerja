<?php
	echo getcwd();
?>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
	var htmlobjek;
	$(document).ready(function(){
	  //apabila terjadi event onchange terhadap object <select id=propinsi>
	  $("#lv1").change(function(){
		var lv1 = $("#lv1").val();
		$.ajax({
			url: "page/addkeg.php",
			data: "lv1="+lv1,
			cache: false,
			success: function(msg){
				//jika data sukses diambil dari server kita tampilkan
				//di <select id=kota>
				$("#lv2").html(msg);
			}
		});
	  });
	});
	 
</script>

<select placeholder="Pilih Seksi..." name="lv1" id="lv1" class="form-control" required>
	<option></option>
	<option value="1">Tata Usaha</option>
	<option value="2">Sosial</option>
	<option value="3">Produksi</option>
	<option value="4">Distribusi</option>
	<option value="5">Neraca</option>
	<option value="6">IPDS</option>
</select>


<select data-placeholder="Pilih Kegiatan..." name="lv2" id="lv2" class="form-control" required>
	<option></option>
</select>
