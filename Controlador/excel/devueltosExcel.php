<?php



header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=REPORTE LIBROS DEVUELTOS.xls');

include('../../db.php');

try {
    $sql = "SELECT*FROM devuelto";
    $run_query = oci_parse($con,$sql);					
    $ok = oci_execute($run_query);
    ?>
    
    <table>
    
        <tr>
            <th>ID DEVOLUCION</th>
            <th>USUARIO</th>
            <th>MOTIVO</th>
            <th>FECHA DEVOLUCION</th>
            <th>BOUCHER</th>
            <th> ID LIBRO</th>
            <th>ID DETALLE</th>
          
          

            
    
    
        </tr>
        <?PHP while($row = oci_fetch_object($run_query)){
            ?>
                <tr>
                    <td><?php echo $row->ID_DEVOLUCION?></td>
                    <td><?php echo $row->USER_ID?></td>
                    <td><?php echo $row->MOTIVO?></td>
                    <td><?php echo $row->FECHA_DEVOLUCION?></td>
                    <td><?php echo $row->BOUCHER?></td>
                    <td><?php echo $row->LIBRO_ID?></td>
                    <td><?php echo $row->ID_DETALLE?></td>
                    
                    
                </tr>
    <?php
        }
    ?>
        
    </table>
    <?php
    } catch (\Throwable $th) {
    echo "mala la wea";
    
    

}

