<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $min = filter_input(INPUT_POST, 'min', FILTER_SANITIZE_NUMBER_INT);
    $max = filter_input(INPUT_POST, 'max', FILTER_SANITIZE_NUMBER_INT);

    if (empty($min) || empty($max)) {
        echo json_encode(['erro' => 'Dados inválidos!']);
        exit;
    }

    if ($min > $max) {
        echo json_encode(['erro' => 'Mínimo maior que máximo!']);
        exit;
    }

    $numero = rand($min, $max);

    echo json_encode(['numero' => $numero]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Números</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #111827;
            padding: 40px;
            border-radius: 16px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 10px;
            border: none;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #1d4ed8;
        }

        #resultado {
            margin-top: 20px;
            font-size: 28px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Gerador Aleatório</h1>

        <input id="min" type="number" placeholder="Valor mínimo">
        <input id="max" type="number" placeholder="Valor máximo">

        <button onclick="gerar()">Gerar Número</button>

        <div id="resultado">-</div>
    </div>

    <script>
        function gerar() {
            const min = document.getElementById('min').value;
            const max = document.getElementById('max').value;

            if (min === '' || max === '') {
                alert('Preencha os dois campos!');
                return;
            }

            fetch('', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'min=' + min + '&max=' + max
                })
                .then(res => res.json())
                .then(data => {
                    if (data.erro) {
                        alert(data.erro);
                        return;
                    }

                    document.getElementById('resultado').innerText = data.numero;
                });
        }
    </script>
</body>

</html>