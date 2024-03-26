<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Salário para Vendedores</title>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    color: #333;
    margin-top: 50px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
input[type="number"],
button {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button {
    background-color: #4caf50;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}

h3 {
    text-align: center;
    color: #333;
    margin-top: 30px;
}

p {
    text-align: center;
    color: #555;
}

    </style>
</head>
<body>
    <h2>Calculadora de Salário para Vendedores</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nome_vendedor">Nome do Vendedor:</label>
        <input type="text" id="nome_vendedor" name="nome_vendedor" required><br><br>

        <label for="meta_semanal">Meta Semanal (R$):</label>
        <input type="number" id="meta_semanal" name="meta_semanal" required><br><br>

        <label for="meta_mensal">Meta Mensal (R$):</label>
        <input type="number" id="meta_mensal" name="meta_mensal" required><br><br>

        <button type="submit">Calcular Salário</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperando os valores do formulário
        $nome_vendedor = $_POST['nome_vendedor'];
        $meta_semanal = $_POST['meta_semanal'];
        $meta_mensal = $_POST['meta_mensal'];

        // Definindo os valores
        $salario_minimo = 1500; // Salário mínimo dos vendedores
        $valor_meta_semanal = 0.01 * $meta_semanal; // Valor sobre a meta semanal (1%)
        $valor_excedente_semanal = $meta_semanal > 20000 ? 0.05 * ($meta_semanal - 20000) : 0; // Valor sobre o excedente de meta semanal (5%)
        $valor_excedente_mensal = 0; // Valor inicial da bonificação de excedente mensal

        // Verifica se todas as metas semanais foram cumpridas
        if ($meta_semanal >= 20000) {
            // Calcula o valor do excedente de meta mensal (10% sobre o valor excedente)
            $valor_excedente_mensal = 0.10 * (($meta_semanal * 4) - $meta_mensal);
        }

        // Calcula o salário final
        $salario_final = $salario_minimo + ($valor_meta_semanal * 4) + ($valor_excedente_semanal * 4) + $valor_excedente_mensal;

        // Exibe o resultado
        echo "<h3>Resultado do Cálculo de Salário</h3>";
        echo "<p>O salário final do vendedor $nome_vendedor é de R$ " . number_format($salario_final, 2, ',', '.') . "</p>";
    }
    ?>
</body>
</html>