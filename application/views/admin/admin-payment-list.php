<?php
   
?>   
        <!-- page content -->
        <div class="right_col" role="main">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php $this->load->view('common/common-msg'); ?>
                    <h2>Pyament Transaction List <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                 
                  <div class="x_content">
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Candidate Name</th>
                          <th>Transaction Id</th>
                          <th>Amount</th>
                          <th>Points</th>
                          <th>Current Points</th>
                          <th>Candidate IP</th>
                          <th>Payment Date</th>
                          
                          
                        </tr>
                      </thead>
                     <tbody>
                       <?php 
                       if(!empty($payment_list))
                       {
                          foreach($payment_list as $val)
                           {
                                  echo '<tr>
                              <td>'.$val->insta_user_name.'</td>
                              <td>'.$val->insta_payment_transaction_id.'</td>
                               <td>'.$val->insta_payment_amount.'</td>';
                               
                                echo '<td>'.$val->insta_payment_points.'</td>
                                  <td>'.$val->insta_current_points.'</td>
                            
                                <td>'.$val->insta_payment_user_ip.'</td>
                               <td>'.$val->insta_payment_date.'</td>
                              </tr>';
                           }
                           
                       }
                       
            ?>
                        
                                           
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
        </div>
        <!-- /page content <a href="'.base_url().'admin/delete/'.$user_list['user'][$i]->insta_user_id.'/user" onClick="return doconfirm();"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>-->

<script>
$(document).ready(function() {
    $('#datatable-responsive').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
         "ordering": false
    } );
} );
</script>

        

    