function abrirModalNovo() {
  document.getElementById("modalNovoUsuario").classList.remove("hidden");
}

function fecharModalNovo() {
  document.getElementById("formNovoUsuario").reset();
  document.getElementById("modalNovoUsuario").classList.add("hidden");
}

document
  .getElementById("formNovoUsuario")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const dados = Object.fromEntries(formData.entries());

    fetch("../backend/salvar_usuario.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(dados),
    })
      .then((res) => res.json())
      .then((res) => {
        if (res.sucesso) {
          alert("Usuário cadastrado com sucesso!");
          fecharModalNovo();
          carregarUsuarios();
        } else {
          alert("Erro ao cadastrar: " + res.erro);
        }
      })
      .catch((err) => {
        console.error("Erro:", err);
        alert("Erro ao enviar os dados.");
      });
  });

function carregarUsuarios() {
  fetch("../backend/get_usuarios.php")
    .then((res) => res.json())
    .then((dados) => {
      const tbody = document.getElementById("tabelaUsuarios");
      tbody.innerHTML = "";
      dados.forEach((usuario) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td class="p-2 border">${usuario.nome}</td>
            <td class="p-2 border">${usuario.usuario}</td>
            <td class="p-2 border">${usuario.permissao}</td>
            <td class="p-2 border">
              <button class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600">Editar</button>
              <button class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">Excluir</button>
            </td>
          `;
        tbody.appendChild(tr);
      });
    });
}

carregarUsuarios();
