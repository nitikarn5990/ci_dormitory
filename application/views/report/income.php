<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-file-text"></i> รายงานสรุปรายรับประจำเดือน
    </h1>
    <ol class="breadcrumb hidden">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!--Alert -->
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('message_success')) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('message_success') ?>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('message_error')) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('message_error') ?>
                </div>
            <?php } ?>



        </div>
        <div class="col-md-12">
            <form action="<?= base_url() ?>report/income" method="POST">
                <div class="box box-success">

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> ค้นหา</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label class="control-label col-md-2">ตั้งแต่เดือน</label>
                            <div class="col-md-4">
                                <div id="datepicker1" data-date="<?= $this->input->post('pay_monthly1') == '' ? '12/03/2012' : $this->input->post('pay_monthly1') ?>"></div>
                                <input type="hidden" id="my_hidden_input1" name="pay_monthly1">
                            </div>
                            <div class="col-md-1 text-center">
                                ถึง
                            </div>

                            <div class="col-md-4">
                                <div id="datepicker2" data-date="<?= $this->input->post('pay_monthly2') == '' ? '12/03/2012' : $this->input->post('pay_monthly2') ?>"></div>
                                <input type="hidden" id="my_hidden_input2" name="pay_monthly2">
                            </div>
                        </div>


                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info" name="btn_submit" value="ค้นหา"><i class="fa fa-search"></i> ค้นหา</button>
                        <a href="<?= base_url() ?>report/income" class="btn btn-info"><i class="fa fa-list-alt"></i> แสดงทั้งหมด</a>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header">
                        <h3><i class="fa fa-list"></i> แสดงข้อมูลที่ค้นหา</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>   
                                        <th>เลขที่สัญญา</th>
                                        <th>ชื่อ</th>
                                        <th>หมายเลขห้อง</th>
                                        <th>ประจำเดือน</th>
                                        <th>ยอดชำระแล้ว</th>
                                      
                                       
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $total_income = 0;
                                    foreach ($res_active_rent as $key => $row) {

                                        $result_active_payment = $this->db->get_where('active_payment', array('active_rent_id' => $row['id']))->result_array();

                                        //หายอดเงินที่ชำระมาแล้ว
                                        $total_paid = 0;
                                        foreach ($result_active_payment as $rows) {

                                            $total_paid = $total_paid + $rows['total_paid'];
                                        }


                                        $water_rate = $this->db->get_where('water_rate', array('id' => 1))->row_array()['rate_price'];
                                        $electric_rate = $this->db->get_where('electric_rate', array('id' => 1))->row_array()['rate_price'];


                                        //หา เลขมิเตอร์เดือนที่แล้ว
                                        $result_active_rent_last_count = $this->db->get_where('active_rent', array('rental_id' => $row['rental_id'], 'pay_monthly' => Add_month('-1', $row['pay_monthly'])))
                                                ->num_rows();

                                        if ($result_active_rent_last_count == 0) {

                                            $price_el = ( $row['meter_electric_last'] - $row['meter_electric'] ) * $electric_rate;
                                            $price_water = ( $row['meter_water_last'] - $row['meter_water'] ) * $water_rate;
                                        } else {
                                            $result_active_rent_before = $this->db->get_where('active_rent', array('rental_id' => $row['rental_id'], 'pay_monthly' => Add_month('-1', $row['pay_monthly'])))
                                                    ->row_array();
                                            $price_el = ( $row['meter_electric_last'] - $result_active_rent_before['meter_electric_last'] ) * $electric_rate;
                                            $price_water = ( $row['meter_water_last'] - $result_active_rent_before['meter_water_last'] ) * $water_rate;
                                        }

                                        $still_pay = ($row['internet'] + $row['deposit'] + $row['price_per_month'] + $price_el + $price_water) - $total_paid;


                                        if ($row['meter_electric_last'] == 0 && $row['meter_water_last'] == 0) {
                                            $txt_msg = 'รอชำระเงิน';
                                            $bg = 'bg-warning';
                                        } else {

                                            if ($still_pay > 0) { //ถ้าชำระไม่หมด
                                                $txt_msg = 'ค้างชำระ';
                                                $bg = 'bg-danger';
                                            } else {
                                                $txt_msg = 'ชำระแล้ว';
                                                $bg = 'bg-success';
                                            }
                                        }
                                        
                                        $total_income = $total_income + $total_paid;
                                        ?>

                                        <tr class="bg-success">
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $row['rental_id'] ?></td>
                                            <td><?= $row['customer_firstname'] . ' ' . $row['customer_lastname'] ?></td>
                                            <td><?= $row['number_room'] ?></td>
                                            <td><?= $row['pay_monthly'] ?></td>
                                            <td><?= $total_paid ?></td>
                                         
                                         

                                        </tr>
                                    <?php } ?>
                                        <tr class="bg-green-active">
                                            <td colspan="5" class="text-right">รวมรายรับทั้งสิ้น</td>
                                             <td ><?=$total_income?></td>
                                        </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->



<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatable2/semantic.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatable2/dataTables.semanticui.min.css">

<script src="<?= base_url() ?>assets/plugins/datatable2/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable2/dataTables.semanticui.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable2/semantic.min.js"></script>

<!-- date-range-picker -->

<style>
    .ui-datepicker-calendar {

        display: none;

    }​

</style>
<script>
    $(document).ready(function () {
        $('#example').DataTable();

        $("#chkboxall").click(function (e) {
            $('.chkbox').prop('checked', this.checked);
        });

        //date start
        $('#datepicker1').datepicker({
            format: 'yyyy-mm',
            todayHighlight: true,
            language: 'th',
            minViewMode: 'months',
        });
        $('#datepicker1').on("changeDate", function () {
            $('#my_hidden_input1').val(
                    $('#datepicker1').datepicker('getFormattedDate')
                    );
        });
        $('#my_hidden_input1').val(
                $('#datepicker1').datepicker('getFormattedDate')
                );

//date end
        $('#datepicker2').datepicker({
            format: 'yyyy-mm',
            todayHighlight: true,
            language: 'th',
            minViewMode: 'months',
        });
        $('#datepicker2').on("changeDate", function () {
            $('#my_hidden_input2').val(
                    $('#datepicker2').datepicker('getFormattedDate')
                    );
        });
        $('#my_hidden_input2').val(
                $('#datepicker2').datepicker('getFormattedDate')
                );




    });




</script>
