<link rel="stylesheet" href="css/tstyle.css" />
<script type="text/javascript" src="js/tinybox.js"></script>
<h2>
	Detail Dinas Luar Pegawai<br>
</h2>
		
<table class="table table-unbordered table-condensed">
	<thead>
	</thead>
	<tbody>
		<tr>
			<td>Nama </td>
			<?php				
					$sql="SELECT * FROM `pegawai` where id='".$_GET['id']."'";
					if ($result = $mysqli->query($sql)) { 
						while($obj = $result->fetch_object()){			
						echo "<td><div class='col-md-4'>".$obj->nama."</div></td>";
			 			}
			 		} 
			 	
			 ?>
		</tr>		
		<tr>
			<td>Bulan </td>
			<td>
				<div class="col-md-4">
					<?php echo bulan($_SESSION['bln'])." ".TAHUN; ?>
				</div>			
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th><div align='center'>
				Tanggal
			</div></th>
			<th><div align='center'>
				Seksi
			</div></th>
			<th><div align='center'>
				Kode Kegiatan
			</div></th>
			<th><div align='center'>
				Kegiatan
			</div></th>
			<th><div align='center'>
				Insert By
			</div></th>
			<th><div align='center'>
				Keterangan
			</div></th>
		</tr>
	</thead>
	<tbody>
	<?php	
		$namabulan=bulan($_SESSION['bln']);
		$timestamp = strtotime(TAHUN."-".$_SESSION['bln']."-1");
		$days = date('w', $timestamp);
		$query="select ket,insert_dl_by, tanggal.tgl, df.kode_seksi, df.kode_kegiatan, df.keterangan from tanggal left join 
		(select m.id_m_kode as id_m_kode, m.kode_seksi as kode_seksi, m.kode_kegiatan as kode_kegiatan, m.keterangan as keterangan, 
		insert_dl_by, d.tgl as tgl, d.bln as bln, d.thn as thn,d.ket as ket from dinas_luar d, m_kode_kegiatan m where m.id_m_kode=d.id_m_kode 
		and d.id='".$_GET['id']."' and d.thn='".TAHUN."' and d.bln='".$_SESSION['bln']."') df on tanggal.tgl=df.tgl 
		order by tanggal.tgl limit 0,".jmlhari($_SESSION['bln']);
		if($result=$mysqli->query($query)){
			while($obj=$result->fetch_object()){
				if($days==0||$days==6){
					echo "<tr bgcolor='#ffb3b3'>";
				}else{
					echo "<tr>";
				}
				echo "<td align='center'>".$obj->tgl."_".$namabulan."_".TAHUN."</td>";
				echo "<td align='center'>".namaseksi($obj->kode_seksi)."</td>";
				echo "<td align='center'>".$obj->kode_kegiatan."</td>";
				echo "<td>".$obj->keterangan."</td>";
				echo "<td align='center'>".$obj->insert_dl_by."</td>";
				echo "<td>".$obj->ket."</td>";
				echo "</tr>";
				$days++;
				if($days==7){$days=0;}
			}
		}
	?>
	</tbody>
</table>