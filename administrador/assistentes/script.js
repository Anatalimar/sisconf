$(document).ready(function() {
  // Carrega a página inicial
  carregarPagina(getPaginaAtual());
  
  // Configura os cliques no menu
  $(".sidebar-menu a").on('click', function(e) {
      e.preventDefault();
      const pagina = $(this).data('page');
      carregarPagina(pagina);
  });
});

function getPaginaAtual() {
  const urlParams = new URLSearchParams(window.location.search);
  let pagina = urlParams.get('pagina');
  
  // Lista de páginas válidas (igual ao seu PHP)
  const paginasValidas = [
      'dashboard', 'usuarios', 'colaboradores', 'pagamentos',
      'relatorio-usuarios', 'relatorio-colaboradores', 'relatorio-pagamentos'
  ];
  
  // Verifica se a página é válida ou usa dashboard como padrão
  return paginasValidas.includes(pagina) ? pagina : 'dashboard';
}

function carregarPagina(pagina) {
  // Atualiza a URL
  history.pushState(null, null, `?pagina=${pagina}`);
  
  // Mostra loading
  $(".main-content").html(
      '<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-3x"></i></div>'
  );
  
  // Carrega o conteúdo
  $.get(`${pagina}.php`, function(data) {
      $(".main-content").html(data);
      // Atualiza o menu ativo
      atualizarMenuAtivo(pagina);
  }).fail(function() {
      $(".main-content").html(
          '<div class="alert alert-danger">Erro ao carregar a página.</div>'
      );
  });
}

function atualizarMenuAtivo(pagina) {
  $(".sidebar-menu li").removeClass("active");
  
  // Encontra o link correspondente à página
  $(`.sidebar-menu li a[data-page="${pagina}"]`).parent().addClass("active");
  
  // Caso especial para relatórios (se estiverem em submenus)
  if (pagina.startsWith('relatorio-')) {
      $(".sidebar-menu li a[data-page='relatorios']").parent().addClass("active");
  }
}

// Função para logout (mantida da sua versão)
function fazerLogout() {
  if (confirm("Deseja realmente sair do sistema?")) {
      window.location.href = "logout.php";
  }
}

// Manipula o botão voltar/avançar do navegador
window.onpopstate = function() {
  carregarPagina(getPaginaAtual());
};