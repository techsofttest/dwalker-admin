<?php

$mode = "Live";



$config['client_id'] = "58257c6c7e934d5bbdaaee701dd73336";

$config['client_secret'] = "53E84D7563d14dABBe7B103803C95498";

if($mode=="UAT")
{

$config['nz_auth_url'] = "https://oauth.nzpost.co.nz/as/token.oauth2";

$config['nz_search_address_url'] = "https://api.uat.nzpost.co.nz/parceladdress/2.0/domestic/addresses";

$config['nz_address_detail_url'] = "https://api.uat.nzpost.co.nz/parceladdress/2.0/domestic/addresses/";

//$config['nz_booking_url'] = "https://api.uat.nzpost.co.nz/parcelpickup/v3/bookings";

$config['nz_booking_url'] = "https://anypoint.mulesoft.com/mocking/api/v1/sources/exchange/assets/b8271f09-2ad8-4e1c-b6b1-322c5727d148/parcelpickup-api/3.0.9/m/bookings";

}

else
{

$config['nz_auth_url'] = "https://oauth.nzpost.co.nz/as/token.oauth2";

$config['nz_search_address_url'] = "https://api.nzpost.co.nz/parceladdress/2.0/domestic/addresses";

$config['nz_address_detail_url'] = "https://api.nzpost.co.nz/parceladdress/2.0/domestic/addresses/";

$config['nz_booking_url'] = "https://api.nzpost.co.nz/parcelpickup/v3/bookings";


}