<h4>
	Edit Absensi Harian Pegawai<br>
</h4>
<br><br>
<?php
	$sql="SELECT * FROM `pegawai` where id='".$_SESSION['id']."'";
	if ($result = $mysqli->query($sql)) { 
		while($obj = $result->fetch_object()){
?> 			
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<tr>
			<td>Nama </td>
			<td><div class="col-md-4"><?php echo $obj->nama;?></div></td>
		</tr>		
		<tr>
			<td>Bulan </td>
			<td>
				<form action="?page=viewbulanpertanggal" method="post"> 
				<div class="col-md-4">
					<select id="bln" name="bln" class="form-control">
						<option></option>
						<option value="01" <?php if($_POST['bln']=="01"){echo "selected";}?>>Januari</option>
						<option value="02" <?php if($_POST['bln']=="02"){echo "selected";}?>>Februari</option>
						<option value="03" <?php if($_POST['bln']=="03"){echo "selected";}?>>Maret</option>
						<option value="04" <?php if($_POST['bln']=="04"){echo "selected";}?>>April</option>
						<option value="05" <?php if($_POST['bln']=="05"){echo "selected";}?>>Mei</option>
						<option value="06" <?php if($_POST['bln']=="06"){echo "selected";}?>>Juni</option>
						<option value="07" <?php if($_POST['bln']=="07"){echo "selected";}?>>Juli</option>
						<option value="08" <?php if($_POST['bln']=="08"){echo "selected";}?>>Agustus</option>
						<option value="09" <?php if($_POST['bln']=="09"){echo "selected";}?>>September</option>
						<option value="10" <?php if($_POST['bln']=="10"){echo "selected";}?>>Oktober</option>
						<option value="11" <?php if($_POST['bln']=="11"){echo "selected";}?>>November</option>
						<option value="12" <?php if($_POST['bln']=="12"){echo "selected";}?>>Desember</option>
					</select>
				</div>
				<div class="col-md-2">
					<button type="submit" name="submit">Submit</button>
				</div>
				</form>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
<?php }} ?>
<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th><div align='center'>
				Tanggal
			</div></th>
			<th><div align='center'>
				Dinas Luar &<br>Penugasan
			</div></th>
			<th><div align='center'>
				Seksi
			</div></th>
			<th><div align='center'>
				Kegiatan
			</div></th>
		</tr>
	</thead>
	<tbody>
	<?php
		$namabulan = bulan($_GET['bln']);
		$sql2="SELECT * FROM `harian` where id='".$_GET['id']."' and bulan='".$_GET['bln']."'";
		if ($result2 = $mysqli->query($sql2)) { 
			while($obj2 = $result2->fetch_object()){	
				for($i=1;$i<=jmlhari($_GET['bln']);$i++){
					echo "<tr>
							<td>
								".$i." ".$namabulan." 2016
							</td>
							<td>
								<div class='checkbox' align='center' valign='center'>
								  <input type='checkbox' name='checkboxes' checked id='checkboxes-0' value='1'
								</div>	
							</td>
							<td>
								<select id='seksi' name='seksi' class='form-control'>
								  <option value=''></option>
								  <option value='1'>TU</option>
								  <option value='2'>Sosial</option>
								  <option value='3'>Produksi</option>
								  <option value='4'>Distribusi</option>
								  <option value='5'>Neraca</option>
								  <option value='6'>IPDS</option>
								</select>
							</td>
							<td>
									<input id='textinput' name='textinput' type='text' class='form-control input-md'>
							</td>
						</tr>";
				}
			}
		}
	?>
	</tbody>
</table>
<div class="col-md-12" align="right">
<button id="singlebutton" name="singlebutton" class="btn btn-primary">SIMPAN</button>
<button id="singlebutton" name="singlebutton" class="btn btn-primary">CANCEL</button>
</div>	
