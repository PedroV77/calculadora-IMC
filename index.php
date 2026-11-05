<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; background-color: #f4f4f9; }
        .container { max-width: 400px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 8px; margin: 10px 0; box-sizing: border-box; }
        button { background: #00cf8a; color: white; border: none; padding: 10px; width: 100%; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .resultado { margin-top: 20px; padding: 10px; background: #a5eb7a; border-left: 4px solid #4fbd06; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Calculadora de IMC</h2>
        <form method="POST" action="">
            <label for="peso">Peso (kg):</label>
            <input type="number" step="0.01" name="peso" id="peso" required>

            <label for="altura">Altura (metros):</label>
            <input type="number" step="0.01" name="altura" id="altura" required>

            <button type="submit" name="calcular">Calcular</button>
        </form>
        
        <?php
        // 1. Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calcular'])) {
            
            // 2. Verifica se os campos não estão vazios
            if (!empty($_POST['peso']) && !empty($_POST['altura'])) {
                
                $peso = floatval($_POST['peso']);
                $altura = floatval($_POST['altura']);

                // 3. Verifica se a altura é maior que zero para evitar divisão por zero
                if ($altura > 0) {
                    
                    // Cálculo IMC
                    $imc = $peso / ($altura * $altura);
                    $classificacao = "";

                    // Estrutura condicional
                    if ($imc < 18.5) {
                        $classificacao = "abaixo do peso";
                    } elseif ($imc < 25) {
                        $classificacao = "peso normal";
                    } elseif ($imc < 30) {
                        $classificacao = "sobrepeso";
                    } else {
                        $classificacao = "obesidade"; // Ajustado aqui!
                    }

                    // Exibe o resultado na tela
                    echo "<div class='resultado'>";
                    echo "<strong>Resultado:</strong><br>";
                    echo "Seu IMC é: <strong>" . number_format($imc, 2, ',', '.') . "</strong><br>";
                    echo "Classificação: <strong>{$classificacao}</strong>";
                    echo "</div>";

                } else {
                    echo "<p style='color: red;'>A altura não pode ser zero.</p>";
                }

            } else {
                echo "<p style='color: red;'>Por favor, preencha todos os campos.</p>";
            }
        }
        ?>
    </div>
</body>
</html>