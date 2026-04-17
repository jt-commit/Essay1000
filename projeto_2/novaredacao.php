<!DOCTYPE html>
<html>
    
 <head>

 <link rel="stylesheet" href="style.css">

 </head>

 <body>

 <div id="s1" class= "a"></div><!--decoração superior-->
 <div id="s2" class= "a"></div>
 <div id="s3" class= "a"></div>

 
 <img src= "assets/logo.png" id="logo" class= "a"></img><!--logo-->
 <img src= "assets/perfil.png" id="perfil" class="a"></img><!--perfil-->
 <img src= "assets/barra.png" id="barra" onclick ="abrirmenu()" alt="..." class="a"> 
 <!--barra-->

 <nav id="menu" class="a"><!--menu aberto pela barra-->
    <button id="b1" class="a" onclick="novaredacao()"> Nova Redação </button>
    <!--abre novaredacao-->
    <button id="b2" class="a" onclick="redacoes()"> Redações </button>
    <!--abre redacoes-->
</nav>
 <script>

 function abrirmenu(){
    //tira e coloca o none no display//
    let menu = document.getElementById("menu");
    if(menu.style.display === "none"){
    menu.style.display = "inline-block";
    //deixa visivel ao clique na barra//
    }else{
    menu.style.display = "none"
    //deixa invisivel ao clique na barra//
    }};
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