<?php



header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=REPORTE LIBROS.xls');

include('../../db.php');

try {
    $sql = "SELECT*FROM venta";
    $run_query = oci_parse($con,$sql);					
    $ok = oci_execute($run_query);
    ?>
    
    <table>
    
        <tr>
            <th>ID VENTA</th>
            <th>ID LIBRO</th>
            <th>TOTAL</th>
            <th>CANTIDAD LIBRO</th>
            <th>DESCUENTO</th>
          

            
    
    
        </tr>
        <?PHP while($row = oci_fetch_object($run_query)){
            ?>
                <tr>
                    <td><?php echo $row->IDVENTA?></td>
                    <td><?php echo $row->IDLIBRO?></td>
                    <td><?php echo $row->TOTAL?></td>
                    <td><?php echo $row->CANTIDAD?></td>
                    <td><?php echo $row->DESCUENTO?></td>
                    
                    
                </tr>
    <?php
        }
    ?>
        
    </table>
    <?php
    } catch (\Throwable $th) {
    echo "mala la wea";
    
    

}

