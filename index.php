<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <input type="number" name="num1" placeholder="Primo numero">
            <select name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
            <input type="number" name="num2" placeholder="Secondo numero">
            <button>Calculate</button>
        </form>
        <?php
        $messaggio = '';
        $class = '';
        // controllo se il metodo di richiesta sia POST
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            echo "Metodo di richiesta non valido!";
            exit;
        }

        // prendo i valori sanificandoli
        $PrimoNum = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_INT);
        $SecondoNum = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_INT);
        $operator = htmlspecialchars($_POST["operator"]);
        $result = 0; // inizializzo risultato

        // controllo i valori nelle variabili
        if (empty($PrimoNum) || empty($SecondoNum)) {
            $messaggio = 'Inserire entrambi i numeri!';
            $class = 'error';
            exit;
        }
        if (empty($operator)) {
            $messaggio = 'Operatore non valido!';
            $class = 'error';
            exit;
        }

        if (!is_numeric($PrimoNum) || !is_numeric($SecondoNum)) {
            $messaggio = 'Inserire dei numeri come valori!';
            $class = 'error';
            exit;
        }

        switch ($operator) { // a seconda dell'operatore eseguo l'operazione
            case 'add':
                $result = $PrimoNum + $SecondoNum;
                break;
            case 'subtract':
                $result = $PrimoNum - $SecondoNum;
                break;
            case 'multiply':
                $result = $PrimoNum * $SecondoNum;
                break;
            case 'divide':
                $result = $PrimoNum / $SecondoNum;
                break;
            default:
                $messaggio = "non hai scelto l'operatore";
                $class = 'error';
                exit;
                break;
        }
        // risultato
        if ($messaggio === '') {
            $messaggio = "Risultato = $result";
            $class = 'success';
        }
        ?>
        <?php if ($messaggio):    ?>
            <p class="<?php echo $class ?>"><?php echo $messaggio ?></p>
        <?php endif; ?>
    </main>
</body>

</html>