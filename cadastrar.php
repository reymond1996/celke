<?php
include_once './conexao.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cadastrar</h1>
    <?php
    //receber os dados do formulario
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //
    if(!empty($dados['CadUsuario'])){
      //colocar aviso quando tiverf campos vazio
        $empty_input = false;
        $dados = array_map('trim',$dados);
       if(in_array("", $dados)){
            $empty_input =true;
            echo "<p style='color:#f00';>Erro: Necessario preencher todos campos!</p>";
       }elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
           $empty_input = true;
           echo "<p style='color:#f00';>Erro! e necessario preencher com e-mail valido</p>";
           //fim
       }
       //gravar no banco as informação
       if(!$empty_input){
  $query_usuario=  "INSERT INTO usuarios (nome,email) VALUES (:nome,:email)";
      $cad_usuario =$conn->prepare($query_usuario);
      $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
      $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
      $cad_usuario->execute();
      

      }
      //mensagem castrado com sucesso e Erro
      if($cad_usuario->rowCount()){
          echo "<p style='color: green';>Usuario cadastrado com sucesso!</p>";

      }else{
          echo "<p style='color:#f00';>Erro! Usuario não cadastrado com sucesso!</p>";
      }
      
    }
    ?>
    <!--formulario-->
    <form name="cad-usuario" method="POST" action="">
        <label for="">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="nome Completo" value="<?php
        if(isset($dados['nome'])){
            echo $dados['nome'];
        }?>"><br><br>
        <label for="">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="seu Email" value="<?php
        if(isset($dados['nome'])){
            echo $dados['nome'];
        }?>"><br><br>
        <input type="submit" value="cadastrar" name="CadUsuario">
    </form>
</body>
</html>