<?php



header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=REPORTE LIBROS.xls');

include('../../db.php');

try {
    $sql = "SELECT*FROM libros";
    $run_query = oci_parse($con,$sql);					
    $ok = oci_execute($run_query);
    ?>
    
    <table>
    
        <tr>
            <th>ID</th>
            <th>CATEGORIA</th>
            <th>TIPO LIBRO</th>
            <th>NOMBRE LIBRO</th>
            <th>PRECIO</th>
            <th>DESCRIPCION</th>
            <th>STOCK</th>
            <th>EDITORIAL</th>
            <th>AUTOR</th>

            
    
    
        </tr>
        <?PHP while($row = oci_fetch_object($run_query)){
            ?>
                <tr>
                    <td><?php echo $row->LIBRO_ID?></td>
                    <td><?php echo $row->LIBRO_CAT?></td>
                    <td><?php echo $row->LIBRO_ESCR?></td>
                    <td><?php echo $row->LIBRO_NOMBRE?></td>
                    <td><?php echo $row->LIBRO_PRECIO?></td>
                    <td><?php echo $row->LIBRO_DESCR?></td>
                    <td><?php echo $row->STOCK?></td>
                    <td><?php echo $row->LIBRO_EDITORIAL?></td>
                    <td><?php echo $row->LIBRO_AUTOR?></td>
                    
                </tr>
    <?php
        }
    ?>
        
    </table>
    <?php
    } catch (\Throwable $th) {
    echo "mala la wea";
    
    

}

