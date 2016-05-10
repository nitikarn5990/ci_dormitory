 
<section class="content-header">
    <h1>
        แก้ไขข้อมูลห้องเช่า

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

        <!--End Alert -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">ข้อมูล</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?= base_url('room/edit/'.$id) ?>" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">หมายเลขห้อง</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $number_room; ?>" class="form-control"  name="number_room" data-validation="required,number" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">รายละเอียด</label>
                            <div class="col-sm-10">
                                <textarea class="col-md-12" rows="10" name="detail" data-validation="required"><?php echo $detail; ?></textarea>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">เลขมิเตอร์ค่าไฟ เริ่มต้น</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $meter_electric; ?>" class="form-control"  name="meter_electric" data-validation="required,number" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">เลขมิเตอร์ค่าน้ำ เริ่มต้น</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $meter_water; ?>" class="form-control"  name="meter_water" data-validation="required,number" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">ค่าเช่าต่อเดือน (บาท)</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $price_per_month; ?>" class="form-control"  name="price_per_month" data-validation="required,number" >
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">สถานะ</label>
                            <div class="col-sm-10 ">
                                <ul class="<?=$status=='ว่าง'?'bg-success':'bg-danger'?>" style="list-style: none;padding: 10px 0 10px 10px;">
                                    <?php
                                    $getStatus = field_enums('room', 'status');

                                    foreach ($getStatus as $value) {
                                        ?>
                                        <li>
                                            <input type="radio" name="status" id="status" value="<?php echo $value ?>" <?= $value == $status ? 'checked' : '' ?>  data-validation="required"/>
                                            <label><?php echo $value ?></label>
                                        </li>
                                        <?php
                                       
                                    }
                                    ?>
                                </ul>

                            </div>
                        </div>


                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="btn_submit" value="บันทึกและแก้ไขต่อ" class="btn btn-instagram pull-right margin-r-5">บันทึกและแก้ไขต่อ</button>
                        <button type="submit" name="btn_submit" value="บันทึก" class="btn btn-instagram pull-right  margin-r-5">บันทึก</button>&nbsp;&nbsp;

                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->

        </div><!--/.col (right) -->
    </div>
</section><!-- /.content -->
<!-- Validate -->

<script src="<?= base_url() ?>assets/plugins/validate/jquery.form-validator.min.js"></script>
<script> $.validate();</script>