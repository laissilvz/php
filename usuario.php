<?php
class Usuario {
    protected int $id;
    protected string $nome;
    protected string $email;
    protected string $tipo;
    private string $senha_hash; // Parte 2 - Encapsulamento

    public function __construct(int $id, string $nome, string $email, string $tipo) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->tipo = $tipo;
    }

    public function saudacao(): string {
        return "Olá, {$this->nome}!";
    }

    public function tipo_formatado(): string {
        return ucfirst(strtolower($this->tipo));
    }

    public function definirSenha(string $senha): void {
        $this->senha_hash = password_hash($senha, PASSWORD_BCRYPT);
    }

    public function verificarSenha(string $senha): bool {
        return password_verify($senha, $this->senha_hash);
    }

    public function getEmail(): string {
        return $this->email;
    }
}

class Instrutor extends Usuario {
    public array $materias_leciona;

    public function __construct(int $id, string $nome, string $email, array $materias_leciona) {
        parent::__construct($id, $nome, $email, 'instrutor');
        $this->materias_leciona = $materias_leciona;
    }
}

class Aluno extends Usuario {
    public int $xp_total;

    public function __construct(int $id, string $nome, string $email, int $xp_total = 0) {
        parent::__construct($id, $nome, $email, 'aluno');
        $this->xp_total = $xp_total;
    }
}