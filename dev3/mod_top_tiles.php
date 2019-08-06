<?php
	$sql="select * from pegawai p, jabatan j, jabatan_pegawai jp where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan  order by wilker, eselon, bidang";
	if ($result = $mysqli->query($sql)) { 
		$jml_pegawai=$result->num_rows;
	}
	
	$sql="select * from masterkegiatan where parent<>0 and approved=1";
	if ($result = $mysqli->query($sql)) { 
		$jml_pekerjaan=$result->num_rows;
	}
	
	$sql="select * from masterkegiatan where parent<>0 and approved=0";
	if ($result = $mysqli->query($sql)) { 
		$jml_pekerjaan_unapprove=$result->num_rows;
	}
	
	$sql="select substring(nip,15,1) as jk, wilker, count(status) as jml 
		from pegawai p, jabatan j, jabatan_pegawai jp 
		where p.id=jp.id_pegawai and j.id_jabatan=jp.id_jabatan 
		group by jk, wilker order by jk, wilker";

	$jmllk = 0;
	$jmlpr = 0;
	if ($result = $mysqli->query($sql)) { 
		while($obj = $result->fetch_object()){			
			if($obj->jk=='1'){
				$jmllk+=$obj->jml;
			}else{
				$jmlpr+=$obj->jml;
			}
		}
	}
?>
<!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Pegawai</span>
              <div class="count"><?=$jml_pegawai;?></div>
              <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Pegawai Laki-laki</span>
              <div class="count"><?=$jmllk;?></div>
              <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Pegawai Perempuan</span>
              <div class="count"><?=$jmlpr;?></div>
              <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Master Pekerjaan</span>
              <div class="count"><?=$jml_pekerjaan;?></div>
              <a href="?page=usulanmasterpekerjaan"><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?=$jml_pekerjaan_unapprove;?></i> Belum Disetujui</span></a>
            </div>
   <!--         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count green">2,500</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count">4,567</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>-->
          </div>
          <!-- /top tiles -->