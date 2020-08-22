<?php



header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=REPORTE_CATEGORIA.xls');

include('../../db.php');

try {
    $sql = "SELECT*FROM categoria";
    $run_query = oci_parse($con,$sql);					
    $ok = oci_execute($run_query);
    ?>
    
    <table>
    
        <tr>
            <th>ID</th>
            <th>NOMBRE CATEGORIA</th>
            <th>DESCRIPCION</th>
            
    
    
        </tr>
        <?PHP while($row = oci_fetch_object($run_query)){
            ?>
                <tr>
                    <td><?php echo $row->CAT_ID?></td>
                    <td><?php echo $row->CAT_NOMBRE?></td>
                    <td><?php echo $row->CAT_DESCRIPCION?></td>
                    
                </tr>
    <?php
        }
    ?>
        
    </table>
    <?php
    } catch (\Throwable $th) {
    echo "mala la wea";
    
    

}

