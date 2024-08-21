

  <?php  
                   if(count($DigiOrders) > 0) {
                      foreach ($DigiOrders as $OrderData) {
                   ?>

                                              <tr class="newclass<?php echo $OrderData->Status ?>"> 


                                                  <td>{{ $OrderData->OrderID }}</td>
                                                  <td>{{ $OrderData->PONumber }}</td>
                                                  <td>{{ $OrderData->DesignName }}</td>
                                                  <td>{{ $OrderData->CustomerName }}</td>
                                                  <td>{{ $OrderTypes[$OrderData->OrderType] }}</td>
                                                  <td>{{ $OrderData->DesignerName }}</td>
                                                  <td>{{ $OrderStatuses[$OrderData->Status] }}</td>
                                                  <td>
                                                    <Button class="btn btn-primary" onclick="location.href='{{ url('/admin/Norder-details/'.$OrderData->OrderID) }}'"> Detail</Button>
                                                  </td> 

                                                  
                                                </tr>

                                                 <?php  }} ?> 



                                              
                                                
                                                
                                               
                                                