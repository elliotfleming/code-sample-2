// js/scripts.js


///////////////////////////////////////////////////////////////////////////////////////////////////
// Global Namespace //////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

// Get the user's location
function getLocation(callback) {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(
     
            function (position)
            {
                callback(position.coords.latitude, position.coords.longitude);
            },

            function (error)
            {
                switch(error.code)
                {
                    case error.TIMEOUT:
                        console.log('Timeout');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        console.log('Position unavailable');
                        break;
                    case error.PERMISSION_DENIED:
                        console.log('Permission denied');
                        break;
                    case error.UNKNOWN_ERROR:
                        console.log('Unknown error');
                        break;
                }
            }
        );
    }
}

function getLatLong(address, next) {

    var geo = new google.maps.Geocoder();

    geo.geocode({'address':address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            next(results[0].geometry.location.lat(), results[0].geometry.location.lng());
        } else {
            console.log("Geocode was not successful for the following reason: " + status);
        }
    });
}

function distance(lat1,lon1,lat2,lon2) {
    var R = 6371; // km (change this constant to get miles)
    var dLat = (lat2-lat1) * Math.PI / 180;
    var dLon = (lon2-lon1) * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(lat1 * Math.PI / 180 ) * Math.cos(lat2 * Math.PI / 180 ) *
    Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c;
    return Math.round(d*0.621371);
    return d;
}


///////////////////////////////////////////////////////////////////////////////////////////////////
// jQuery ////////////////////////////////////////////////////////////////////////////////////////
// Use a closure (self-invoking anonymous function) to encapsulate jQuery ///////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

(function($) {


    // Functions //////////////////////////////////////////////////////////////////////////////

    // Use the user supplied address and city to autofill the state and zip inputs
    function autofill(address, callback) {
        var geo = new google.maps.Geocoder();
        geo.geocode({'address':address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var components = results[0].address_components,
                    response = {};
                $.each(components, function() {
                    if (this.types[0] == 'administrative_area_level_1') {
                        response.state = this.short_name;
                    }
                    if (this.types[0] == 'postal_code') {
                        response.zip = this.short_name;
                    }
                });
                callback(response);
            } else {
                console.log("Geocode was not successful for the following reason: " + status);
            }
        });
    }


    // Plugins ////////////////////////////////////////////////////////////////////////////////

    // Toggle between two states
    $.fn.toggler = function( fn, fn2 ) {

        var args = arguments,
            guid = fn.guid || $.guid++,
            i = 0,
            toggler = function( event ) {

                var lastToggle = ( $._data( this, "lastToggle" + fn.guid ) || 0 ) % i;

                $._data( this, "lastToggle" + fn.guid, lastToggle + 1 );

                event.preventDefault();

                return args[lastToggle].apply( this, arguments ) || false;
            };

        toggler.guid = guid;

        while ( i < args.length ) {

            args[i++].guid = guid;
        }

        return this.click( toggler );
    };


    ///////////////////////////////////////////////////////////////////////////////////////////////
    // Ready function ////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////
    
    $(function() {

        // Toggle the login/logout menu visibility
        $('.auth-toggle').toggler(function() {
            $('.auth').slideDown(300);
            $('.icon-arrow-down').removeClass('icon-arrow-down').addClass('icon-arrow-up');
        }, function() {
            $('.auth').slideUp();
            $('.icon-arrow-up').removeClass('icon-arrow-up').addClass('icon-arrow-down');
        });

        // Handle AJAX login submission
        $('.auth form').submit(function(event) {
            event.preventDefault();
            $(this).find('[type="submit"]').attr('disabled', 'disabled');
            var form_data = {},
                submit_url = $(this).attr('action'), 
                $form_inputs = $(this).find(':input');
            $form_inputs.each(function() {
                form_data[this.name] = $(this).val();
            });
            $.ajax({
                url: submit_url,
                type: 'POST',
                data: form_data,
                success: function(data) {
                    if (data) {
                        //data = JSON.parse(data);
                        data = $.parseJSON(data);
                        if (data.message.status) {
                            if ($('.message').is(':visible')) {
                                $('.message').fadeTo(300, 0.01).slideUp();
                            }
                            $('.auth .logout-via-ajax').removeAttr('disabled');
                            $('.auth').slideUp(400, function() {
                                $('.icon-arrow-up').removeClass('icon-arrow-up').addClass('icon-arrow-down');
                                $('.auth .toggle-form, .auth .logged-out').hide();
                                $('.auth .logged-in .email').text(data.email);
                                $('.auth .logged-in').show(function() {
                                    $('.auth').slideDown();
                                    $('.icon-arrow-down').removeClass('icon-arrow-down').addClass('icon-arrow-up');
                                });
                            });
                        } else {
                            $('.auth form').find('[type="submit"]').removeAttr('disabled');
                            $('.message').html(data.message.errors).slideDown(500).fadeTo(500, 1);
                        }
                    }
                },
                error: function() {
                    $('.auth form').find('[type="submit"]').removeAttr('disabled');
                    $('.message').html('<p class="error_msg">You could not be logged in due to a server error. Please try again.</p>').slideDown(500).fadeTo(500, 1);
                }
            });
        });

        // Handle AJAX logouts
        $('.auth .logout-via-ajax').click(function(event) {
            event.preventDefault();
            $(this).attr('disabled', 'disabled');
            $.ajax({
                url: '/auth/logout_via_ajax',
                type: 'POST',
                success: function(data) {
                    if (data) {
                        //data = JSON.parse(data);
                        data = $.parseJSON(data);
                        $('.auth form').find('[type="submit"]').removeAttr('disabled');
                        $('.auth').slideUp(400, function() {
                            $('.auth-toggle').click();
                            $('.auth .toggle-form, .auth .logged-in').hide();
                            $('.auth .logged-out').show(function() {
                                $('.message').html(data.message.status).slideDown(500).fadeTo(500, 1, function() {
                                    $(this).delay(4000).fadeTo(1000, 0.01).slideUp(500);
                                });
                            });
                        });
                    }
                },
                error: function() {
                    $('.auth .logout-via-ajax').removeAttr('disabled');
                    $('.message').html('<p class="error_msg">You could not be logged out due to a server error. Please try again.</p>').slideDown(500).fadeTo(500, 1);
                }
            });
        });

        // Fade out status messages, but ensure error messages stay visable.
        if ($('.status_msg').length > 0) {
            $('.standard-message').delay(4000).fadeTo(1000, 0.01).slideUp(500);
        }

        // Show more of the event notes
        $('.show-more').click(function(event) {
            event.preventDefault();
            var id = $(this).attr('data');
            var target = '#description_' + id;
            $(target + ' .short-description').hide();
            $(target + ' .full-description').add(target + ' .show-less').show();
        });

        // Show less of the event notes
        $('.show-less a').click(function(event) {
            event.preventDefault();
            var id = $(this).attr('data');
            var target = '#description_' + id;
            $(target + ' .full-description').add(target + ' .show-less').hide();
            $(target + ' .short-description').show();
        });

        // Call the autofill function when the user leaves the 'city' input
        $('#city').blur(function() {
            autofill($('#address').val() + ', ' + $('#city').val(), function(response) {
                $('#state').val(response.state);
                $('#zip').val(response.zip);
            });
        });

        // Call the autofill function when the user makes changes to the address and there is already a value for city
        $('#address').change(function() {
            if ($('#city').val() != undefined && $('#city').val() != '') {
                autofill($('#address').val() + ', ' + $('#city').val(), function(response) {
                    $('#state').val(response.state);
                    $('#zip').val(response.zip);
                });
            }
        });


        // IE Fixes ///////////////////////////////////////////////////////////////////////////

        // Provide placeholder attribute style functionality for < IE 10
        $('.ie #name').val('Name your event').addClass('muted');
        $('.ie #name').focus(function() {
            if ($(this).val() == 'Name your event') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #name').blur(function() {
            if ($(this).val() == '') {
                $(this).val('Name your event').addClass('muted');
            }
        });
        $('.ie #date').val('mm/dd/yyyy').addClass('muted');
        $('.ie #date').focus(function() {
            if ($(this).val() == 'mm/dd/yyyy') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #date').blur(function() {
            if ($(this).val() == '') {
                $(this).val('mm/dd/yyyy').addClass('muted');
            }
        });
        $('.ie #time').val('hh:mm am/pm').addClass('muted');
        $('.ie #time').focus(function() {
            if ($(this).val() == 'hh:mm am/pm') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #time').blur(function() {
            if ($(this).val() == '') {
                $(this).val('hh:mm am/pm').addClass('muted');
            }
        });
        $('.ie #address').val('321 Who Dat Street').addClass('muted');
        $('.ie #address').focus(function() {
            if ($(this).val() == '321 Who Dat Street') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #address').blur(function() {
            if ($(this).val() == '') {
                $(this).val('321 Who Dat Street').addClass('muted');
            }
        });
        $('.ie #city').val('New Orleans').addClass('muted');
        $('.ie #city').focus(function() {
            if ($(this).val() == 'New Orleans') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #city').blur(function() {
            if ($(this).val() == '') {
                $(this).val('New Orleans').addClass('muted');
            }
        });
        $('.ie #state').val('LA').addClass('muted');
        $('.ie #state').focus(function() {
            if ($(this).val() == 'LA') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #state').blur(function() {
            if ($(this).val() == '') {
                $(this).val('LA').addClass('muted');
            }
        });
        $('.ie #zip').val('70124').addClass('muted');
        $('.ie #zip').focus(function() {
            if ($(this).val() == '70124') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #zip').blur(function() {
            if ($(this).val() == '') {
                $(this).val('70124').addClass('muted');
            }
        });
        $('.ie #description').val("We'll be around back. BYOB.").addClass('muted');
        $('.ie #description').focus(function() {
            if ($(this).val() == "We'll be around back. BYOB.") {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #description').blur(function() {
            if ($(this).val() == '') {
                $(this).val("We'll be around back. BYOB.").addClass('muted');
            }
        });
        $('.ie #website').val('www.facebook.com/awesome-crawfish-boil').addClass('muted');
        $('.ie #website').focus(function() {
            if ($(this).val() == 'www.facebook.com/awesome-crawfish-boil') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #website').blur(function() {
            if ($(this).val() == '') {
                $(this).val('www.facebook.com/awesome-crawfish-boil').addClass('muted');
            }
        });
        $('.ie #email').val('john@example.com').addClass('muted');
        $('.ie #email').focus(function() {
            if ($(this).val() == 'john@example.com') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #email').blur(function() {
            if ($(this).val() == '') {
                $(this).val('john@example.com').addClass('muted');
            }
        });
        $('.ie #phone').val('504-555-5555').addClass('muted');
        $('.ie #phone').focus(function() {
            if ($(this).val() == '504-555-5555') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #phone').blur(function() {
            if ($(this).val() == '') {
                $(this).val('504-555-5555').addClass('muted');
            }
        });
        $('.ie #price').val('0').addClass('muted');
        $('.ie #price').focus(function() {
            if ($(this).val() == '0') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #price').blur(function() {
            if ($(this).val() == '') {
                $(this).val('0').addClass('muted');
            }
        });
        $('.ie #twitter').val('crawfinder').addClass('muted');
        $('.ie #twitter').focus(function() {
            if ($(this).val() == 'crawfinder') {
                $(this).val('').removeClass('muted');
            }
        });
        $('.ie #twitter').blur(function() {
            if ($(this).val() == '') {
                $(this).val('crawfinder').addClass('muted');
            }
        });

    });

})(jQuery);