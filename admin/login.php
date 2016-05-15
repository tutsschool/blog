<!DOCTYPE html>
<html>
    <head>
        <title>Blog Pro</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/reset.css"/>
        <link rel="stylesheet" href="css/login.css"/>
    </head>
    <body>
        <div class="content-login">
            <div class="box-login">
<?php
    $forms = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(isset($forms['acao']) && $forms['acao']=='logarse'){
        unset($forms['acao']);
        if($forms['email'] == ''):
            echo '<p class="alert">Informe um email para fazer login!</p>';
        elseif($forms['senha'] == ''):
            echo '<p class="alert">Você não informou nenhuma senha !</p>';
        else:
            $forms['senha'] = md5($forms['senha']);
            try {
                $logarse = conectar()->prepare("SELECT * FROM usuarios WHERE user_email=:email AND user_password=:senha LIMIT 1");
                $logarse->bindValue(':email', $forms['email'], PDO::PARAM_STR);
                $logarse->bindValue(':senha', $forms['senha'], PDO::PARAM_STR);
                $logarse->execute();
                $logarse->setFetchMode(PDO::FETCH_ASSOC);
                if($logarse->rowCount() >= 1):
                    $_SESSION['userlogin'] = $logarse->fetchAll();
                    header('Location: index.php');
                else:
                    SYSErro('Erro ao fazer login as informações estão incorretas !', SYS_ERROR);
                endif;
            } catch (PDOException $e) {
                echo $e->getMessage().$e->getFile().$e->getLine();
            }


        endif;
    }
?>
                <form action="" method="post">
                    <label>
                        <span>Email : </span>
                        <input type="email" name="email"/>
                    </label>
                    
                    <label>
                        <span>Senha : </span>
                        <input type="password" name="senha"/>
                    </label>
                    
                    <input type="hidden" name="acao" value="logarse"/>
                    <input type="submit" value="Logar" class="btn btn-alert"/>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </body>
</html>
