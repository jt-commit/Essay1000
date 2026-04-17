<!DOCTYPE html>
<html>
 <head>
 

  <link rel= "stylesheet" href="style.css">
  <!-- guia o style para o index -->

 </head>
  <body>
  
  <div id="s1" class= "a"></div><!--decoração superior-->
  <div id="s2" class= "a"></div>
  <div id="s3" class= "a"></div>

  <img src= "assets/logo.png" id="logo2" class= "a"></img><!--logo-->

   <button id="nr" class="a" onclick="novaredacao()"
   > Nova Redação </button> <!--abre novaredacao-->  

  <button id="r" class="a" onclick="redacoes()"
  > Redações </button><!--abre redacoes-->
  
  <script>

      function novaredacao(){
      window.location.href= "novaredacao.php";
      //cria o caminho de novaredacao//
      };
      function redacoes(){
        window.location.href = "redacoes.php";
        //cria o caminho de redacoes//
      };

  </script>

 </body>
</html>