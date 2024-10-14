<?php
session_start();

if (!isset($_SESSION['expression'])) {
    $_SESSION['expression'] = ''; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['key'])) {
        $key = $_POST['key'];

        if ($key === 'C') {
            $_SESSION['expression'] = ''; 
        } elseif ($key === '⌫') {
            $_SESSION['expression'] = substr($_SESSION['expression'], 0, -1);
        } elseif ($key === '=') {

            try {
          
                $result = @eval("return " . $_SESSION['expression'] . ";");
                $_SESSION['expression'] = $result;
            } catch (Throwable $e) {
                $_SESSION['expression'] = "Hata";
            }
        } else {

            $_SESSION['expression'] .= $key;
        }
    }
}

$expression = $_SESSION['expression'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okyanus Temalı Hesap Makinesi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="calculator-container">
        <div class="calculator">
            <div class="display" id="display">
                <?php echo htmlspecialchars($expression); ?>
            </div>
            <form method="POST">
                <div class="buttons">
                    <button type="submit" name="key" value="7">7</button>
                    <button type="submit" name="key" value="8">8</button>
                    <button type="submit" name="key" value="9">9</button>
                    <button type="submit" name="key" value="/">/</button>

                    <button type="submit" name="key" value="4">4</button>
                    <button type="submit" name="key" value="5">5</button>
                    <button type="submit" name="key" value="6">6</button>
                    <button type="submit" name="key" value="*">*</button>

                    <button type="submit" name="key" value="1">1</button>
                    <button type="submit" name="key" value="2">2</button>
                    <button type="submit" name="key" value="3">3</button>
                    <button type="submit" name="key" value="-">-</button>

                    <button type="submit" name="key" value="0">0</button>
                    <button type="submit" name="key" value=".">.</button>
                    <button type="submit" name="key" value="=" class="equals-btn">
                        <img src="crab.png" alt="Eşittir" class="icon">
                    </button>
                    <button type="submit" name="key" value="C" class="reset">
            <img src="sea-shell.png" alt="Temizle" class="icon">
        </button>          
         <button type="submit" name="key" value="C">C</button>
         
        <button type="submit" name="key" value="⌫" class="delete">
            <img src="fish.png" alt="Sil" class="icon">
        </button>

         
                </div>
            </form>
        </div>
    </div>
</body>
</html>
