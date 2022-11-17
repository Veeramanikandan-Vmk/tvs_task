<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TVS | <?php echo $title?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.2/css/searchPanes.dataTables.min.css">
</head>
<body>
    <div class="">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo base_url('/customer')?>">TVS Task</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url("/customer/new") ?>">Add New<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url("/customer") ?>">View all</a>
                    </li>
                   
                </ul>
                <div class="accountinfo text-light">
                    <span>Hi <?php echo $this->session->userdata('user') ? $this->session->userdata('user')->username : 'Anonymous' ?> !</span>
                    <a href="<?php echo base_url('/account/logout');?>">Logout</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="m-2">
        <?php $this->load->view($page);?>
    </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/searchpanes/2.0.2/js/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url("/assets/js/main.js") ?>"></script>
</html>