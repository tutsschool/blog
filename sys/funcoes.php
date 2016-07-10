<?php
     //Responsavel por pegar o titulo da pagina acessada !
     function get_title()
     {
          $retorno = NULL;
          $url = filter_input(INPUT_GET, 'url');
          $explode = explode('/', $url);

          if($explode[0] == ''):
               $retorno = SITENAME. ' - '. SITEDESC;
          elseif($explode[0] == 'categoria'):
               $categoria = $explode[1];
               $read_categorias = conectar()->prepare("SELECT * FROM categorias WHERE cat_url=:url");
               $read_categorias->bindValue(':url', $categoria, PDO::PARAM_STR );
               $read_categorias->execute();

               $read_categorias->setFetchMode(PDO::FETCH_ASSOC);

               if($read_categorias->rowCount() >= 1):
                    foreach($read_categorias->fetchAll() as $cats);
                    $retorno = $cats['cat_name'].' - '. SITENAME;
               endif;

          elseif($explode[0] == 'artigo'):
               $artigo = $explode[2];
               $read_artigos = conectar()->prepare("SELECT * FROM posts WHERE post_url=:url");
               $read_artigos->bindValue(':url', $artigo, PDO::PARAM_STR );
               $read_artigos->execute();

               $read_artigos->setFetchMode(PDO::FETCH_ASSOC);

               if($read_artigos->rowCount() >= 1):
                    foreach($read_artigos->fetchAll() as $post);
                    $retorno = $post['post_title'].' - '. SITENAME;
               endif;

          elseif($explode[0] == 'pesquisa'):
               $busca = $explode[1];
               $read_pesquisa = conectar()->prepare("SELECT * FROM posts WHERE post_title LIKE '%' :buscar '%' ORDER BY post_id DESC");
               $read_pesquisa->bindValue(':buscar', $busca, PDO::PARAM_STR );
               $read_pesquisa->execute();

               $retorno = 'A busca retornou '.$read_pesquisa->rowCount().' resultado - '.SITENAME;
          elseif($explode[0] == 'contato'):
               $retorno = 'Fale Conosco - '.SITENAME;
          else:
               $retorno = '404 Error - '.SITENAME;
          endif;
          return $retorno;
     }
