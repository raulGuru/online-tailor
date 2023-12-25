<?php

if (!function_exists('get_roles')) {
    function get_roles($default = null)
    {
        $roles = array('admin', 'vendor', 'customer');

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
            '11:30 PM',
        ];

        if (is_numeric($default)) {
            return $working_hours[$default];
        }

        return $working_hours;
    }
}

if (!function_exists('get_measurement_form_fields')) {
    function get_measurement_form_fields($genders = null, $variant = null)
    {
        $measurement_fileds = array(
            'men' => array(
                'shirt' => array(
                    'fields' => array(
                        array(
                            'name'  => 'measurement_type',
                            'type'  => 'hidden',
                            'value' => 'shirt',
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
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Shoulder',
                            'name'  => 'shoulder',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Full Sleeve length',
                            'name'  => 'full_sleeve_length',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Half Sleeve length',
                            'name'  => 'half_sleeve_length',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Cuff',
                            'name'  => 'cuff',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Arm',
                            'name'  => 'arm',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Chest',
                            'name'  => 'chest',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Waist',
                            'name'  => 'waist',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Hip',
                            'name'  => 'hip',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Neck',
                            'name'  => 'neck',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Pocket',
                            'name'  => 'pocket',
                            'type'  => 'textarea',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Style details',
                            'name'  => 'style_details',
                            'type'  => 'textarea',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Body posture details',
                            'name'  => 'body_posture_details',
                            'type'  => 'textarea',
                            'value' => ''
                        )
                    ),
                ),
                'pant' => array(
                    'fields' => array(
                        array(
                            'name'  => 'measurement_type',
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
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Waist',
                            'name'  => 'waist',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Hip',
                            'name'  => 'hip',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Thigh',
                            'name'  => 'thigh',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Knee',
                            'name'  => 'knee',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Bottom',
                            'name'  => 'bottom',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Fork',
                            'name'  => 'fork',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Inseam',
                            'name'  => 'inseam',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Pocket',
                            'name'  => 'pocket',
                            'type'  => 'textarea',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Style details',
                            'name'  => 'style_details',
                            'type'  => 'textarea',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Body posture details',
                            'name'  => 'body_posture_details',
                            'type'  => 'textarea',
                            'value' => ''
                        )
                    ),
                )
            ),
            'women' => array()
        );

        if (!empty($genders) && !empty($variant)) {
            return $measurement_fileds[$genders][$variant];
        } else if (!empty($genders)) {
            return $measurement_fileds[$genders];
        }

        return $measurement_fileds;
    }
}

if (!function_exists('get_measurement_form')) {
    function get_measurement_form($genders = null, $variant = null)
    {
        $measurement_fileds = array(
            'men' => array(
                'top' => array(
                    'fields' => array(
                        array(
                            'name'  => 'pattern',
                            'type'  => 'hidden',
                            'value' => 'top',
                        ),
                        array(
                            'name'  => 'type',
                            'type'  => 'hidden',
                            'value' => 'top',
                        ),
                        array(
                            'name'  => 'gender',
                            'type'  => 'hidden',
                            'value' => 'men'
                        ),
                        array(
                            'label' => 'Chest',
                            'name'  => 'chest',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => '',
                            'info' => 'Minimun 36 inch & Maximum 44 inch',
                        ),
                        array(
                            'label' => 'Length',
                            'name'  => 'length',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => '',
                            'info' => 'Minimun 26 inch & Maximum 29 inch'
                        ),
                        array(
                            'label' => 'Shoulder',
                            'name'  => 'shoulder',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Sleeve',
                            'name'  => 'sleeve',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Waist',
                            'name'  => 'waist',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Hip',
                            'name'  => 'hip',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Neck',
                            'name'  => 'neck',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Notes',
                            'name'  => 'note',
                            'type'  => 'textarea',
                            'value' => ''
                        ),
                    ),
                ),
                'bottom' => array(
                    'fields' => array(
                        array(
                            'name'  => 'pattern',
                            'type'  => 'hidden',
                            'value' => 'bottom',
                        ),
                        array(
                            'name'  => 'type',
                            'type'  => 'hidden',
                            'value' => 'bottom',
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
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Waist',
                            'name'  => 'waist',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Hip',
                            'name'  => 'hip',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Thigh',
                            'name'  => 'thigh',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Knee',
                            'name'  => 'knee',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Bottom',
                            'name'  => 'bottom',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Fock',
                            'name'  => 'fock',
                            'type'  => 'textbox',
                            'validate' => 'validateNumber',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Notes',
                            'name'  => 'note',
                            'type'  => 'textarea',
                            'value' => ''
                        ),
                    ),
                )
            ),
            'women' => array()
        );
        if (!empty($genders) && !empty($variant)) {
            return $measurement_fileds[$genders][$variant];
        } else if (!empty($genders)) {
            return $measurement_fileds[$genders];
        }
        return $measurement_fileds;
    }
}

if (!function_exists('measurement_types')) {
    function measurement_types($gender = 'men')
    {
        $types = [
            'men' => array(
                array(
                    'id' => 'top',
                    'name' => 'Top'
                ),
                array(
                    'id' => 'bottom',
                    'name' => 'Bottom'
                ),
            ),
            'women' => array()
        ];
        return $types[$gender];
    }
}

if (!function_exists('stitching_panna')) {
    function stitching_panna($gender = 'men', $type)
    {
        $panna = [
            'men' => array(
                'normal-shirt' => array(
                    array(
                        'label' => '36',
                        'value' => '36',
                        'meter' => '2.25',
                    ),
                    array(
                        'label' => '44',
                        'value' => '44',
                        'meter' => '2',
                    ),
                    array(
                        'label' => '58',
                        'value' => '58',
                        'meter' => '1.16',
                    )
                )
            )
        ];
        return $panna[$gender][$type];
    }
}
