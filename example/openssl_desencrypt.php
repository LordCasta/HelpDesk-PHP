<?php 
//clave de cifrado (asegúrate de usar la misma que se utilizó para cifrar)
$key = "mi_key_secreta";
//Método de cifrado (asegúrate de usar la misma que se utilizó para cifrar)
$cipher = "aes-256-cbc";

//El texto que deseas descifrar
$textoCifrado = "LicH6gflm7f2xkYpW0xPhDe27FqydC+FDI+k78bvJnI=";

//Obtener el IV del texto cifrado
$iv_dec = substr(base64_decode($textoCifrado), 0, openssl_cipher_iv_length($cipher));


//Obtener el texto cifrado sin el IV
$cifradoSinIV = substr(base64_decode($textoCifrado), openssl_cipher_iv_length($cipher));

//Descifrado
$descifrado = openssl_decrypt($cifradoSinIV, $cipher, $key, OPENSSL_RAW_DATA, $iv_dec);
echo "texto descifrado: ". $descifrado;
