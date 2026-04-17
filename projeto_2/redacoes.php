<!DOCTYPE html>
<html>
 <head>

 <link rel = "stylesheet" href="style.css">

 </head>

 <body>

 <div id="s1" class= "a"></div><!--decoração superior-->
 <div id="s2" class= "a"></div>
 <div id="s3" class= "a"></div>

 <img src= "assets/logo.png" id="logo" class= "a"></img><!--logo-->
 <h1 id="tit1" class= "a"> Suas Redações </h1><!--titulo-->

 <img src= "assets/perfil.png" id="perfil" class="a"></img><!--perfil-->
 <img src= "assets/barra.png" id="barra" onclick ="abrirmenu()" alt="..." class="a">
 <!--barra-->

 <nav id="menu" class="a"> <!--menu da barra-->
    <button id="b1" class="a" onclick="novaredacao()"> Nova Redação </button>
    <!--abre novaredacao-->
    <button id="b2" class="a" onclick="redacoes()"> Redações </button>
    <!--abre redacoes-->
</nav>
 <script>

 function abrirmenu(){
    //tira o none do dispaly imposto no style por um clique//
    let menu = document.getElementById("menu");
    if(menu.style.display === "none"){
    menu.style.display = "inline-block";
    }else{
    //aplica o none caso esteja desabilitado por um clique//
    menu.style.display = "none"
    }};
 function novaredacao(){
      //cria o caminho de novaredacao//
      window.location.href= "novaredacao.php";
      };
 function redacoes(){
      //cria o caminho de redacoes//
      window.location.href = "redacoes.php";
      };

</script>

 </body>
</html>