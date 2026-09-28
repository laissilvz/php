<?php

require_once 'Usuario.php';
require_once 'AuthController.php';

$instrutor1 = new Instrutor(1, "Carlos Silva", "carlos.silva@escola.com", ["Programação Web", "Banco de Dados"]);
$aluno1 = new Aluno(2, "Mariana Souza", "mariana.souza@aluno.com", 1500);

$instrutor1->definirSenha("Senha123*");
$aluno1->definirSenha("Aluno2026#");

$usuariosBanco = [$instrutor1, $aluno1];

$authController = new AuthController();

$testesLogins = [
    ["email" => "carlos.silva@escola.com", "senha" => "Senha123*"],
    ["email" => "mariana.souza@aluno.com", "senha" => "Aluno2026#"],
    ["email" => "mariana.souza@aluno.com", "senha" => "SenhaErrada"],
    ["email" => "fantasma@escola.com", "senha" => "123456"]          
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atividade 08 - POO & MVC (SENAI)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; color: #333; line-height: 1.6; }
        h1, h2 { color: #0056b3; }
        .card { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #0056b3; color: white; }
        .sucesso { color: #28a745; font-weight: bold; }
        .erro { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>

    <div class="card">
        <h1>Atividade 08: De Função para Classe & MVC</h1>
        <p>Curso: Aprendizagem em Assistente em Programação Web — SENAI</p>
    </div>

    <div class="card">
        <h2>1. Dados dos Usuários e Saudação (Método <code>saudacao()</code>)</h2>
        <ul>
            <li><strong>Instrutor:</strong> <?php echo $instrutor1->saudacao(); ?> (Tipo: <?php echo $instrutor1->tipo_formatado(); ?>)</li>
            <li><strong>Aluno:</strong> <?php echo $aluno1->saudacao(); ?> (Tipo: <?php echo $aluno1->tipo_formatado(); ?>)</li>
        </ul>
        <p><em>Confirmação de acesso às propriedades herdadas de Usuario (id, nome, email):</em> Ambas as instâncias possuem acesso normal aos atributos herdados por estarem sob a mesma hierarquia de herança.</p>
    </div>

    <div class="card">
        <h2>2. Teste Final: Validação de Requisições de Login (Controller)</h2>
        <table>
            <thead>
                <tr>
                    <th>E-mail Testado</th>
                    <th>Senha Testada</th>
                    <th>Resultado da Validação</th>
                    <th>Mensagem / Saudação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testesLogins as $teste): ?>
                    <?php 
                        $usuarioLogado = $authController->validar_login($teste['email'], $teste['senha'], $usuariosBanco);
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($teste['email']); ?></td>
                        <td><code><?php echo htmlspecialchars($teste['senha']); ?></code></td>
                        <td>
                            <?php if ($usuarioLogado): ?>
                                <span class="sucesso">Login bem-sucedido!</span>
                            <?php else: ?>
                                <span class="erro">Erro no login (Falha ou credenciais inválidas)</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($usuarioLogado): ?>
                                <?php echo $usuarioLogado->saudacao(); ?> (Acesso autorizado)
                            <?php else: ?>
                                Acesso negado.
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

php -S localhost:8000