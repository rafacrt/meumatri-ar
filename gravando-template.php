<?php
/*
 Template Name: grava dados
 */
 global $wpdb;
 $current_user = wp_get_current_user();
//  $teste = $wpdb->get_results("SELECT post_title FROM ".$wpdb->prefix."posts");
//  $teste = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_author =".$current_user->ID." AND post_status = 'publish' ");


 // Start the buffering //
$start =  ob_start();
var_dump($current_user->ID+869);
//  foreach ($teste as $page){
//     echo $page->post_title."<br><hr>";
//  }



 ?>
  <div class="editable">
      <div>
          <form action="" method="post">
              <input type="text" name="nome" id="nome" placeholder="Nome" required>
              <br>
              <input type="submit" value="salvar" name="save">
            </form>
            <!-- <h1>testando sem forms</h1> -->
        </div>
        
        <!-- <div id="save-wrapper">
            <button id="save-btn">Salvar</button>
        </div>
        <div class="teste">
            <p>apenas um teste</p>
        </div> -->
    </div>

<script>
//       document.addEventListener( 'DOMContentLoaded', function() {

//           var editBtn = document.getElementById('edit-btn');
//           var saveWrapper = document.getElementById('save-wrapper');
//           var saveBtn = document.getElementById('save-btn');

//           saveBtn.addEventListener('click', function() {
        
//             var content = document.querySelector('.editable').innerHTML;
//             var xhr = new XMLHttpRequest();
//             xhr.open('POST', window.location.href, true);
//             xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//             xhr.onload = function() {
//               saveWrapper.style.display = 'none';
//             }
//             xhr.send('edited-content=' + encodeURIComponent(content));
//           });
//   } );
</script>

 <?php
 $page =  ob_get_contents();
//  echo  $teste;
 // Get the content that is in the buffer and put it in your file //
 if(isset($_POST['save'])) {
    $post_id = $current_user->ID+1989;
    $content = $page;
    $data = array(
        'ID' => $post_id,
        'post_content' =>  $content,
        'post_title' => $_POST['nome']
    );
    $result = $wpdb->insert($wpdb->prefix.'posts', $data);
    if($result){
        file_put_contents('./yourpage'.$post_id.'.html', ob_get_contents());
        echo "Dados gravados com sucesso!";
    }
    else{
        echo "Erro ao gravar os dados!";
    }
 }
 ?>