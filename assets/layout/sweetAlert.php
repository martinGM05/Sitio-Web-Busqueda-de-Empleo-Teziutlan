<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
            if(isset($_GET['Error'])){
                //echo "<h1 class='text-danger text-center'>Usuario y/o password incorrecto</h1>";
                echo "<script type='text/javascript'>";
                if($_GET['Error'] == 400){
                    echo "swal('Precaución','Usuario y/o password incorrecto','warning');";
                }else if($_GET['Error'] == 401){
                    echo "swal('Precaución','No ha iniciado sesión','error');";
                }else if($_GET['Error'] == 402){
                    echo "swal('Precaución','Favor de llenar todos los campos','error');";
                }
                echo "</script>";
            }
        ?>