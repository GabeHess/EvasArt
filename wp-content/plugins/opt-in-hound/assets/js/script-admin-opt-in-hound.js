jQuery( function($) {

    /*
     * Strips one query argument from a given URL string
     *
     */
    function remove_query_arg( key, sourceURL ) {

        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";

        if (queryString !== "") {
            params_arr = queryString.split("&");
            for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                param = params_arr[i].split("=")[0];
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }

            rtn = rtn + "?" + params_arr.join("&");

        }

        if(rtn.split("?")[1] == "") {
            rtn = rtn.split("?")[0];
        }

        return rtn;
    }


    /*
     * Adds an argument name, value pair to a given URL string
     *
     */
    function add_query_arg( key, value, sourceURL ) {

        return sourceURL + '&' + key + '=' + value;

    }
    

    /******************************************************************/
    /* Init chosen
    /******************************************************************/
    if( $.fn.chosen != undefined ) {

        $('.oih-chosen').chosen();

    }

	/******************************************************************/
	/* Init color picker
	/******************************************************************/
	$('.oih-colorpicker').wpColorPicker();


    /******************************************************************/
    /* Init date picker
    /******************************************************************/
    $('.oih-datepicker').datepicker( {dateFormat: 'yy-mm-dd'} );


    /******************************************************************/
    /* Init slider
    /******************************************************************/
    if( $.fn.slider != undefined ) {

        $('.oih-range').each( function() {
            $(this).slider({
                min   : ( typeof $(this).data('min') != 'undefined' ? $(this).data('min') : 0 ),
                max   : ( typeof $(this).data('max') != 'undefined' ? $(this).data('max') : 100 ),
                value : ( typeof $(this).data('value') != 'undefined' ? $(this).data('value') : 0 ),
                step  : 1,
                range : "min",
                orientation: "horizontal",
                slide  : oih_update_slider_input_value
            });
        });

        function oih_update_slider_input_value( event, ui ) {
            $(ui.handle).parent().siblings('input').val( ui.value );
        }

        $(document).on( 'keyup', '.oih-settings-field-range input', function() {

            var value = $(this).val();
            
            if( value == '' )
                value = $(this).siblings('.oih-range').slider( 'option', 'min' );

            $(this).siblings('.oih-range').slider( 'value', parseInt( $(this).val() ) );

        });

    }


	/******************************************************************/
	/* Tab Navigation
	/******************************************************************/
	$('.oih-nav-tab').on( 'click', function(e) {
		e.preventDefault();

		// Nav Tab activation
		$('.oih-nav-tab').removeClass('oih-active').removeClass('nav-tab-active');
		$(this).addClass('oih-active').addClass('nav-tab-active');

		// Show tab
		$('.oih-tab').removeClass('oih-active');

		var nav_tab = $(this).attr('data-tab');
		$('.oih-tab[data-tab="' + nav_tab + '"]').addClass('oih-active');
		$('input[name=active_tab]').val( nav_tab );

        // Change http referrer
        $_wp_http_referer = $('input[name=_wp_http_referer]');

        var _wp_http_referer = $_wp_http_referer.val();
        _wp_http_referer = remove_query_arg( 'tab', _wp_http_referer );
        $_wp_http_referer.val( add_query_arg( 'tab', $(this).attr('data-tab'), _wp_http_referer ) );
		
	});


    /******************************************************************/
    /* Sub Tab Navigation
    /******************************************************************/
    $('.oih-nav-sub-tab').on( 'click', function(e) {
        e.preventDefault();

        // Nav sub tab activation
        $('.oih-nav-sub-tab').removeClass('oih-active').removeClass('current');
        $(this).addClass('oih-active').addClass('current');

        // Show sub tab
        $('.oih-sub-tab').removeClass('oih-active');

        var nav_sub_tab = $(this).attr('data-sub-tab');
        $('.oih-sub-tab[data-sub-tab="' + nav_sub_tab + '"]').addClass('oih-active');
        $('input[name=active_sub_tab]').val( nav_sub_tab );

        // Change http referrer
        $_wp_http_referer = $('input[name=_wp_http_referer]');

        var _wp_http_referer = $_wp_http_referer.val();
        _wp_http_referer = remove_query_arg( 'sub-tab', _wp_http_referer );
        $_wp_http_referer.val( add_query_arg( 'sub-tab', $(this).attr('data-sub-tab'), _wp_http_referer ) );
        
    });


	/******************************************************************/
    /* Show and hide back-end settings tool-tips
	/******************************************************************/
	$(document).on( 'mouseenter', '.oih-settings-field-tooltip-icon', function() {
		$(this).siblings('div').css('opacity', 1).css('visibility', 'visible');
	});
	$(document).on( 'mouseleave', '.oih-settings-field-tooltip-icon', function() {
		$(this).siblings('div').css('opacity', 0).css('visibility', 'hidden');
	});

	$(document).on( 'mouseenter', '.oih-settings-field-tooltip-wrapper.oih-has-link', function() {
		$(this).find('div').css('opacity', 1).css('visibility', 'visible');
	});
	$(document).on( 'mouseleave', '.oih-settings-field-tooltip-wrapper.oih-has-link', function() {
		$(this).find('div').css('opacity', 0).css('visibility', 'hidden');
	});


	/******************************************************************/
    /* Disable the uninstaller submit button until "REMOVE" is written in the input box
	/******************************************************************/
    $(document).on( 'keyup', '#oih-uninstall-confirmation', function(e) {
        
        e.preventDefault();
        
        $('#oih-uninstall-plugin-submit').prop('disabled', true);
        
        if( $(this).val() === 'REMOVE' )
            $('#oih-uninstall-plugin-submit').prop('disabled', false);

    });


    /******************************************************************/
    /* Enable the Continue button when selecting an opt-in type
	/******************************************************************/
	$('input[type=radio][name=opt_in_type]').click( function() {

		$('#oih-select-new-opt-in-type').attr( 'disabled', false );
		
	});

    /******************************************************************/
    /* Show the spinner next to the Continue button from the select
    /* opt-in type box
    /******************************************************************/
    $('#oih-select-new-opt-in-type').click( function() {
        $(this).siblings('.spinner').css( 'visibility', 'visible' ).css( 'opacity', 1 );
    });


    /******************************************************************/
    /* Settings Field: Image
    /******************************************************************/
    var frame;

    $(document).on('click', '.oih-settings-field-image-button-select, .oih-settings-field-image-button-replace', function(e) {
        
        e.preventDefault();

        $button      = $(this);

        $wrapper     = $button.closest('.oih-settings-field-image');
        $thumbnail   = $wrapper.find('img');
        $value_input = $wrapper.find('input[type=hidden]');

        // If the media frame already exists, reopen it.
        if ( frame ) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Use Image'
            },
            multiple: false
        });


        frame.on( 'select', function() {
      
            var attachment = frame.state().get('selection').first().toJSON();

            if( typeof attachment.sizes.medium != 'undefined' )
                attachment_url = attachment.sizes.medium.url;
            else
                attachment_url = attachment.url;
            
            $thumbnail.attr( 'src', attachment_url );
            $thumbnail.parent().show();
            $value_input.val( attachment.id ).trigger('change');

            $wrapper.find('.oih-settings-field-image-button-select').hide();

        });


        frame.open();

    });

    $('.oih-settings-field-image-button-remove').on('click', function(e) {

        e.preventDefault();

        if( ! confirm( "Are you sure you want to remove this image?" ) )
            return false;

        $button      = $(this);

        $wrapper     = $button.closest('.oih-settings-field-image');
        $thumbnail   = $wrapper.find('img');
        $value_input = $wrapper.find('input[type=hidden]');

        $thumbnail.attr( 'src', '' );
        $thumbnail.parent().hide();
        $value_input.val( '' ).trigger('change');

        $wrapper.find('.oih-settings-field-image-button-select').show();

    });


    /******************************************************************/
    /* Display settings fields based on checkbox field conditional value
    /******************************************************************/

    // Handle on page load
    $('.oih-settings-field[data-conditional]').each( function() {

        // Handle checkboxes, because they are special
        if( $( '.oih-settings-field input[type="checkbox"][name="' + $(this).data('conditional') + '"]' ).is(':checked') )
            $(this).show();

        // Handle rest of the fields if conditional value is set
        if( $( '.oih-settings-field [name="' + $(this).data('conditional') + '"]' ).attr('type') != 'checkbox' ) {

            if( typeof $(this).data('conditional-value') != 'undefined' ) {

                if( $( '.oih-settings-field [name="' + $(this).data('conditional') + '"]' ).val() == $(this).data('conditional-value') )
                    $(this).show();

            } else {

                if( $( '.oih-settings-field [name="' + $(this).data('conditional') + '"]' ).val() != 0 || $( '.oih-settings-field [name="' + $(this).data('conditional') + '"]' ).val() != '' )
                    $(this).show();

            }

        }

    });

    // Handle on field value change
    $('.oih-settings-field *').change( function() {

        $this = $(this);

        // Handle checkboxes
        if( $this.attr('type') == 'checkbox' ) {

            if( $this.is(':checked') )
                $('.oih-settings-field[data-conditional="' + $this.attr('name') + '"]').show();
            else
                $('.oih-settings-field[data-conditional="' + $this.attr('name') + '"]').hide();            

        // Handle rest of the fields
        } else {

            $('.oih-settings-field[data-conditional="' + $this.attr('name') + '"]' ).each( function() {

                if( typeof $(this).data('conditional-value') == 'undefined' ) {

                    if( $this.val() != '' )
                        $('.oih-settings-field[data-conditional="' + $this.attr('name') + '"]').show();
                    else
                        $('.oih-settings-field[data-conditional="' + $this.attr('name') + '"]').hide();

                } else {

                    $('.oih-settings-field[data-conditional="' + $this.attr('name') + '"]:not([data-conditional-value="' + $this.val() + '"])').hide();

                    $('.oih-settings-field[data-conditional="' + $this.attr('name') + '"][data-conditional-value="' + $this.val() + '"]').show();

                }

            });

        }
        
    });


    /******************************************************************/
    /* Disable a buttons
    /******************************************************************/
    $('a.oih-button-primary.disabled').click( function(e) {
        e.preventDefault();
    });


    /******************************************************************/
    /* List Linking Table
    /******************************************************************/

    /*
    // Adding a table row
    $(document).on( 'click', '.oih-table-list-linking .button-secondary', function(e) {

        e.preventDefault();

        $this = $(this);

        $this.blur();

        $table = $this.closest('table');

        $new_row = $table.find('tr.oih-placeholder').clone();
        $new_row.removeClass('oih-placeholder');

        $this.closest('tr').before( $new_row.attr( 'data-index', $table.find('tr[data-index]').last().data('index') + 1 ) );

    });

    // Removing a table row
    $(document).on( 'click', '.oih-table-list-linking tr .oih-remove', function() {

        $table = $(this).closest('table');

        $(this).closest('tr').remove();

        $table.find('select').first().trigger('change');

    });

    // Updating value for the hidden field
    $(document).on( 'change', '.oih-table-list-linking select', function() {

        var values = [];

        $table = $(this).closest('table');

        $table.find( 'tr[data-index]' ).each( function( index ) {

            var first = $(this).find('select').first().val();
            var last  = $(this).find('select').last().val();

            var value = {};

            value[first]  = last;
            values[index] = value;

        });

        values = ( values.length != 0 ? JSON.stringify( values ) : '' );

        $table.siblings('input[name=' + $table.data('name') + ']').val( values );

    });
    */


    /******************************************************************/
    /* Deactivation Form
    /******************************************************************/
    $('select[name=email_provider_account_id]').change( function() {

        $select = $(this);

        // Remove all related fields
        $('div[data-conditional=email_provider_account_id]').remove();
        
        if( $select.val() == 0 )
            return;

        // Disable select and show spinner
        $select.blur().attr( 'disabled', true );
        $select.siblings('.spinner').css( 'visibility', 'visible' );

        // Set-up the data
        data = {
            action : 'oih_opt_in_settings_email_provider_account_change',
            email_provider_account_id : $select.val()
        }

        // Get email provider account fields
        $.post( ajaxurl, data, function( response ) {

            response = JSON.parse( response );

            // Enable select and hide spinner
            $select.attr( 'disabled', false );
            $select.siblings('.spinner').css( 'visibility', 'hidden' );

            // If all good add fields and show them
            if( response.success == 1 ) {

                $select.closest('.oih-settings-field').after( response.data );
                $('[data-conditional=email_provider_account_id][data-conditional-value=' + data.email_provider_account_id + ']').show();

            }

        });

    });

    /******************************************************************/
    /* Deactivation Form
    /******************************************************************/
    $('.wp-admin.plugins-php tr[data-slug="opt-in-hound"] .row-actions .deactivate a').click(function(e) {
        e.preventDefault();  
        $('#oih-deactivate-modal').show();
    });

    $('#oih-deactivate-modal form input[type="radio"]').click(function () {
        $('#oih-deactivate-modal form textarea, #oih-deactivate-modal form input[type="text"]').hide();
        $(this).parents('li').next('li').children('input[type="text"], textarea').fadeIn().focus();
        $('#oih-deactivate-contact-me').fadeIn();
        $('#oih-feedback-submit').attr( 'disabled', false );
    });

    $('#oih-feedback-submit').click(function (e) {
        e.preventDefault();        
        $('#oih-deactivate-modal').hide();        
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                action: 'oih_send_deactivation_feedback',
                data: $('#oih-deactivate-modal form').serialize()
            },
            complete: function (MLHttpRequest, textStatus, errorThrown) {
                $('#oih-deactivate-modal').remove();
                window.location.href = $('.wp-admin.plugins-php tr[data-slug="opt-in-hound"] .row-actions .deactivate a').attr('href');   
            }
        });      
    });
    
    $('#oih-only-deactivate').click(function (e) {
        e.preventDefault();
        $('#oih-deactivate-modal').hide();        
        $('#oih-deactivate-modal').remove();
        window.location.href = $('.wp-admin.plugins-php tr[data-slug="opt-in-hound"] .row-actions .deactivate a').attr('href');
        
    });    
    
    $('.oih-deactivate-close').click(function (e) {
        e.preventDefault();
        $('#oih-deactivate-modal').hide();
    });

});