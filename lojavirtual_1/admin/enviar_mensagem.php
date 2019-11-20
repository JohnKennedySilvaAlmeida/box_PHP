<?

$query = "SELECT * FROM usuarios ORDER BY codigo DESC LIMIT $begin,15";
$query = mysql_query($query,$conexao);

// Gera uma tabela para cada assinatura no livro de visitas (loop)
echo "<h2> Esta interface é uma pagina de administração de usuarios<b> Restrita</b></h2><br>";
echo "<form method=\"GET\" ACTION=\"excluir_usuario.php\">";
echo "<table width=\"100%\" border=1 cellpadding=1 cellspacing=1>";
echo "<tr>";
echo "<td >codigo:</td>";
echo "<td >email:</td>";
echo "<td >data:</td>";
echo "<td >ip:</td>";
echo "<td >Ação:</td>";
echo "</tr>";

while ($linha=mysql_fetch_array($query)) {
$codigo = $linha["codigo"];
$email = $linha["email"];
$data = $linha["data"];
$ip= $linha["ip"];
     global $t;
     $t++;
    if ($t % 2 == 0) {$cor="#99ccff";}
    else             {$cor="#99cccc";}
      echo "<tr bgcolor='$cor'><td><input type=\"checkbox\" name=\"email\" value=\"$email\" checked>$codigo</td>";
         echo "<td>$email</td>";
         echo "<td>$data</td>";
          echo "<td>$ip</td>";

echo "<td ><a href=\"alterar_usuario.php?codigo=$codigo\">Alterar</a><br>";
echo "<a href=\"excluir_usuario.php?codigo=$codigo\">Excluir</a><br></td>";
echo "</tr>";
                                                    }
         echo "</form></table>\n";



 mysql_close($conexao);




}  ?>


