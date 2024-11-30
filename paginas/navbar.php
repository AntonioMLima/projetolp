<?php
    session_start();
    if(!isset($_SESSION['acesso'])){
        header('Location: login.php');        
    }
?>

<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="/dashboard">
        <img src="https://flashplacas.com.br/wp-content/uploads/2023/10/placa-permitido-estacionar-R-6b.webp" alt="Logo" class="d-inline-block align-text-top" style="height: 40px;">
        Sistema de Estacionamento
    </a>

    <!-- Navbar Toggler (Mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Admin Section -->
        <?php
          if ($_SESSION['nivel'] == 'adm'):
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuários
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsu">
              <li><a class="dropdown-item" href="usuarios.php">Gerenciar</a></li>
            </ul>
          </li>
        <?php
          endif;
        ?>

        <!-- Clientes -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownClientes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Clientes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownClientes">
            <li><a class="dropdown-item" href="clientes.php">Gerenciar</a></li>
          </ul>
        </li>

        <!-- Vagas -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownVagas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vagas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownVagas">
            <li><a class="dropdown-item" href="vagas.php">Gerenciar</a></li>
          </ul>
        </li>

        <!-- Veículos -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownVeiculos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Veículos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownVeiculos">
            <li><a class="dropdown-item" href="veiculos.php">Gerenciar</a></li>
          </ul>
        </li>
      </ul>

      <!-- User Info Section -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Bem-vindo, 
            <?php
              if (isset($_SESSION['usuario']))
                echo $_SESSION['usuario'];
            ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
            <li><a class="dropdown-item" href="editar_usuario.php">Editar dados</a></li>
            <li><a class="dropdown-item" href="logout.php">Sair</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
