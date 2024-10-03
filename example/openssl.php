<?php 
    //TODO: estos son los Datos a cifrar (se usa OpenSSL)
    $data = "adad ";
    //La clave de cifrado, trata de hacerla compleja
    $key = "mi_key_secreta";
    //El método de cifrado
    $cipher="aes-256-cbc";

    //Vector de inicialización (IV) necesario para el cifrado
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));

    //Cifrado
    $cifrado = openssl_encrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);
   
    //Concatenar el IV al texto cifrado
    $textoCifrado = base64_encode($iv . $cifrado);

    //Concatenar el IV del texto cifrado
    $iv_dec = substr(base64_decode($textoCifrado), 0, openssl_cipher_iv_length($cipher));

    //Obtener el texto cifrado sin el iv
    $cifradoSinIV = substr(base64_decode($textoCifrado), openssl_cipher_iv_length($cipher));

    //Descifrado
    $descifrado = openssl_decrypt($cifradoSinIV, $cipher, $key, OPENSSL_RAW_DATA, $iv_dec);
    
    echo"Texto cifrado: ".$textoCifrado;
    echo "<br> Texto Descifrado: ". $descifrado;