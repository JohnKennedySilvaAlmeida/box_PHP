<?

      // Define por header que será gerado um JPG

      header("Content-type:image/jpeg");



      // Recebe o caminho para a Imagem

      $imagem = $_GET['imagem'];

      // Define-se as dimensões da miniatura

      $largura = 80;

      $altura = 60;



      // Cria-se uma nova imagem a partir da imagem original

      $imagem_original = imagecreatefromjpeg($imagem);



      // Pega-se a Largura

      $pontoX = imagesx($imagem_original);

      // Pega-se a Altura

      $pontoY = imagesy($imagem_original);



      // Cria-se a imagem em miniatura

      $imagem_final = imagecreatetruecolor($largura, $altura);



      // Copia-se a imagem redimensionada para o arquivo em Miniatura

      imagecopyresized($imagem_final, $imagem_original, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY);



      // Salva-se virtualmente para exibição, com a qualidade de JPG de 85

      imagejpeg($imagem_final,"",85);



      // Depois, libera-se a memória utilizada

      imagedestroy($imagem_final);

      ?>


