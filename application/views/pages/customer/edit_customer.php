<div class="m-2">
    <form method="post" action="<?php echo base_url("/customer/updatecustomer"); ?>" enctype='multipart/form-data'>
        <input type="hidden" name="customerid" value="<?php echo (isset($customerid) ? $customerid : '') ?>">
        <div class="form-group">
            <label for="customername">Customer name</label>
            <input type="text" class="form-control" id="customername" name="customername"  value="<?php echo (isset($customername) ? $customername : '') ?>" placeholder="Customer name">
        </div>
       
        <div class="form-group">
            <label for="mobile">Mobile Number</label>
            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo (isset($mobile) ? $mobile : '') ?>" placeholder="Mobile Number">
        </div>
        <div class="form-group">
            <label for="email">Email ID</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo (isset($email) ? $email : '') ?>" placeholder="Email ID">
        </div>
        <div class="row">
            <div class="col-4 form-group">
                <label for="item">Item</label>
                <input type="text" class="form-control" <?php echo (isset($item) && $item ? '' : 'disabled') ?> id="item" name="item" value="<?php echo (isset($item) ? $item : '') ?>" placeholder="Item">
            </div>
            <div class="col-4 form-group">
                <label for="value">Value</label>
                <input type="text" class="form-control" <?php echo (isset($value) && $value ? '' : 'disabled') ?> id="value" name="value" value="<?php echo (isset($value) ? $value : '') ?>" placeholder="Value">
            </div>
                <button id="enableitem" class="col-1 m-1 btn btn-primary <?php echo(((!isset($item) || $item== "") && (!isset($value) || $value == "") ) ? "" : 'd-none') ?>">+</button>
                <button id="clearitem" class="col-1 m-1 btn btn-danger <?php echo(((isset($item) && $item != "") && (isset($value) && $value != "") ) ? "" : 'd-none') ?>">-</button>
            </div>

      
        <div class="form-group">
            <label for="date_time">Date / Time </label>
            <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="<?php echo (isset($date_time) ? $date_time : '') ?>" placeholder="Date / Time">
        </div>
         <div class="form-group row">
            <div class="col"> 
                <label for="resume">Profile Image</label>
                <input type="file" class="form-control" id="profileimg" name="profileimg">
            </div>
            <?php if($profileimg != "null") {?>
           <div class="col text-center">
                <div>
                    <img style="max-width:100px;max-height:100px" src="<?php echo $profileimg ?>">
                </div>
                <div class="m-2">
                    <a class='btn btn-primary m-1' href='<?php echo $profileimg?>' download> Download Profile image </a>
                    <a href="<?php echo base_url("/customer/deleteprofileimg/{$customerid}")?>" class="btn btn-danger">Delete profile image</a>
                </div>
           </div>
           <?php }?>
        </div>
        <input type="reset" class="btn btn-secondary">
        <button class="btn btn-primary">Update Customer</button>
        
    </form>
</div>
