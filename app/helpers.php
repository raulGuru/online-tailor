<?php

if (!function_exists('get_roles')) {
    function get_roles($default = null)
    {
        $roles = array('admin', 'editor', 'contributor', 'viewer', 'billing', 'vendor', 'customer');

        if (is_numeric($default)) {
            return $roles[$default];
        }

        return $roles;
    }
}

if (!function_exists('week_days')) {
    function week_days($default = null)
    {
        $week_days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        if (is_numeric($default)) {
            return $week_days[$default];
        }

        return $week_days;
    }
}

if (!function_exists('working_hours')) {
    function working_hours($default = null)
    {
        $working_hours = [
            '12:00 AM',
            '12:30 AM',
            '01:00 AM',
            '01:30 AM',
            '02:00 AM',
            '02:30 AM',
            '03:00 AM',
            '03:30 AM',
            '04:00 AM',
            '04:30 AM',
            '05:00 AM',
            '05:30 AM',
            '06:00 AM',
            '06:30 AM',
            '07:00 AM',
            '07:30 AM',
            '08:00 AM',
            '08:30 AM',
            '09:00 AM',
            '09:30 AM',
            '10:00 AM',
            '10:30 AM',
            '11:00 AM',
            '11:30 AM',
            '12:00 PM',
            '12:30 PM',
            '01:00 PM',
            '01:30 PM',
            '02:00 PM',
            '02:30 PM',
            '03:00 PM',
            '03:30 PM',
            '04:00 PM',
            '04:30 PM',
            '05:00 PM',
            '05:30 PM',
            '06:00 PM',
            '06:30 PM',
            '07:00 PM',
            '07:30 PM',
            '08:00 PM',
            '08:30 PM',
            '09:00 PM',
            '09:30 PM',
            '10:00 PM',
            '10:30 PM',
            '11:00 PM',
            '11:30 PM'
        ];

        if (is_numeric($default)) {
            return $working_hours[$default];
        }

        return $working_hours;
    }
}

if (!function_exists('get_measurment_form_fields')) {
    function get_measurment_form_fields($genders = null, $variant = null)
    {
        $measurment_fileds = array(
            'men' => array(
                'shirt' => array(
                    'fields' => array(
                        array(
                            'name'  => 'measurment_type',
                            'type'  => 'hidden',
                            'value' => 'shirt'
                        ),
                        array(
                            'name'  => 'gender',
                            'type'  => 'hidden',
                            'value' => 'men'
                        ),
                        array(
                            'label' => 'Length',
                            'name'  => 'length',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Shoulder',
                            'name'  => 'shoulder',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Full Sleeve length',
                            'name'  => 'full_sleeve_length',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Half Sleeve length',
                            'name'  => 'half_sleeve_length',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Cuff',
                            'name'  => 'cuff',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Arm',
                            'name'  => 'arm',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Chest',
                            'name'  => 'chest',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Waist',
                            'name'  => 'waist',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Hip',
                            'name'  => 'hip',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Neck',
                            'name'  => 'neck',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Pocket',
                            'name'  => 'pocket',
                            'type'  => 'textarea',
                        ),
                        array(
                            'label' => 'Style details',
                            'name'  => 'style_details',
                            'type'  => 'textarea',
                        ),
                        array(
                            'label' => 'Body posture details',
                            'name'  => 'body_posture_details',
                            'type'  => 'textarea',
                        )
                    ),
                ),
                'pant' => array(
                    'fields' => array(
                        array(
                            'name'  => 'measurment_type',
                            'type'  => 'hidden',
                            'value' => 'pant'
                        ),
                        array(
                            'name'  => 'gender',
                            'type'  => 'hidden',
                            'value' => 'men'
                        ),
                        array(
                            'label' => 'Length',
                            'name'  => 'length',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Waist',
                            'name'  => 'waist',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Hip',
                            'name'  => 'hip',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Thigh',
                            'name'  => 'thigh',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Knee',
                            'name'  => 'knee',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Bottom',
                            'name'  => 'bottom',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Fork',
                            'name'  => 'fork',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Inseam',
                            'name'  => 'inseam',
                            'type'  => 'textbox',
                        ),
                        array(
                            'label' => 'Pocket',
                            'name'  => 'pocket',
                            'type'  => 'textarea',
                        ),
                        array(
                            'label' => 'Style details',
                            'name'  => 'style_details',
                            'type'  => 'textarea',
                        ),
                        array(
                            'label' => 'Body posture details',
                            'name'  => 'body_posture_details',
                            'type'  => 'textarea',
                        )
                    ),
                )
            ),
            'women' => array()
        );

        if (!empty($genders) && !empty($variant)) {
            return $measurment_fileds[$genders][$variant];
        } else if (!empty($genders)) {
            return $measurment_fileds[$genders];
        }

        return $measurment_fileds;
    }
}

if (!function_exists('measurment_types')) {
    function measurment_types($gender = 'men')
    {
        $types = [
            'men' => array(
                array(
                    'id' => 'shirt',
                    'name' => 'Shirt'
                ),
                array(
                    'id' => 'pant',
                    'name' => 'Pant / Trouser'
                ),
                array(
                    'id' => 'jacket',
                    'name' => 'Jacket'
                ),
                array(
                    'id' => 'blazer',
                    'name' => 'Blazer'
                ),
                array(
                    'id' => 'kurta',
                    'name' => 'Kurta'
                ),
                array(
                    'id' => 'pyjama',
                    'name' => 'Pyjama'
                )
            ),
            'women' => array(

            )
        ];
        return $types[$gender];
    }
}
