<?php
	define('TAHUN',2019);
	function bulan($bln){
		switch ($bln) {
			case '01': return "Januari";break;
			case '02': return "Februari";break;
			case '03': return "Maret";break;
			case '04': return "April";break;
			case '05': return "Mei";break;
			case '06': return "Juni";break;
			case '07': return "Juli";break;
			case '08': return "Agustus";break;
			case '09': return "September";break;
			case '10': return "Oktober";break;
			case '11': return "November";break;
			case '12': return "Desember";break;
			default: return "";
		}
	}
	
	function namaseksi($seksi){
		switch ($seksi) {
			case 1: return "Tata_Usaha";break;
			case 2: return "Sosial";break;
			case 3: return "Produksi";break;
			case 4: return "Distribusi";break;
			case 5: return "Neraca";break;
			case 6: return "IPDS";break;
			case 7: return "KSK";break;
			default: return "";
		}
	}
	
	function jmlhari($bln){
		switch ($bln) {
			case '01': return 31;break;
			case '02': return 28;break;
			case '03': return 31;break;
			case '04': return 30;break;
			case '05': return 31;break;
			case '06': return 30;break;
			case '07': return 31;break;
			case '08': return 31;break;
			case '09': return 30;break;
			case '10': return 31;break;
			case '11': return 30;break;
			case '12': return 31;break;
			default: return 0;
		}
	}
	
	function level($lvl){
		switch ($lvl) {
			case 1: return "Super Administrator";break;
			case 2: return "Administrator Prop";break;
			case 3: return "Administrator Kab";break;
			case 4: return "Supervisor Prop";break;
			case 5: return "Supervisor Kab";break;
			case 6: return "User";break;
			default: return 0;
		}
	}
	
	function satuan($satuan){
		switch ($satuan) {
		    case 0: return "_undefined";break;
			case 1: return "Blok_Sensus";break;
			case 2: return "Dokumen";break;
			case 3: return "Rumah_Tangga";break;
			case 4: return "Kegiatan";break;
			case 5: return "Paket";break;
			case 6: return "Perusahaan";break;
			case 7: return "Responden";break;
			case 8: return "Publikasi";break;
			case 9: return "Surat";break;
			case 10: return "Daftar";break;
			case 11: return "Kunjungan";break;
			case 12: return "Peta";break;
			case 13: return "Plot Bidang Ubinan";break;
			case 14: return "Laporan";break;
			case 15: return "Tabel";break;
			case 16: return "Naskah";break;
			case 17: return "File";break;
			case 18: return "Kabupaten/Kota";break;
			case 19: return "Jam";break;
			case 20: return "BRS";break;
			case 21: return "Buku";break;
			case 22: return "Eksemplar";break;
			case 23: return "Pertemuan";break;
			case 24: return "Database";break;
			case 25: return "O-P";break;
			case 26: return "Kali";break;
			case 27: return "Komoditas";break;
			case 28: return "Instansi";break;
			case 29: return "Peserta";break;
			case 30: return "Kode";break;
			case 31: return "Pegawai";break;
			case 32: return "Transaksi";break;
			case 33: return "Satuan Kerja";break;
			case 34: return "Objek";break;
			case 35: return "Orang";break;
			default: return 0;
		}
	}

	function waktu($waktu){
		switch ($waktu) {
			case 1: return "Hari";break;
			case 2: return "Jam";break;
			case 3: return "Menit";break;
			default: return 0;
		}
	}
	
	function eselon($eselon){
		switch ($eselon) {
			case 0: return "Semua Pegawai";break;
			case 3: return "Kepala Kantor";break;
			case 4: return "Kepala Seksi";break;
			case 9: return "Staff & KSK";break;
			default: return 0;
		}
	}
?>