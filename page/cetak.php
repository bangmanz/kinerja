  <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
		<h2>Print Laporan Pekerjaan <small></small></h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="#">Settings 1</a>
			  </li>
			  <li><a href="#">Settings 2</a>
			  </li>
			</ul>
		  </li>
		  <li><a class="close-link"><i class="fa fa-close"></i></a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>

	  <div class="x_content">


		<div class="table-responsive">
		  <table class="table table-striped jambo_table bulk_action">
			<thead>
			  <tr class="headings">
				<th class="column-title" align='center'>No </th>
				<th class="column-title" align='center'>Bulan </th>
				<th class="column-title" align='center'>Nama </th>
				<th class="column-title" align='center'>Download Excel</th>
				<th class="column-title" align='center'>Print</th>
			  </tr>
			</thead>

			<tbody>
			<?php
				if($_SESSION['level_user']==2){
					$querry = "select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and jp.wilker=".$_SESSION['wilker']."  order by wilker, bidang, eselon, j.id_jabatan, nama";
				}else{
					$querry = "select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id='".$_SESSION['id']."' and p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan and jp.wilker=".$_SESSION['wilker']."  order by wilker, bidang, eselon, j.id_jabatan, nama";
				}
			 //echo $querry;

				$no = 1;
				if ($result2 = $mysqli->query($querry)) { 
					while($obj2 = $result2->fetch_object()){	
						echo "
							<tr>
								<td><div align='center'>".$no."</div></td>
								<td>Januari</td>
								<td>".$obj2->nama."</td>
								<td align='center'><a target='_blank' href='../page/downloadexcel.php?bln=01&id=".$obj2->id."'><img src='../images/excel.jpg' width='20' height='20'></a></td>		
								<td align='center'><a target='_blank' href='../page/print.php?bln=01&id=".$obj2->id."'><img src='../images/print.jpg' width='20' height='20'></a></td>								
							";
						echo "</tr>";
						$no++;
						echo "
							<tr>
								<td><div align='center'>".$no."</div></td>
								<td>Februari</td>
								<td>".$obj2->nama."</td>
								<td align='center'><a target='_blank' href='../page/downloadexcel.php?bln=02&id=".$obj2->id."'><img src='../images/excel.jpg' width='20' height='20'></a></td>								
								<td align='center'><a target='_blank' href='../page/print.php?bln=02&id=".$obj2->id."'><img src='../images/print.jpg' width='20' height='20'></a></td>								
							";
						echo "</tr>";

						
						$no++;
					}
				}
			?>	 
			</tbody>
		  </table>
		</div>
				
			
	  </div>
	</div>
  </div>