<?php


function currency(int $value)
{
    return number_format($value, 0, '.', ',') . ' đ';
}

function websiteName()
{
    $data = Storage::disk('local')->get('public/about-us/about-us.json');
    if ($data) {
        $data = json_decode($data);
        $webname = $data->company_name;
    } else {
        $webname = 'Website';
    }
    return "$webname";
}
if (!function_exists('logo')) {
    function logo()
    {
        $data = Storage::disk('local')->get('public/about-us/about-us.json');
        if ($data) {
            $data = json_decode($data);
            $logo = "/storage/$data->image";
        } else {
            $logo = asset('assets/img/no-image.png');
        }
        return $logo;
    }
}

if (!function_exists('selectedOption')) {
    function selectedOption($value, $option)
    {
        if ($value == $option) {
            return 'selected';
        }
    }
}
