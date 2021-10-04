<?php

add_action( 'frm_after_create_entry', function( $entry_id, $form_id ) {
    if ( $form_id == 4 || $form_id == 2 ) { // Request Quote or Request Info
        $info = [
            'MSM_source' => '0fb2abdc-a3bc-4ec1-adf3-384c942d266b',
            'MSM_coy' => '767',
            'MSM_formId' => '0FB2ABDC-A3BC-4EC1-ADF3-384C942D266B',
            'MSM_leadCaptureName' => 'MarketSharp'
        ];

        $msm_field_names = [
            'msm_firstname' => 'MSM_firstname',
            'msm_firstname2' => 'MSM_firstname',
            'msm_lastname' => 'MSM_lastname',
            'msm_lastname2' => 'MSM_lastname',
            'msm_email' => 'MSM_email',
            'msm_email2' => 'MSM_email',
            'msm_homephone' => 'MSM_homephone',
            'msm_homephone2' => 'MSM_homephone',
            'line1' => 'MSM_address1',
            'line2' => 'MSM_address2',
            'city' => 'MSM_city',
            'state' => 'MSM_state',
            'zip' => 'MSM_zip'
        ];

        $form = FrmForm::getOne( $form_id );
        $fields = FrmField::get_all_for_form( $form_id );
        $entry = FrmEntry::getOne( $entry_id, true );

//        var_dump( $form, $fields, $entry );

        $message_fields = [];

        foreach ( $fields as $field ) {
            if ( in_array( $field->type, [ 'divider', 'end_divider', 'html' ] ) ) { // Field types to skip
                continue;
            }

            $value = $entry->metas[ $field->id ] ?? '';

            // Format some values.
            if ( $field->type == 'address' ) {
              foreach ($value as $key => $val) {
                if ( isset( $msm_field_names[ $key ] ) ) {
                    $info[ $msm_field_names[ $key ] ] = $val;
                }
              }
                $value = ($value['line1'] ?? '') . ' ' . ($value['line2'] ?? '') . ', ' . ($value['city'] ?? '') . ', ' . ($value['state'] ?? '') . ' ' . ($value['zip'] ?? '');
            } elseif ( is_array( $value ) ) {
                $value = implode( ', ', $value );
            }

            if ( $field->field_key == 'MSM_homephone' || $field->field_key == 'msm_homephone' ) {
                $value = preg_replace("/[^a-zA-Z0-9]+/", "", $value);
            }

            // Remove new lines.
            $value = str_replace( "\n", '', $value );

            // If the field has a defined name for MarketSharp, use it.
            // Otherwise, add it to the message fields.
            if ( isset( $msm_field_names[ $field->field_key ] ) ) {
                $info[ $msm_field_names[ $field->field_key ] ] = $value;
            } else {
                $message_fields[ $field->name ] = $value;
            }
        }

        // Combine message fields into the custom interests field.
        $info['MSM_custom_Interests'] = array_reduce( array_keys( $message_fields ), function( $carry, $key ) use ( $message_fields ) {
            return $carry . "\r\n" . $key . ': ' . $message_fields[ $key ];
        }, '' );

        // URL encode all of the info.
        array_walk( $info, function( &$value, $key ) {
            $value = $key . '=' . urlencode( $value );
        } );

        // Submit to MarketSharp.
        $post_data = [
            'info' => urlencode( implode( '&|&', $info ) ),
            'version' => 2,
            '_' => time() * 1000,
            'callback' => 'noop'
        ];

        $url = 'https://ha.marketsharpm.com/LeadCapture/MarketSharp/LeadCapture.ashx';
        $url = add_query_arg( $post_data, $url );

        wp_remote_get( $url );
    }
}, 999, 2 );
