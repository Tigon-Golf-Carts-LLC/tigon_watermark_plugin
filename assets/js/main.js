jQuery( document ).ready(function(){

    jQuery('.tigonwm_tablewrapper table')?.dataTable({
        order: [[0, 'desc']],   
    });

    jQuery(document).on('click', '.tigonwm_addnew', function(){
        if ( !jQuery('#tigonwm_addnew_input').val() ) 
        {
            alert('Input can not be empty!');
        }
        else
        {
            jQuery(this).html('Adding...');
            jQuery.ajax({
                url      : olm_ajax_url.ajax_url,
                type     : 'POST',
                data     : {
                    action    : 'add_watermark',
                    watermark : jQuery('#tigonwm_addnew_input').val(),
                },
                success : function(response){
                    location.reload();
                }
            });
        }
    }); 
    

    jQuery(document).on('click', '.tigonwm_editlabel', function(){
        var crntid    = jQuery(this).data('crntid');
        var new_label = jQuery('#tigonwm_editinput_'+crntid).val(); 
        
        if ( !new_label ) 
        {
            alert('Input can not be empty');
        }
        else
        {
            jQuery(this).html('Updating...');
            jQuery.ajax({
                url      : olm_ajax_url.ajax_url,
                type     : 'get',
                data     : {
                    action    : 'update_watermark',
                    watermark : new_label,
                    crntid    : crntid,
                },
                success : function(response){
                    location.reload();
                }
            });
        }
    });

    jQuery(document).on('click', '.tigonwm_delbtn', function(){
        
        if ( confirm('Are you sure to delete this location?') )
        {
            jQuery(this).html('Deleting...');
            jQuery.ajax({
                url      : olm_ajax_url.ajax_url,
                type     : 'get',
                data     : {
                    action    : 'date_watermark',
                    crntid    : jQuery(this).data('crntid'),
                },
                success : function(response){
                    location.reload();
                }
            });
        }
    });


});
