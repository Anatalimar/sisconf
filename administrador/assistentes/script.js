// Função para carregar conteúdo via AJAX
function carregarPagina(pagina) {
  // Atualiza a URL sem recarregar a página
  history.pushState(null, null, `?pagina=${pagina}`);

  // Mostra loading
  $(".main-content").html(
    '<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-3x"></i></div>'
  );

  // Carrega o conteúdo
  $.get(`paginas/${pagina}.php`, function (data) {
    $(".main-content").html(data);
    // Atualiza o menu ativo
    $(".sidebar-menu li").removeClass("active");
    $(`.sidebar-menu li a[data-page="${pagina}"]`).parent().addClass("active");
  }).fail(function () {
    $(".main-content").html(
      '<div class="alert alert-danger">Erro ao carregar a página.</div>'
    );
  });
}

// Carrega a página inicial quando o DOM estiver pronto
$(document).ready(function () {
  // Verifica se há uma página específica na URL
  const urlParams = new URLSearchParams(window.location.search);
  const pagina = urlParams.get("pagina") || "dashboard";

  // Carrega a página
  carregarPagina(pagina);

  // Configura os cliques nos links do menu
  $(".sidebar-menu a").on("click", function (e) {
    e.preventDefault();
    const pagina = $(this).data("page");
    carregarPagina(pagina);
  });

  // Toggle do submenu
  $(".sidebar-menu li.has-submenu > a").on("click", function (e) {
    e.preventDefault();
    $(this).parent().toggleClass("active");
  });

  // Toggle do dropdown do usuário
  $(".user-dropdown").on("click", function (e) {
    e.stopPropagation();
    $(this).find(".dropdown-menu").toggle();
  });

  // Fecha o dropdown quando clicar em qualquer lugar
  $(document).on("click", function () {
    $(".dropdown-menu").hide();
  });
});

// Função para logout
function fazerLogout() {
  if (confirm("Deseja realmente sair do sistema?")) {
    window.location.href = "logout.php";
  }
}
