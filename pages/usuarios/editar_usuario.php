<?php 
require_once "../../config/conexao.php";

$id = $_GET['id'];
echo $id;
$sql = "SELECT * FROM usuarios WHERE id = $id";

$resultado = $conexao->query($sql);
$usuario = $resultado->fetch(PDO::FETCH_ASSOC);

?>
<form action="atualizar_usuario.php" method="POST">

  <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

  <label>Nome</label>
  <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>">

  <label>CPF</label>
  <input type="text" name="cpf" value="<?php echo $usuario['cpf']; ?>">

  <label>Email</label>
  <input type="email" name="email" value="<?php echo $usuario['email']; ?>">

  <label>Telefone</label>
  <input type="text" name="telefone" value="<?php echo $usuario['telefone']; ?>">

  <input type="text" name="cep" id="cep" value="<?php echo $usuario['cep']; ?>">
<input type="text" name="numero" value="<?php echo $usuario['numero']; ?>">

  <label>Plano</label>
  <select name="plano_id">
    <option value="1">Mensal</option>
    <option value="2">Trimestral</option>
    <option value="3">Anual</option>
  </select>

  <button type="submit">Salvar alterações</button>

</form>