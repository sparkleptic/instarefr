 <!-- Current Page Info-->
<?php if($this->session->flashdata('flsh_msg') != null) { echo "<h2>".$this->session->flashdata('flsh_msg')."</h2>"; } ?>
<div class="points-table-container">
    <div class="container">
    <?php $this->load->view('common/common-msg'); ?>
        <div class="row">
            <div id="content" class="col-md-9 col-sm-12 col-xs-12">
                <div class="points-table-heading clearfix">
                    <div class="points-col-1 d-inline-block points-table-head">Point Rule</div>
                    <div class="points-col-2 d-inline-block points-table-head">Point Type</div>
                    <div class="points-col-3 d-inline-block points-table-head">Transaction Date</div>
                    <div class="points-col-4 d-inline-block points-table-head">Transaction Points</div>
                    <div class="points-col-5 d-inline-block points-table-head">Current Points</div>
                </div>
                <div class="points-table-contents">
                     <?php if(!empty($points_list))
                     {
                        foreach($points_list as $point) { 
                            $type_color_class = "credit-color";
                            $amount_color_class = "points-and-date-color";
                            if($point->rule_type == 'Debit')
                            {
                                $type_color_class = "debit-color";
                                $amount_color_class = "minus-points-color";
                            }
                        echo '<div class="points-table-row clearfix">
                            <div class="points-col-1 d-inline-block points-table-cell">'.$point->rule_name.'</div>
                            <div class="points-col-2 d-inline-block points-table-cell '.$type_color_class.'">'.$point->rule_type.'</div>
                            <div class="points-col-3 d-inline-block points-table-cell points-and-date-color">'.$point->insta_points_transaction_date.'</div>
                            <div class="points-col-4 d-inline-block points-table-cell points-and-date-color '.$amount_color_class.'">'.$point->insta_points_transaction_amount.'</div>
                            <div class="points-col-5 d-inline-block points-table-cell points-and-date-color">'.$point->insta_points_transaction_current_points.'</div>
                        </div>';

                        }
                     }else{
                        echo '<div class="points-table-row clearfix">
                            <div class="points-col-1 d-inline-block points-table-cell">-</div>
                            <div class="points-col-2 d-inline-block points-table-cell">-</div>
                            <div class="points-col-3 d-inline-block points-table-cell points-and-date-color">-</div>
                            <div class="points-col-4 d-inline-block points-table-cell points-and-date-color">0</div>
                            <div class="points-col-5 d-inline-block points-table-cell points-and-date-color">0</div>
                        </div>';
                     }
                     ?>                    
                </div>
            </div>
           <?php $this->load->view('common/inner-sidebar'); ?>
        </div>
    </div>
</div>

