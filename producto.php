<?php
session_start();
if(!isset($_SESSION["id"])){
    header("Location: iniciarSesion.php");
}

$id = $_SESSION["id"];
require ("logica/Persona.php");
require ("logica/Administrador.php");
require ("logica/Categoria.php");
require ("logica/Marca.php");
require ("logica/Producto.php");
$administrador = new Administrador($id);
$administrador -> consultar();

if(isset($_POST["nombre"]) && isset($_POST["id"]) && isset($_POST["cantidad"]) && isset($_POST["precioCompra"]) && isset($_POST["precioVenta"]) && isset($_POST["marca"]) && isset($_POST["categoria"]) ){
    $producto = new Producto($_POST["id"], $_POST["nombre"], $_POST["cantidad"], $_POST["precioCompra"], $_POST["precioVenta"], $_POST["marca"], $_POST["categoria"], $administrador->getIdPersona());
    $producto -> registrar();
}
?>
<html>
<head>
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
	rel="stylesheet">
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<?php include ("encabezado.php");?>

	<nav class="navbar navbar-expand-lg bg-body-tertiary">
		<div class="container">
			<a class="navbar-brand" href="#"><img src="img/logo2.png" width="50" /></a>
			<button class="navbar-toggler" type="button"
				data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
				aria-controls="navbarNavDropdown" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav me-auto">
					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
						href="#" role="button" data-bs-toggle="dropdown"
						aria-expanded="false">Producto</a>
						<ul class="dropdown-menu">
                            <li><a class='dropdown-item' href='#'>Nuevo Producto</a></li>
						</ul></li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
						href="#" role="button" data-bs-toggle="dropdown"
						aria-expanded="false"><?php echo $administrador -> getNombre() . " " . $administrador -> getApellido() ?></a>
						<ul class="dropdown-menu">
                            <li><a class='dropdown-item' href='index.php?cerrarSesion=true'>Cerrar Sesion</a></li>
						</ul></li>
				</ul>			
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row mb-3">
			<div class="col">
				<div class="card border-primary">
					<div class="card-header text-bg-info">
						<h4>Proucto</h4>
					</div>
					<div class="card-body mt-4 mb-4 mx-5">
                    <form action="producto.php" method="post">
                        <div class="mb-2">
                            <label for="id" class="form-label">Id</label>
                            <input type="text" class="form-control" id="id" name="id" required>
                        </div>
                        <div class="mb-2">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="precioCompra" class="form-label">Precio de Compra</label>
                            <input type="number" class="form-control" id="precioCompra" name="precioCompra" required>
                        </div>
                        <div class="mb-3">
                            <label for="precioVenta" class="form-label">Precio de Venta</label>
                            <input type="number" class="form-control" id="precioVenta" name="precioVenta" required>
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <select class="form-control" id="marca" name="marca">
                                <option>Seleccione</option>
                                <?php
                                    $marca = new Marca();
                                    $marcas = $marca->consultarTodos();
                                    foreach ($marcas as $marcaActual) {
                                        echo "<option value='".$marcaActual->getIdMarca()."'>".$marcaActual->getNombre()."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select class="form-control"  name="categoria" id="categoria">
                                <option>Seleccione</option>
                                <?php
                                    $categoria = new Categoria();
                                    $categorias = $categoria->consultarTodos();
                                    foreach ($categorias as $categoriaActual) {
                                        echo "<option value='".$categoriaActual->getIdCategoria()."'>".$categoriaActual->getNombre()."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>