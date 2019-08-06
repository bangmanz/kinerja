<?php include "mod_top_tiles.php";?>
<link rel="stylesheet" type="text/css" media="screen" href="css/hoverstyle.css"/>
  <div class="container">
        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3> </h3>
            </div>
        </div>
        <!-- /.row -->
 		<hr>
        <!-- Page Features -->
        <div class="row text-center">

            <div class="col-md-3 col-sm-6 hero-feature tilt pic">
                <div class="thumbnail">
                    <a href="?page=pertanggal"><img src="images/table.png" alt=""></a>
                    <div class="caption">
                        <h3>Matriks Kegiatan</h3>
                        <p></p>
                       
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature vertpan pic">
                <div class="thumbnail">
                    <a href="?page=viewdaftarpenugasan"><img src="images/work.png" alt=""></a>
                    <div class="caption">
                        <h3>Daftar Penugasan</h3>
                        <p></p>
                       
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature morph pic">
                <div class="thumbnail">
                    <a href="?page=viewdaftarpenugasanpertanggal"><img src="images/tanggal.png" alt=""></a>
                    <div class="caption">
                        <h3>Kegiatan Harian</h3>
                        <p></p>
                      
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature blur pic">
                <div class="thumbnail">
                    <img src="images/help.png" alt="">
                    <div class="caption">
                        <h3>Bantuan</h3>
                        <p></p>
                      
                    </div>
                </div>
            </div>

        </div>


        <hr>
        <div class="col-md-12">
            <?php
                $query = 'SELECT * FROM quote ORDER BY RAND() LIMIT 1';
                if($sql=$mysqli->query($query)){
                    while($result=$sql->fetch_array()){
                        echo "
                        <blockquote>
                            <p>
                                ".$result[1]."
                            </p> <small>".$result[2]." - <cite>".$result[3]."</cite></small>
                        </blockquote>";
                    }
                }
            ?>
           
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <p>Copyright &copy; bps1805 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->