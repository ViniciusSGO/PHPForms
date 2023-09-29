<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário PHP</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/alerts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="icon" type="image/x-icon" href="./img/icon/favicon.png">
</head>
<body>
<?php
    $errors = [];
    $formularioEnviado = false;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $formularioEnviado = true;

        // verifica o campo nome
        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];
            if (empty($nome)) {
                $errors["nome"] = "O valor de <b>nome</b> <i>está vazio!</i>";
            } elseif (strlen($nome) < 4 || strlen($nome) > 10) {
                $errors["nome"] = "O campo <b>nome</b> <i>deve ter entre 4 e 10 caracteres.";
            }
        } else {
            $errors["nome"] = "O campo <b>nome</b> <i>não foi enviado no formulário!</i>";
        }

        // verifica o campo idade
        if (isset($_POST["idade"])) {
            $idade = $_POST["idade"];
            if (empty($idade)) {
                $errors["idade"] = "O valor de <b>idade</b> <i>está vazio!</i>";
            } elseif ($idade < 18 || $idade > 60) {
                $errors["idade"] = "A <b>idade</b> <i>deve estar entre 18 e 60 anos.</i>";
            }
        } else {
            $errors["idade"] = "O campo <b>idade</b> <i>não foi enviado no formulário!</i>";
        }

        // verifica o campo email
        if (isset($_POST["email"])) {
            $email = $_POST["email"];
            if (empty($email)) {
                $errors["email"] = "O valor de <b>e-mail</b> <i>está vazio!</i>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "O <b>e-mail</b> inserido <i>não é valido!</i>";
            }
        } else {
            $errors["email"] = "O campo <b>e-mail</b> <i>não foi enviado no formulário!</i>";
        }

        // verifica o campo estado civil
        if (isset($_POST["estado_civil"])) {
            $estadoCivil = $_POST["estado_civil"];
            if ($estadoCivil === "---") {
                $errors["estado_civil"] = "O <b>estado-civil</b> <i>não foi selecionado!</i>";
            } elseif ($estadoCivil < 0 || $estadoCivil > 2) {
                $errors["estado_civil"] = "Algum valor de <b>estado civil</b> <i>não está com um valor válido.</i>";
            }
        } else {
            $errors["estado_civil"] = "O campo <b>estado-civil</b> <i>não foi enviado no formulário!</i>";
        }



        // verifica o campo comida
        if (isset($_POST["comida"])) {
            $comida = $_POST["comida"];
            if (empty($comida)) {
                $errors["comida"] = "O <b>estado-civil</b> <i>não foi selecionado!</i>";
            } elseif (count($comida) != 3) {
                $errors["comida"] = "Você deve selecionar exatamente 3 opções de <b>comida</b>";
            } else {
                foreach ($comida as $c) {
                    if ($c < 0 || $c > 5) {
                        $errors["comida"] = "Uma das opções de <b>comida</b> <i>selecionada não está no intervalo esperado (0 a 5).</i>";
                        break;
                    }
                }
            }
        } else {
            $errors["comida"] = "O campo <b>comida</b> <i>não foi enviado no formulário!</i>";
        }

        // verifica o campo forma de entrega
        if (isset($_POST["forma"])) {
            $forma = $_POST["forma"];
            if ($forma < 0 || $forma > 1) {
                $errors["forma"] = "Algum valor do campo <b>forma de entrega</b> <i>não está no intervalo esperado (0 ou 1).</i>";
            }
        } else {
            $errors["forma"] = "A <b>forma de entrega</b> <i>não foi selecionada!</i>";
        }
    }
?>  
    <main>
        <h2>Teste de formulario PHP</h2>
        <div id="colunas">
            <section id="formulario">
                <form method="post" action="">
                    <div>
                        <label for="nome">Nome:</label>
                        <input type="text" placeholder="Informe seu nome" name="nome" id="nome">
                    </div>

                    <div>
                        <label for="idade">Idade:</label>
                        <input type="number" placeholder="Informe sua idade" name="idade" id="idade">
                    </div>

                    <div>
                        <label for="email">Email:</label>
                        <input type="text" placeholder="Informe seu email" name="email" id="email">
                    </div>

                    <div>
                        <label for="estado_civil">Estado Civil:</label>
                        <select name="estado_civil" id="estado_civil">
                            <option value="---">---</option>
                            <option value="0">Solteiro</option>
                            <option value="1">Casado</option>
                            <option value="2">Viúvo</option>
                        </select>
                    </div>



                    <div>
                        <label>O que você gostaria de comer hoje?</label>
                        <div>
                            <input type="checkbox" name="comida[]" id="peitoFrango" value="0"> <label class="labelCheckBox" for="peitoFrango">Peito de frango</label><br>
                            <input type="checkbox" name="comida[]" value="1" id="bifeAlcatra"> <label class="labelCheckBox" for="bifeAlcatra">Bife de Alcatra</label><br>
                            <input type="checkbox" name="comida[]" value="2" id="pureBatata"> <label class="labelCheckBox" for="pureBatata">Purê de batatas</label><br>
                            <input type="checkbox" name="comida[]" value="3" id="arroz"> <label class="labelCheckBox" for="arroz">Arroz</label><br>
                            <input type="checkbox" name="comida[]" value="4" id="batatFrita"> <label class="labelCheckBox" for="batatFrita">Batata Frita</label><br>
                            <input type="checkbox" name="comida[]" value="5" id="saladaVerde"> <label class="labelCheckBox" for="saladaVerde">Salada Verde</label><br>
                        </div>
                    </div>

                    <div>
                        <label>Forma de entrega:</label>
                        <div>
                            <input type="radio" name="forma" id="entrega" value="0"> <label class="labelRadio" for="entrega">Entrega</label><br>
                            <input type="radio" name="forma" id="buscar" value="1"> <label class="labelRadio" for="buscar">Buscar</label><br>
                        </div>
                    </div>
                    
                    <div id="acoes">
                        <input type="submit" value="Enviar">
                        <input type="reset" value="Limpar">
                    </div>
                </form>
            </section>
            <section id="regrasValidacoes">
                <p>Regras do formulário:</p>
                <ul>
                    <li>O nome deve ser enviado e ter de 4 a até 10 caracteres no máximo!</li>
                    <li>A idade deve ser enviado e ser maior ou igual a 18 anos, e menor ou igual a 60 anos.</li>
                    <li>O email deve ser válido</li>
                    <li>O estado civil deve ser enviado e não pode ser "vazio". Só pode aceitar valores 0, 1 e 2.</li>
                    <li>A lista de comida deve receber exatamente 3 itens selecionados. Os valores recebidos devem ser números de 0 a 5.</li>
                    <li>Uma forma de entrega deve ser selecionada. Apenas números 0 e 1 são aceitos.</li>
                </ul>
            </section>
            <section id="validacoes">
                <?php
                    if($formularioEnviado) {
                        $errorsName = ["nome", "idade", "email", "estado_civil", "comida", "forma"];
                        for($x = 0; $x < count($errorsName); $x++) {
                            if(isset($errors[$errorsName[$x]])) {
                                $mensagemErro = $errors[$errorsName[$x]];
                                $nomeCampo = $errorsName[$x];
                                echo "
                                    <article class='message is-danger'>
                                        <div class='message-header'>Erro!</div>
                                        <div class='message-body'>$mensagemErro</div>
                                    </article>
                                ";
                            } else {
                                $nomeCampo = str_replace("_", " ", $errorsName[$x]);
                                echo "
                                    <article class='message is-success'>
                                        <div class='message-header'>OK</div>
                                        <div class='message-body'>O valor <b>$nomeCampo</b> está OK!</div>
                                    </article>
                                ";
                            }
                        }
                    }
                ?>
            </section>
        </div>
    </main>
    <footer>
        <a href="https://www.linkedin.com/in/vmacena/">Vinicius Macena</a>
        <a href="https://www.linkedin.com/in/mauricio-teixeira-37a932196/">Mauricio Brito</a>
        <a href="https://www.linkedin.com/in/viniciussgo/">Vinicius Oliveira</a>
    </footer>
</body>
</html>