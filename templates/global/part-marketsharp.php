
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.pack.js"></script>
    <script>
        function textCounter( field, spanId, maxlimit ) {
          if ( field.value.length > maxlimit )
          {
            field.value = field.value.substring( 0, maxlimit );
            alert( 'Textarea value can only be ' + maxlimit + ' characters in length.' );
            return false;
          }
          else
          {
            jQuery('#'+spanId).text('' + (maxlimit - field.value.length) + ' characters remaining');
          }
        }

        jQuery(document).ready(function(){
            jQuery.validator.addMethod(
                "phoneUS", function(phone_number, element) {
                    phone_number = phone_number.replace(/\s+/g, "");
	                return this.optional(element) || phone_number.length > 9 &&
		                phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
                },
                "Please specify a valid phone number"
            );

            jQuery('#SubmitButton').click(function(evt) {
              var isValid = jQuery('form').valid();

              <!--if (!isValid)-->
              evt.preventDefault();

              if (isValid)
                {
                    jQuery("div.error").hide();

                    /*jQuery("body").append('<form id="form-to-submit" style="visibility:hidden;"></form>');
                    jQuery("#form-to-submit").html(jQuery("#marketsharpmFieldSet").clone());*/

                    var textareaData = new Array();
                    jQuery.each(jQuery("#marketsharpmFieldSetDiv textarea"), function(index, value) {
                        var cleanValue = escape(jQuery.trim(value.value));

                        if (cleanValue !== '')
                            textareaData[value.name] = cleanValue;
                    });

                    var selectData = new Array();
                    jQuery.each(jQuery("#marketsharpmFieldSetDiv select"), function(index, value) {
                        var cleanValue = escape(jQuery.trim(value.value));

                        if (cleanValue !== '')
                            selectData[value.name] = cleanValue;
                    });

                    /*var values = jQuery("#form-to-submit").serialize();*/
                    var values = jQuery("#marketsharpmForm").serialize();

                    if (values == '')
                    {
                        jQuery("body").append('<form id="form-to-submit" style="visibility:hidden;"></form>');
                        jQuery("#form-to-submit").html(jQuery("#marketsharpmFieldSet").clone());

                        values = jQuery("#form-to-submit").serialize();
                    }

                    /*Perform manual check for Phone or Email (at least one is required)*/
                    var email = jQuery("#form-to-submit #MSM_email").val();
                    var homePhone = jQuery("#form-to-submit #MSM_homephone").val();
                    var cellPhone = jQuery("#form-to-submit #MSM_cellphone").val();
                    var workPhone = jQuery("#form-to-submit #MSM_workphone").val();

                    if(email === '' && homePhone === '' && cellPhone === '' && workPhone === '')
                    {
                        jQuery("div.error span").html("Phone or Email is required.");
                        jQuery("div.error").show();
                        return false; //short-circuit
                    }

                    for(var keyName in selectData) {
                        var regEx = new RegExp("&" + keyName + "=[^&]*", "gi");
                        var allSelectData = regEx.exec(values);
	                    values = values.replace(allSelectData, "&" + keyName + "=" + selectData[keyName]);
                    }
                    for(var keyName in textareaData) {
                        var regEx = new RegExp("&" + keyName + "=[^&]*", "gi");
                        var allInterestData = regEx.exec(values);

	                    values = values.replace(allInterestData, "&" + keyName + "=" + textareaData[keyName]);
                    }

                    values = values.replace(/&/g, "&|&");
                    //console.log('values: ', JSON.stringify(values));

                    /*jQuery("#form-to-submit").remove();*/

                     jQuery.getJSON("https://ha.marketsharpm.com/LeadCapture/MarketSharp/LeadCapture.ashx?callback=?",
                       { "info": values, "version" : 2 },
                       function(data, msg) {
                        jQuery("div.error span").html("");
                        if (data.errors.length > 0)
                        {
                            jQuery.each(data.errors, function() {
                                jQuery("div.error span").append(this + "<br />");
                            });
                            jQuery("div.error span br:last").remove();
                            jQuery("div.error").show();
                        }
                        else if (data.redirectUrl != '')
                        {
                            window.location.replace(data.redirectUrl);
                        }
                        else if (data.msg == 'success')
                        {
                         jQuery('#marketsharpmFieldSetDiv').html("<div id='message' style='text-align: center;'></div>");
                         jQuery('#message').html("<h2>Contact Information Submitted!</h2>")
                         .append("<p>We will be in touch soon.</p>")
                         .hide()
                         .fadeIn(1500, function() {
                           jQuery('#message').append("");
                         });
                        }
                        else
                        {
                        jQuery("div.error span").html("There was an unknown error submitting the form.");
                        jQuery("div.error").show();
                        }
                       }
                     );
                     return false;
                }
            });

            jQuery("form").validate({
                onsubmit: false,
                invalidHandler: function(e, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        var message = errors == 1
                        ? 'You missed 1 field. It has been highlighted below'
                        : 'You missed ' + errors + ' fields. They have been highlighted below';
                        jQuery("div.error span").html(message);
                        jQuery("div.error").show();
                    } else {
                        jQuery("div.error").hide();
                    }
                },
                onkeyup: false
             });
          });
    </script>



<div id="marketsharpmFormDiv">
    <form id="marketsharpmForm" method="post" action="https://ha.marketsharpm.com/LeadCapture/MarketSharp/LeadCapture.ashx">
    <fieldset id="marketsharpmFieldSet" >
    <div id="marketsharpmFieldSetDiv">
        <div class="error" style="display:none;">
        <span></span><br clear="all" />
        </div>

        <!-- NOTE: Minimally First Name and Last Name are required. -->

        <p><label for="MSM_firstname">First Name:</label><input id="MSM_firstname" type="text" name="MSM_firstname" class="required" maxlength="50" /></p>
        <p><label for="MSM_lastname">Last Name:</label><input id="MSM_lastname" type="text" name="MSM_lastname" class="required" maxlength="50" /></p>

        <!-- NOTE: You may remove any lines below that you do not wish to collect. -->
<?php /*
        <p><label for="MSM_address1">Address Line 1:</label><input id="MSM_address1" type="text" name="MSM_address1" maxlength="200" /></p>
        <p><label for="MSM_address2">Address Line 2:</label><input id="MSM_address2" type="text" name="MSM_address2" maxlength="100" /></p>
        <p><label for="MSM_city">City:</label><input id="MSM_city" type="text" name="MSM_city" maxlength="50" /></p>
        <p><label for="MSM_state">State:</label><input id="MSM_state" type="text" name="MSM_state" maxlength="50" /></p>
        <p><label for="MSM_zip">Zip:</label><input id="MSM_zip" type="text" name="MSM_zip" maxlength="50" /></p>
*/ ?>
        <!-- NOTE: Phone number or Email is required. -->

        <p><label for="MSM_email">Email:</label><input id="MSM_email" type="text" name="MSM_email" class=" email" maxlength="100" /></p>
        <p><label for="MSM_homephone">Home Phone:</label><input id="MSM_homephone" type="text" name="MSM_homephone" class=" phoneUS" maxlength="15" /></p>
<?php /*        <p><label for="MSM_cellphone">Cell Phone:</label><input id="MSM_cellphone" type="text" name="MSM_cellphone" class="phoneUS" maxlength="15" /></p>
        <p><label for="MSM_workphone">Work Phone:</label><input id="MSM_workphone" type="text" name="MSM_workphone" class="phoneUS" maxlength="15" /></p> */ ?>
        <p><label for="MSM_custom_Interests">Interest In:</label><textarea rows="3" cols="30" id="MSM_custom_Interests" name="MSM_custom_Interests" /></textarea></p>
<?php /*        <p><label for="MSM_custom_Best_Time_To_Reach">Best Time to Reach:</label><input id="MSM_custom_Best_Time_To_Reach" type="text" name="MSM_custom_Best_Time_To_Reach" maxlength="75" /></p> */?>

        <!-- NOTE: The following hidden fields below are required. -->

        <p class="submit"><input type="submit" id="SubmitButton" name="submitbutton" value="Submit Info" class="submit" /></p>
        <input type="hidden" name="MSM_source" value="0fb2abdc-a3bc-4ec1-adf3-384c942d266b" />
        <input type="hidden" name="MSM_coy" value="767" />
        <input type="hidden" name="MSM_formId" value="0FB2ABDC-A3BC-4EC1-ADF3-384C942D266B" />
        <input type="hidden" name="MSM_leadCaptureName" value="MarketSharp" />

    </div>
    </fieldset>
    </form>
</div>
