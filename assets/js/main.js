    let emptable;
    $(document).ready(function(){

        if($('#customertable')){
            emptable = $('#customertable').DataTable( {
                serverSide: true,
                processing: true,
                "ajax": {
                    "url": "customer/getcustomers",
                    "data": function ( d ) {
                        d.qualification =  $('#qualfilter').val();
                        // d.custom = $('#myInput').val();
                        // etc
                    }
                },
                dom: '<"#positionFilter">t'
            } );
            
        
        }
        
        
        
        if($('#enableitem')){
            $('#enableitem').click(function(e){
                e.preventDefault()
            $('#item').removeAttr('disabled')
            $('#value').removeAttr('disabled')
            $(this).addClass('d-none')
            $("#clearitem").removeClass('d-none')
            });
        }
        if($('#clearitem')){
            $('#clearitem').click(function(e){
                e.preventDefault()
            $('#item').val('').attr('disabled','true')
            $('#value').val('').attr('disabled','true')
            $(this).addClass('d-none')
            $("#enableitem").removeClass('d-none')
            });
        }
    })

