<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        ชำระค่าห้องไม่เกินวันที่

    </h1>
    <ol class="breadcrumb hidden">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">ชำระค่าห้องไม่เกินวันที่</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?= base_url('pay_limit_date/update') ?>" method="POST">
                    <input type="hidden" name="id" value="<?=isset($id)?$id:''?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">ไม่เกินวันที่</label>
                            <div class="col-sm-5">
                                <input type="text" value="<?php echo isset($day)?$day:'' ?>" class="form-control"  name="day" data-validation="required,number" >
                            </div>
                             <label for="inputEmail3" class="col-sm-3 control-label">ของทุกเดือน</label>
                        </div>
                


                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="btn_submit" value="บันทึกและแก้ไขต่อ" class="btn btn-instagram pull-right margin-r-5">บันทึกและแก้ไขต่อ</button>
                       

                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->

        </div><!--/.col (right) -->
    </div>
</section><!-- /.content -->
<!-- Validate -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
<script> $.validate();</script>