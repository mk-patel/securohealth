<?php

// Global Decryption for all public information.
function aes_decrypt($ciphertext){

	// Store the cipher method
	$ciphering = "AES-128-CTR";

	// Use OpenSSl Encryption method
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	
	// Non-NULL Initialization Vector for decryption
	$decryption_iv = '1234567891011121';

	// Store the decryption key
	$decryption_key = "%4eh!htyy%#dsg67*5gg#3zd%mpi*hbbj@y6$";

	// Use openssl_decrypt() function to decrypt the data
	$decryption=openssl_decrypt ($ciphertext, $ciphering, $decryption_key, $options, $decryption_iv);

	// Return the encrypted string
	return $decryption;
}
?>
