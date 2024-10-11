<?php
 require_once 'rendicion.php';
 $objecto = new rendicion();
 $listar = $objecto->listarGastosVarios(1);
 while( $item = mysqli_fetch_array($listar))
 {
         ?>
           <tr>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['descripcion'];?></td>
              <td><?php echo $item['comprobante'];?></td>
              <td><?php echo $item['importe'];?></td>
              <td> 
                <a class="btn btn-primary btn-sm" id="borrarGV<?php echo $item['idgastosvarios'];?>" > X</a>
              </td>
          </tr>
          <?
           }
          ?>
          </tbody>
         </table>
         ?>