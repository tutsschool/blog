<h2>PUBLICAR POSTAGEM</h2>
<?php
    $postId = filter_input(INPUT_GET, 'pid');
    $forms = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(isset($forms['acao']) && $forms['acao']=='update'):
        unset($forms['acao']);
        
        $forms['post_userid'] = $user['user_id'];
        $forms['post_url'] = urlTitle($forms['post_title']);
        $forms['post_views'] = 1;
        $forms['post_data'] = date('Y-m-d');
        
        $imagem = $_FILES['post_imagem'];
        
        if($forms['post_title'] == ''):
            SYSErro("Informe o titulo do post !", SYS_ALERT);
        elseif($forms['post_category'] == ''):
            SYSErro("Selecione uma categoria !", SYS_ALERT);
        elseif($forms['post_content'] == ''):
            SYSErro("Precisamos de um bom conteudo para este post!", SYS_ALERT);
        else:
            
            if(!empty($imagem['name'])):
                $tmp = $imagem['tmp_name'];
                $name = explode('.', $imagem['name']);
                $forms['post_imagem'] = $forms['post_url'].'-'.time().'.'.end($name);
                
                if(file_exists("../uploads/posts/".$forms['imgantiga']))
                {
                    unlink("../uploads/posts/".$forms['imgantiga']);
                }
                
                if(move_uploaded_file($tmp, '../uploads/posts/'.$forms['post_imagem'])){
                    $retorno = true;
                }else{
                    die("Erro ao enviar imagem de destaque !");
                }
                unset($forms['imgantiga']);
            else:
                
                $forms['post_imagem'] = $forms['imgantiga'];
                unset($forms['imgantiga']);
                $retorno = true;
            endif;
            foreach($forms as $key => $value):
                $campos[] = $key."=?";
                $valores[] = $value;
            endforeach;
            $valores[] = $postId;
            $places = implode(',', $campos);
            $valor = "'".implode("','", $valores)."'";
            $update = conectar()->prepare("UPDATE posts SET {$places} WHERE post_id=?");
             try {
                if($update->execute($valores) && $retorno):
                    SYSErro("Post e imagem de destaque atualizadas com sucesso !", SYS_SUCCESS);
                endif;
             } catch (PDOException $e) {
                 SYSErro($e->getMessage(), SYS_ERROR);
             }
        endif;
        
    endif;
?>
<form action="" method="post" enctype="multipart/form-data">
    <?php
        $selecionaPost = conectar()->prepare("SELECT * FROM posts WHERE post_id=? LIMIT 1");
        $selecionaPost->execute(array($postId));
        $selecionaPost->setFetchMode(PDO::FETCH_ASSOC);
        
        if($selecionaPost->rowCount() >= 1):
            $getPosts = $selecionaPost->fetchAll();
            foreach($getPosts as $posts); 
        endif;
    ?>
    <label>
        <span>Titulo do post : </span>
        <input type="text" name="post_title" value="<?= $posts['post_title']; ?>"/>
    </label>
    
    <label>
        <span>Categoria : </span>
        <select name="post_category">
            <option  value="<?= $posts['post_category']; ?>">[ categoria atual : <?= str_replace('-', ' ', $posts['post_category']); ?> ]</option>
            <?php
                $cats = conectar()->prepare("SELECT * FROM categorias WHERE cat_url!=? ORDER BY cat_id DESC");
                $cats->execute(array($posts['post_category']));
                $cats->setFetchMode(PDO::FETCH_ASSOC);
                if($cats->rowCount() >= 1):
                   foreach($cats->fetchAll() as $category):
                        echo '<option value="'.$category['cat_url'].'">'.$category['cat_name'].'</option>';
                   endforeach;
                endif;
            ?>
        </select>
    </label>
    
    <label>
        <span>Selecionar capa : </span>
        <input type="file" name="post_imagem"/>
    </label>
    
    <label>
        <span>Conteudo do post : </span>
        <textarea name="post_content" rows="10"><?= $posts['post_content']; ?></textarea>
    </label>
    
    <label>
        <input type="text" disabled="disabled" name="post_data" value="<?= date("Y-m-d"); ?>"/>
    </label>
    
    <input type="hidden" name="imgantiga" value="<?= $posts['post_imagem']; ?>"/>
    <input type="hidden" name="acao" value="update"/>
    <input type="submit" value="cadastrar post" class="btn btn-alert"/>
</form>