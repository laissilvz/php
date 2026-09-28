<?php

require_once 'Usuario.php';

class AuthController {
    
    public function validar_login(string $email, string $senha, array $usuariosBanco): ?Usuario {
        foreach ($usuariosBanco as $usuario) {
            
            if ($usuario->getEmail() === $email) {
                
                if ($usuario->verificarSenha($senha)) {
                    return $usuario;
                }
            }
        }
        return null;
    }
}