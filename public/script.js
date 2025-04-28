// script.js - Código completo atualizado

// Inicializa os ícones Lucide
lucide.createIcons();

// Função principal que roda quando o DOM estiver carregado
document.addEventListener("DOMContentLoaded", function () {
  // Elementos do modal
  const modal = document.getElementById("confirmationModal");
  const closeModalButton = document.getElementById("closeModalButton");
  const modalCloseButton = document.getElementById("modalCloseButton");

  // Função para fechar o modal
  function closeModal() {
    modal.style.display = "none";
    window.location.href = "../backend/agradecimento.html";
  }

  // Event listeners para fechar o modal
  if (closeModalButton) closeModalButton.addEventListener("click", closeModal);
  if (modalCloseButton) modalCloseButton.addEventListener("click", closeModal);

  // Fechar modal ao clicar fora do conteúdo
  modal.addEventListener("click", function (e) {
    if (e.target === modal) closeModal();
  });

  // Mostrar/ocultar campos de acompanhantes baseado na seleção
  document.getElementById("type").addEventListener("change", function () {
    const isParticipating = this.value === "sim";
    document
      .getElementById("companionCountGroup")
      .classList.toggle("hidden", !isParticipating);
    document
      .getElementById("acomp11a17Group")
      .classList.toggle("hidden", !isParticipating);
    document
      .getElementById("acomp04a10Group")
      .classList.toggle("hidden", !isParticipating);
  });

  // Carregar colaboradores quando selecionar um setor
  document
    .getElementById("setor")
    .addEventListener("change", async function () {
      const setor = this.value;
      const nomeSelect = document.getElementById("nome");
      const contratacaoInput = document.getElementById("contratacao");
      const colIdInput = document.getElementById("col_id");

      // Resetar campos dependentes
      nomeSelect.innerHTML =
        '<option value="">Selecione um colaborador</option>';
      contratacaoInput.value = "";
      colIdInput.value = "";

      if (!setor) return;

      try {
        // Estado de carregamento
        nomeSelect.disabled = true;
        const loadingOption = document.createElement("option");
        loadingOption.value = "";
        loadingOption.textContent = "Carregando...";
        loadingOption.disabled = true;
        nomeSelect.appendChild(loadingOption);

        // Buscar colaboradores do setor selecionado
        const response = await fetch(
          `../backend/get_colaboradores.php?setor=${encodeURIComponent(setor)}`
        );

        if (!response.ok) throw new Error("Erro ao carregar colaboradores");

        const colaboradores = await response.json();

        // Preencher select com os colaboradores
        nomeSelect.innerHTML =
          '<option value="">Selecione um colaborador</option>';
        colaboradores.forEach((colab) => {
          const option = document.createElement("option");
          option.value = colab.nome;
          option.textContent = colab.nome;
          option.dataset.contratacao = colab.contratacao;
          option.dataset.id = colab.id;
          nomeSelect.appendChild(option);
        });

        nomeSelect.disabled = false;
      } catch (error) {
        console.error("Erro:", error);
        nomeSelect.innerHTML =
          '<option value="">Erro ao carregar colaboradores</option>';
        nomeSelect.disabled = false;
      }
    });

  // Preencher tipo de contratação e ID quando selecionar um colaborador
  document.getElementById("nome").addEventListener("change", function () {
    const contratacaoInput = document.getElementById("contratacao");
    const colIdInput = document.getElementById("col_id");
    const selectedOption = this.selectedOptions[0];

    if (selectedOption && selectedOption.dataset.contratacao) {
      contratacaoInput.value = selectedOption.dataset.contratacao;
      colIdInput.value = selectedOption.dataset.id || "";
    } else {
      contratacaoInput.value = "";
      colIdInput.value = "";
    }
  });

  // Botão de voltar ao topo
  const scrollToTopBtn = document.getElementById("scrollToTop");
  if (scrollToTopBtn) {
    scrollToTopBtn.addEventListener("click", function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  // Envio do formulário de confirmação
  const rsvpForm = document.getElementById("rsvpForm");
  if (rsvpForm) {
    rsvpForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      const formData = new FormData(rsvpForm);
      const submitBtn = rsvpForm.querySelector('button[type="submit"]');
      const originalBtnText = submitBtn.innerHTML;

      try {
        // Mostrar estado de carregamento
        submitBtn.disabled = true;
        submitBtn.innerHTML =
          '<i data-lucide="loader" class="animate-spin"></i> Enviando...';
        lucide.createIcons();

        // Validar campos obrigatórios
        if (!formData.get("col_id") || !formData.get("type")) {
          throw new Error("Por favor, preencha todos os campos obrigatórios");
        }

        // Enviar dados para o backend
        const response = await fetch("../backend/confirmar.php", {
          method: "POST",
          body: formData,
          headers: {
            "X-Requested-With": "XMLHttpRequest", // Adiciona este header
          },
        });

        const result = await response.json();

        if (!response.ok || !result.success) {
          throw new Error(result.message || "Erro ao processar confirmação");
        }

        // Preencher modal com os dados confirmados
        document.getElementById("confirmName").textContent =
          formData.get("nome");
        document.getElementById("confirmEmail").textContent =
          formData.get("email");
        document.getElementById("confirmDepartment").textContent =
          formData.get("setor");
        document.getElementById("confirmType").textContent =
          formData.get("contratacao");

        // Exibir valor calculado ou isenção
        if (formData.get("type") === "sim") {
          document.getElementById(
            "confirmPrice"
          ).textContent = `R$ ${result.valor_pagar.toFixed(2)}`;
        } else {
          document.getElementById("confirmPrice").textContent =
            "Isento (não participará)";
        }

        // Mostrar modal de confirmação
        modal.style.display = "flex";

        // Opcional: Limpar formulário após sucesso
        // rsvpForm.reset();
      } catch (error) {
        console.error("Erro:", error);
        alert(
          error.message ||
            "Ocorreu um erro ao enviar os dados. Por favor, tente novamente."
        );
      } finally {
        // Restaurar estado do botão
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        lucide.createIcons();
      }
    });
  }
});

// Função auxiliar para exibir mensagens de erro
function showError(message) {
  const errorElement = document.createElement("div");
  errorElement.className = "error-message";
  errorElement.textContent = message;

  // Adicionar ao topo do formulário
  const form = document.getElementById("rsvpForm");
  if (form) {
    form.prepend(errorElement);

    // Remover após 5 segundos
    setTimeout(() => {
      errorElement.remove();
    }, 5000);
  } else {
    alert(message);
  }
}

// Carrossel automático
document.addEventListener("DOMContentLoaded", function () {
  const slides = document.querySelectorAll(".background-slide");
  let currentIndex = 0;
  const intervalTime = 4000; // tempo em ms (4 segundos)

  function showNextSlide() {
    slides[currentIndex].classList.remove("active");
    currentIndex = (currentIndex + 1) % slides.length;
    slides[currentIndex].classList.add("active");
  }

  setInterval(showNextSlide, intervalTime);
});

document.getElementById("rsvpForm").addEventListener("submit", function (e) {
  e.preventDefault(); // Impede o envio normal do formulário

  const form = new FormData(this);
  form.append(
    "attendee",
    JSON.stringify({
      setor: document.getElementById("setor").value,
      nome: document.getElementById("nome").value,
      email: document.getElementById("email").value,
      contratacao: document.getElementById("contratacao").value,
    })
  );
  form.append("price", totalPrice); // Adiciona o preço total

  fetch("send_email.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        // Exibe a confirmação para o usuário
        document.getElementById("confirmationModal").style.display = "block";
      } else {
        alert("Erro ao enviar o e-mail: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Erro ao enviar e-mail:", error);
    });
});
