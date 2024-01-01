
<?php

?>

<!-- pop-up dialog box, containing a form -->
<dialog id="guestsOptions">
  <form method="dialog">
    <h4>Presentes</h4>

        <div class="gift-statistics_controls">
            <p><span id="closeStatisticsModal">Fechar</span></p>
          <a href="/lista-de-convidados/"> <p><span class="green-text">Ver Extrato</span></p></a>
        </div>
    </form>
</dialog>   
            
<style>

    #guestsOptions {
        width: 326px;
    }
    #guestsOptions>form>h4 {
        padding: 64px 0 80px;
        color: #000;
        font-family: Poligon;
        font-size: 28px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%; /* 33.6px */
    }


</style>
<script>
    const updateButton = document.getElementById("showStatistics");
    const cancelButton = document.getElementById("closeStatisticsModal");
    const guestsOptionsModal = document.getElementById("guestsOptions");
    guestsOptionsModal.returnValue = "boolean";

function openCheck(guestsOptionsModal) {
  if (guestsOptionsModal.open) {
    console.log("Dialog open");
  } else {
    console.log("Dialog closed");
  }
}

// Update button opens a modal dialog
updateButton.addEventListener("click", () => {
  guestsOptionsModal.showModal();
  openCheck(guestsOptionsModal);
});

// Form cancel button closes the dialog box
cancelButton.addEventListener("click", () => {
  guestsOptionsModal.close();
  openCheck(guestsOptionsModal);
});
</script>
