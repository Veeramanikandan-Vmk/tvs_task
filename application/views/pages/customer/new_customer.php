<div class="m-2">
    <form method="post" action="<?php echo base_url("/customer/addcustomer") ?>" enctype='multipart/form-data'>
        <div class="form-group">
            <label for="customername">Customer name</label>
            <input type="text" class="form-control" id="customername" name="customername"  value=""placeholder="Customer name">
        </div>
        <div class="form-group">
            <label for="mobile">Mobile Number</label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number">
        </div>
        <div class="form-group">
            <label for="email">Email ID</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email ID">
        </div>
        <div class="row">
            <div class="col form-group">
                <label for="item">Item</label>
                <input type="text" class="form-control" id="item" name="item" placeholder="Item">
            </div>
            <div class="col form-group">
                <label for="value">Value</label>
                <input type="text" class="form-control" id="value" name="value" placeholder="Value">
            </div>
        </div>
        <div class="form-group">
            <label for="date_time">Date / Time</label>
            <input type="datetime-local" class="form-control" id="date_time" name="date_time" placeholder="Date / Time">
        </div>
        <div class="form-group">
            <label for="resume">Profile Image</label>
            <input type="file" class="form-control" id="profileimg" name="profileimg">
        </div>  
        <input type="reset" class="btn btn-secondary">
        <button class="btn btn-primary">Add Customer</button>
        
    </form>
</div>
