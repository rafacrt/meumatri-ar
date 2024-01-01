/**
 * Impede que o usuário saia sem salvar a pagina
 */
(function () {
  // Variável para verificar se houve alterações na página
  let hasUnsavedChanges = false;

  // Monitora alterações nos campos de entrada do formulário
  const formInputs = document.querySelectorAll('input, textarea');
  formInputs.forEach(input => {
    input.addEventListener('change', function () {
      hasUnsavedChanges = true;
    });
  });

  // Monitora cliques em links do site
  const siteLinks = document.querySelectorAll('a');
  siteLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      if (hasUnsavedChanges) {
        e.preventDefault();
        const confirmationMessage = 'Você tem alterações não salvas. Tem certeza de que deseja sair da página?';
        e.returnValue = confirmationMessage;
        return confirmationMessage;
      }
    });
  });

  // Monitora a tentativa de fechar a página
  window.addEventListener('beforeunload', function (e) {
    if (hasUnsavedChanges) {
      const confirmationMessage = 'Você tem alterações não salvas. Tem certeza de que deseja sair da página?';
      e.returnValue = confirmationMessage;
      return confirmationMessage;
    }
  });
})();
